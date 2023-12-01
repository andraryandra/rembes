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
                                <th>Name Reimburse</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th width="280px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($rembes as $key => $rembes_list)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rembes_list->name }}</td>
                                    <td>{{ $rembes_list->categoryTahun->nama_category_tahun }}</td>
                                    <td>
                                        @php
                                            $tanggal = \Carbon\Carbon::parse($rembes_list->tanggal_ticket)->locale('id_ID');
                                        @endphp
                                        {{ $tanggal->isoFormat('dddd, D MMMM YYYY') ?? 'No Date' }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge
                                            @if ($rembes_list->status == 'PENDING') btn-warning
                                            @elseif ($rembes_list->status == 'APPROVED')
                                            btn-success
                                            @elseif ($rembes_list->status == 'REJECTED')
                                            btn-danger @endif
                                            text-start">
                                            {{ $rembes_list->status }}
                                        </span>
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
                                        @can('rembes-list')
                                            <a class="badge
                                            badge-light-info text-start"
                                                href="{{ route('dashboard.rembes.show', $rembes_list->id) }}">
                                                <i data-feather="eye"></i>
                                                View
                                            </a>
                                        @endcan
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
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
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
