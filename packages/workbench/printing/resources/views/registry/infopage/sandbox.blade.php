<style>
td, th {

    padding: unset !important;
    border-collapse: unset;
    }

    .table {
    display: table;
    width: 100%;
    border-spacing: 0;
  }
</style>
  <div class="card border-radius-6">
    <div class="card-content">
       <h6 class="mb-2 mt-2"><i class="material-icons">computer</i>&nbsp;Sandbox</h6>
      <hr>
      <div class="row">
        <div class="col s12">
         <div class="app-email">
  <div class="content-area" style="width: unset !important;margin-top:unset !important;font-size: 12px;">
    <div class="app-wrapper">
      
      <div class="card card card-default scrollspy border-radius-6 fixed-width">
        <div class="card-content p-0 ">
          <div class="email-header" style="padding: 10px;">
            <div class="ml-1" tabindex="0"><i class="material-icons" style="vertical-align: middle;"> wrap_text </i> Testing API with Parameter</div>
            <div class="list-content"></div>
          </div>
          <div class="collection email-collection" style="padding: 25px;">
                {!! form()->open()->post()->attribute('id', 'sandboxform') !!}
                                
                  <input type="hidden" name="id" value="{{$ori_main_app}}"/>
                  <input type="hidden" name="url" id="actionurl" value="3"/>

                  @if($listtype==2)<!--unused-->
                  <input type="hidden" name="key" id="key" value="{{env('KONG_API_KEY')}}"/>
                  @else
                  <input type="hidden" name="key" id="key" value="{{$usertoken}}"/>
                  @endif
                  
                  <div class="row">

                     <p class="caption">1. Parameter</p>
                     <div class="row">
                      <div class="col s12">
                         <ul class="collapsible collapsible-accordion">
                            <li>
                               <div class="collapsible-header">Show All Parameter</div>
                               <div class="collapsible-body">
                                  <table class=""  style="font-size: 11px !important;border-collapse: unset;">
                                      <tbody>
                                        @foreach($parameter as $key =>$data)
                                            <tr>
                                              <td><b>{{data_get($data,'param_name')}}</b> : </td>
                                              <td><input value="{{data_get($data,'sample_data')}}" type="text" name="parameter[{{data_get($data,'param_name')}}]" style="font-size: 12px"></td>
                                            </tr>
                                         @endforeach
                                       
                                      </tbody>
                                    </table>
                               </div>
                            </li>
                            
                         </ul>
                      </div>
                   </div>
                     
                    

                    <br>
                    <hr>
                    <p class="caption">2. Security / Header</p>
                    <p></p>
                    @if($listtype==2)<!--unused-->
                    <pre class=" language-markup border-radius-6"></pre>
                    @else
                    <pre class=" language-markup border-radius-6">apikey = {{substr(env('KONG_API_KEY'), 0, 5)}}XXXXXXXXXXXXXX</pre>
                    @endif
                    
                     <br>
                    <hr>
                    <p class="caption">3. Method and Environment</p>
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
                            <button class="blue btn btn-small" name="action" onclick="runtest(0)" value="0" type="button" style="font-size: 12px;height: 30px">Test</button>         
                          </div>
                          <h6 class="timeline-title">Mockup <p class="timeline-text">METHOD : {{$api->api_main->protocol->api_protocol}}</p></h6>
                          <p class="timeline-text"><span class="border-radius-6 white-text badge gradient-45deg-purple-deep-orange users-view-id" style="margin-left:unset;font-size: 10px;float:left">CORE : <b>APIM PORTAL</b></span> <br></p>
                          
                          <div class="timeline-content grey-text shadow " style="font-size: 12px;">
                            /mockup/testapi
                          </div>
                        </li>
                        @if(data_get($data_api,'api_status')!=2)
                         <li class="timeline-items timeline-icon-cyan active">
                          <div class="timeline-time"> 
                            <button class="cyan btn btn-small" name="action" onclick="runtest(1)" value="1" type="button" style="font-size: 12px;height: 30px">Test</button>         
                          </div>
                          <h6 class="timeline-title">Development Environment <p class="timeline-text">METHOD : {{$api->api_main->protocol->api_protocol}}</p></h6>
                          <p class="timeline-text"><span class="border-radius-6 white-text badge gradient-45deg-purple-deep-orange users-view-id" style="margin-left:unset;font-size: 10px;float:left">@if($api->api_main->devurl->send_core == 1) CORE : <b>created</b> @else CORE : <b>pending</b> @endif</span> <br></p>
                          
                          <div class="timeline-content grey-text shadow " style="font-size: 12px;">
                            @if($api->api_main->devurl->send_core == 1) 
                              <b>{{env('CORE').$api->api_main->devurl->core_route}}</b>
                            @else
                              {{$port.'://'.$api->api_main->devurl->url.data_get($api,'api_main.devurl.path')}}
                            @endif
                          </div>
                        </li>
                        <li class="timeline-items timeline-icon-green active">
                          <div class="timeline-time"> 
                            <button class="green btn btn-small" name="action" onclick="runtest(2)" value="2" type="button" style="font-size: 12px;height: 30px">Test</button>   

                          </div>
                          <h6 class="timeline-title">Staging Environment <p class="timeline-text">METHOD : {{$api->api_main->protocol->api_protocol}}</p></h6>
                          <p class="timeline-text"><span class="border-radius-6 white-text badge gradient-45deg-purple-deep-orange users-view-id" style="margin-left:unset;font-size: 10px;float:left">@if($api->api_main->stageurl->send_core == 1) CORE : <b>created</b> @else CORE : <b>pending</b> @endif</span> <br></p>
                          
                          <div class="timeline-content grey-text shadow " style="font-size: 12px;">
                            @if($api->api_main->stageurl->send_core == 1) 
                              {{env('CORE').$api->api_main->stageurl->core_route}}
                            @else
                              {{$port.'://'.$api->api_main->stageurl->url.data_get($api,'api_main.stageurl.path')}}
                            @endif
                          </div>

                        </li>
                        @endif
                         @if($listtype==1 && $countTestProd >0)
                        <li class="timeline-items timeline-icon-red active">
                          <div class="timeline-time"> 
                            <button class="red btn btn-small" name="action" onclick="runtest(3)" value="3" type="button" style="font-size: 12px;height: 30px">Test</button>         
                          </div>
                          <h6 class="timeline-title">Production Environment <p class="timeline-text">METHOD : {{$api->api_main->protocol->api_protocol}}</p></h6>
                          <p class="timeline-text"><span class="border-radius-6 white-text badge gradient-45deg-purple-deep-orange users-view-id" style="margin-left:unset;font-size: 10px;float:left">@if($api->api_main->produrl->send_core == 1) CORE : <b>created</b> @else CORE : <b>pending</b> @endif</span> <br></p>
                          
                          <div class="timeline-content grey-text shadow " style="font-size: 12px;">
                            @if($api->api_main->produrl->send_core == 1) 
                                {{env('CORE').$api->api_main->produrl->core_route}}
                            @else
                                {{$port.'://'.$api->api_main->produrl->url.data_get($api,'api_main.produrl.path')}}
                            @endif
                          </div>
                        </li>
                        @endif
                        
                      </ul>
                    </div>


                  </div>
                  
                {!! form()->close() !!}
          </div>
        </div>
      </div>
      <br>
      <br>
      <div class="card card card-default scrollspy border-radius-6 fixed-width">
        <div class="card-content p-0 pb-2">
          <div class="email-header" style="padding-top:10px">
            <div class="ml-1" tabindex="0"><i class="material-icons" style="vertical-align: middle;"> wrap_text </i> Result</div>
            <div class="list-content"></div>
          </div>
          <div class="collection email-collection" id="result" style="background-color: #141312d4;padding: 20px;color:white !important;font-weight: bold;">
                run test to the result ...
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Content Area Ends -->

        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>

