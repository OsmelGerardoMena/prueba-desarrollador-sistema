@extends('layouts.app-master')

@section('content')
    

    <div class="bg-light p-4 rounded">
        <h1>Cursos</h1>
        <div class="lead">
            <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm float-right">Agregar curso</a>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col" width="15%">Imagen</th>
                <th scope="col" width="15%">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col" width="1%" colspan="3"></th>    
            </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <th scope="row">{{ $course->id }}</th>
                        <td><img src="{{url('')}}/image/{{ $course->img }}" width="100px"></td>
                        <td>{{ $course->name }}</td>
                        <td>{{ $course->description }}</td>
                        <td><a href="{{ route('courses.edit', $course->id) }}" class="btn btn-info btn-sm">Editar</a></td>
                        <td>
                            {!! Form::open(['method' => 'DELETE','route' => ['courses.destroy', $course->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Eliminar', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
