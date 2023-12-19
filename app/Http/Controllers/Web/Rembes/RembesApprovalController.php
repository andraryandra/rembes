<?php

namespace App\Http\Controllers\Web\Rembes;

use App\Models\Rembes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;

class RembesApprovalController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:submission-approved-list|submission-approved-create|submission-approved-edit|submission-approved-delete', ['only' => ['index']]);
        $this->middleware('permission:submission-approved-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:submission-approved-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:submission-approved-delete', ['only' => ['destroy']]);
        $this->middleware('permission:submission-artikel-list', ['only' => ['show', 'commentStore', 'commentUpdate']]);
    }

    public function index(): \Illuminate\Contracts\View\View
    {
        // dd('test');
        $data = [
            'rembes' => \App\Models\Rembes::where('status', 'APPROVED')->get(),
            'active' => 'submission-approved',
        ];

        return view('pages.s_user.manager.m_submission_approved.index', $data);
    }

    public function getPendingCount(Request $request)
    {
        $pendingCount = \App\Models\Rembes::where('status', 'PENDING')->count();
        return response()->json(['pendingCount' => $pendingCount]);
    }


    public function create()
    {
        $data = [
            'rembes' => \App\Models\Rembes::where('status', 'PENDING')->get(),
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

    public function show($id): \Illuminate\Contracts\View\View
    {
        if (Gate::denies('submission-artikel-list')) {
            abort(403, 'Anda tidak memiliki hak untuk melihat data ini');
        }
        $data = [
            'rembes' => \App\Models\Rembes::findOrFail($id),
            'rembes_item' => \App\Models\RembesItem::where('rembes_id', $id)->get(),
            'rembes_nominal_item' => \App\Models\RembesItem::where('rembes_id', $id)->sum('nominal'),
            'comment' => \App\Models\CommentRembes::where('rembes_id', $id)->orderByDesc('created_at')->paginate(10),

            'active' => '',
        ];

        return view('pages.s_user.manager.m_submission_approved.comment-show',  $data);
    }


    public function commentStore(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
        ], [
            'comment.required' => 'Komentar harus diisi',
        ]);

        $rembes = Rembes::find($id);

        if (!$rembes) {
            return Redirect::route('dashboard.submission-approved.index')->with(['error' => 'Data tidak ditemukan']);
        }

        $comment = new \App\Models\CommentRembes([
            'rembes_id' => $rembes->id,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment,
        ]);

        if ($comment->save()) {
            return redirect()->back()->with(['success' => 'Komentar Berhasil Ditambahkan!']);
        } else {
            return redirect()->back()->with(['error' => 'Komentar Gagal Ditambahkan!']);
        }
    }

    public function commentUpdate(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required',
        ], [
            'comment.required' => 'Komentar harus diisi',
        ]);

        try {
            $comment = \App\Models\CommentRembes::findOrFail($id);
            $comment->comment = $request->comment;

            if ($comment->save()) {
                return back()->with(['success' => 'Komentar Berhasil Diperbarui!']);
            } else {
                return back()->with(['error' => 'Komentar Gagal Diperbarui!']);
            }
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }


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

    // public function update(Request $request)
    // {
    //     try {
    //         // Validate the request
    //         $this->validate(
    //             $request,
    //             [
    //                 'id' => 'required|array',
    //                 'id.*' => 'exists:rembes,id', // Validate that each ID exists in the 'rembes' table
    //                 'status' => 'required',
    //                 'comment' => 'nullable|array', // Change 'description' to 'comment'
    //                 'comment.*' => 'string', // Each comment in the array must be a string
    //             ],
    //             [
    //                 'id.required' => 'Pilih setidaknya satu Data Rembes untuk diperbarui',
    //                 'status.required' => 'Status harus diisi',
    //             ]
    //         );

    //         // Get an array of selected IDs and comments
    //         $selectedIds = $request->input('id');
    //         $comments = $request->input('comment', []);

    //         // Begin the database transaction
    //         DB::beginTransaction();

    //         // Perform updates for each selected ID
    //         foreach ($selectedIds as $id) {
    //             $rembes = \App\Models\Rembes::find($id);

    //             if (!$rembes) {
    //                 // Rollback the database transaction and return an error message
    //                 DB::rollback();
    //                 return redirect()->route('dashboard.submission-approved.index')->with(['error' => 'Data tidak ditemukan']);
    //             }

    //             $rembes->status = $request->status;

    //             // Clean up existing CommentRembes entries for the current Rembes
    //             \App\Models\CommentRembes::where('rembes_id', $id)->where('user_id', Auth::user()->id)->delete();

    //             // Iterate through each comment and create new CommentRembes entries
    //             foreach ($comments as $comment) {
    //                 // Create a new instance of CommentRembes
    //                 $commentInstance = new \App\Models\CommentRembes();

    //                 // Set values for 'rembes_id' and 'user_id' in the CommentRembes model
    //                 $commentInstance->rembes_id = $rembes->id;
    //                 $commentInstance->user_id = Auth::user()->id;
    //                 $commentInstance->comment = $comment;

    //                 // Save the CommentRembes instance to the database
    //                 $commentInstance->save();
    //             }

    //             $rembes->save();
    //         }

    //         // Commit the database transaction
    //         DB::commit();

    //         return redirect()->route('dashboard.submission-approved.index')->with(['success' => 'Data Berhasil Diperbarui!']);
    //     } catch (\Exception $e) {
    //         // Rollback the database transaction in case of an exception
    //         DB::rollback();

    //         return redirect()->route('dashboard.submission-approved.index')->with(['error' => $e->getMessage()]);
    //     }
    // }


    public function update(Request $request)
    {
        try {
            // Validate the request
            $this->validate(
                $request,
                [
                    'id' => 'required|array',
                    'id.*' => 'exists:rembes,id',
                    'status' => 'required',
                    'comment' => 'nullable|array',
                ],
                [
                    'id.required' => 'Pilih setidaknya satu Data Rembes untuk diperbarui',
                    'status.required' => 'Status harus diisi',


                ]
            );

            // Get an array of selected IDs and comments
            $selectedIds = $request->input('id');
            $comments = $request->input('comment', []);

            // Begin the database transaction
            DB::beginTransaction();

            // Perform updates for each selected ID
            foreach ($selectedIds as $id) {
                $rembes = \App\Models\Rembes::find($id);

                if (!$rembes) {
                    // Rollback the database transaction and return an error message
                    DB::rollback();
                    return redirect()->route('submission-approved.index')->with(['error' => 'Data tidak ditemukan']);
                }

                $rembes->status = $request->status;
                $rembes->save(); // Save status update first

                // Iterate through each comment and create new CommentRembes entries
                foreach ($comments as $comment) {
                    // Create a new instance of CommentRembes
                    $commentInstance = new \App\Models\CommentRembes();

                    // Set values for 'rembes_id' and 'user_id' in the CommentRembes model
                    $commentInstance->rembes_id = $rembes->id;
                    $commentInstance->user_id = Auth::user()->id;
                    $commentInstance->comment = $comment;

                    // Save the CommentRembes instance to the database
                    $commentInstance->save();
                }
            }

            // Commit the database transaction
            DB::commit();

            return redirect()->route('dashboard.submission-approved.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } catch (\Exception $e) {
            // Rollback the database transaction in case of an exception
            DB::rollback();

            return back()->with(['error' => $e->getMessage()]);
        }
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
