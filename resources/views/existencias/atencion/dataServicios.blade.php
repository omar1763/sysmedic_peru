    <div class="panel panel-default">
        
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($servicios) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>@lang('global.servicios.fields.detalle')</th>
                        <th>@lang('global.servicios.fields.precio')</th>
                        <th>@lang('global.servicios.fields.porcentaje')</th>
                 
                      
                        <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($servicios) > 0)
                        @foreach ($servicios as $ser)
                            <tr data-entry-id="{{ $ser->id }}">
                                <td></td>

                                <td>{{ $ser->detalle }}</td>
                                <td>{{ $ser->precio }}</td>
                                <td>{{ $ser->porcentaje }}</td>
                            

                            </tr>
                        @endforeach

                    @endif
                </tbody>
            </table>
        </div>
    </div>


