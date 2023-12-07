@extends('layouts.app')

@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Submission Approved</li>
                <li class="breadcrumb-item active" aria-current="page">Add Submission</li>
                <li class="breadcrumb-item active" aria-current="page">Detail Item Reimburse</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="row my-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('dashboard.submission.create') }}">
                    <i class="far fa-arrow-alt-circle-left"></i>
                    Back
                </a>
            </div>
        </div>
    </div>

    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-8">

                <table id="zero-config" class="table table-striped dt-table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Reimburse Item</th>
                            <th>Nominal</th>
                            <th>Date Reimburse</th>
                            <th>Image</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rembes_item as $key => $rembes_item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rembes_item->nama_rembes }}</td>
                                <td>Rp. {{ number_format($rembes_item->nominal, 0, ',', '.') }}</td>
                                <td>
                                    @php
                                        $tanggal = \Carbon\Carbon::parse($rembes_item->tanggal_rembes)->locale('id_ID');
                                    @endphp
                                    {{ $tanggal->isoFormat('dddd, D MMMM YYYY') ?? 'No Date' }}
                                </td>
                                <td>
                                    @if ($rembes_item->foto_bukti)
                                        @foreach (explode(',', $rembes_item->foto_bukti) as $file)
                                            @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                <a href="{{ asset('storage/foto_bukti/' . $file) }}" target="_blank">
                                                    <img src="{{ asset('storage/foto_bukti/' . $file) }}"
                                                        alt="{{ $rembes_item->id }}" class="mx-2 rounded border"
                                                        width="75">
                                                </a>
                                            @else
                                                <span class="badge btn-info">
                                                    <i class="far fa-file-archive"></i>
                                                    {{ $file }}
                                                </span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="badge btn-danger">
                                            <i class="far fa-times-circle"></i>
                                            No Image
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    {{ Str::limit($rembes_item->deskripsi, 50, '...') ?? 'No Description' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Reimburse Item</th>
                            <th>Nominal</th>
                            <th>Date Reimburse</th>
                            <th>Image</th>
                            <th>Description</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
@endsection
