@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.profesionales.title')</h3>
    <p>
        <a href="{{ route('admin.profesionales.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($profesionales) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>@lang('global.profesionales.fields.name')</th>
                        <th>@lang('global.profesionales.fields.apellidos')</th>
                        <th>@lang('global.profesionales.fields.especialidad')</th>
                        <th>@lang('global.profesionales.fields.centro')</th>
                        <th>@lang('global.profesionales.fields.cmp')</th>
                        <th>@lang('global.profesionales.fields.codigo')</th>
                        <th>@lang('global.profesionales.fields.nacimiento')</th>

                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($profesionales) > 0)
                        @foreach ($profesionales as $prof)
                            <tr data-entry-id="{{ $prof->id }}">
                                <td></td>

                                <td>{{ $prof->name }}</td>
                                <td>{{ $prof->apellidos }}</td>
                                <td>{{ $prof->especialidad }}</td>
                                <td>{{ $prof->centro }}</td>
                                <td>{{ $prof->cmp }}</td>
                                <td>{{ $prof->codigo }}</td>
                                <td>{{ $prof->nacimiento }}</td>
                                <td>
                                    <a href="{{ route('admin.profesionales.edit',[$prof->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.profesionales.destroy', $prof->id])) !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.profesionales.mass_destroy') }}';
    </script>
@endsection
