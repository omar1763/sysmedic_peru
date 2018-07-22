    <div class="col-md-6">
                <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('acuenta', 'Monto a Abonar', ['class' => 'control-label']) !!}
                    {!! Form::text('acuenta', old('acuenta'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('acuenta'))
                        <p class="help-block">
                            {{ $errors->first('acuenta') }}
                        </p>
                    @endif
                </div>
            </div>

           </div>

@include('partials.javascripts')

@section('javascript') 

<script>
    $('#acuenta').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
    });
    </script>

@endsection

