    <div class="col-md-6">
                <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('costoa', 'Monto a Abonar', ['class' => 'control-label']) !!}
                    {!! Form::text('costoa', old('costoa'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('costoa'))
                        <p class="help-block">
                            {{ $errors->first('costoa') }}
                        </p>
                    @endif
                </div>
            </div>

           </div>

@include('partials.javascripts')

@section('javascript') 

<script>
    $('#costoa').priceFormat({
    prefix: '',
    centsSeparator: ',',
    thousandsSeparator: '.'
    });
    </script>

@endsection

