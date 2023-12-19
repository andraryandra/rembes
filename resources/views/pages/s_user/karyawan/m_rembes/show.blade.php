@extends('layouts.app')
@section('content')
    <div class="row invoice layout-top-spacing layout-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

            <div class="doc-container">

                <div class="row">

                    <div class="col-xl-9">

                        <div class="invoice-container">
                            <div class="invoice-inbox">

                                <div id="ct" class="">

                                    <div class="invoice-00001">
                                        <div class="content-section">

                                            <div class="inv--head-section inv--detail-section">

                                                <div class="row">

                                                    <div class="col-sm-6 col-12 mr-auto">
                                                        <div class="d-flex">
                                                            <img class="" src="{{ asset('logo/samara.png') }}"
                                                                alt="company" class="rounded" width="150">
                                                            <h3 class="in-heading align-self-center"
                                                                style="font-size: 18px;">PT Satya Amarta Prima
                                                            </h3>
                                                        </div>
                                                        <p class="inv-street-addr mt-3">Jl. Villa Melati Mas Raya No.5,
                                                            Jelupang, Serpong Utara, South Tangerang City, Banten 15323</p>
                                                        <p class="inv-email-address">sap-samara.com</p>
                                                        <p class="inv-email-address">(120) 456 789</p>
                                                    </div>

                                                    <div class="col-sm-6 text-sm-end">
                                                        <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4"><span
                                                                class="inv-title">No Reimburse : </span> <span
                                                                class="inv-number">{{ $rembes['id'] }}</span></p>

                                                        <p class="inv-created-date mt-sm-5 mt-3"><span
                                                                class="inv-title">Reimburse Date : </span>
                                                            @php
                                                                $tanggal = \Carbon\Carbon::parse($rembes->tanggal)->locale('id_ID');
                                                            @endphp

                                                            <span class="inv-date">
                                                                {{ $tanggal->isoFormat('dddd, D MMMM YYYY') ?? 'No Date' }}</span>
                                                        </p>
                                                        {{-- <p class="inv-due-date"><span class="inv-title">Due Date : </span>
                                                            <span class="inv-date">26 Mar 2022</span> --}}
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="inv--detail-section inv--customer-detail-section">

                                                <div class="row">

                                                    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                        <p class="inv-to">Reimburse From</p>
                                                    </div>

                                                    <div
                                                        class="col-xl-4 col-lg-5 col-md-6 col-sm-8 align-self-center order-sm-0 order-1 text-sm-end mt-sm-0 mt-5">
                                                        {{-- <h6 class=" inv-title">Ticket From</h6> --}}
                                                    </div>

                                                    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                        <p class="inv-street-addr">Name User:
                                                            <b>{{ $rembes->user->name }}</b>
                                                        </p>
                                                        <p class="inv-street-addr">Reimburse Name:
                                                            <b>{{ $rembes->name }}</b>
                                                        </p>
                                                        <p class="inv-street-addr">Status: <b>{{ $rembes->status }}</b>
                                                        </p>
                                                        {{-- <p
                                                            class="inv-email-address fw-bold  text-light
                                                        @if ($rembes->status == 'PENDING') badge badge-warning
                                                        @elseif($rembes->status == 'APPROVED')
                                                        badge badge-info
                                                        @elseif($rembes->status == 'REJECTED')
                                                        badge badge-danger
                                                        @elseif($rembes->status == 'SUCCESS')
                                                        badge badge-success
                                                        @else
                                                        badge badge-secondary @endif

                                                        ">
                                                            {{ $rembes->status }}
                                                        </p> --}}
                                                    </div>

                                                    <div
                                                        class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 order-sm-0 order-1 text-sm-end">
                                                        {{-- <p class="inv-customer-name">{{ $rembes->user->name }}</p>
                                                        <p class="inv-street-addr">{{ $rembes->name }} </p>
                                                        <p class="inv-email-address">{{ $rembes->tanggal_ticket }}</p>
                                                        <p class="inv-email-address">{{ $rembes->status }}</p> --}}
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="inv--product-table-section">
                                                <div class="">
                                                    <table class="table table-bordered px-3 ">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Name Reimburse</th>
                                                                <th>Nominal</th>
                                                                <th>Date Reimburse</th>
                                                                <th>Description</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($rembes_item as $item)
                                                                @if ($item->rembes_id == $rembes->id)
                                                                    <tr>
                                                                        <td style="font-size: 12px;">{{ $loop->iteration }}
                                                                        </td>
                                                                        <td style="font-size: 12px;">
                                                                            {{ $item->nama_rembes }}</td>
                                                                        <td style="font-size: 12px;">
                                                                            Rp.
                                                                            {{ number_format($item->nominal, 0, ',', '.') }}
                                                                        </td>
                                                                        <td style="font-size: 12px;">
                                                                            @php
                                                                                $tanggal = \Carbon\Carbon::parse($item->tanggal_rembes)->locale('id_ID');
                                                                            @endphp
                                                                            {{ $tanggal->isoFormat('D-MMMM-YYYY') ?? 'No Date' }}
                                                                        </td>
                                                                        <td
                                                                            style="font-size: 12px; overflow: hidden; text-overflow: ellipsis; max-width: 100px; white-space: pre-line;">
                                                                            @if ($item->deskripsi == null)
                                                                                -
                                                                            @else
                                                                                {{ $item->deskripsi }}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            {{-- <div class="inv--total-amounts">
                                                <h5 class="fw-bold">Photo Evidence:</h5>
                                                @foreach ($rembes_item as $item)
                                                    @if ($item->rembes_id == $rembes->id)
                                                        @if ($item->foto_bukti)
                                                            @foreach (explode(',', $item->foto_bukti) as $file)
                                                                @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                                    <a href="{{ asset('storage/foto_bukti/' . $file) }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset('storage/foto_bukti/' . $file) }}"
                                                                            alt="{{ $item->id }}"
                                                                            class="mx-2 rounded border" width="75">
                                                                    </a>
                                                                @else
                                                                    <span class="badge btn-info">
                                                                        <i class="far fa-file-archive"></i>
                                                                        {{ $file }}
                                                                    </span>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            -
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </div> --}}

                                            <div class="inv--total-amounts">
                                                <div class="row mt-4">
                                                    <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                    </div>
                                                    <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                        <div class="text-sm-end">
                                                            <div class="row fw-bold">
                                                                <div class="col-sm-8 col-7">
                                                                    <p class="">Sub Total :</p>
                                                                </div>
                                                                <div class="col-sm-4 col-5">
                                                                    <p class="">
                                                                        {{ number_format($rembes_nominal_item, 0, ',', '.') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="inv--total-amounts">
                                                <div class="form-group my-2">
                                                    <div class="row">
                                                        @php
                                                            $no = 1;
                                                        @endphp
                                                        @foreach ($rembes_item as $item)
                                                            @if ($item->rembes_id == $rembes->id)
                                                                @if ($item->foto_bukti)
                                                                    @foreach (explode(',', $item->foto_bukti) as $file)
                                                                        <div class="col-4">
                                                                            <h6>{{ $no++ }}.{{ $item->nama_rembes }}
                                                                            </h6>
                                                                            @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                                                                <img src="{{ asset('storage/foto_bukti/' . $file) }}"
                                                                                    alt="{{ $item->nama_rembes }}"
                                                                                    class="mx-2 rounded border"
                                                                                    width="250">
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="inv--note">
                                                {{-- <div class="row mt-4">
                                                    <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                        <p>Note: Thank you for doing Business with us.</p>
                                                    </div>
                                                </div> --}}
                                            </div>

                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>

                    </div>

                    <div class="col-xl-3">

                        <div class="invoice-actions-btn">

                            <div class="invoice-action-btn">

                                <div class="row">
                                    {{-- <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-send">Send Invoice</a>
                                    </div> --}}
                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="javascript:void(0);"
                                            class="btn btn-secondary btn-print  action-print">Print</a>
                                    </div>
                                    {{-- <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="javascript:void(0);" class="btn btn-success btn-download">Download</a>
                                    </div> --}}
                                    {{-- <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="./app-invoice-edit.html" class="btn btn-dark btn-edit">Edit</a>
                                    </div> --}}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
