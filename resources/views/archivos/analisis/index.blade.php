@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.analisis.title')</h3>
    <p>
        <a href="{{ route('admin.analisis.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($analisis) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>@lang('global.analisis.fields.name')</th>
                        <th>@lang('global.analisis.fields.laboratorio')</th>
                        <th>Tiempo de Entrega</th>
                        <th>Material</th>
                        <th>@lang('global.analisis.fields.preciopublico')</th>
                        <th>@lang('global.analisis.fields.costlab')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($analisis) > 0)
                        @foreach ($analisis as $ana)
                            <tr data-entry-id="{{ $ana->id }}">
                                <td></td>

                                <td>{{ $ana->name }}</td>
                                <td>{{ $ana->laboratorio }}</td>
                                <td>{{ $ana->tiempo }}</td>
                                <td>{{ $ana->material }}</td>
                                <td>{{ $ana->preciopublico }}</td>
                                <td>{{ $ana->costlab }}</td>
                                <td>
                                    <a href="{{ route('admin.analisis.edit',[$ana->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.analisis.destroy', $ana->id])) !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.analisis.mass_destroy') }}';
    </script>
@endsection
