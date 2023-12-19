<?php

namespace App\Http\Controllers\Web\Rembes;

use App\Models\Rembes;
use Illuminate\Http\Request;
use App\Models\CommentRembes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RembesSuccessController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        $data = [
            'rembes' => \App\Models\Rembes::where('status', 'SUCCESS')->get(),
            'active' => 'submission-success',
        ];

        return view('pages.s_user.bendahara.m_submission_success.index', $data);
    }

    public function getApprovedCount(Request $request)
    {
        $approvedCount = \App\Models\Rembes::where('status', 'APPROVED')->count();
        return response()->json(['approvedCount' => $approvedCount]);
    }

    public function create()
    {
        $data = [
            'rembes' => \App\Models\Rembes::where('status', 'APPROVED')->get(),
            'active' => 'submission-success',
        ];

        return view('pages.s_user.bendahara.m_submission_success.create', $data);
    }

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
                    'comment.*' => 'string',
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
                    return redirect()->route('dashboard.submission-success.index')->with(['error' => 'Data tidak ditemukan']);
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

            return redirect()->route('dashboard.submission-success.index')->with(['success' => 'Data Berhasil Diperbarui!']);
        } catch (\Exception $e) {
            // Rollback the database transaction in case of an exception
            DB::rollback();

            return redirect()->route('dashboard.submission-success.index')->with(['error' => $e->getMessage()]);
        }
    }
}
