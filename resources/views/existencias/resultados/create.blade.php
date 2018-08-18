@extends('layouts.app')

@section('content')



            {!! Form::open(['method' => 'POST', 'route' => ['admin.resultados.store']]) !!}
            {{ Form::hidden('id', $id) }}
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="page-title">@lang('global.resultados.title')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="row">
           
                    

                    <div class="container-fluid">
                       
                            <textarea class="ckeditor" name="editor1" id="editor1" rows="10" cols="80">
                                Este es el textarea que es modificado por la clase ckeditor
                            </textarea>
                       
                    </div>
             
        </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer " style="text-align: right;">
              {!! Form::submit('GUARDAR', ['class' => 'btn btn-danger']) !!}
              </div>


            
</div>


























    
    


   
   

    @include('partials.javascripts')

@stop



