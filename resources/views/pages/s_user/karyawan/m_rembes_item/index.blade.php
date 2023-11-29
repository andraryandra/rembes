@extends('layouts.app')
@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Rembes Item</li>
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

    <div class="searchable-container">
        <div class="switch align-self-center">

            @can('rembes-item-create')
                <a class="btn btn-primary" href="{{ route('dashboard.rembes-item.create', $rembes->id) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-user-plus">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                    Add New Rembes Item
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
                                <th>Name Rembes</th>
                                <th>Nominal</th>
                                <th>Date Rembes</th>
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
                                        {{ Str::limit($rembes_item->deskripsi, 50, '...') ?? 'No Description' }}
                                    </td>

                                    <td>
                                        {{-- @can('rembes-item-list')
                                            <a class="badge
                                            badge-light-info text-start"
                                                href="{{ route('dashboard.rembes-item.show', $rembes_item->id) }}">
                                                <i data-feather="eye"></i>
                                                View
                                            </a>
                                        @endcan --}}
                                        @can('rembes-item-edit')
                                            <a class="badge badge-light-primary text-start me-2"
                                                href="{{ route('dashboard.rembes-item.edit', ['rembes' => $rembes->id, 'id' => $rembes_item->id]) }}">
                                                <i class="far fa-edit"></i>
                                                Edit
                                            </a>
                                        @endcan

                                        @can('rembes-item-delete')
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['dashboard.rembes-item.destroy', ['rembes' => $rembes->id, 'id' => $rembes_item->id]],
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
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name Rembes</th>
                                <th>Nominal</th>
                                <th>Date Rembes</th>
                                <th>Description</th>
                                <th width="280px"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--
                                    <td>
                                        @if ($rembes_list->foto_bukti)
                                            @foreach (explode(',', $rembes_list->foto_bukti) as $file)
                                                @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                    <img src="{{ asset('storage/foto_bukti/' . $file) }}"
                                                        alt="{{ $rembes_list->id }}" class="mx-2 rounded" width="100">
                                                @else
                                                    <span class="badge btn-info">
                                                        <i class="far fa-file-archive"></i>
                                                        {{ $file }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        @else
                                            Tidak ada foto bukti
                                        @endif
                                    </td> --}}
