<?php

namespace App\Http\Controllers\Web\Rembes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        $data = [
            'rembes' => \App\Models\Rembes::get(),
            'active' => 'submission-approved',
        ];

        return view('pages.s_user.manager.m_submission_approved.index', $data);
    }
}
