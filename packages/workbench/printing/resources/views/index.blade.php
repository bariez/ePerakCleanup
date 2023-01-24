@extends('laravolt::apim.layouts.base')


@section('content')

<div class="row">
    <div class="col s12 m12 l12">
      	<div id="html-validations" class="card card-tabs">
        	<div class="card-content">
          		<div class="card-title">
            		<div class="row">
         			 	<div class="col s12 m6 l10">
                			<h4 class="card-title">Title</h4>
              			</div>
              			<div class="col s12 m6 l2"></div>
            		</div>
            		  <div class="row">
			              <div class="input-field col m6 s12">
			                <input class="validate"  type="text" id="name" name="name" required>
			                <label for="name" id="name_label">aaaaa <span class="req">*</span></label>
			              </div>
			              <div class="input-field col m6 s12">
			                <input class="validate"  type="text" id="ca_no" name="ca_no" required>
			                <label for="ca_no" id="ca_no_label">bbbb <span class="req">*</span></label>
			              </div>
			            </div>
		      	</div>
			</div>
		</div>
	</div>
</div>
@endsection