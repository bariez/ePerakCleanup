<style type="text/css">
  hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
        border-top-color: currentcolor;
        border-top-style: none;
        border-top-width: 0px;
    border-top: 1px solid #eee;
}
hr {
    height: 0;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
}
</style>
<div id="knowledge">
	<div class="card border-radius-6">
   		<div class="card-content">
       		    <h6 class="mb-2 mt-2"><i class="material-icons">comment</i>&nbsp;Knowledge-Info</h6>
      			<hr>
      		<div class="row">
        	  <div class="col s12 m12">
        	 	<div class="box box-primary" style="overflow: auto;font-size:12px">
              		<div class="box-body">

                   
                		<strong>API Purpose :</strong>
		                			<p class="text-muted">
		                  				{{data_get($data_api,'api_purpose')}}
		                			</p>
                				<hr>
				                <strong>Method</strong>
					                <p class="text-muted">
					                  <pre class=" language-markup border-radius-6">{{data_get($data_api_scheme,'api_protocol')}}</pre>
					                </p>
				                <hr>
				                <strong>Parameter</strong>
				                	<p class="text-muted">
				                  	  @if(!empty(count($parameter)))
						                
						                @foreach($parameter as $key =>$data)
						                  <pre class=" language-markup border-radius-6">{string}  -  {{data_get($data,'param_name')}}</pre>
						                   
						                @endforeach
					                  @else
					                   <pre class=" language-markup border-radius-6">No Data</pre>
					                  @endif
				                	</p>
			                	 <hr>
					                <strong>Security - <span onclick="reveal()" style="cursor: pointer;color:red">SHOW/HIDE</span></strong>
					                <div id="skey" style="display:none">
					                  <br>
					                <br>
					                   <span class="border-radius-6 white-text badge gradient-45deg-purple-deep-orange gradient-shadow users-view-id" style="margin-left:unset;font-size: 11px;float: left;">Please keep me save!! [key : {{auth()->user()->security_token}}]</span>
					                  </div>
					                  <br>
					                  <br>
					                <p>
					                  <span style="color:blue"></span></p><pre class=" language-markup border-radius-6">Please use this in header request<br>OR<br>use as additional parameter<br>apikey = {{substr(auth()->user()->security_token, 0, 5)}}XXXXXXXXXXXXXX</pre>
					                <p></p>
					                

					                <hr>
				                	<strong>Sample : </strong>
					                  <p class="text-muted">
						                  <pre class=" language-markup border-radius-6">@foreach($parameter as $key =>$data){{data_get($data,'param_name')}}={{data_get($data,'sample_data')}}<br>@endforeach</pre>
					                 </p>
				                	<hr>
								                	     
				                        <?php 


				                    ?>
		                	     	<strong>Usage Development</strong>
					                <p><span style="color:blue"></span></p>	
					                	@if($api->api_main->devurl->send_core == 1) 
		                              <pre class=" language-markup border-radius-6">{{env('CORE').$api->api_main->devurl->core_route}}</pre>
		                            @else
		                              <?php 

		                                if($api->api_main->devurl->port == 443)
		                                {
		                                    $port = 'https';

		                                }else
		                                {
		                                   $port = 'http';
		                                }

		                                if(($api->api_main->devurl->port == 80) OR ($api->api_main->devurl->port == 443))
		                                {
		                                  $apiurlp = $port.'://'.$api->api_main->devurl->url.data_get($api,'api_main.devurl.path');

		                                }else
		                                {
		                                  $apiurlp = $port.'://'.$api->api_main->devurl->url.':'.$api->api_main->devurl->port.data_get($api,'api_main.devurl.path');
		                                }
		                              ?>

		                              <pre class=" language-markup border-radius-6">{{$apiurlp}}</pre>
		                              
		                            @endif
					              
				                    <strong>Usage Staging</strong>
					                <p>
					                  <span style="color:blue"></span></p>
					                  @if($api->api_main->stageurl->send_core == 1) 
		                              <pre class=" language-markup border-radius-6">{{env('CORE').$api->api_main->stageurl->core_route}}
		                              </pre>
		                              @else
		                              <?php 

		                                if($api->api_main->stageurl->port == 443)
		                                {
		                                    $port = 'https';

		                                }else
		                                {
		                                   $port = 'http';
		                                }

		                                if(($api->api_main->stageurl->port == 80) OR ($api->api_main->stageurl->port == 443))
		                                {
		                                  $apiurlp = $port.'://'.$api->api_main->stageurl->url.data_get($api,'api_main.stageurl.path');

		                                }else
		                                {
		                                  $apiurlp = $port.'://'.$api->api_main->stageurl->url.':'.$api->api_main->stageurl->port.data_get($api,'api_main.stageurl.path');
		                                }
		                              ?>
		                              
		                              <pre class=" language-markup border-radius-6">{{$apiurlp}}</pre>
		                              
		                            @endif
					                
				                	<strong>Usage Production</strong>
					                <p>
					                  <span style="color:blue"></span></p>

					                @if($api->api_main->produrl->send_core == 1) 
		                                <pre class=" language-markup border-radius-6">{{env('CORE').$api->api_main->produrl->core_route}}</pre>
		                            @else
		                              <?php 

		                                if($api->api_main->produrl->port == 443)
		                                {
		                                    $port = 'https';

		                                }else
		                                {
		                                   $port = 'http';
		                                }

		                                if(($api->api_main->produrl->port == 80) OR ($api->api_main->produrl->port == 443))
		                                {
		                                  $apiurlp = $port.'://'.$api->api_main->produrl->url.data_get($api,'api_main.produrl.path');

		                                }else
		                                {
		                                  $apiurlp = $port.'://'.$api->api_main->produrl->url.':'.$api->api_main->produrl->port.data_get($api,'api_main.produrl.path');
		                                }
		                              ?>
		                              
		                            @endif
					                <p></p>

					                <hr>
					                   <strong>Return : </strong>
					                <p>
					                  	<span style="color:blue"></span></p><pre class=" language-markup border-radius-6">{{data_get($data_api_scheme,'data_format')}}</pre>
					                <p></p>

					                 <hr>
					                   <strong>Description : </strong>
					                <p>
					                  	<span style="color:blue"></span></p><pre class=" language-markup border-radius-6">{!! data_get($knowledgeBase,'description') !!}</pre>
					                <p></p>

        			</div>
      			</div>
    		 </div>
		  </div>
		</div>
	</div>
</div>
