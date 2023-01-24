         
<style>
  #status_code{
    display: none;
  }

    .pos-dropdown__dropdown-menu.dropdown-menu.show{
      width: 50% !important;
      /*transform: translate(651px, 1020px) !important*/
    }
    .email-header {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    padding: 1rem 1.5rem 1rem 0;
    border-bottom: 1px solid #e0e0e0;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
}
</style>
                <div>
                <div class="intro-y box px-5 pt-5 mt-5">
                  <div class="font-medium text-base mr-auto">Sandbox</div>
                  <br>
                  <hr>
                       <div class="col-span-12 lg:col-span-12 2xl:col-span-9" style="font-size:12px">
                        <!-- BEGIN: Display Information -->
                        <div class="intro-y box lg:mt-5">
                            {!! form()->open()->post()->attribute('id', 'sandboxform') !!}
                            <div class="p-5">
                                <div class="flex flex-col-reverse xl:flex-row flex-col">
                                    <div class="flex-1 mt-6 xl:mt-0">
                                        <div class="grid grid-cols-12 gap-x-5">
                                          

                                           <input type="hidden" name="id" value="{{$ori_main_app}}"/>
                                          <input type="hidden" name="url" id="actionurl" value="3"/>

                                          @if($listtype==2)<!--unused-->
                                          <input type="hidden" name="key" id="key" value="{{env('KONG_API_KEY')}}"/>
                                          @else
                                          <input type="hidden" name="key" id="key" value="{{$usertoken}}"/>
                                          @endif
                                            <div class="col-span-12 2xl:col-span-12">
                                                 <div class="font-medium text-base mr-auto">Testing API with Parameter</div>
                                                <br>
                                                <hr>
                                                <br>
                                                 <p class="caption">1. Parameter</p>
                                                   <div id="faq-accordion-1" class="accordion accordion-boxed p-5">
                                                        <div class="accordion-item">
                                                                  <div id="faq-accordion-content-2" class="accordion-header">
                                                                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-accordion-collapse-2" aria-expanded="false" aria-controls="faq-accordion-collapse-2"> Show All Parameter</button>
                                                                  </div>
                                                              <div id="faq-accordion-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-2" data-bs-parent="#faq-accordion-1">
                                                                    <hr>
                                                                      <div class="accordion-body text-gray-700 dark:text-gray-600 leading-relaxed">
                                                                       <table class="table"  style="font-size: 11px !important;border-collapse: unset;">
                                                                          <tbody>
                                                                            @foreach($api->api_main->parameter->where('param_type','<>','header') as $param)
                                                                            <tr style="height: 50px;">
                                                                              <td><b>{{$param->param_name}}</b> : </td>
                                                                              <td><input value="{{$param->sample_data}}" type="text" name="parameter[{{$param->param_name}}]" style="font-size: 12px" id="regular-form-1" type="text" class="form-control" placeholder="Input text"></td>
                                                                            </tr>
                                                                           @endforeach
                                                                           
                                                                           </tbody>
                                                                        </table>
                                                                     </div>
                                                              </div>
                                                       </div>
                                                  </div>

                                                    <br>
                                                    <hr>
                                                    <br>
                                                      <p class="caption">2. Header Value</p>
                                                                  <div id="faq-accordion-1" class="accordion accordion-boxed  p-5">
                                                                      <div class="accordion-item">
                                                                          <div id="faq-accordion-content-1" class="accordion-header">
                                                                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-accordion-collapse-1" aria-expanded="false" aria-controls="faq-accordion-collapse-1"> Show All Header Value</button>
                                                                          </div>
                                                                          <div id="faq-accordion-collapse-1" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-1" data-bs-parent="#faq-accordion-1" style="display: none;">
                                                                              <div class="accordion-body text-gray-700 dark:text-gray-600 leading-relaxed">
                                                                                <table class="table"  style="font-size: 11px !important;border-collapse: unset;">
                                                                            <tbody>
                                                                               @if(count($api->api_main->parameter->where('param_type','=','header')) > 0)
                                                                                  @foreach($api->api_main->parameter->where('param_type','=','header') as $param)
                                                                                  <tr style="height: 50px;">
                                                                                    <td><b>{{$param->param_name}}</b> : </td>
                                                                                    <td><input value="{{$param->sample_data}}" type="text" name="header[{{$param->param_name}}]" style="font-size: 12px" id="regular-form-1" type="text" class="form-control" placeholder="Input text"></td>
                                                                                  </tr>
                                                                                 @endforeach
                                                                              @else
                                                                                <tr style="height: 50px;">
                                                                                    <td colspan="2"><b>No Header Value specified</b></td>
                                                                                   
                                                                                  </tr>
                                                                              @endif
                                                                             
                                                                            </tbody>
                                                                          </table>
                                                                              </div>
                                                                          </div>
                                                                      </div>
                                                                      
                                                                  </div>
                                                           
                                                          

                                                    <br>
                                                    <br>
                                                    <hr>
                                                    <br>
                                                    <p class="caption">3.Security / Header</p>
                                                    <p></p>
                                                    @if($listtype==2)<!--unused-->
                                                    <pre class=" language-markup border-radius-6"></pre>
                                                    @else
                                                    <pre class=" language-markup border-radius-6">apikey = {{substr(env('KONG_API_KEY'), 0, 5)}}XXXXXXXXXXXXXX</pre>
                                                    @endif

                                                    <br>
                                                    <hr>
                                                    <br>

                                                     <p class="caption">4. Method and Environment</p>
                                                      <p></p>
                                                                          <?php 

                                                          if($api->api_main->port == 443)
                                                          {
                                                              $port = 'https';

                                                          }else
                                                          {
                                                             $port = 'http';
                                                          }

                                                      ?>


                                   <div class="activity" style="font-size:12px">
                                          <ul class="widget-timeline mb-0">
                                            <li class="timeline-items timeline-icon-blue active">
                                              <div class="timeline-time"> 
                                                <button class="btn btn-sm btn-primary w-24 mr-1 mb-2" name="action" onclick="runtest(0)" value="0" type="button" style="font-size: 12px;height: 30px;background-color: #0352f4;">Test</button>         
                                              </div>
                                              <h6 class="timeline-title">Mockup <p class="timeline-text">METHOD : {{$api->api_main->protocol->api_protocol}}</p></h6>
                                              <p class="timeline-text"><span class="border-radius-6 white-text badge gradient-45deg-purple-deep-orange users-view-id" style="margin-left:unset;font-size: 10px;float:left">CORE : <b>APIM PORTAL</b></span> <br></p>
                                              
                                              <div class="timeline-content grey-text shadow " style="font-size: 12px;">
                                                /mockup/testapi
                                              </div>

                                              <div class="intro-y col-span-12 sm:col-span-12" id="loading_0" style="display: none">
                                                  <div class="col-span-6 sm:col-span-3 xl:col-span-10 flex flex-col items-center">
                                                      <svg width="20" viewBox="0 0 135 140" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8">
                                                          <rect y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="30" y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="60" width="15" height="140" rx="6">
                                                              <animate attributeName="height" begin="0s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="90" y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="120" y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                      </svg> 
                                                      <div class="text-center text-xs mt-2">In Progress</div>
                                                  </div>
                                              </div>
                                            </li>
                                            @if(data_get($data_api,'api_status')!=2)
                                             <li class="timeline-items timeline-icon-cyan active">
                                              <div class="timeline-time"> 
                                                <button class="btn btn-sm btn-primary w-24 mr-1 mb-2" name="action" onclick="runtest(1)" value="1" type="button" style="font-size: 12px;height: 30px;background-color: #03a9f4;">Test</button>         
                                              </div>
                                              <h6 class="timeline-title">Development Environment <p class="timeline-text">METHOD : {{$api->api_main->protocol->api_protocol}}</p></h6>
                                              <p class="timeline-text"><span class="border-radius-6 white-text badge gradient-45deg-purple-deep-orange users-view-id" style="margin-left:unset;font-size: 10px;float:left">@if($api->api_main->devurl->send_core == 1) CORE : <b>created</b> @else CORE : <b>pending</b> @endif</span> <br></p>
                                              
                                              <div class="timeline-content grey-text shadow " style="font-size: 12px;">
                                                @if($api->api_main->devurl->send_core == 1) 
                                                  <b>{{env('CORE').$api->api_main->devurl->core_route}}</b>
                                                @else
                                                  {{$api->api_main->devurl->pro->name.'://'.$api->api_main->devurl->url.data_get($api,'api_main.devurl.path')}}
                                                @endif
                                              </div>
                                                                  
                                              <div class="intro-y col-span-12 sm:col-span-12" id="loading_1" style="display: none">
                                                  <div class="col-span-6 sm:col-span-3 xl:col-span-10 flex flex-col items-center">
                                                      <svg width="20" viewBox="0 0 135 140" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8">
                                                          <rect y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="30" y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="60" width="15" height="140" rx="6">
                                                              <animate attributeName="height" begin="0s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="90" y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="120" y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                      </svg> 
                                                      <div class="text-center text-xs mt-2">In Progress</div>
                                                  </div>
                                              </div>
                                            </li>
                                            <li class="timeline-items timeline-icon-green active">
                                              <div class="timeline-time"> 
                                                <button class="btn btn-sm btn-primary w-24 mr-1 mb-2" name="action" onclick="runtest(2)" value="2" type="button" style="font-size: 12px;height: 30px;background-color: #4caf50;">Test</button>   

                                              </div>
                                              <h6 class="timeline-title">Staging Environment <p class="timeline-text">METHOD : {{$api->api_main->protocol->api_protocol}}</p></h6>
                                              <p class="timeline-text"><span class="border-radius-6 white-text badge gradient-45deg-purple-deep-orange users-view-id" style="margin-left:unset;font-size: 10px;float:left">@if($api->api_main->stageurl->send_core == 1) CORE : <b>created</b> @else CORE : <b>pending</b> @endif</span> <br></p>
                                              
                                              <div class="timeline-content grey-text shadow " style="font-size: 12px;">
                                                @if($api->api_main->stageurl->send_core == 1) 
                                                  {{env('CORE').$api->api_main->stageurl->core_route}}
                                                @else
                                                  {{$api->api_main->stageurl->pro->name.'://'.$api->api_main->stageurl->url.data_get($api,'api_main.stageurl.path')}}
                                                @endif
                                              </div>
                                                                  
                                              <div class="intro-y col-span-12 sm:col-span-12" id="loading_2" style="display: none">
                                                  <div class="col-span-6 sm:col-span-3 xl:col-span-10 flex flex-col items-center">
                                                      <svg width="20" viewBox="0 0 135 140" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8">
                                                          <rect y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="30" y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="60" width="15" height="140" rx="6">
                                                              <animate attributeName="height" begin="0s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="90" y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="120" y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                      </svg> 
                                                      <div class="text-center text-xs mt-2">In Progress</div>
                                                  </div>
                                              </div>

                                            </li>
                                            @endif
                                             @if(data_get($countTestProd,'request_prod_testing')==1)
                                            <li class="timeline-items timeline-icon-red active">
                                              <div class="timeline-time"> 
                                                <button class="btn btn-sm btn-primary w-24 mr-1 mb-2" name="action" onclick="runtest(3)" value="3" type="button" style="font-size: 12px;height: 30px;background-color: #f51418;">Test</button>         
                                              </div>
                                              <h6 class="timeline-title">Production Environment <p class="timeline-text">METHOD : {{$api->api_main->protocol->api_protocol}}</p></h6>
                                              <p class="timeline-text"><span class="border-radius-6 white-text badge gradient-45deg-purple-deep-orange users-view-id" style="margin-left:unset;font-size: 10px;float:left">@if($api->api_main->produrl->send_core == 1) CORE : <b>created</b> @else CORE : <b>pending</b> @endif</span> <br></p>
                                              
                                              <div class="timeline-content grey-text shadow " style="font-size: 12px;">
                                                @if($api->api_main->produrl->send_core == 1) 
                                                    {{env('CORE').$api->api_main->produrl->core_route}}
                                                @else
                                                    {{$api->api_main->produrl->pro->name.'://'.$api->api_main->produrl->url.data_get($api,'api_main.produrl.path')}}
                                                @endif
                                              </div>
                                                                  
                                              <div class="intro-y col-span-12 sm:col-span-12" id="loading_3" style="display: none">
                                                  <div class="col-span-6 sm:col-span-3 xl:col-span-10 flex flex-col items-center">
                                                      <svg width="20" viewBox="0 0 135 140" xmlns="http://www.w3.org/2000/svg" fill="rgb(45, 55, 72)" class="w-8 h-8">
                                                          <rect y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="30" y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="60" width="15" height="140" rx="6">
                                                              <animate attributeName="height" begin="0s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="90" y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.25s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.25s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                          <rect x="120" y="10" width="15" height="120" rx="6">
                                                              <animate attributeName="height" begin="0.5s" dur="1s" values="120;110;100;90;80;70;60;50;40;140;120" calcMode="linear" repeatCount="indefinite"></animate>
                                                              <animate attributeName="y" begin="0.5s" dur="1s" values="10;15;20;25;30;35;40;45;50;0;10" calcMode="linear" repeatCount="indefinite"></animate>
                                                          </rect>
                                                      </svg> 
                                                      <div class="text-center text-xs mt-2">In Progress</div>
                                                  </div>
                                              </div>
                                            </li>
                                            @endif
                                            
                                          </ul>
                                        </div>
                                          
                                           
                                        </div>
                                     
                                    </div>
                                   
                                </div>
                            </div>

                        </div>
                          {!! Form::close() !!}
                        <!-- END: Display Information -->
                  </div>
                   <div class="col-span-12 lg:col-span-12 2xl:col-span-9">
                        <!-- BEGIN: Display Information -->
                        <div class="intro-y box lg:mt-5">
                            
                            <div class="p-5">
                                <div class="flex flex-col-reverse xl:flex-row flex-col">
                                    <div class="flex-1 mt-6 xl:mt-0">
                                        <div class="grid grid-cols-12 gap-x-5">
                                            <div class="col-span-12 2xl:col-span-12">
                                              <div class="email-header" style="padding-top:10px">
                                                  <div class="ml-1" tabindex="0"><i class="material-icons" style="vertical-align: middle;"> wrap_text </i> Result</div>
                                                  <div class="list-content">
                                                    <div class="pos-dropdown dropdown ml-auto sm:ml-0">
                                                      <button class="dropdown-toggle btn px-2 box text-gray-700 dark:text-gray-300" aria-expanded="false" id="status_code">
                                                          <span class="h-5 flex items-center justify-center"><i class="material-icons" style="color: blue">info</i>&nbsp;&nbsp; HTTP Status Code</span>
                                                      </button>
                                                      <div class="pos-dropdown__dropdown-menu dropdown-menu">
                                                          <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                                                              @foreach($lkp_status_code as $key => $data)
                                                                <span class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md truncate" style="display:inline-block; width: 49%">{{$data->name}} - {{$data->description}}</span>
                                                              @endforeach
                                                          </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              <br>
                                              <hr>
                                                <div class="card card card-default scrollspy border-radius-6 fixed-width">
                                                        <div class="card-content p-0 pb-2">
                                                        
                                                          <div class="collection email-collection" id="result" style="background-color: #141312d4;padding: 20px;color:white !important;font-weight: bold;">
                                                                run test to the result ...
                                                          </div>
                                                        </div>
                                                      </div>
                                                

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


