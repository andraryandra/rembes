@extends('layouts.app')
@section('content')
    {{-- <div class="row invoice layout-top-spacing layout-spacing">
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
                                                            <h3 class="in-heading align-self-center">PT. Satya Amarta Prima.
                                                            </h3>
                                                        </div>
                                                        <p class="inv-street-addr mt-3">Jl. Villa Melati Mas Raya No.5,
                                                            Jelupang, Serpong Utara, South Tangerang City, Banten 15323</p>
                                                        <p class="inv-email-address">sap-samara.com</p>
                                                        <p class="inv-email-address">(120) 456 789</p>
                                                    </div>

                                                    <div class="col-sm-6 text-sm-end">
                                                        <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4"><span
                                                                class="inv-title">No Ticket : </span> <span
                                                                class="inv-number">{{ $rembes['id'] }}</span></p>

                                                        <p class="inv-created-date mt-sm-5 mt-3"><span
                                                                class="inv-title">Ticket Date : </span>
                                                            @php
                                                                $tanggal = \Carbon\Carbon::parse($rembes->tanggal)->locale('id_ID');
                                                            @endphp

                                                            <span class="inv-date">
                                                                {{ $tanggal->isoFormat('dddd, D MMMM YYYY') ?? 'No Date' }}</span>
                                                        </p>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="inv--detail-section inv--customer-detail-section">

                                                <div class="row">

                                                    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4 align-self-center">
                                                        <p class="inv-to">Ticket To</p>
                                                    </div>

                                                    <div
                                                        class="col-xl-4 col-lg-5 col-md-6 col-sm-8 align-self-center order-sm-0 order-1 text-sm-end mt-sm-0 mt-5">
                                                        <h6 class=" inv-title">Ticket From</h6>
                                                    </div>

                                                    <div class="col-xl-8 col-lg-7 col-md-6 col-sm-4">
                                                        <p class="inv-customer-name">Jesse Cory</p>
                                                        <p class="inv-street-addr">405 Mulberry Rd., NC, 28649</p>
                                                        <p class="inv-email-address">jcory@company.com</p>
                                                        <p class="inv-email-address">(128) 666 070</p>
                                                    </div>

                                                    <div
                                                        class="col-xl-4 col-lg-5 col-md-6 col-sm-8 col-12 order-sm-0 order-1 text-sm-end">
                                                        <p class="inv-customer-name">{{ $rembes->nama }}</p>
                                                        <p class="inv-street-addr">2161 Ferrell Street, MN, 56545 </p>
                                                        <p class="inv-email-address">info@mail.com</p>
                                                        <p class="inv-email-address">(218) 356 9954</p>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="inv--product-table-section">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead class="">
                                                            <tr>
                                                                <th scope="col">S.No</th>
                                                                <th scope="col">Items</th>
                                                                <th class="text-end" scope="col">Qty</th>
                                                                <th class="text-end" scope="col">Price</th>
                                                                <th class="text-end" scope="col">Amount</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Calendar App Customization</td>
                                                                <td class="text-end">1</td>
                                                                <td class="text-end">$120</td>
                                                                <td class="text-end">$120</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Chat App Customization</td>
                                                                <td class="text-end">1</td>
                                                                <td class="text-end">$230</td>
                                                                <td class="text-end">$230</td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>Laravel Integration</td>
                                                                <td class="text-end">1</td>
                                                                <td class="text-end">$405</td>
                                                                <td class="text-end">$405</td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>Backend UI Design</td>
                                                                <td class="text-end">1</td>
                                                                <td class="text-end">$2500</td>
                                                                <td class="text-end">$2500</td>
                                                            </tr>
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
    </div> --}}
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Reimburse</li>
                <li class="breadcrumb-item active" aria-current="page">Reimburse Item</li>
                <li class="breadcrumb-item active" aria-current="page">detail Reimburse Item</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    <div class="row my-3">
        <div class="col-lg-12 margin-tb">

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('dashboard.rembes-item.index', $rembes->id) }}">
                    <i class="far fa-arrow-alt-circle-left"></i>
                    Back
                </a>
            </div>
        </div>
    </div>

    <div class="searchable-container">
        <div class="card ">
            <div class="row m-2">
                <div class="card-body">
                    <div class="form-group my-2">
                        <label for="nama_rembes">Item Name: <span class="text-danger">*</span></label>
                        <input value="{{ $rembes_item->nama_rembes }}" class="form-control readonly-input" readonly>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Amount of money : <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">Rp.</span>
                            <input type="text" name="nominal" value="{{ $rembes_item->nominal }}"
                                class="form-control readonly-input" readonly>
                        </div>
                    </div>

                    <div class="form-group my-2">
                        <label for="tanggal_rembes">Date: <span class="text-danger">*</span></label>
                        <input value="{{ $rembes_item->tanggal_rembes }}" class="form-control readonly-input" readonly>
                    </div>

                    <div class="form-group my-2">
                        <label for="deskripsi">Description (Optional):</label>
                        <textarea rows="3" class="form-control readonly-input" readonly>{{ $rembes_item->deskripsi }}</textarea>
                    </div>

                    <div class="form-group my-2">
                        <label for="foto_bukti">Photo Evidence: <span class="text-danger">*</span></label>
                        <div class="row">
                            @foreach (explode(',', $rembes_item->foto_bukti) as $file)
                                <div class="col-4">
                                    @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                        <a href="{{ asset('storage/foto_bukti/' . $file) }}" target="_blank">
                                            <img src="{{ asset('storage/foto_bukti/' . $file) }}"
                                                alt="{{ $rembes_item->id }}" class="mx-2 rounded border" width="250">
                                        </a>
                                    @else
                                        <span class="badge btn-info">
                                            <i class="far fa-file-archive"></i>
                                            {{ $file }}
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- form readonly  -->
        <style>
            /* Gaya kustom untuk input yang readonly tanpa background abu-abu */
            .readonly-input {
                background-color: transparent !important;
                /* Atur latar belakang ke transparan */
                /* border: none; */
                /* Hilangkan garis tepi */
                box-shadow: none;
                /* Hilangkan bayangan kotak */
                color: black !important;
                /* Tetapkan warna teks menjadi hitam */
            }
        </style>
    @endsection
