<br>
<div id="overview">
<div class="intro-y box col-span-12">
            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200 dark:border-dark-5">
                <h2 class="font-medium text-base mr-auto">
                    Knowledge Info
                </h2>
               @if(data_get($countapiapproved,'id') != null)
               <a href="{!! URL::to('developer/exportknowledge/'.$id)  !!}" class="btn btn-sm btn-round has-ripple gradient-45deg-indigo-purple btn-small Right ml-1" style="font-size: 10px;height: 30px;padding-left:10px;padding-right:10px;margin-right: 10px;"><i class="material-icons left">picture_as_pdf</i> PDF <i class="material-icons">file_download</i>
                         </a>
              @endif
            </div>



			<div class="col-span-12 lg:col-span-12 2xl:col-span-9">
				<!-- BEGIN: Display Information -->
				<div class="intro-y box lg:mt-5">

			<div class="p-5">
				<div class="flex flex-col-reverse xl:flex-row flex-col">
				    <div class="flex-1 mt-6 xl:mt-0">
				        <div class="grid grid-cols-12 gap-x-5">
				            <div class="col-span-12 2xl:col-span-12" style="font-size:12px">
				                <div>
				                    <label for="update-profile-form-1" class="form-label"><strong>API Purpose :</strong></label>
				                    <input id="update-profile-form-1" type="text" class="form-control" placeholder="Input text" value="{{data_get($data_api,'api_purpose')}}" disabled>
				                </div>
				                <br>
									<hr>
									<br>
				                <div>
				                    <label for="update-profile-form-1" class="form-label"><strong>Method</strong></label>
				                    <pre class=" language-markup border-radius-6">{{data_get($data_api_scheme,'api_protocol')}}</pre>
				                </div>
				                <br>
									<hr>
									<br>
									<div>
				                    <label for="update-profile-form-1" class="form-label"><strong>API Type</strong></label>
				                    <pre class=" language-markup border-radius-6">{{data_get($data_api_scheme,'api_type')}}</pre>
				                </div>
				                <br>
									<hr>
									<br>
									<label for="update-profile-form-1" class="form-label"><strong>Parameter</strong></label>
									 <p class="text-muted">
				              	  @if(!empty(count($parameter)))
					                
					                 @foreach($api->api_main->parameter->where('param_type','<>','header') as $param)

					                     <pre class=" language-markup border-radius-6">{ {{$param->param_type}} }  -  {{$param->param_name}}</pre>
					 
					                 
					                @endforeach
				                  @else
				                   <pre class=" language-markup border-radius-6">No Data</pre>
				                  @endif
				        		</p>
				        		<br>
									<hr>
									<br>
									<strong>Header Values</strong>
					                <p class="text-muted">
					                  @if(count($api->api_main->parameter->where('param_type','=','header')) > 0)
					                    @foreach($api->api_main->parameter->where('param_type','=','header') as $param)
					                     
					                      <pre class=" language-markup border-radius-6">{{$param->param_name}} : "{{$param->sample_data}}</pre>
					                    @endforeach
					                  @else
					                  <pre class=" language-markup border-radius-6">No Header Value specified</pre>
					                  @endif

					                </p>
					                <br>
					                <hr>
					                <br>
									   <strong>Security - <span onclick="reveal()" style="cursor: pointer;color:red">SHOW/HIDE</span></strong>
					                 <div id="skey" style="display:none">
					                  <br>
					                   <br>
					                   <span id="sskey" class="border-radius-6 white-text badge gradient-45deg-purple-deep-orange gradient-shadow users-viSew-id" style="margin-left:unset;font-size: 11px;float: left;">Please keep me save!! [key : {{auth()->user()->security_token}}]</span><div onclick="myCopy('{{auth()->user()->security_token}}');this.innerHTML='Copied'" class="py-1 px-2 rounded-full text-xs bg-theme-10 text-white cursor-pointer font-medium gradient-45deg-orage-orange" style="float:right">Copy</div>
					                  </div>
					                  <br>
					                  <br>
					                <p>
					                  <span style="color:blue"></span></p><pre class=" language-markup border-radius-6">Please use this in header request<br>OR<br>use as additional parameter<br>apikey = {{substr(auth()->user()->security_token, 0, 5)}}XXXXXXXXXXXXXX</pre>
					                <p></p>
					             <hr>

                @if($api->api_main->type->id == 1)
                <strong>Curl Usage Sample : </strong>
             
                  <p class="text-muted">
                  <pre class=" language-markup border-radius-6"><b>[Curls] :<br>-------------------------------------</b><br>curl -X {{$api->api_main->protocol->api_protocol}} -d "param1{PARAM1}{{'$'}}param2{PARAM2}" -H "apikey:{{substr(auth()->user()->security_token, 0, 5)}}XXXXXXXXXXXXXX'" {{env('CORE').$api->api_main->devurl->core_route}}<br>-------------------------------------<br><br><br><b>[PHP file_get_contents] :<br>-------------------------------------</b><br>$url = "{{env('CORE').$api->api_main->devurl->core_route}}";<br>$parameters = array(<br>@foreach($api->api_main->parameter as $param)  '{{$param->param_name}}'=>'{{$param->sample_data}}',<br>@endforeach);<br><br>$options = array('http' => array(<br>  'header'  => 'apikey: {{substr(auth()->user()->security_token, 0, 5)}}XXXXXXXXXXXXXX',<br>  'header'  => 'Content-Type: application/x-www-form-urlencoded\r\n',<br>  'method'  => '{{$api->api_main->protocol->api_protocol}}',<br>  'content' => http_build_query($parameters)<br>));<br><br>$context  = stream_context_create($options);<br>$result = file_get_contents($url, false, $context);<br>-------------------------------------<br><br><br><b>[.NET-C# Curls] :<br>-------------------------------------</b><br>using (var httpClient = new HttpClient())
{
    using (var request = new HttpRequestMessage(new HttpMethod("{{$api->api_main->protocol->api_protocol}}"), "{{env('CORE').$api->api_main->devurl->core_route}}"))
    {
        request.Headers.TryAddWithoutValidation("apikey", "{{substr(auth()->user()->security_token, 0, 5)}}XXXXXXXXXXXXXX'"); 

        request.Content = new StringContent("param1{PARAM1}{{'$'}}param2{PARAM2}");
        request.Content.Headers.ContentType = MediaTypeHeaderValue.Parse("application/x-www-form-urlencoded"); 

        var response = await httpClient.SendAsync(request);
    }
}<br>-------------------------------------<br></pre>
                </p>
                <hr>
                 @else
                <?php $soupurl=''; ?>
                @if(count($api->api_main->parameter->where('param_type','=','header')) > 0)
                      @foreach($api->api_main->parameter->where('param_type','=','header') as $param)

                        @if($param->param_name == 'SOAPAction')
                          <?php $soupurl=$param->sample_data ?>

                        @else
                                <?php $soupurl=''; ?>
                        @endif
                     
                     @endforeach
                  @else
                    <?php $soupurl=''; ?>
                  @endif

                  
                  <?php

                    $actioncode = basename($soupurl);

                    if(count($api->api_main->parameter->where('param_type','<>','header')) > 0)
                    {
                        
                        $xml_post_string  = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><'.$actioncode.' xmlns="http://www.outsystems.com"><Request>';
                                
                            foreach ($api->api_main->parameter->where('param_type','<>','header') as $param) 
                            {
                               $xml_post_string .='<'.$param->param_name.'>'.$param->sample_data.'</'.$param->param_name.'>';
                            }

                        $xml_post_string .= '</Request></'.$actioncode.'></soap:Body></soap:Envelope>';

                    }else
                    {
                        $xml_post_string  = '<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/"><soap:Body><'.$actioncode.' xmlns="http://www.outsystems.com"><Request></Request></'.$actioncode.'></soap:Body></soap:Envelope>';
                    }

                    $escaped = htmlentities($xml_post_string);
                    $formatted = str_replace('&lt;', '<span>&lt;', $escaped);
                    $formatted = str_replace('&gt;', '&gt;</span>', $formatted);
                    $formatted = str_replace("&lt;/","<br>&lt;/",$formatted);
                    $formatted = str_replace('xmlns:', '<br>xmlns:', $formatted);
                    $formatted = str_replace('<span><br>&lt;/', '<span>&lt;/', $formatted);
                    $formatted = str_replace('/&gt;</span>', '/&gt;</span><br>', $formatted);
               
                  ?>
                  <strong>Curl Usage Sample Of SOAP API: </strong>
                                   <p class="text-muted">
                  <pre class=" language-markup border-radius-6"><b>[Curls] :<br>-------------------------------------</b><br>curl<br>--header "Content-Type: text/xml;charset=UTF-8"<br>--header "SOAPAction:{{$soupurl}}"<br>--data @request.xml {{env('CORE').$api->api_main->devurl->core_route}}<br>-------------------------------------<br><br><br><b>[XML Body Structure] :<br>-------------------------------------</b><?php echo "<pre>".str_replace("</span><span>","</span><br><span>",$formatted)."</pre>\n"; ?><br>-------------------------------------<br><br><br><b>[.NET-C# SOAP] :<br>-------------------------------------</b><br>The most basic approach is to add it as a Reference from the solution explorer within Visual Studio itself<br>-------------------------------------<br></pre>
                </p>
                <hr>

                @endif
                

									                
							                    <br>
                  								<hr>
                  								<br>
                  								<strong>Usage Development</strong>
								                <p><span style="color:blue"></span></p>	
							                	@if($api->api_main->devurl->send_core == 1)
								                <p>
								                  <span style="color:blue"></span></p>
								                  <pre class=" language-markup border-radius-6">{{env('CORE').$api->api_main->devurl->core_route}} <div onclick="myCopy('{{env('CORE').$api->api_main->devurl->core_route}}');this.innerHTML='Copied'" class="py-1 px-2 rounded-full text-xs bg-theme-10 text-white cursor-pointer font-medium gradient-45deg-orage-orange" style="float:right">Copy</div></pre>
								                <p></p>
								                @else
								                <p>
								                  <span style="color:blue"></span></p>

								                  <?php 

					                                // if($api->api_main->devurl->port == 443)
					                                // {
					                                //     $port = 'https';

					                                // }else
					                                // {
					                                //    $port = 'http';
					                                // }

													$port = $api->api_main->devurl->pro->name;
					                                if(($api->api_main->devurl->port == 80) OR ($api->api_main->devurl->port == 443))
					                                {
					                                  $apiurlp = $port.'://'.$api->api_main->devurl->url.data_get($api,'api_main.devurl.path');

					                                }else
					                                {
					                                  $apiurlp = $port.'://'.$api->api_main->devurl->url.':'.$api->api_main->devurl->port.data_get($api,'api_main.devurl.path');
					                                }
					                              ?>

					                              <pre class=" language-markup border-radius-6">{{$apiurlp}}</pre>
					                              
								                <p></p>
								                @endif
								              
							                    <strong>Usage Staging</strong>
								                <p>
								                  <span style="color:blue"></span></p>
								                   @if($api->api_main->stageurl->send_core == 1)
									                <p>
									                  <span style="color:blue"></span></p>
									                  <pre class=" language-markup border-radius-6">{{env('CORE').$api->api_main->stageurl->core_route}} <div onclick="myCopy('{{env('CORE').$api->api_main->stageurl->core_route}}');;this.innerHTML='Copied'" class="py-1 px-2 rounded-full text-xs bg-theme-10 text-white cursor-pointer font-medium gradient-45deg-orage-orange" style="float:right">Copy</div></pre>
									                <p></p>
									                @else
									                <p>
									                  <span style="color:blue"></span></p>

									                  <?php 

						                                // if($api->api_main->stageurl->port == 443)
						                                // {
						                                //     $port = 'https';

						                                // }else
						                                // {
						                                //    $port = 'http';
						                                // }

														$port = $api->api_main->stageurl->pro->name;
						                                if(($api->api_main->stageurl->port == 80) OR ($api->api_main->stageurl->port == 443))
						                                {
						                                  $apiurlp = $port.'://'.$api->api_main->stageurl->url.data_get($api,'api_main.stageurl.path');

						                                }else
						                                {
						                                  $apiurlp = $port.'://'.$api->api_main->stageurl->url.':'.$api->api_main->stageurl->port.data_get($api,'api_main.stageurl.path');
						                                }
						                              ?>

						                              <pre class=" language-markup border-radius-6">{{$apiurlp}}</pre>
						                              
									                <p></p>
									                @endif
								                <p>
								                
							                	<strong>Usage Production</strong>
								                <p>
								                  <span style="color:blue"></span></p>

								                @if($api->api_main->produrl->send_core == 1)
								                <p>
								                  <span style="color:blue"></span></p>
								                  <pre class=" language-markup border-radius-6">{{env('CORE').$api->api_main->produrl->core_route}} <div onclick="myCopy('{{env('CORE').$api->api_main->produrl->core_route}}');this.innerHTML='Copied'" class="py-1 px-2 rounded-full text-xs bg-theme-10 text-white cursor-pointer font-medium gradient-45deg-orage-orange" style="float:right">Copy</div></pre>
								                <p></p>
								                @else
								                <p>
								                  <span style="color:blue"></span></p>
									                  <?php 

						                                // if($api->api_main->produrl->port == 443)
						                                // {
						                                //     $port = 'https';

						                                // }else
						                                // {
						                                //    $port = 'http';
						                                // }

														$port = $api->api_main->produrl->pro->name;
						                                if(($api->api_main->produrl->port == 80) OR ($api->api_main->produrl->port == 443))
						                                {
						                                  $apiurlp = $port.'://'.$api->api_main->produrl->url.data_get($api,'api_main.produrl.path');

						                                }else
						                                {
						                                  $apiurlp = $port.'://'.$api->api_main->produrl->url.':'.$api->api_main->produrl->port.data_get($api,'api_main.produrl.path');
						                                }
						                              ?>

						                              <pre class=" language-markup border-radius-6">{{$apiurlp}}</pre>
						                              
								                <p></p>
								                @endif
								                <p></p>

								                <br>
                  								<hr>
                  								<br>

                  								<strong>Return : </strong>
								                <p>
								                  	<span style="color:blue"></span></p><pre class=" language-markup border-radius-6">{{data_get($data_api_scheme,'data_format')}}</pre>
								                </p>
								                <br>
                  								<hr>
                  								<br>

                  								 <strong>Description : </strong>
									                <p>
									                  	<span style="color:blue"></span></p><pre class=" language-markup border-radius-6">{!! data_get($knowledgeBase,'description') !!}</pre>
									                </p>

                                            </div>

                                        </div>
                                        
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                       
                        <!-- END: Display Information -->
                  </div>
              </div>
          </div>


