@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.labporpagar.title')</h3>
   
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($labporpagar) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>@lang('global.labporpagar.fields.id_atencion')</th>
                        <th>@lang('global.labporpagar.fields.name')</th>
                        <th>@lang('global.labporpagar.fields.monto')</th>
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($labporpagar) > 0)
                        @foreach ($labporpagar as $lab)
                            <tr data-entry-id="{{ $lab->id }}">
                                <td></td>

                                <td>{{ $lab->id_atencion }}</td>
                                <td>{{ $lab->name }}</td>
                                <td>{{ $lab->costlab }}</td>
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure_pay")."');",
                                        'route' => ['admin.labporpagar.destroy', $lab->id])) !!}
                                    {!! Form::submit(trans('global.app_pay'), array('class' => 'btn btn-xs btn-danger')) !!}
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
        window.route_mass_crud_entries_destroy = '{{ route('admin.labporpagar.mass_destroy') }}';
    </script>
@endsection
