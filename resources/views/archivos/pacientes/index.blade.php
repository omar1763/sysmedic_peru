@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.pacientes.title')</h3>
     <p>
        <a href="{{asset('/pacientes/create')}}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

  
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($pacientes) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>@lang('global.pacientes.fields.dni')</th>
                        <th>@lang('global.pacientes.fields.nombres')</th>
                        <th>@lang('global.pacientes.fields.apellidos')</th>
                        <th>@lang('global.pacientes.fields.direccion')</th>
                        <th>@lang('global.pacientes.fields.provincia')</th>
                        <th>@lang('global.pacientes.fields.distrito')</th>
                        <th>@lang('global.pacientes.fields.telefono')</th>
                        <th>@lang('global.pacientes.fields.fechanac')</th>
                        <th>@lang('global.pacientes.fields.gradoinstruccion')</th>
                        <th>@lang('global.pacientes.fields.ocupacion')</th>
                        <th>@lang('global.pacientes.fields.edocivil')</th>
                         <th>@lang('global.pacientes.fields.historia')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($pacientes) > 0)
                        @foreach ($pacientes as $pac)
                            <tr data-entry-id="{{ $pac->id }}">
                                <td></td>

                                <td>{{ $pac->dni }}</td>
                                <td>{{ $pac->nombres }}</td>
                                <td>{{ $pac->apellidos }}</td>
                                <td>{{ $pac->direccion }}</td>
                                <td>{{ $pac->provincia }}</td>
                                <td>{{ $pac->distrito }}</td>
                                <td>{{ $pac->telefono }}</td>
                                <td>{{ $pac->fechanac }}</td>
                                <td>{{ $pac->gradoinstruccion }}</td>
                                <td>{{ $pac->ocupacion }}</td>
                                <td>{{ $pac->edocivil }}</td>
                                <td>{{ $pac->historia }}</td>
                            
                                <td>
                                    <a href="{{asset('/pacientes/edit')}}/{{$pac->id}}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['pacientes.destroy', $pac->id])) !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.pacientes.mass_destroy') }}';
    </script>
@endsection
