@if(Session::has('success'))
	<div class="row">
		<div class="col-lg-8 col-md-2 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
	  		<p class="text-success">
	  			{{Session::get('success') }}
	  		</p>
	 	</div>
	</div>
@elseif(Session::has('error'))
	<div class="row">
		<div class="col-md-3">
	  		<p class="text-danger">
	  			{{Session::get('error') }}
	  		</p>
	 	</div>
	</div>
@endif