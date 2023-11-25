@extends('layouts.app')


@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Roles</li>
                <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
                <li class="breadcrumb-item active" aria-current="page">{{ $role->name }}</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('dashboard.roles.index') }}">
                    <i class="far fa-arrow-alt-circle-left"></i>
                    Back</a>
            </div>
        </div>
    </div>

    @include('layouts.partials.alert-prompt.alert')

    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['dashboard.roles.update', $role->id]]) !!}
    <div class="card my-2">
        <div class="m-3">
            <div class="form-group">
                <strong>Name:</strong>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="row my-4">

        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body shadow-sm">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0">Menu Role</h5>
                    </div>
                    <hr />
                    <div class="form-group">
                        @foreach ($permission as $value)
                            @if (strpos($value->name, 'role-') === 0)
                                <div class="form-check my-2">
                                    <label class="form-check-label" for="permission_{{ $value->id }}">
                                        {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'form-check-input', 'id' => 'permission_' . $value->id]) }}
                                        <span class="mx-2">{{ $value->name }}</span>
                                    </label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body shadow-sm">
                    <div class="card-title d-flex align-items-center">
                        <h5 class="mb-0">Menu Users</h5>
                    </div>
                    <hr />
                    <div class="form-group">
                        @foreach ($permission as $value)
                            @if (strpos($value->name, 'user-') === 0)
                                <div class="form-check my-2">
                                    <label class="form-check-label" for="permission_{{ $value->id }}">
                                        {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'form-check-input', 'id' => 'permission_' . $value->id]) }}
                                        <span class="mx-2">{{ $value->name }}</span>
                                    </label>

                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary  mb-2 me-4">
                <i class="far fa-save"></i>
                <span class="btn-text-inner">Save</span>
            </button>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
