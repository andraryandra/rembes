@extends('layouts.app')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">User</li>
                <li class="breadcrumb-item active" aria-current="page">Create New Rembes</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="row my-3">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('dashboard.rembes.index') }}">
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
                <form action="{{ route('dashboard.rembes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group my-2">
                        <label for="user_id">User:</label>
                        <input style="display: none;" type="text" name="user_id" id="user_id" class="form-control"
                            value="{{ Auth::user()->id }}">
                        <input type="text" name="nama_user" id="nama_user" class="form-control" disabled
                            value="{{ Auth::user()->name }}">
                    </div>

                    <div class="form-group my-2">
                        <label for="user_id">Reimbursement Name:</label>
                        <input type="text" name="name" id="nama" class="form-control" value="{{ old('name') }}"
                            placeholder="Enter the reimbursement name">
                    </div>

                    <div class="form-group my-2">
                        <label for="category_tahun_id">Category:</label>
                        <select class="form-select" name="category_tahun_id" id="category_tahun_id" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_tahun_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama_category_tahun }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group my-2">
                        <label for="tanggal_ticket">Tanggal:</label>
                        <input type="date" name="tanggal_ticket" id="tanggal_ticket" class="form-control"
                            value="{{ old('tanggal_ticket') }}" required>
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
