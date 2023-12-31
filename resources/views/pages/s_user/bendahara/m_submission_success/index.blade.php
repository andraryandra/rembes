@extends('layouts.app')
@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Submission Resolved</li>
                {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard.submission-success.index') }}">Resolved</a></li> --}}
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    @include('layouts.partials.alert-prompt.alert')

    <div class="searchable-container">
        <div class="switch align-self-center">


            @can('submission-success-create')
                <a class="btn btn-primary mb-2 me-4" href="{{ route('dashboard.submission-success.create') }}">
                    <i class="far fa-plus-square"></i>

                    Add resolved Rembes <span id="pending-count" class="badge bg-light text-dark ms-2"></span>
                </a>
            @endcan
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
                                    <td>
                                        @can('submission-artikel-list')
                                            <a class="text-primary" style="text-decoration: underline;"
                                                href="{{ route('dashboard.submission.show', $data_rembes->id) }}">
                                                {{ $data_rembes->name }}
                                            </a>
                                        @endcan
                                    </td>
                                    <td>{{ $data_rembes->categoryTahun->slug }}</td>
                                    <td>
                                        @php
                                            $tanggal = \Carbon\Carbon::parse($data_rembes->tanggal_ticket)->locale('id_ID');
                                        @endphp
                                        {{ $tanggal->isoFormat('dddd, D MMMM YYYY') ?? 'No Date' }}
                                    </td>
                                    <td>
                                        @if ($data_rembes->status == 'PENDING')
                                            <span class="badge badge-warning">{{ $data_rembes->status }}</span>
                                        @elseif($data_rembes->status == 'APPROVED')
                                            <span class="badge badge-info">{{ $data_rembes->status }}</span>
                                        @elseif($data_rembes->status == 'REJECTED')
                                            <span class="badge badge-danger">{{ $data_rembes->status }}</span>
                                        @elseif($data_rembes->status == 'SUCCESS')
                                            <span class="badge badge-success">{{ $data_rembes->status }}</span>
                                        @else
                                            <span class="badge badge-secondary">{{ $data_rembes->status }}</span>
                                        @endif
                                    </td>
                                    <td>


                                        {{-- @can('submission-artikel-list') --}}
                                        {{-- <a class="badge badge-light-success text-start me-2"
                                                href="{{ route('dashboard.submission.invoice', $data_rembes->id) }}">
                                                <i class="fas fa-file-invoice"></i>Cetak Invoice</a> --}}
                                        <a class="badge
                                                badge-light-info text-start"
                                            href="{{ route('dashboard.rembes.show', $data_rembes->id) }}">
                                            <i data-feather="printer"></i>
                                            Print
                                        </a>
                                        {{-- @endcan --}}
                                        @if (
                                            $data_rembes->status == 'PENDING' ||
                                                $data_rembes->status == 'REJECTED' ||
                                                Auth::user()->roles[0]->name == 'Admin' ||
                                                Auth::user()->roles[0]->name == 'Bendahara')
                                            @can('submission-success-edit')
                                                <a class="badge badge-light-primary text-start me-2"
                                                    href="{{ route('dashboard.submission.edit', $data_rembes->id) }}">
                                                    <i class="far fa-edit"></i>Edit</a>
                                            @endcan
                                            @can('submission-success-delete')
                                                <a class="badge badge-light-danger text-start me-2"
                                                    href="{{ route('dashboard.rembes.destroy', $data_rembes->id) }}"
                                                    onclick="return confirm('Are you sure you want to delete this item?');">
                                                    <i class="far fa-trash-alt"></i>Delete</a>
                                            @endcan
                                        @endif

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

    <!-- Include jQuery -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function updateApprovedCount() {
            $.ajax({
                url: '{{ route('dashboard.getApprovedCount') }}',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var approvedCount = response.approvedCount;
                    $('#pending-count').text(approvedCount);
                },
                error: function(error) {
                    console.error('Error fetching Approved count:', error);
                }
            });
        }

        // Panggil fungsi updatePendingCount saat halaman dimuat
        $(document).ready(function() {
            updateApprovedCount();
        });
    </script>
@endsection
