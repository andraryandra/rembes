<?php

namespace App\Http\Controllers\Web\Rembes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
                ],
                [
                    'rembes_id.required' => 'Rembes harus diisi',
                    'nama_rembes.required' => 'Nama Rembes harus diisi',
                    'nominal.required' => 'Nominal harus diisi',
                    'tanggal_rembes.required' => 'Tanggal Rembes harus diisi',
                    'tanggal_rembes.date' => 'Tanggal Rembes harus berupa tanggal',
                ]
            );

            $rembes = \App\Models\Rembes::findOrFail($id);

            // Simpan data ke dalam database
            $rembes_item = \App\Models\RembesItem::create([
                'rembes_id' => $rembes->id,
                'nama_rembes' => $request->nama_rembes,
                'nominal' => $request->nominal,
                'tanggal_rembes' => $request->tanggal_rembes,
                'deskripsi' => $request->deskripsi,
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
    public function edit($id, $rembes): \Illuminate\Contracts\View\View
    {
        $data = [
            'active' => 'rembes-item',
            'rembes' => \App\Models\Rembes::findOrFail($rembes),
            'rembes_item' => \App\Models\RembesItem::findOrFail($id),
            'users' => \App\Models\User::get(),
            'categories' => \App\Models\CategoryTahun::get(),
        ];

        return view('pages.s_user.karyawan.m_rembes_item.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @param  \App\Models\RembesItem  $rembesItem
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id, $rembes): \Illuminate\Http\RedirectResponse
    {
        try {
            // Validasi input
            $this->validate(
                $request,
                [
                    'rembes_id' => 'required|numeric',
                    'nama_rembes' => 'required|string',
                    'nominal' => 'required|numeric',
                    'tanggal_rembes' => 'required|date',
                    'deskripsi' => 'nullable|string',
                ],
                [
                    'rembes_id.required' => 'Rembes harus diisi',
                    'nama_rembes.required' => 'Nama Rembes harus diisi',
                    'nominal.required' => 'Nominal harus diisi',
                    'tanggal_rembes.required' => 'Tanggal Rembes harus diisi',
                    'tanggal_rembes.date' => 'Tanggal Rembes harus berupa tanggal',
                ]
            );

            // Cari data yang akan diupdate
            $rembes = \App\Models\Rembes::findOrFail($rembes);
            $rembes_item = \App\Models\RembesItem::findOrFail($id);

            // Update data
            $rembes_item->update([
                'rembes_id' => $rembes->id,
                'nama_rembes' => $request->nama_rembes,
                'nominal' => $request->nominal,
                'tanggal_rembes' => $request->tanggal_rembes,
                'deskripsi' => $request->deskripsi,
            ]);

            // Redirect atau berikan respon sukses
            return redirect()->route('dashboard.rembes-item.index', $rembes_item->rembes_id)->with('success', 'Data berhasil diperbarui');
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
    public function destroy($id, $rembes): \Illuminate\Http\RedirectResponse
    {
        try {
            // Cari data yang akan dihapus
            $rembes = \App\Models\Rembes::findOrFail($rembes);
            $rembes_item = \App\Models\RembesItem::findOrFail($id);

            // Hapus data
            $rembes_item->delete();

            // Redirect atau berikan respon sukses
            return redirect()->route('dashboard.rembes-item.index', $rembes_item->rembes_id)->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Redirect atau berikan respon gagal
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
