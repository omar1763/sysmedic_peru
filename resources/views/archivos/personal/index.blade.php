@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.personal.title')</h3>
    <p>
        <a href="{{ route('admin.personal.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($personal) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>@lang('global.personal.fields.nombres')</th>
                        <th>@lang('global.personal.fields.apellidos')</th>
                        <th>@lang('global.personal.fields.dni')</th>
                        <th>@lang('global.personal.fields.telefono')</th>
                        <th>@lang('global.personal.fields.direccion')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($personal) > 0)
                        @foreach ($personal as $prs)
                            <tr data-entry-id="{{ $prs->id }}">
                                <td></td>

                                <td>{{ $prs->nombres }}</td>
                                <td>{{ $prs->apellidos }}</td>
                                <td>{{ $prs->dni }}</td>
                                <td>{{ $prs->telefono }}</td>
                                <td>{{ $prs->direccion }}</td>
                                <td>
                                    <a href="{{ route('admin.personal.edit',[$prs->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.personal.destroy', $prs->id])) !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.personal.mass_destroy') }}';
    </script>
@endsection
