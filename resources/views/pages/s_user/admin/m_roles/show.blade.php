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

    <div class="card my-2">
        <div class="m-3">
            <div class="form-group">
                <strong>Name:</strong>
                <b>{{ $role->name }}</b>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="row my-4">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body shadow-sm">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0">Menu Role</h5>
                        </div>
                        <hr />
                        <div class="form-group">
                            @foreach ($rolePermissions as $permission)
                                @if (strpos($permission->name, 'role-') === 0)
                                    <div class="form-check my-2">
                                        {{ Form::checkbox('permissions[]', $permission->id, true, ['class' => 'form-check-input', 'id' => 'permission_' . $permission->id, 'disabled' => 'disabled', 'checked' => 'checked']) }}
                                        {{ Form::label('permission_' . $permission->id, $permission->name, ['class' => 'form-check-label']) }}
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
                            @foreach ($rolePermissions as $v)
                                @if (strpos($v->name, 'user-') === 0)
                                    <div class="form-check my-2">

                                        {{ Form::checkbox('permissions[]', $v->id, true, ['class' => 'form-check-input', 'id' => 'permission_' . $v->id, 'disabled' => 'disabled', 'checked' => 'checked']) }}
                                        {{ Form::label('permission_' . $v->id, $v->name, ['class' => 'form-check-label']) }}
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
                            <h5 class="mb-0">Menu Rembes</h5>
                        </div>
                        <hr />
                        <div class="form-group">
                            @foreach ($rolePermissions as $v)
                                @if (strpos($v->name, 'rembes-') === 0)
                                    <div class="form-check my-2">

                                        {{ Form::checkbox('permissions[]', $v->id, true, ['class' => 'form-check-input', 'id' => 'permission_' . $v->id, 'disabled' => 'disabled', 'checked' => 'checked']) }}
                                        {{ Form::label('permission_' . $v->id, $v->name, ['class' => 'form-check-label']) }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
