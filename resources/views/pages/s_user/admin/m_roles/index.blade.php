@extends('layouts.app')


@section('content')
    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Roles</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->

    @include('layouts.partials.alert-prompt.alert')

    <div class="searchable-container">
        <div class="switch align-self-center">

            @can('role-create')
                <a class="btn btn-primary" href="{{ route('dashboard.roles.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-user-plus">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                    Add New Role
                </a>
            @endcan
        </div>

        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                <div class="widget-content widget-content-area br-8">

                    <table id="zero-config" class="table table-striped dt-table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th width="280px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('dashboard.roles.show', $role->id) }}">
                                            <i class="far fa-eye"></i>
                                            Show</a>
                                        @can('role-edit')
                                            <a class="btn btn-primary" href="{{ route('dashboard.roles.edit', $role->id) }}">
                                                <i class="far fa-edit"></i>
                                                Edit</a>
                                        @endcan
                                        @can('role-delete')
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['dashboard.roles.destroy', $role->id],
                                                'style' => 'display:inline',
                                                'onsubmit' => 'return confirm("Are you sure you want to delete this role?");',
                                            ]) !!}
                                            {!! Form::button('<i class="far fa-trash-alt"></i> Delete', [
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger',
                                            ]) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th width="280px"></th>
                            </tr>
                        </tfoot>
                    </table>
                    {{-- {!! $roles->render() !!} --}}

                </div>
            </div>
        </div>
    </div>
@endsection
