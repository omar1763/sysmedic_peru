@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.atencion.title')</h3>
     <p>
        <a href="{{ route('admin.atencion.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
      {!! Form::open(['method' => 'get', 'route' => ['admin.atencion.index']]) !!}



      <div class="row">
        <div class="col-md-4">
            {!! Form::label('fecha', 'Seleccione una Fecha', ['class' => 'control-label']) !!}
            {!! Form::date('fecha', old('fechanac'), ['id'=>'fecha','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('fecha'))
            <p class="help-block">
                {{ $errors->first('fecha') }}
            </p>
            @endif
        </div>
        <div class="col-md-4">
            {!! Form::submit(trans('global.app_search'), array('class' => 'btn btn-info')) !!}
            {!! Form::close() !!}

        </div>
    </div>
     
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($atencion) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>ID</th>
                        <th>Paciente</th>
                        <th>Origen</th>
                        <th>Detalle</th>
                        <th>Total</th>
                        <th>P.Unit</th>
                        <th>Porcentaje</th>
                        <th>Monto Abonar</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($atencion) > 0)
                        @foreach ($atencion as $atec)
                            <tr data-entry-id="{{ $atec->id }}">
                                <td></td>
                                <td>{{ $atec->id_atencion }}</td>
                                <td>{{ $atenciondetalle->selectPaciente($atec->id_paciente) }}</td>
                                <td>{{ $atenciondetalle->selectProfesional($atec->id_profesional) }}</td>
                                <td>{{ $atec->detalle }}</td>
                                <td>{{ $atec->costo }}</td>
                                <td>{{ $atec->precio }}</td>
                                <td>{{ $atec->porcentaje }}</td>
                                <td>{{ $atec->costoa }}</td>

                                <td>
                                  <a  target="_blank" href="{{asset('ticket_atencion_ver')}}/{{$atec->id_atencion}}" class="btn btn-xs btn-success">@lang('global.app_imprimirt')</a>
                                  
                                 @if(Auth::user()->rol!="Recepcionista")

                                 <a href="{{ route('admin.atencion.edit',[$atec->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>


                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.atencion.destroy', $atec->id_atencion])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.atencion.mass_destroy') }}';
    </script>
@endsection
