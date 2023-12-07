<?php

namespace App\Http\Controllers\Web\Rembes;

use App\Models\Rembes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RembesApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:submission-approved-list|submission-approved-create|submission-approved-edit|submission-approved-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:submission-approved-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:submission-approved-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:submission-approved-delete', ['only' => ['destroy']]);
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        // dd('test');
        $data = [
            'rembes' => \App\Models\Rembes::get(),
            'active' => 'submission-approved',
        ];

        return view('pages.s_user.manager.m_submission_approved.index', $data);
    }

    public function create()
    {
        $data = [
            'rembes' => \App\Models\Rembes::get(),
            'active' => 'submission-approved',
        ];

        return view('pages.s_user.manager.m_submission_approved.create', $data);
    }

    // public function show($id): \Illuminate\Contracts\View\View
    // {
    //     // dd("oke");
    //     $data = [
    //         'rembes' => \App\Models\Rembes::findOrFail($id),
    //         'rembes_item' => \App\Models\RembesItem::where('rembes_id', $id)->get(),
    //         'rembes_nominal_item' => \App\Models\RembesItem::where('rembes_id', $id)->sum('nominal'),
    //         'active' => 'submission-approved',
    //     ];

    //     return view('pages.s_user.manager.m_submission_approved.show',  $data);
    // }

    public function edit($id): \Illuminate\Contracts\View\View
    {
        // dd("oke");
        $data = [
            'rembes' => \App\Models\Rembes::findOrFail($id),
            'categories' => \App\Models\CategoryTahun::get(),
            'active' => 'submission-approved',
        ];

        return view('pages.s_user.manager.m_submission_approved.edit',  $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        // Validate the request
        $this->validate(
            $request,
            [
                'id' => 'required|array',
                'id.*' => 'exists:rembes,id', // Validate that each ID exists in the 'rembes' table
                'status' => 'required',
                'description' => 'nullable',
            ],
            [
                'id.required' => 'Pilih setidaknya satu Data Rembes untuk diperbarui',
                // 'user_id.required' => 'User harus diisi',
                'status.required' => 'Status harus diisi',
            ]
        );

        // Get an array of selected IDs
        $selectedIds = $request->input('id');

        // Perform updates for each selected ID
        foreach ($selectedIds as $id) {
            $rembes = \App\Models\Rembes::find($id);

            if (!$rembes) {
                return redirect()->route('dashboard.submission-approved.index')->with(['error' => 'Data tidak ditemukan']);
            }

            $rembes->status = $request->status;
            $rembes->description = $request->description;

            $rembes->save();
        }

        return redirect()->route('dashboard.submission-approved.index')->with(['success' => 'Data Berhasil Diperbarui!']);
    }

    public function updateOneReimburse($id, Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'tanggal_ticket' => 'required',
                'status' => 'required',
                'description' => 'nullable',
            ],
            [
                'name.required' => 'Nama reimburse harus diisi',
                'tanggal_ticket.required' => 'Tanggal reimburse harus di isi',
                'status.required' => 'Status harus diisi',
            ]
        );

        // Update Rembes
        $rembes = \App\Models\Rembes::find($id);
        if (!$rembes) {
            return redirect()->route('dashboard.submission-approved.index')->with(['error' => 'Data tidak ditemukan']);
        }

        $rembes->name = $request->name;
        $rembes->tanggal_ticket = $request->tanggal_ticket;
        $rembes->status = $request->status;
        $rembes->description = $request->description;

        if ($rembes->save()) {
            return redirect()->route('dashboard.submission-approved.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } else {
            return redirect()->route('dashboard.submission-approved.index')->with(['error' => 'Data Gagal Diperbarui!']);
        }
    }


    // public function update(Request $request, $id)
    // {
    //     // dd("oke");
    //     // dd($request->all());
    //     $this->validate(
    //         $request,
    //         [
    //             'user_id' => 'required',
    //             'status' => 'required',
    //             'description' => 'nullable',
    //         ],
    //         [
    //             'user_id.required' => 'User harus diisi',
    //             'status.required' => 'status harus diisi',
    //         ]
    //     );

    //     $rembes = \App\Models\Rembes::find($id);

    //     if (!$rembes) {
    //         return redirect()->route('dashboard.submission-approved.index')->with(['error' => 'Data tidak ditemukan']);
    //     }

    //     $rembes->user_id = $request->user_id;
    //     $rembes->status = $request->status;
    //     $rembes->description = $request->description;

    //     if ($rembes->save()) {
    //         return redirect()->route('dashboard.submission-approved.index')->with(['success' => 'Data Berhasil Diperbarui!']);
    //     } else {
    //         return redirect()->route('dashboard.submission-approved.index')->with(['error' => 'Data Gagal Diperbarui!']);
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id): \Illuminate\Http\RedirectResponse
    // {
    //     dd("oke");
    //     // Ambil model Rembes dari database berdasarkan ID
    //     $rembes = Rembes::find($id);

    //     // Pastikan model ditemukan sebelum melanjutkan
    //     if ($rembes) {
    //         // Hapus foto_bukti terkait
    //         if ($rembes->foto_bukti) {
    //             $fotoBuktiFiles = explode(',', $rembes->foto_bukti);
    //             foreach ($fotoBuktiFiles as $file) {
    //                 $filePath = storage_path('app/public/foto_bukti/' . $file);

    //                 if (file_exists($filePath)) {
    //                     unlink($filePath);
    //                 }
    //             }
    //         }

    //         // Hapus data Rembes
    //         $rembes->delete();

    //         return redirect()->route('dashboard.rembes.index')
    //             ->with('success', 'Rembes deleted successfully');
    //     } else {
    //         // Model tidak ditemukan, berikan respon yang sesuai
    //         return redirect()->route('dashboard.rembes.index')
    //             ->with('error', 'Rembes not found');
    //     }
    // }

    public function reimburseItem($id): \Illuminate\Contracts\View\View
    {
        // dd("oke");
        $data = [
            'rembes' => \App\Models\Rembes::findOrFail($id),
            'rembes_item' => \App\Models\RembesItem::where('rembes_id', $id)->get(),
            'rembes_nominal_item' => \App\Models\RembesItem::where('rembes_id', $id)->sum('nominal'),
            'active' => 'submission-approved',
        ];

        return view('pages.s_user.manager.m_submission_approved.reimburse_item',  $data);
    }

    public function invoice($id): \Illuminate\Contracts\View\View
    {
        // dd("oke");
        $data = [
            'rembes' => \App\Models\Rembes::findOrFail($id),
            'rembes_item' => \App\Models\RembesItem::where('rembes_id', $id)->get(),
            'rembes_nominal_item' => \App\Models\RembesItem::where('rembes_id', $id)->sum('nominal'),
            'active' => 'submission-approved',
        ];

        return view('pages.s_user.manager.m_submission_approved.invoice',  $data);
    }
}
