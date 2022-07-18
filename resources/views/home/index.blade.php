@extends('layouts.app-master')

@section('content')
<div class="bg-light p-4 rounded">
    
    <div id="cursos" class="row justify-content-center">
        <div class="col-md-12 col-sm-12 col-12">
            <div class="row">
                <div class="col-md-12 sin-padding">
                    <div class="row">
                    @foreach($courses as $course)
                        <div class="col-md-6 col-xl-3 col-sm-12 col-12">
                            <div class="item-opor">
                                <div class="row sin-margin">
                                    <div class="col-sm-12 col-12">
                                        <img src="{{url('')}}/image/{{ $course->img }}" width="313px" height="117px" class="img-responsive w-100 h-155">
                                    </div>
                                    <div class="col-sm-12 col-12 p-t-7 contenedor-padding">
                                        <label class="precio">{{ \App\Http\Controllers\CourseController::GetPrecio($course->id); }}</label>
                                    </div>
                                    <div class="col-sm-12 col-12 contenedor-padding m-t-10">
                                        <label class="texto card-titulo">{{ $course->name }}</label>
                                    </div>

                                    <div class="col-sm-12 col-12 contenedor-padding">
                                        <label class="texto2">{{ $course->description }}</label>
                                    </div>
                                    <div class="col-sm-12 col-12 a-center contenedor-padding m-t-10">
                                        <a href="{{ route('courses.show', $course->id) }}"><label class="info2">Pedir información</label></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection