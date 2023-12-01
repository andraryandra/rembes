@extends('layouts.app')
@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Submission Approved</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    @include('layouts.partials.alert-prompt.alert')

    <div class="searchable-container">
        <div class="switch align-self-center">
        </div>

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">

                    <table id="zero-config" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name </th>
                                <th>Name Reimburse</th>
                                <th>Category Tahun</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th width="280px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($rembes as $data_rembes)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data_rembes->user->name }}</td>
                                    <td>{{ $data_rembes->name }}</td>
                                    <td>{{ $data_rembes->categoryTahun->slug }}</td>
                                    <td>{{ $data_rembes->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        @if ($data_rembes->status == 'PENDING')
                                            <span class="badge badge-warning">{{ $data_rembes->status }}</span>
                                        @elseif($data_rembes->status == 'APPROVED')
                                            <span class="badge badge-success">{{ $data_rembes->status }}</span>
                                        @elseif($data_rembes->status == 'REJECTED')
                                            <span class="badge badge-danger">{{ $data_rembes->status }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $data_rembes->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('submission-approved-list')
                                            <a class="badge badge-light-primary text-start me-2"
                                                href="{{ route('dashboard.submission.show', $data_rembes->id) }}">
                                                <i class="far fa-edit"></i>show</a>
                                        @endcan

                                        @can('submission-approved-list')
                                            <a class="badge badge-light-primary text-start me-2"
                                                href="{{ route('dashboard.submission.invoice', $data_rembes->id) }}">
                                                <i class="fas fa-file-invoice"></i>Cetak Invoice</a>
                                        @endcan
                                        {{-- @can('submission-approved-edit')
                                            <a class="badge badge-light-primary text-start me-2"
                                                href="{{ route('dashboard.submission.edit', $data_rembes->id) }}">
                                                <i class="far fa-edit"></i>edit</a>
                                        @endcan --}}
                                        {{-- @can('submission-approved-delete')
                                            <form method="POST"
                                                action="{{ route('dashboard.submission.destroy', $data_rembes->id) }}"
                                                style="display:inline"
                                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="badge badge-light-danger text-start mx-3"
                                                    onclick="return confirm('Are you sure you want to delete this user?');">
                                                    <i class="far fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        @endcan --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name </th>
                                <th>Name Reimburse</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th width="280px"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
