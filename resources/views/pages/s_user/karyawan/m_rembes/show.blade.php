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
                                                        {{-- <p class="inv-due-date"><span class="inv-title">Due Date : </span>
                                                            <span class="inv-date">26 Mar 2022</span> --}}
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
                                                                <th scope="col">Nama Rembes</th>
                                                                <th class="text-end" scope="col">Nominal</th>
                                                                <th class="text-end" scope="col">Tanggal Rembes</th>
                                                                <th class="text-end" scope="col">Deskripsi</th>
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
