@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.resultados.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.resultados.store']]) !!}

     <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">A continuaciòn por favor redacte su informe:</div>

                    <div class="panel-body">
                        <form>
                            <textarea class="ckeditor" name="editor1" id="editor1" rows="10" cols="80">
                                Este es el textarea que es modificado por la clase ckeditor
                            </textarea>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    {!! Form::close() !!}

    @include('partials.javascripts')

@stop



