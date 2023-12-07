@extends('layouts.app')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Submission Approved</li>
                <li class="breadcrumb-item active" aria-current="page">Detail Submission</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="row my-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('dashboard.submission-approved.index') }}">
                    <i class="far fa-arrow-alt-circle-left"></i>
                    Back
                </a>
            </div>
        </div>
    </div>

    @include('layouts.partials.alert-prompt.alert')

    <div class="card ">
        <div class="row m-2">
            <div class="card-body">
                <form action="{{ route('dashboard.submission.updateOneReimburse', $rembes->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group my-2">
                        <label for="user_id">User:</label>
                        <input style="display: none;" type="text" name="user_id" id="user_id" class="form-control"
                            value="{{ $rembes->user_id }}">
                        <input type="text" name="nama_user" id="nama_user" class="form-control" disabled
                            value="{{ $rembes->user->name }}">
                    </div>

                    <div class="form-group my-2">
                        <label for="user_id">Reimbursement Name:</label>
                        <input type="text" name="name" id="nama" class="form-control" value="{{ $rembes->name }}"
                            placeholder="Enter the reimbursement name">
                    </div>

                    <div class="form-group my-2">
                        <label for="category_tahun_id">Nominal:</label>
                        <div class="input-group">
                            @php
                                $totalNominal = \App\Models\RembesItem::where('rembes_id', $rembes->id)->sum('nominal');
                            @endphp
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="text" name="nominal" id="input-harga" class="form-control"
                                placeholder="Entry your amount of money"
                                value="{{ number_format($totalNominal, 0, ',', '.') }}" required>
                        </div>
                    </div>

                    <div class="form-group my-2">
                        <label for="tanggal_ticket">Date Reimburse:</label>
                        <input type="date" name="tanggal_ticket" id="tanggal_ticket" class="form-control"
                            value="{{ $rembes->tanggal_ticket }}" required>
                    </div>

                    <div class="form-group my-2">
                        <label for="status">Status Pengajuan:</label>
                        <select class="form-control" name="status" id="status">
                            <option disabled selected>Select Submission Status</option>
                            <option value="PENDING" {{ $rembes->status == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                            <option value="APPROVED" {{ $rembes->status == 'APPROVED' ? 'selected' : '' }}>APPROVED</option>
                            <option value="REJECTED" {{ $rembes->status == 'REJECTED' ? 'selected' : '' }}>REJECTED</option>
                        </select>
                    </div>

                    <div class="form-group my-2">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Enter description">{{ $rembes->description }}</textarea>
                    </div>

                    <div class="form-group my-2">
                        <label>Detail Item Reimburse:</label><br>
                        <a class="btn btn-light-primary" href="#">Detail</a>
                    </div>

                    <div class="form-group my-3 text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="far fa-save"></i>
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
