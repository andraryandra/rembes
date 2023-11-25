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

            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('dashboard.users.index') }}">
                    <i class="far fa-arrow-alt-circle-left"></i>
                    Back
                </a>
            </div>
        </div>
    </div>

    @include('layouts.partials.alert-prompt.alert')

    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="form-group mb-2 d-flex align-items-center">
                        <strong class="mr-2">Name:</strong>
                        {{ $user->name }}
                    </div>
                    <div class="form-group mb-2 d-flex align-items-center">
                        <strong class="mr-2">Email:</strong>
                        {{ $user->email }}
                    </div>
                    <div class="form-group">
                        <strong>Roles:</strong>
                        @if (!empty($user->getRoleNames()))
                            <div class="mb-3">
                                @foreach ($user->getRoleNames() as $v)
                                    <span
                                        class="badge {{ $v == 'Admin' ? 'bg-warning' : ($v == 'User' ? 'bg-primary' : 'bg-success') }} rounded-pill mb-2">{{ $v }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
