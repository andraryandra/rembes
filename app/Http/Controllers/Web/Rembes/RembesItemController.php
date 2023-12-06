<?php

namespace App\Http\Controllers\Web\Rembes;

use App\Models\User;
use App\Models\Rembes;
use App\Models\RembesItem;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CategoryTahun;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class RembesItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:rembes-item-list|rembes-item-create|rembes-item-edit|rembes-item-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:rembes-item-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:rembes-item-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:rembes-item-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        $data = [
            'rembes_item' => \App\Models\RembesItem::where('rembes_id', $request->id)->get(),
            'rembes' => \App\Models\Rembes::findOrFail($request->id),
            'active' => 'rembes-item',
        ];

        return view('pages.s_user.karyawan.m_rembes_item.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */

    public function create($id): \Illuminate\Contracts\View\View
    {
        $data = [
            'active' => 'rembes-item',
            'rembes_item' => \App\Models\RembesItem::get(),
            'users' => \App\Models\User::get(),
            'categories' => \App\Models\CategoryTahun::get(),
            'rembes' => \App\Models\Rembes::findOrFail($id),
        ];
        return view('pages.s_user.karyawan.m_rembes_item.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        try {
            // Validasi input
            $this->validate(
                $request,
                [
                    'rembes_id' => 'nullable|numeric',
                    'nama_rembes' => 'required|string',
                    'nominal' => 'required|numeric',
                    'tanggal_rembes' => 'required|date',
                    'deskripsi' => 'nullable|string',
                    'foto_bukti.*' => 'nullable|max:2048', // Add file validation
                ],
                [
                    'rembes_id.required' => 'Rembes harus diisi',
                    'nama_rembes.required' => 'Nama Rembes harus diisi',
                    'nominal.required' => 'Nominal harus diisi',
                    'tanggal_rembes.required' => 'Tanggal Rembes harus diisi',
                    'tanggal_rembes.date' => 'Tanggal Rembes harus berupa tanggal',
                    'foto_bukti.*.max' => 'Ukuran foto maksimal 2 MB',
                ]
            );

            $rembes = \App\Models\Rembes::findOrFail($id);

            // Proses file foto_bukti
            if ($request->hasFile('foto_bukti')) {
                $uploadedFiles = $request->file('foto_bukti');
                $uploadedFileNames = [];

                foreach ($uploadedFiles as $file) {
                    // Generate a random prefix for the filename
                    $randomPrefix = Str::random(10);

                    // Combine the random prefix, underscore, and the original file name
                    $fileName = $randomPrefix . '_' . $file->getClientOriginalName();

                    // Store the file in the 'public/foto_bukti' directory
                    $file->storeAs('public/foto_bukti', $fileName);

                    // Save the filename to the array
                    $uploadedFileNames[] = $fileName;
                }

                // Save the filenames as a comma-separated string in the database
                $data['foto_bukti'] = implode(',', $uploadedFileNames);
            }

            // Simpan data ke dalam database
            $rembes_item = \App\Models\RembesItem::create([
                'rembes_id' => $rembes->id,
                'nama_rembes' => $request->nama_rembes,
                'nominal' => $request->nominal,
                'tanggal_rembes' => $request->tanggal_rembes,
                'deskripsi' => $request->deskripsi,
                'foto_bukti' => $data['foto_bukti'] ?? null, // Use null if no files were uploaded
            ]);

            // Redirect atau berikan respon sukses
            return redirect()->route('dashboard.rembes-item.index', $rembes_item->rembes_id)->with('success', 'Data berhasil disimpan');
        } catch (ValidationException $e) {
            // Tangani kesalahan validasi
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            // Tangani kesalahan umum
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RembesItem  $rembesItem
     * @return \Illuminate\Http\Response
     */
    public function show($id): \Illuminate\Contracts\View\View
    {
        $data = [
            'active' => 'rembes-item',
            'rembes' => \App\Models\Rembes::findOrFail($id),
            'rembes_item' => \App\Models\RembesItem::findOrFail($id),
        ];

        return view('pages.s_user.karyawan.m_rembes_item.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RembesItem  $rembesItem
     * @return \Illuminate\Http\Response
     */
    public function edit($rembes, $id)
    {
        try {
            $rembesItem = \App\Models\RembesItem::findOrFail($id);
            $rembesModel = \App\Models\Rembes::findOrFail($rembes);
            $rembesImageItem = \App\Models\RembesItem::select('foto_bukti')->where('id', $id)->first();
            $users = \App\Models\User::get();
            $categories = \App\Models\CategoryTahun::get();

            $data = [
                'active' => 'rembes-item',
                'rembes_item' => $rembesItem,
                'rembes' => $rembesModel,
                'rembes_image_item' => $rembesImageItem,
                'users' => $users,
                'categories' => $categories,
            ];

            return view('pages.s_user.karyawan.m_rembes_item.edit', $data);
        } catch (\Exception $e) {
            // Handle the exception (e.g., show an error page or redirect back with an error message)
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @param  \App\Models\RembesItem  $rembesItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $rembesId, $itemId): \Illuminate\Http\RedirectResponse
    {
        try {
            // Validasi input
            $this->validate(
                $request,
                [
                    'nama_rembes' => 'required|string',
                    'nominal' => 'required|numeric',
                    'tanggal_rembes' => 'required|date',
                    'deskripsi' => 'nullable|string',
                    'foto_bukti.*' => 'nullable|max:2048', // Add file validation
                ],
                [
                    'nama_rembes.required' => 'Nama Rembes harus diisi',
                    'nominal.required' => 'Nominal harus diisi',
                    'tanggal_rembes.required' => 'Tanggal Rembes harus diisi',
                    'tanggal_rembes.date' => 'Tanggal Rembes harus berupa tanggal',
                    'foto_bukti.*.max' => 'Ukuran foto maksimal 2 MB',
                ]
            );

            $rembesItem = \App\Models\RembesItem::findOrFail($itemId);

            // Proses file foto_bukti
            if ($request->hasFile('foto_bukti')) {
                $uploadedFiles = $request->file('foto_bukti');
                $uploadedFileNames = [];

                foreach ($uploadedFiles as $file) {
                    // Generate a random prefix for the filename
                    $randomPrefix = Str::random(10);

                    // Combine the random prefix, underscore, and the original file name
                    $fileName = $randomPrefix . '_' . $file->getClientOriginalName();

                    // Store the file in the 'public/foto_bukti' directory
                    $file->storeAs('public/foto_bukti', $fileName);

                    // Save the filename to the array
                    $uploadedFileNames[] = $fileName;
                }

                // Hapus foto lama
                $oldFotoBukti = explode(',', $rembesItem->foto_bukti);
                foreach ($oldFotoBukti as $oldFileName) {
                    Storage::delete('public/foto_bukti/' . $oldFileName);
                }

                // Save the filenames as a comma-separated string in the database
                $rembesItem->foto_bukti = implode(',', $uploadedFileNames);
            } else {
                // No new files uploaded, set foto_bukti to empty string
                $rembesItem->foto_bukti = '';
            }

            // Update data in the database
            $rembesItem->update([
                'nama_rembes' => $request->nama_rembes,
                'nominal' => $request->nominal,
                'tanggal_rembes' => $request->tanggal_rembes,
                'deskripsi' => $request->deskripsi,
            ]);

            // Redirect atau berikan respon sukses
            return redirect()->route('dashboard.rembes-item.index', $rembesItem->rembes_id)->with('success', 'Data berhasil diupdate');
        } catch (ValidationException $e) {
            // Tangani kesalahan validasi
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            // Tangani kesalahan umum
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RembesItem  $rembesItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($rembesId, $itemId): \Illuminate\Http\RedirectResponse
    {
        try {
            $rembesItem = \App\Models\RembesItem::findOrFail($itemId);
            $rembes = $rembesItem->rembes;

            // Hapus foto
            $fotoBukti = explode(',', $rembesItem->foto_bukti);
            foreach ($fotoBukti as $fileName) {
                Storage::delete('public/foto_bukti/' . $fileName);
            }

            // Hapus data dari database
            $rembesItem->delete();

            // Redirect atau berikan respon sukses
            return redirect()->route('dashboard.rembes-item.index', $rembes->id)->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Tangani kesalahan umum
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
