@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.otrosingresos.title')</h3>
     <p>
        <a href="{{ route('admin.otrosingresos.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
      {!! Form::open(['method' => 'get', 'route' => ['admin.otrosingresos.index']]) !!}

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
            <table class="table table-bordered table-striped {{ count($otrosingresos) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('global.otrosingresos.fields.descripcion')</th>
                        <th>@lang('global.otrosingresos.fields.monto')</th>
                       <!-- <th>@lang('global.otrosingresos.fields.origen')</th>-->
                        <th>@lang('global.otrosingresos.fields.causa')</th>
                        <th>@lang('global.otrosingresos.fields.detallecausa')</th>
                        <th>@lang('global.otrosingresos.fields.created_at')</th>
                    
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($otrosingresos) > 0)
                        @foreach ($otrosingresos as $otr)
                            <tr data-entry-id="{{ $otr->id }}">
                                <td></td>

                                <td>{{ $otr->descripcion }}</td>
                                <td>{{ $otr->monto }}</td>
                                <!--<td>$otr->origen</td>-->
                                <td>
                                    @if ($otr->causa == 'V')
                                    <span> VENTAS</span>
                                    @elseif ($otr->causa == 'CC')
                                    <span>CUENTAS POR COBRAR</span>
                                    @else                                    
                                    <span>OTROS</span>
                                    @endif
                                </td>
                                <td>



                                    @if ($otr->causa == 'V')
                                    {{$creditosproductos->selectAllProductos($otr->id)}}
                                    
                                    @else                                    
                                    <span>No Aplica</span>
                                    @endif

                               </td>
                                <td>{{ $otr->created_at }}</td>
                     
                                <td>
                                  @if(Auth::user()->rol!="Recepcionista")

                                    <a href="{{ route('admin.otrosingresos.edit',[$otr->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("Esta seguro de Eliminar?")."');",
                                        'route' => ['admin.otrosingresos.destroy', $otr->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endif
                                </td>

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
        window.route_mass_crud_entries_destroy = '{{ route('admin.otrosingresos.mass_destroy') }}';
    </script>
@endsection
