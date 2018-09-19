@extends('layouts.app')

@section('content')



            {!! Form::open(['method' => 'POST', 'route' => ['admin.resultadospaqserv.store']]) !!}
            {{ Form::hidden('id', $id) }}
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="page-title">@lang('global.resultadospaqserv.title')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="row">
           
                    

                  <div class="container-fluid">
                    @if (!$exists)
                    <textarea class="ckeditor" name="editor1" id="editor1" rows="10" cols="80">

                    </textarea>
                    @else
                    <div class="info-box info-box bg-green">
                      <span class="info-box-icon"><i class="fa fa-comments-o"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">El Resultado ya Fue Procesado</span>



                        <span class="progress-description">
                          <h4>


                            {!! $comentario !!}


                          </h4>
                        </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    @endif

                  </div>
                  
             
        </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer " style="text-align: right;">
                @if (!$exists)
                     
              {!! Form::submit('GUARDAR', ['class' => 'btn btn-danger']) !!}
                      @endif
              </div>


            
</div>

    @include('partials.javascripts')

@stop



