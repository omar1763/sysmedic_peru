@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.atencion.title')</h3>
     <p>
        <a href="{{ route('admin.atencion.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

  
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($atencion) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('global.atencion.fields.id')</th>
                        <th>@lang('global.atencion.fields.paciente')</th>
                        <th>@lang('global.atencion.fields.servicio')</th>
                        <th>@lang('global.atencion.fields.costo')</th>
                        <th>@lang('global.atencion.fields.porcentaje')</th>
                        <th>@lang('global.atencion.fields.acuenta')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($atencion) > 0)
                        @foreach ($atencion as $atec)
                            <tr data-entry-id="{{ $ing->id }}">
                                <td></td>

                                <td>{{ $atec->id }}</td>
                      
                                <td>
                                    <a href="{{ route('admin.atencion.edit',[$atec->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.ingresos.destroy', $atec->id])) !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.atencion.mass_destroy') }}';
    </script>
@endsection
