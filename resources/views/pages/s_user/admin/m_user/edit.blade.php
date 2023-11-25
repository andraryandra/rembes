@extends('layouts.app')


@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">User</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    <div class="row my-3">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('dashboard.users.index') }}">
                    <i class="far fa-arrow-alt-circle-left"></i>
                    Back</a>
            </div>
        </div>
    </div>

    @include('layouts.partials.alert-prompt.alert')



    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['dashboard.users.update', $user->id]]) !!}
    <div class="card">
        <div class="card-body">
            <div class="simple-pill border p-4 rounded">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active btn-outline-primary" id="pills-home-icon-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-home-icon" type="button" role="tab" aria-controls="pills-home-icon"
                            aria-selected="true">
                            {{-- <i data-feather="home"></i> --}}
                            Edit User
                        </button>
                    </li>
                    <li class="nav-item mx-2" role="presentation">
                        <button class="nav-link btn-outline-primary" id="pills-profile-icon-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile-icon" type="button" role="tab"
                            aria-controls="pills-profile-icon" aria-selected="false">
                            Change Password
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home-icon" role="tabpanel"
                        aria-labelledby="pills-home-icon-tab" tabindex="0">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0">User Registration</h5>
                        </div>
                        <hr />
                        <div class="row mb-3">
                            <label for="inputEnterYourName" class="col-sm-3 col-form-label">Enter Your Name</label>
                            <div class="col-sm-9">
                                {!! Form::text('name', null, [
                                    'placeholder' => 'Name',
                                    'class' => 'form-control',
                                    'placeholder' => 'Masukkan Nama',
                                ]) !!}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmailAddress2" class="col-sm-3 col-form-label">Email Address</label>
                            <div class="col-sm-9">
                                {!! Form::text('email', null, [
                                    'placeholder' => 'Email',
                                    'class' => 'form-control',
                                    'placeholder' => 'Masukkan Email Address',
                                ]) !!}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="roles" class="col-sm-3 col-form-label">Role</label>
                            <div class="col-sm-9">
                                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-profile-icon" role="tabpanel"
                        aria-labelledby="pills-profile-icon-tab" tabindex="0">
                        <div class="row mb-3">
                            <label for="inputChoosePassword2" class="col-sm-3 col-form-label">Choose Password</label>
                            <div class="col-sm-9">
                                {!! Form::password('password', [
                                    'placeholder' => 'Password',
                                    'class' => 'form-control',
                                    'placeholder' => 'Masukkan Password Baru',
                                ]) !!}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputConfirmPassword2" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">

                                {!! Form::password('confirm-password', [
                                    'placeholder' => 'Confirm Password',
                                    'class' => 'form-control',
                                    'placeholder' => 'Masukkan Password Baru Lagi',
                                ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary px-5">
                            <i class="far fa-save"></i>
                            Save
                        </button>
                    </div>
                </div>
            </div>\
        </div>
    </div>
    {!! Form::close() !!}
@endsection
