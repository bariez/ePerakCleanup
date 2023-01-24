
              <div id="overview">
                <div class="intro-y box px-5 pt-5 mt-5">
                    <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
                        <div class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
                               <table class="table"style="font-size: 12px">
                                      <tbody>
                                          <tr class="bg-gray-200 dark:bg-dark-1">
                                              <td class="border-b dark:border-dark-5" style="width: 50%">Registered At :</td>
                                              <td class="border-b dark:border-dark-5">{{date("d/m/Y", strtotime(data_get($data_api,'appl_date')))}}</td>
                                            </tr>
                                          <tr>
                                              <td class="border-b dark:border-dark-5">Registered By :</td>
                                              <td class="border-b dark:border-dark-5">{{data_get($data_api,'regby')}}</td>
                                              
                                          </tr>
                                          <tr class="bg-gray-200 dark:bg-dark-1">
                                             <td>Status API :</td>
                                               @if(data_get($data_api,'api_status')==1)
                                              <td class="border-b dark:border-dark-5">Active</td>
                                              @elseif(data_get($data_api,'api_status')==2)
                                              <td class="border-b dark:border-dark-5">Inactive</td>
                                               @elseif(data_get($data_api,'api_status')==3)
                                              <td class="border-b dark:border-dark-5">Maintenance</td>
                                              @else
                                              <td class="border-b dark:border-dark-5"></td>
                                              
                                              @endif
                                             
                                              
                                          </tr>
                                      </tbody>
                                </table>
                          </div>
                   
                        <div class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
                              
                                  <table class="table" style="font-size: 12px">
                                            <tbody>
                                                <tr class="bg-gray-200 dark:bg-dark-1">
                                                    <td class="border-b dark:border-dark-5" style="width: 50%">API Purpose :</td>
                                                    <td class="border-b dark:border-dark-5">{{data_get($data_api,'api_purpose')}}</td>
                                                  </tr>
                                                <tr>
                                                   <td class="border-b dark:border-dark-5">Version :</td>
                                                   <td class="border-b dark:border-dark-5">{{data_get($data_api,'version')}}</td>
                                                    
                                                </tr>
                                                <tr class="bg-gray-200 dark:bg-dark-1">
                                                    <td class="border-b dark:border-dark-5">Status :</td>
                                                    <td class="border-b dark:border-dark-5"><mark class="p-1 bg-yellow-200">{{data_get($data_api,'status_name')}}</mark></td>

                                                    
                                                </tr>
                                            </tbody>
                                    </table>
                     
                              </div>
                          </div>
                      </div>



                <div class="intro-y box px-5 pt-5 mt-5">
                    <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5">
                        <div class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
                               <table class="table" style="font-size: 12px">
                                            <tbody>
                                                <tr class="bg-gray-200 dark:bg-dark-1">
                                                    <td class="border-b dark:border-dark-5" style="width: 50%">API Method:</td>
                                                    <td class="border-b dark:border-dark-5">{{data_get($data_api_scheme,'api_protocol')}}</td>
                                                  </tr>
                                                <tr>
                                                    <td class="border-b dark:border-dark-5">API Data Format:</td>
                                                    <td class="border-b dark:border-dark-5">{{data_get($data_api_scheme,'data_format')}}</td>
                                                    
                                                </tr>
                                                <tr class="bg-gray-200 dark:bg-dark-1">
                                                   <td class="border-b dark:border-dark-5">Port:</td>
                                                   <td class="border-b dark:border-dark-5">{{data_get($data_api_scheme,'port')}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                
                          </div>
                   
                        <div class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-0 border-gray-200 dark:border-dark-5 pt-5 lg:pt-0">
                              
                                          <table class="table" style="font-size: 12px">
                                            <tbody>
                                                <tr class="bg-gray-200 dark:bg-dark-1">
                                                  <td class="border-b dark:border-dark-5" style="width: 50%">API Type:</td>
                                                  <td class="border-b dark:border-dark-5">{{data_get($data_api_scheme,'api_type')}}</td>
                                                </tr>
                                                <tr>
                                                  <td class="border-b dark:border-dark-5">Host:</td>
                                                  <td class="border-b dark:border-dark-5">{{data_get($data_api_scheme,'host')}}</td>
                                                </tr>
                                                 <tr class="bg-gray-200 dark:bg-dark-1">
                                                  <td class="border-b dark:border-dark-5">Tags:</td>
                                                  <td class="border-b dark:border-dark-5">{{data_get($data_api_scheme,'tags')}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                     
                              </div>
                          </div>
                      </div>

                    @if($countconsumer > 0 )
                          <div class="intro-y box px-5 pt-5 mt-5">
                            <div class="font-medium text-base mr-auto"> API Request Info  </div>
                            <br>
                            <hr>
                              <div class="flex flex-col lg:flex-row border-b border-gray-200 dark:border-dark-5 pb-5 -mx-5 overflow-x-auto">
                                 
                                 <table  class="table" style="width:100%;font-size: 12px" >
                                        <thead>
                                          <tr>
                                            <th>No</th>
                                            <th>System</th>
                                            <th>Modules</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Approved By</th>
                                            <th>Status API</th>
                                            <th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                           <?php $i=1; ?>
                                          @foreach($data_consumer as $key =>$data)
                                         
                                            <tr>
                                              <td>{{$i}}</td>
                                              <td>{{data_get($data,'system_name')}}</td>
                                              <td>{{data_get($data,'modules_name')}}</td>
                                              <td>{{data_get($data,'api_name')}}</td>
                                              <td>{{data_get($data,'status_name')}}</td>
                                               @if($data->statusid==12)
                                              <td>{{$data->approval}}</td>
                                              @else
                                              <td>-</td>
                                              @endif
                                              @if(data_get($data,'api_status')==1)
                                              <td>Active</td>
                                              @elseif(data_get($data,'api_status')==2)
                                              <td>Inactive</td>
                                               @elseif(data_get($data,'api_status')==3)
                                              <td>Maintenance</td>
                                              @else
                                              <td></td>
                                              @endif

                                              <td>
                                                 @if(data_get($data,'statusid') == 12)
                                                <a href="#" data-toggle="modal" data-target="#modeledit" class="btn btn-primary btnview2" data_purpose2='{{data_get($data,'purpose')}}'
                                                 data_api_id2='{{$id}}'
                                                data_freq2='{{data_get($data,'expected_trans')}}'
                                                data_testprod2='{{data_get($data,'test_prod')}}'
                                                data_status2='{{data_get($data,'status_name')}}'
                                                data_minute2='{{data_get($data,'minute')}}'
                                                data_hour2='{{data_get($data,'hour')}}'
                                                data_day2='{{data_get($data,'day')}}'
                                                data_fk_limiter2='{{data_get($data,'fk_limiter_config')}}'
                                                data_email_cc2='{{data_get($data,'emailcc')}}'
                                                data_ip_request2='{{data_get($data,'ip_request')}}'
                                                data_consumerid_d2='{{data_get($data,'consumerid')}}'
                                                data_created_at2='{{date("d/m/Y H:i:s", strtotime(data_get($data,'created_at')))}}'>Request Info</a>
                                                @else
                                                <a href="#" data-toggle="modal" data-target="#modeldetail" class="btn btn-primary btnviewd2" data_purpose_d2='{{data_get($data,'purpose')}}'
                                                data_freq_d2='{{data_get($data,'expected_trans')}}'
                                                data_testprod_d2='{{data_get($data,'test_prod')}}'
                                                data_status_d2='{{data_get($data,'status_name')}}'
                                                data_minute_d2='{{data_get($data,'minute')}}'
                                                data_hour_d2='{{data_get($data,'hour')}}'
                                                data_day_d2='{{data_get($data,'day')}}'
                                                data_fk_limiter_d2='{{data_get($data,'fk_limiter_config')}}'
                                                data_email_cc_d2='{{data_get($data,'emailcc')}}'
                                                data_ip_request_d2='{{data_get($data,'ip_request')}}'
                                                data_created_at_d2='{{date("d/m/Y H:i:s", strtotime(data_get($data,'created_at')))}}'>Request Info</a>

                                                @endif
 

                                              </td>
                                          
                                            </tr>
                                            <?php $i++;?>
                                          @endforeach
                                        </tbody>
                                      </table>
                                   
                              </div>
                            </div>
                      @endif


                  <div id="modeledit" class="modal" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                              <div class="modal-body p-10 text-left"> 
                                <div class="font-medium text-base mr-auto"> <i data-feather="bookmark"></i> API Request Info  </div>
                                <br>
                                <hr>
                                 <div>
                                    {!! form()->open()->post()->action(route('dashboard.usageRequestFormEditpost'))->horizontal() !!}
                                     <input type="hidden" name="consumerid_d2" id="consumerid_d" value=""/>
                                     <input type="hidden" name="api_id2" id="api_id" value=""/>
                                            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                              <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-1" class="form-label">Requested At</label>
                                               <input id="requestat2" name="requestat2" type="text" class="form-control" readonly="readonly">

                                            </div>
                                            <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-1" class="form-label">Status</label>
                                               <input id="statuscon2" name="statuscon2" type="text" class="form-control" readonly="readonly">
                                            </div>
                                            <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-1" class="form-label">Purpose of use</label>
                                                <input id="purpose2" name="purpose2" type="text" class="form-control" readonly="readonly">

                                            </div>
                                            <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-6" class="form-label">Expected Frequency to use API</label>

                                             <input id="freq2" name="freq2" type="text" class="form-control" readonly="readonly">

                                            </div>
                                              <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-1" class="form-label">IP Request (Eg:100.10.1.91,100.1.2.1,100.20.90.1)</label>
                                               <textarea  class="form-control" name="ip_request2" id="ip_request2" placeholder="IP Request"></textarea>

                                            </div>
                                            <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-6" class="form-label">Email CC (Eg:test@gmail.com,test2@gmail.com)</label>

                                               <textarea  class="form-control" name="emailcc2" id="emailcc2" placeholder="Email CC"></textarea>

                                            </div>
                                            <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-3" class="form-label">Require to test in a production environment</label>
                                                 <input id="testprod2" name="testprod2" type="text" class="form-control" readonly="readonly">
                                            </div>
                                            <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-3" class="form-label">Rate Limiter Setting</label>
                                                <div id="limiternone2">
                                                 <input type="text" class="form-control" placeholder="Minute" aria-describedby="input-group-3" readonly="readonly" value="-">
                                               </div>
                                                 <div class="sm:grid grid-cols-3 gap-2" id="limiter2">
                                                                  <div class="input-group">
                                                                     <div id="input-group-5" class="input-group-text">Day</div>
                                                                      <input type="text" id="ld2" name="ld2" class="form-control sm:w-20" placeholder="Minute" aria-describedby="input-group-3" readonly="readonly" value="-">
                                                                   
                                                                  </div>
                                                                
                                                                 <div class="input-group mt-2 sm:mt-0">
                                                                  <div id="input-group-4" class="input-group-text">Hour</div>
                                                                    <input type="text" id="lh2" name="lh2" class="form-control sm:w-20" placeholder="Hour" aria-describedby="input-group-4" readonly="readonly" >
                                                               
                                                                </div>
                                                                <div class="input-group mt-2 sm:mt-0">
                                                                <div id="input-group-5" class="input-group-text">Minute</div>
                                                                    <input type="text"id="lm2" name="lm2" class="form-control sm:w-20" placeholder="Day" aria-describedby="input-group-5" readonly="readonly">
                                                                </div>
                                                            </div>
                                            </div>
                                           
                                            <div class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5">
                                                
                                                <button class="btn btn-primary w-24 ml-2" type="submit" name="action">Save</button>
                                            </div>
                                        </div>


                                      {!! form()->close() !!}
                                  </div> 
                                </div>
                           </div>
                        </div>
                  </div>

                  <div id="modeldetail" class="modal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-body p-10 text-left"> 
                                  <div class="font-medium text-base mr-auto"> <i data-feather="bookmark"></i> API Request Info  </div>
                                    <br>
                                    <hr>
                                     
                                             <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                                              <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-1" class="form-label">Requested At</label>
                                               <input id="requestat_d2" name="requestat_d2" type="text" class="form-control" readonly="readonly">

                                            </div>
                                            <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-1" class="form-label">Status</label>
                                               <input id="statuscon_d2" name="statuscon_d2" type="text" class="form-control" readonly="readonly">
                                            </div>
                                            <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-1" class="form-label">Purpose of use</label>
                                                <input id="purpose_d2" name="purpose_d2" type="text" class="form-control" readonly="readonly">

                                            </div>
                                            <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-6" class="form-label">Expected Frequency to use API</label>

                                             <input id="freq_d2" name="freq_d2" type="text" class="form-control" readonly="readonly">

                                            </div>
                                              <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-1" class="form-label">IP Request (Eg:100.10.1.91,100.1.2.1,100.20.90.1)</label>
                                               <textarea  class="form-control" name="ip_request_d2" id="ip_request_d2" placeholder="IP Request" readonly="readonly"></textarea>

                                            </div>
                                            <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-6" class="form-label">Email CC (Eg:test@gmail.com,test2@gmail.com)</label>

                                               <textarea  class="form-control" name="emailcc_d2" id="emailcc_d2" placeholder="Email CC" readonly="readonly"></textarea>

                                            </div>
                                            <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-3" class="form-label">Require to test in a production environment</label>
                                                 <input id="testprod_d2" name="testprod_d2" type="text" class="form-control" readonly="readonly">
                                            </div>
                                            <div class="intro-y col-span-12 sm:col-span-6">
                                                <label for="input-wizard-3" class="form-label">Rate Limiter Setting</label>
                                                <div id="limiternone_d2">
                                                 <input type="text" class="form-control" placeholder="Minute" aria-describedby="input-group-3" readonly="readonly" value="-">
                                               </div>
                                                 <div class="sm:grid grid-cols-3 gap-2" id="limiter_d2">
                                                                  <div class="input-group">
                                                                     <div id="input-group-5" class="input-group-text">Day</div>
                                                                      <input type="text" id="ld_d2" name="ld_d2" class="form-control sm:w-20" placeholder="Minute" aria-describedby="input-group-3" readonly="readonly" value="-">
                                                                   
                                                                  </div>
                                                                
                                                                 <div class="input-group mt-2 sm:mt-0">
                                                                  <div id="input-group-4" class="input-group-text">Hour</div>
                                                                    <input type="text" id="lh_d2" name="lh_d2" class="form-control sm:w-20" placeholder="Hour" aria-describedby="input-group-4" readonly="readonly" >
                                                               
                                                                </div>
                                                                <div class="input-group mt-2 sm:mt-0">
                                                                <div id="input-group-5" class="input-group-text">Minute</div>
                                                                    <input type="text"id="lm_d2" name="lm_d2" class="form-control sm:w-20" placeholder="Day" aria-describedby="input-group-5" readonly="readonly">
                                                                </div>
                                                            </div>
                                            </div>
                                           
                                  
                                        </div>

                                  </div>
                            </div>
                        </div>
                  </div>
                  
                  @if(data_get($countapiapproved,'id') != null)
                  <div class="intro-y box px-5 pt-5 mt-5">
                      <div class="font-medium text-base mr-auto">Assigned Sub Consumer</div>
                      <hr>
                      <br>
                      <div class="col s12">
                           <div class="container">
                                <div class="card-content p-5">
                                       <table id="data-table-contact" class="display" style="width:100%;font-size: 12px;background-color:#87b0fb">
                                          <thead style="text-align: left;">
                                              <tr>
                                                  <th>Name</th>
                                                  <th>Email</th>
                                                  <th>Phone</th>
                                                  <th>Security Token</th>
                                                  <th>Assigned By</th>
                                                  <th>Action</th>
                                                  <th>PDF</th>
                                            </tr>
                                          </thead>
                                            <tbody>
                                              <?php $i=1; ?>
                                              @foreach($subconsumer as $key =>$datasub)
                                                @if($datasub->subconsume->isNotEmpty())
                                                <?php $subcon = $datasub->subconsume->where('fk_api_main','=',$id)->first();?>
                                                @if($subcon)
                                                    <tr>
                                                      <td>{{data_get($datasub,'name')}}</td>
                                                      <td>{{data_get($datasub,'email')}}</td>
                                                      <td>{{data_get($datasub,'phone')}}</td>
                                                      <td>
                                                          
                                                              @if($subcon->status == 0 || $subcon->status == 5)
                                                                  xxxxxxxxxxxxxx
                                                              @else
                                                                  {{data_get($datasub,'security_token')}}
                                                              @endif
                                                          
                                                      </td>
                                                      <td>{{data_get($subcon,'parent.name')}}</td>
                                                      <td>
                                                         
                                                              @if($subcon->status == 0 || $subcon->status == 5)
                                                                  <a href="/developer/dashboard/invoke/{{$datasub->id}}/{{$id}}" class="btn btn-warning ">Please Try Again</a>
                                                              @else
                                                                  <a href="/developer/dashboard/invoke/{{$datasub->id}}/{{$id}}" class="btn btn-danger ">Revoke Access</a>
                                                              @endif
                                                          
                                                      </td>
                                                      <td>
                                                          
                                                              @if($subcon->status == 0 || $subcon->status == 5)
                                                                  -
                                                              @else
                                                                  <a href="{!! URL::to('developer/exportknowledgesubcon/'.$id.'/'.$datasub->id.'/'.$mainsubcon)  !!}" class="btn btn-sm btn-round has-ripple gradient-45deg-indigo-purple btn-small Right ml-1" style="font-size: 10px;height: 30px;padding-left:10px;padding-right:10px;margin-right: 10px;"><i class="material-icons left">picture_as_pdf</i> PDF <i class="material-icons">file_download</i>
                                                              @endif
                                                          
                                                      </td>

                                                    </tr>

                                                @endif
                                                @endif
                                              <?php $i++;?>
                                              @endforeach
                                            </tbody>
                                        </table>
                                    </div>      
                                </div>
                      </div>
                  </div>
                  <div class="intro-y box px-5 pt-5 mt-5">
                      <div class="font-medium text-base mr-auto">Other Sub Consumer</div>
                      <hr>
                      <br>
                      <div class="col s12">
                           <div class="container">
                                <div class="card-content p-5">
                                       <table id="data-table-contact2" class="display" style="width:100%;font-size: 12px;background-color:#87b0fb">
                                          <thead style="text-align: left;">
                                              <tr>
                                                  <th>Name</th>
                                                  <th>Email</th>
                                                  <th>Phone</th>
                                                  <th>Security Token</th>
                                                  <th>Action</th>
                                                  <th>PDF</th>
                                            </tr>
                                          </thead>
                                            <tbody>
                                              <?php $i=1; ?>
                                              @foreach($subconsumer as $key =>$datasub)
                                                @if($datasub->subconsume->isEmpty())
                                                    <tr>
                                                      <td>{{data_get($datasub,'name')}}</td>
                                                      <td>{{data_get($datasub,'email')}}</td>
                                                      <td>{{data_get($datasub,'phone')}}</td>
                                                      <td>xxxxxxxxxxxxxx</td>
                                                      <td>
                                                        <a href="/developer/dashboard/invoke/{{$datasub->id}}/{{$id}}" class="btn btn-primary ">Give Access</a>
                                                      </td>
                                                      <td>-</td>

                                                    </tr>

                                                @else
                                                    <?php $subcon = $datasub->subconsume->where('fk_api_main','=',$id)->first();?>
                                                      @if($subcon)
                                                      @else
                                                        <tr>
                                                          <td>{{data_get($datasub,'name')}}</td>
                                                          <td>{{data_get($datasub,'email')}}</td>
                                                          <td>{{data_get($datasub,'phone')}}</td>
                                                          <td>xxxxxxxxxxxxxx</td>
                                                          <td>
                                                            <a href="/developer/dashboard/invoke/{{$datasub->id}}/{{$id}}" class="btn btn-primary ">Give Access</a>
                                                          </td>
                                                          <td>-</td>
                                                        </tr>
                                                      @endif
                                                @endif
                                              <?php $i++;?>
                                              @endforeach
                                            </tbody>
                                        </table>
                                    </div>      
                                </div>
                      </div>
                  </div>
                  @endif


                   @if(data_get($countapiapproved,'id') != null)
                  {!! $embed !!}
                  @endif

      </div>



