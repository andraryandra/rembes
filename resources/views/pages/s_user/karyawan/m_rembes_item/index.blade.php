@extends('layouts.app')
@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reimburse</li>
                <li class="breadcrumb-item active" aria-current="page">Reimburse Item</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    {{-- <div class="row my-3">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('dashboard.rembes.index') }}">
                    <i class="far fa-arrow-alt-circle-left"></i>
                    Back
                </a>
            </div>
        </div>
    </div> --}}

    @include('layouts.partials.alert-prompt.alert')

    <div class="searchable-container">
        <div class="switch align-self-center">



            @can('rembes-item-create')
                @if ($rembes->status == 'PENDING' || ($rembes->status == 'REJECTED' && auth()->id() == $rembes->user_id))
                    <a class="btn btn-primary" href="{{ route('dashboard.rembes-item.create', $rembes->id) }}">
                        <i class="far fa-plus-square"></i>
                        Add New Reimburse Item
                    </a>
                @endif
            @endcan
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
                                <th width="280px"></th>
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

                                    <td>
                                        @if ($rembes->status == 'PENDING' || ($rembes->status == 'REJECTED' && auth()->id() == $rembes->user_id))
                                            <a class="badge badge-light-primary text-start me-2"
                                                href="{{ route('dashboard.rembes-item.show', ['rembes' => $rembes->id, 'id' => $rembes_item->id]) }}">
                                                <i class="far fa-edit"></i>
                                                Detail
                                            </a>
                                            @can('rembes-item-edit')
                                                @if ($rembes->status !== 'APPROVED')
                                                    <a class="badge badge-light-primary text-start me-2"
                                                        href="{{ route('dashboard.rembes-item.edit', ['rembes' => $rembes->id, 'id' => $rembes_item->id]) }}">
                                                        <i class="far fa-edit"></i>
                                                        Edit
                                                    </a>
                                                @endif
                                            @endcan

                                            @can('rembes-item-delete')
                                                @if ($rembes->status !== 'APPROVED')
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['dashboard.rembes-item.destroy', ['rembes' => $rembes->id, 'id' => $rembes_item->id]],
                                                        'style' => 'display:inline',
                                                    ]) !!}
                                                    {!! Form::button('<i class="far fa-trash-alt"></i> Delete', [
                                                        'type' => 'submit',
                                                        'class' => 'badge badge-light-danger text-start mx-3',
                                                        'onclick' => 'return confirm("Are you sure you want to delete this rembes item?");',
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                @endif
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name Rembes</th>
                                <th>Nominal</th>
                                <th>Date Rembes</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th width="280px"></th>
                            </tr>
                        </tfoot>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
