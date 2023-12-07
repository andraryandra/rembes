@extends('layouts.app')
@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Submission Approved</li>
                <li class="breadcrumb-item active" aria-current="page">Submission Invoice</li>
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
                                                                alt="company" class="rounded" width="200">
                                                        </div>
                                                        <p class="inv-street-addr mt-3">Jl. Villa Melati Mas Raya No.5,
                                                            Jelupang, Serpong Utara, South Tangerang City, Banten 15323</p>
                                                        <p class="inv-email-address">sap-samara.com</p>
                                                        <p class="inv-email-address">(120) 456 789</p>
                                                    </div>

                                                    <div class="col-sm-6 text-sm-end">
                                                        <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4"><span
                                                                class="inv-title">No Reimburse: </span> <span
                                                                class="inv-number">{{ $rembes['id'] }}</span></p>

                                                        <p class="inv-created-date mt-sm-5 mt-3"><span
                                                                class="inv-title">Reimburse Date : </span>
                                                            @php
                                                                $tanggal = \Carbon\Carbon::parse($rembes->tanggal)->locale('id_ID');
                                                            @endphp

                                                            <span class="inv-date">
                                                                {{ $tanggal->isoFormat('dddd, D MMMM YYYY') ?? 'No Date' }}</span>
                                                        </p>
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="inv--detail-section inv--customer-detail-section">

                                                <div class="row">

                                                    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                        <p class="inv-to">Reimburse To</p>
                                                    </div>

                                                    <div
                                                        class="col-xl-4 col-lg-5 col-md-6 col-sm-8 align-self-center order-sm-0 order-1 text-sm-end mt-sm-0 mt-5">
                                                        <h6 class=" inv-title">Reimburse From</h6>
                                                    </div>

                                                    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                        <p class="inv-customer-name">Jeremy Lesmana</p>
                                                        <p class="inv-street-addr">405 Mulberry Rd., NC, 28649</p>
                                                        <p class="inv-email-address">jcory@company.com</p>
                                                        <p class="inv-email-address">(128) 666 070</p>
                                                    </div>

                                                    <div
                                                        class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 order-sm-0 order-1 text-sm-end">
                                                        <p class="inv-customer-name">{{ $rembes->user->name }}</p>
                                                        <p class="inv-street-addr">{{ $rembes->user->address }}</p>
                                                        <p class="inv-email-address">{{ $rembes->user->email }}</p>
                                                        <p class="inv-email-address">{{ $rembes->user->phone }}</p>
                                                    </div>

                                                </div>

                                            </div>

                                            {{-- <div class="inv--product-table-section">
                                                <div class="table-responsive">
                                                    <table class="table" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Nama Rembes</th>
                                                                <th scope="col">Nominal</th>
                                                                <th scope="col">Tanggal Rembes</th>
                                                                <th scope="col">Deskripsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($rembes_item as $item)
                                                                @if ($item->rembes_id == $rembes->id)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $item->nama_rembes }}</td>
                                                                        <td class="text-end">
                                                                            Rp.
                                                                            {{ number_format($item->nominal, 0, ',', '.') }}
                                                                        </td>
                                                                        <td>
                                                                            @php
                                                                                $tanggal = \Carbon\Carbon::parse($item->tanggal_rembes)->locale('id_ID');
                                                                            @endphp
                                                                            {{ $tanggal->isoFormat('dddd, D MMMM YYYY') ?? 'No Date' }}
                                                                        </td>
                                                                        <td class="text-end">{{ $item->deskripsi }}</td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div> --}}
                                            <div class="inv--product-table-section">
                                                <div class="table-responsive">
                                                    <table class="table table-striped" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Nama Rembes</th>
                                                                <th scope="col" class="text-end">Nominal</th>
                                                                <th scope="col">Tanggal Rembes</th>
                                                                <th scope="col" class="text-end">Deskripsi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @forelse ($rembes_item as $item)
                                                                @if ($item->rembes_id == $rembes->id)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $item->nama_rembes }}</td>
                                                                        <td class="text-end">Rp.
                                                                            {{ number_format($item->nominal, 0, ',', '.') }}
                                                                        </td>
                                                                        <td>
                                                                            @php
                                                                                $tanggal = \Carbon\Carbon::parse($item->tanggal_rembes)->locale('id_ID');
                                                                            @endphp
                                                                            {{ $tanggal->isoFormat('dddd, D MMMM YYYY') ?? 'No Date' }}
                                                                        </td>
                                                                        <td class="text-end">{{ $item->deskripsi }}</td>
                                                                    </tr>
                                                                @endif
                                                            @empty
                                                                <tr>
                                                                    <td colspan="5" class="text-center">Tidak ada data
                                                                    </td>
                                                                </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>


                                            <div class="inv--total-amounts">

                                                <div class="row mt-4">
                                                    <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                    </div>
                                                    <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                        <div class="text-sm-end">
                                                            <div class="row">
                                                                <div class="col-sm-8 col-7">
                                                                    <p class="">Sub Total :</p>
                                                                </div>
                                                                <div class="col-sm-4 col-5">
                                                                    <p class="">$3155</p>
                                                                </div>
                                                                <div class="col-sm-8 col-7">
                                                                    <p class="">Tax 10% :</p>
                                                                </div>
                                                                <div class="col-sm-4 col-5">
                                                                    <p class="">$315</p>
                                                                </div>
                                                                <div class="col-sm-8 col-7">
                                                                    <p class=" discount-rate">Shipping :</p>
                                                                </div>
                                                                <div class="col-sm-4 col-5">
                                                                    <p class="">$10</p>
                                                                </div>
                                                                <div class="col-sm-8 col-7">
                                                                    <p class=" discount-rate">Discount 5% :</p>
                                                                </div>
                                                                <div class="col-sm-4 col-5">
                                                                    <p class="">$150</p>
                                                                </div>
                                                                <div class="col-sm-8 col-7 grand-total-title mt-3">
                                                                    <h4 class="">Grand Total : </h4>
                                                                </div>
                                                                <div class="col-sm-4 col-5 grand-total-amount mt-3">
                                                                    <h4 class="">$3480</h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="inv--note">

                                                <div class="row mt-4">
                                                    <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                        <p>Note: Thank you for doing Business with us.</p>
                                                    </div>
                                                </div>

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
                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="javascript:void(0);" class="btn btn-primary btn-send">Send Invoice</a>
                                    </div>
                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="javascript:void(0);"
                                            class="btn btn-secondary btn-print  action-print">Print</a>
                                    </div>
                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="javascript:void(0);" class="btn btn-success btn-download">Download</a>
                                    </div>
                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                        <a href="./app-invoice-edit.html" class="btn btn-dark btn-edit">Edit</a>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
