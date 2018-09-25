@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.existencias.title')</h3>
    
    {!! Form::model($productos, ['method' => 'PUT', 'route' => ['admin.productos.update', $productos->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', 'Nombre*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('medida', 'Presentaciòn*', ['class' => 'control-label']) !!}
                    {!! Form::select('medida', $medida, old('medida'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('medida'))
                        <p class="help-block">
                            {{ $errors->first('medida') }}
                        </p>
                    @endif
                </div>
            </div>
            
              <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cantidad', 'Cantidad', ['class' => 'control-label']) !!}
                    {!! Form::number('cantidad', old('cantidad'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cantidad'))
                        <p class="help-block">
                            {{ $errors->first('cantidad') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('precio', 'Precio*', ['class' => 'control-label']) !!}
                    {!! Form::text('precio', old('precio'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('precio'))
                        <p class="help-block">
                            {{ $errors->first('precio') }}
                        </p>
                    @endif
                </div>
            </div>
            
            
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@include('partials.javascripts')

@section('javascript') 

 <script>
    $('#precio').priceFormat({
    prefix: '',
    thousandsSeparator: '',
    clearOnEmpty: true
    });
    </script>
@endsection

