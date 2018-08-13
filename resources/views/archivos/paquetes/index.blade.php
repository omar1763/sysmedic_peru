@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.paquetes.title')</h3>
     <p>
        <a href="{{ route('admin.paquetes.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

  
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($paquetes) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>@lang('global.paquetes.fields.name')</th>
                        <th>@lang('global.paquetes.fields.costo')</th>
                        <th>@lang('global.paquetes.fields.servicios')</th>
                        <th>Analisis</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($paquetes) > 0)
                        @foreach ($paquetes as $paq)
                            <tr data-entry-id="{{ $paq->id }}">
                                <td></td>

                                <td>{{ $paq->name }}</td>
                                <td>{{ $paq->costo }}</td>
                                 <td> 
                                  @if($paquetes_servicios->selectAllServicios($paq->id))
                                  {{$paquetes_servicios->selectAllServicios($paq->id)}}
                                  @else
                                  <small class="label pull-left bg-red">Sin Servicio</small>
                                  @endif
                              </td>



                              <td> 
                 @if($paquetes_analises->selectAllAnalisis($paq->id))
                {{$paquetes_analises->selectAllAnalisis($paq->id)}}
                                  @else
                                  <small class="label pull-left bg-red">Sin Analisis</small>
                                  @endif
                              </td>












                             

                                <td>
                                    <a href="{{ route('admin.paquetes.edit',[$paq->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.paquetes.destroy', $paq->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.paquetes.mass_destroy') }}';
    </script>
@endsection
