@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <div class="lead">
            <img src="{{url('')}}/image/{{ $course->img }}" width="auto" height="300">
        </div>
        
        <div class="container mt-4">
            <div>
                {{ $course->name }}
            </div>
            <br />
            <div>
                {{ $course->description }}
            </div>
            <div>
                
            </div>
        </div>

    </div>
@endsection
