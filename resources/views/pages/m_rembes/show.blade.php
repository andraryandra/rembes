@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Rembes</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('m_rembes.create') }}"> Create New Rembes</a>
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
        @foreach ($m_rembes as $key => $m_rembes)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $m_rembes->nama }}</td>
                <td>{{ $m_rembes->alamat }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('m_rembes.show', $m_rembes->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('m_rembes.edit', $m_rembes->id) }}">Edit</a>
                    {!! Form::open([
                        'method' => 'DELETE',
                        'route' => ['m_rembes.destroy', $m_rembes->id],
                        'style' => 'display:inline',
                    ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    {!! $m_rembes->render() !!}
    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
