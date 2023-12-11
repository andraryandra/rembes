@extends('layouts.app')
@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta mb-3">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    @include('layouts.partials.alert-prompt.alert')

    <!-- Content -->
    <div class="tab-content" id="animateLineContent-4 ">
        <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel"
            aria-labelledby="animated-underline-home-tab">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <form class="section general-info">
                        <div class="info">
                            <h6 class="">General Information</h6>
                            <div class="row">
                                <div class="col-lg-11 mx-auto">
                                    <div class="row">
                                        <div class="col-xl-2 col-lg-12 col-md-4">
                                            <div class="profile-image  mt-4 pe-md-4">

                                                <!-- // The classic file input element we'll enhance
                                                                                        // to a file pond, we moved the configuration
                                                                                        // properties to JavaScript -->

                                                <div class="img-uploader-content">
                                                    <input type="file" class="filepond" name="filepond"
                                                        accept="image/png, image/jpeg, image/gif" />
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                            <div class="form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="fullName">Full Name</label>
                                                            <input type="text" class="form-control mb-3" id="fullName"
                                                                placeholder="Full Name" value="{{ Auth::user()->name }}">
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="profession">Profession</label>
                                                            <input type="text" class="form-control mb-3" id="profession"
                                                                placeholder="Designer" value="Web Developer">
                                                        </div>
                                                    </div> --}}

                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="country">Country</label>
                                                            <select class="form-select mb-3" id="country">
                                                                <option>All Countries</option>
                                                                <option selected>United States</option>
                                                                <option>India</option>
                                                                <option>Japan</option>
                                                                <option>China</option>
                                                                <option>Brazil</option>
                                                                <option>Norway</option>
                                                                <option>Canada</option>
                                                            </select>
                                                        </div>
                                                    </div> --}}

                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="address">Address</label>
                                                            <input type="text" class="form-control mb-3" id="address"
                                                                placeholder="Address" value="New York">
                                                        </div>
                                                    </div> --}}

                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="location">Location</label>
                                                            <input type="text" class="form-control mb-3" id="location"
                                                                placeholder="Location">
                                                        </div>
                                                    </div> --}}
                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone">Phone</label>
                                                            <input type="text" class="form-control mb-3" id="phone"
                                                                placeholder="Write your phone number here"
                                                                value="+1 (530) 555-12121">
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="text" class="form-control mb-3" id="email"
                                                                placeholder="Write your email here"
                                                                value="{{ Auth::user()->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="website1">Website</label>
                                                            <input type="text" class="form-control mb-3" id="website1"
                                                                placeholder="Enter URL">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="customCheck1">
                                                            <label class="form-check-label" for="customCheck1">Make this my
                                                                default address</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12 mt-1">
                                                        <div class="form-group text-end">
                                                            <button class="btn btn-secondary">Save</button>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                    <form id="social" class="section social">
                        <div class="info">
                            <h5 class="">Social</h5>
                            <div class="row">

                                <div class="col-md-11 mx-auto">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group social-linkedin mb-3">
                                                <span class="input-group-text me-3" id="linkedin"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-linkedin">
                                                        <path
                                                            d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z">
                                                        </path>
                                                        <rect x="2" y="9" width="4" height="12"></rect>
                                                        <circle cx="4" cy="4" r="2"></circle>
                                                    </svg></span>
                                                <input type="text" class="form-control" placeholder="Linkedin Username"
                                                    aria-label="Username" aria-describedby="linkedin" value="jimmy_turner">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group social-tweet mb-3">
                                                <span class="input-group-text me-3" id="tweet"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-twitter">
                                                        <path
                                                            d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                                        </path>
                                                    </svg></span>
                                                <input type="text" class="form-control" placeholder="Twitter Username"
                                                    aria-label="Username" aria-describedby="tweet" value="@jTurner">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-11 mx-auto">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group social-fb mb-3">
                                                <span class="input-group-text me-3" id="fb"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-facebook">
                                                        <path
                                                            d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                        </path>
                                                    </svg></span>
                                                <input type="text" class="form-control"
                                                    placeholder="Facebook Username" aria-label="Username"
                                                    aria-describedby="fb" value="Jimmy Turner">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group social-github mb-3">
                                                <span class="input-group-text me-3" id="github"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-github">
                                                        <path
                                                            d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                                        </path>
                                                    </svg></span>
                                                <input type="text" class="form-control" placeholder="Github Username"
                                                    aria-label="Username" aria-describedby="github" value="@TurnerJimmy">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <link rel="stylesheet" href="{{ asset('assets/src/plugins/src/filepond/filepond.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}">

    <link href="{{ asset('assets/src/plugins/css/light/filepond/custom-filepond.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/src/assets/css/light/components/tabs.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/light/elements/alert.css') }}">



    <link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/light/forms/switches.css') }}">
    <link href="{{ asset('assets/src/assets/css/light/components/list-group.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/src/assets/css/light/users/account-setting.css') }}" rel="stylesheet" type="text/css" />



    <link href="{{ asset('assets/src/plugins/css/dark/filepond/custom-filepond.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/src/assets/css/dark/components/tabs.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/dark/elements/alert.css') }}">



    <link rel="stylesheet" type="text/css" href="{{ asset('assets/src/assets/css/dark/forms/switches.css') }}">
    <link href="{{ asset('assets/src/assets/css/dark/components/list-group.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('assets/src/assets/css/dark/users/account-setting.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ asset('assets/src/plugins/src/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
    <script src="{{ asset('assets/src/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
    <script src="{{ asset('assets/src/assets/js/users/account-settings.js') }}"></script>
@endsection
