      <div class="row">
        <div class="col-md-6 ">
            {!! Form::label('product', 'Productos*', ['class' => 'control-label']) !!}
            {!! Form::select('product[]', $product, old('product'), ['id'=>'product','class' => 'form-control select2', 'multiple' => 'multiple']) !!}
           
        </div>

        <div class="col-md-6">
            {!! Form::label('cant', 'Cantidad a Vender', ['class' => 'control-label']) !!}
            {!! Form::text('cant', old('cant'), ['class' => 'form-control', 'placeholder' => 'Ingrese el Monto', 'required' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('cant'))
            <p class="help-block">
              {{ $errors->first('cant') }}
            </p>
            @endif
          </div>               
        </div>
        

       



  