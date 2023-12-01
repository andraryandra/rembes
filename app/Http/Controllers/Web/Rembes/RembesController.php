<?php

namespace App\Http\Controllers\Web\Rembes;

use App\Models\Rembes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class RembesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:rembes-list|rembes-create|rembes-edit|rembes-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:rembes-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:rembes-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:rembes-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        $data = [
            'rembes' => \App\Models\Rembes::get(),
            'active' => 'rembes',
        ];

        return view('pages.s_user.karyawan.m_rembes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        $data = [
            'active' => 'rembes',
            'users' => \App\Models\User::get(),
            'categories' => \App\Models\CategoryTahun::get(),
        ];
        return view('pages.s_user.karyawan.m_rembes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // dd($request->all());
        $this->validate(
            $request,
            [
                'user_id' => 'required',
                'name' => 'required',
                'category_tahun_id' => 'required',
                'tanggal_ticket' => 'required|date',
                'status' => 'nullable',
            ],
            [
                'user_id.required' => 'User harus diisi',
                'name.required' => 'Nama Reimburse harus diisi',
                'category_tahun_id.required' => 'Category Tahun harus diisi',
                'tanggal_ticket.required' => 'Tanggal harus diisi',
                'tanggal_ticket.date' => 'Tanggal harus berupa tanggal',
            ]
        );

        // dd($request);

        $rembes = \App\Models\Rembes::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'category_tahun_id' => $request->category_tahun_id,
            'tanggal_ticket' => $request->tanggal_ticket,
            'status' => 'PENDING',
        ]);

        if ($rembes) {
            return redirect()->route('dashboard.rembes.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('dashboard.rembes.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id): \Illuminate\Contracts\View\View
    {
        // dd("oke");
        $data = [
            'rembes' => \App\Models\Rembes::findOrFail($id),
            'rembes_item' => \App\Models\RembesItem::where('rembes_id', $id)->get(),
            'rembes_nominal_item' => \App\Models\RembesItem::where('rembes_id', $id)->sum('nominal'),
            'active' => 'rembes',
        ];

        return view('pages.s_user.karyawan.m_rembes.show',  $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id): \Illuminate\Contracts\View\View
    {
        $data = [
            'rembes' => \App\Models\Rembes::findOrFail($id),
            'categories' => \App\Models\CategoryTahun::get(),
            'active' => 'rembes',
        ];

        return view('pages.s_user.karyawan.m_rembes.edit',  $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'user_id' => 'required',
                'name' => 'required',
                'category_tahun_id' => 'required',
                'tanggal_ticket' => 'required|date',
                'status' => 'nullable',
            ],
            [
                'user_id.required' => 'User harus diisi',
                'name.required' => 'Nama Reimburse harus diisi',
                'category_tahun_id.required' => 'Category Tahun harus diisi',
                'tanggal_ticket.required' => 'Tanggal harus diisi',
                'tanggal_ticket.date' => 'Tanggal harus berupa tanggal',
            ]
        );

        $rembes = \App\Models\Rembes::find($id);

        if (!$rembes) {
            return redirect()->route('dashboard.rembes.index')->with(['error' => 'Data tidak ditemukan']);
        }

        $rembes->user_id = $request->user_id;
        $rembes->name = $request->name;
        $rembes->category_tahun_id = $request->category_tahun_id;
        $rembes->tanggal_ticket = $request->tanggal_ticket;
        $rembes->status = $request->status ?? 'PENDING'; // Menggunakan nilai default jika status tidak ada dalam request

        if ($rembes->save()) {
            return redirect()->route('dashboard.rembes.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } else {
            return redirect()->route('dashboard.rembes.index')->with(['error' => 'Data Gagal Diperbarui!']);
        }
    }

    // public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    // {
    //     $this->validate(
    //         $request,
    //         [
    //             'nama' => 'required',
    //             'nominal' => 'required|numeric',
    //             'tanggal' => 'required|date',
    //             'status' => 'required|in:PENDING,APPROVED,REJECTED',
    //             'deskripsi' => 'nullable|string|max:100',
    //             'foto_bukti.*' => 'nullable|max:2048',
    //         ],
    //         [
    //             'nama.required' => 'Nama harus diisi',
    //             'nominal.required' => 'Nominal harus diisi',
    //             'nominal.numeric' => 'Nominal harus berupa angka',
    //             'tanggal.required' => 'Tanggal harus diisi',
    //             'tanggal.date' => 'Tanggal harus berupa tanggal',
    //             'status.required' => 'Status harus diisi',
    //             'status.in' => 'Status harus diisi dengan PENDING, APPROVED, atau REJECTED',
    //             'deskripsi.max' => 'Deskripsi maksimal 100 karakter',
    //             'foto_bukti.*.max' => 'Foto bukti maksimal 2MB',
    //         ]
    //     );

    //     $data = $request->all();

    //     // Proses file foto_bukti
    //     if ($request->hasFile('foto_bukti')) {
    //         $uploadedFiles = $request->file('foto_bukti');
    //         $uploadedFileNames = [];

    //         foreach ($uploadedFiles as $file) {
    //             $fileName = Str::random(10) . '.' . $file->getClientOriginalExtension();
    //             Storage::putFileAs('public/foto_bukti', $file, $fileName);
    //             $uploadedFileNames[] = $fileName;
    //         }

    //         // Hapus foto lama
    //         $oldFotoBukti = explode(',', $data['foto_bukti']);
    //         foreach ($oldFotoBukti as $oldFileName) {
    //             Storage::delete('public/foto_bukti/' . $oldFileName);
    //         }

    //         $data['foto_bukti'] = implode(',', $uploadedFileNames); // Menggabungkan array menjadi string
    //     } else {
    //         // Jika foto_bukti tidak diupdate, gunakan foto lama
    //         unset($data['foto_bukti']);
    //     }


    //     $rembes = \App\Models\Rembes::findOrFail($id);
    //     $rembes->update($data);

    //     return redirect()->route('dashboard.rembes.index')
    //         ->with('success', 'Rembes updated successfully.');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        // Ambil model Rembes dari database berdasarkan ID
        $rembes = Rembes::find($id);

        // Pastikan model ditemukan sebelum melanjutkan
        if ($rembes) {
            // Hapus foto_bukti terkait
            if ($rembes->foto_bukti) {
                $fotoBuktiFiles = explode(',', $rembes->foto_bukti);
                foreach ($fotoBuktiFiles as $file) {
                    $filePath = storage_path('app/public/foto_bukti/' . $file);

                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }

            // Hapus data Rembes
            $rembes->delete();

            return redirect()->route('dashboard.rembes.index')
                ->with('success', 'Rembes deleted successfully');
        } else {
            // Model tidak ditemukan, berikan respon yang sesuai
            return redirect()->route('dashboard.rembes.index')
                ->with('error', 'Rembes not found');
        }
    }
}
