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
                <form action="{{ route('dashboard.submission.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table id="just-table" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th></th>
                                <th>Username</th>
                                <th>Reimburse</th>
                                <th>Nominal</th>
                                <th>Date Reimburse</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rembes as $item)
                                @if ($item->status !== 'APPROVED')
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="" type="checkbox" id="rembes_{{ $item->id }}"
                                                    name="id[]" value="{{ $item->id }}">
                                            </div>
                                        </td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            <label class="form-check-label" for="rembes_{{ $item->id }}">
                                                {{ $item->name }} - {{ $item->user->name }}
                                            </label>
                                        </td>
                                        <td>
                                            @php
                                                $totalNominal = \App\Models\RembesItem::where('rembes_id', $item->id)->sum('nominal');
                                            @endphp
                                            Rp. {{ number_format($totalNominal, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            @php
                                                $tanggal = \Carbon\Carbon::parse($item->tanggal_rembes)->locale('id_ID');
                                            @endphp
                                            {{ $tanggal->isoFormat('dddd, D MMMM YYYY') ?? 'No Date' }}
                                        </td>
                                        <td>
                                            <a class="badge badge-light-primary text-start me-2"
                                                href="{{ route('dashboard.submission.reimburseItem', $item->id) }}">
                                                <i class="far fa-eye"></i>show</a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>

                    <div class="form-group mt-5 mb-3">
                        <label for="status">Status Pengajuan:</label>
                        <select class="form-control" name="status" id="status">
                            <option disabled selected>Select Submission Status</option>
                            <option value="APPROVED">APPROVED</option>
                            <option value="REJECTED">REJECTED</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Enter description"></textarea>
                    </div>

                    <!-- Your other input fields go here -->
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
