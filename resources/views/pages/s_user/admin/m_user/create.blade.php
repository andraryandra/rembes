@extends('layouts.app')


@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">User</li>
                <li class="breadcrumb-item active" aria-current="page">Create New Users</li>
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



    {!! Form::open(['route' => 'dashboard.users.store', 'method' => 'POST']) !!}
    <div class="card ">
        <div class="row m-2">
            <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'id' => 'email']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                <div class="form-group">
                    <strong>Password:</strong>
                    {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    {!! Form::password('confirm-password', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 my-2">
                <div class="form-group">
                    <strong>Role:</strong>
                    {!! Form::select('roles[]', $roles, [], ['class' => 'form-control', 'multiple']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 my-3 text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="far fa-save"></i>
                    Save
                </button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    @push('script')
        <script>
            $("#email").inputmask({
                mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
                greedy: !1,
                onBeforePaste: function(m, a) {
                    return (m = m.toLowerCase()).replace("mailto:", "")
                },
                definitions: {
                    "*": {
                        validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]",
                        cardinality: 1,
                        casing: "lower"
                    }
                }
            })
        </script>
    @endpush
@endsection
