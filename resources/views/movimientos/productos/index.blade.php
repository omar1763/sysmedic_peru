@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.existencias.title')</h3>
  
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($productos) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>@lang('global.productos.fields.nombre')</th>
                        <th>@lang('global.productos.fields.cantidad')</th>
                        <th>@lang('global.productos.fields.medida')</th>
                         <th>Precio</th>
                        <th>@lang('global.ingresos.fields.fecha')</th>


                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($productos) > 0)
                        @foreach ($productos as $prod)
                            <tr data-entry-id="{{ $prod->id }}">
                                <td></td>

                                <td>{{ $prod->name }}</td>
                                <td>{{ $prod->cantidad }}</td>
                                <td>{{ $prod->medida }}</td>
                                <td>{{ $prod->precio }}</td>
                                <td>{{ $prod->updated_at }}</td>

                              
                                <td>
                                    @if(Auth::user()->rol!="Recepcionista")

                                    <a href="{{ route('admin.productos.edit',[$prod->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.productos.destroy', $prod->id])) !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.productos.mass_destroy') }}';
    </script>
@endsection
