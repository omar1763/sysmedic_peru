    <div class="panel panel-default">
        
        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($pacientes) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>

                        <th>@lang('global.pacientes.fields.dni')</th>
                        <th>@lang('global.pacientes.fields.nombres')</th>
                        <th>@lang('global.pacientes.fields.apellidos')</th>
                        <th>@lang('global.pacientes.fields.telefono')</th>
                        <th>@lang('global.pacientes.fields.direccion')</th>
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
                                <td>{{ $pac->telefono }}</td>
                                <td>{{ $pac->direccion }}</td>
                                <td>{{ $pac->historia }}</td>



                            </tr>
                        @endforeach

                    @endif
                </tbody>
            </table>
        </div>
    </div>


