      
        <div class="col-xs-12 form-group">
            {!! Form::label('servicio', 'Servicio*', ['class' => 'control-label']) !!}
            {!! Form::select('servicio', $servicio, old('servicio'), [ 'id'=>'servicios','class' => 'form-control select2', 'required' => 'required']) !!}
            <p class="help-block"></p>
            @if($errors->has('servicio'))
                <p class="help-block">
                    {{ $errors->first('servicio') }}
                </p>
            @endif
        </div>

        <div class="row">
            
        <div class="col-md-6 id="ser">

        </div>
        </div>





@section('javascript') 


        <script type="text/javascript">
      $(document).ready(function(){
        $('#servicios').on('change',function(){
          var link;
            link = '/existencias/atencion/dataServicios/'+$(this).val();
          $.ajax({
                 type: "get",
                 url:  link,
                 success: function(a) {
                    $('#ser').html(a);
                 }
          });

        });
        

      });
       
    </script>

@endsection
