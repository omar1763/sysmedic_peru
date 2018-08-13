      
        <div class="col-md-6 ">
            {!! Form::label('product', 'Productos*', ['class' => 'control-label']) !!}
            {!! Form::select('product[]', $product, old('product'), ['id'=>'product','class' => 'form-control select2', 'multiple' => 'multiple']) !!}
           
        </div>

       



  