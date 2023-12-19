@extends('layouts.app')
@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reimburse</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    @include('layouts.partials.alert-prompt.alert')
    <div class="searchable-container">

        <div class="switch align-self-center">

            @can('rembes-create')
                <a class="btn btn-primary" href="{{ route('dashboard.rembes.create') }}">
                    <i class="far fa-plus-square"></i>
                    Add New Rembes
                </a>
            @endcan

        </div>
    </div>

    <div class="row
                        layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">


            <div class="widget-content widget-content-area br-8" id="rembesContainer">
                <div class="me-auto col-md-2 mx-3 my-3">
                    <form action="{{ route('dashboard.rembes.index') }}" method="GET">
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua
                            </option>
                            <option value="PENDING" {{ request('status') == 'PENDING' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="APPROVED" {{ request('status') == 'APPROVED' ? 'selected' : '' }}>
                                Approved
                            </option>
                            <option value="SUCCESS" {{ request('status') == 'SUCCESS' ? 'selected' : '' }}>
                                Success</option>
                            <option value="REJECTED" {{ request('status') == 'REJECTED' ? 'selected' : '' }}>
                                Rejected
                            </option>
                        </select>
                    </form>
                </div>
                <table id="zero-config" class="table dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name Reimburse</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rembes as $key => $rembes_list)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @can('submission-artikel-list')
                                        <a class="text-primary" style="text-decoration: underline;"
                                            href="{{ route('dashboard.submission.show', $rembes_list->id) }}">
                                            {{ $rembes_list->name }}
                                        </a>
                                    @endcan
                                </td>

                                <td>{{ $rembes_list->categoryTahun->nama_category_tahun }}</td>
                                <td>
                                    @php
                                        $tanggal = \Carbon\Carbon::parse($rembes_list->tanggal_ticket)->locale('id_ID');
                                    @endphp
                                    {{ $tanggal->isoFormat('dddd, D MMMM YYYY') ?? 'No Date' }}
                                </td>
                                <td>
                                    @if ($rembes_list->status == 'PENDING')
                                        <span class="badge badge-warning">{{ $rembes_list->status }}</span>
                                    @elseif($rembes_list->status == 'APPROVED')
                                        <span class="badge badge-info">{{ $rembes_list->status }}</span>
                                    @elseif($rembes_list->status == 'REJECTED')
                                        <span class="badge badge-danger">{{ $rembes_list->status }}</span>
                                    @elseif($rembes_list->status == 'SUCCESS')
                                        <span class="badge badge-success">{{ $rembes_list->status }}</span>
                                    @else
                                        <span class="badge badge-secondary">{{ $rembes_list->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    @can('rembes-item-list')
                                        <a class="badge
                                        badge-light-warning text-start"
                                            href="{{ route('dashboard.rembes-item.index', $rembes_list->id) }}">
                                            <i data-feather="database"></i>
                                            List Reimburse
                                        </a>
                                    @endcan
                                    {{-- @can('submission-artikel-list')
                                        <a class="badge badge-light-info text-start me-2"
                                            href="{{ route('dashboard.submission.show', $rembes_list->id) }}">
                                            <i class="fas fa-archive"></i>
                                            Artikel Ticket</a>
                                    @endcan --}}
                                    @can('rembes-list')
                                        <a class="badge
                                        badge-light-info text-start"
                                            href="{{ route('dashboard.rembes.show', $rembes_list->id) }}">
                                            <i data-feather="printer"></i>
                                            Print
                                        </a>
                                    @endcan
                                    @if ($rembes_list->status == 'PENDING' || $rembes_list->status == 'REJECTED')
                                        @can('rembes-edit')
                                            <a class="badge badge-light-primary text-start me-2"
                                                href="{{ route('dashboard.rembes.edit', $rembes_list->id) }}">
                                                <i class="far fa-edit"></i>
                                                Edit</a>
                                        @endcan
                                        @can('rembes-delete')
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['dashboard.rembes.destroy', $rembes_list->id],
                                                'style' => 'display:inline',
                                                'onsubmit' => 'return confirm("Are you sure you want to delete this user?");',
                                            ]) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i> Delete', [
                                                'type' => 'submit',
                                                'class' => 'badge badge-light-danger text-start mx-3',
                                                'onclick' => 'return confirm("Are you sure you want to delete this user?");',
                                            ]) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        @push('script')
        @endpush
    @endsection
