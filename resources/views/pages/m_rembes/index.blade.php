@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Rembes Management</h2>
            </div>
            <div class="pull-right">
                @can('rembes-create')
                    <a class="btn btn-success" href="{{ route('rembes.create') }}"> Create New Rembes</a>
                @endcan
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($rembes as $key => $rembes)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $rembes->nama }}</td>
                <td>{{ $rembes->alamat }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('rembes.show', $rembes->id) }}">Show</a>
                    @can('rembes-edit')
                        <a class="btn btn-primary" href="{{ route('rembes.edit', $rembes->id) }}">Edit</a>
                    @endcan
                    @can('rembes-delete')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['rembes.destroy', $rembes->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    {!! $rembes->render() !!}
    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
