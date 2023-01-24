      <div id="overview"><!-- end overview-->
    <div class="card border-radius-6">
    <div class="card-content"  >
      <div class="row">
        <div class="col s12 m6">
          <table class="striped" style="font-size: 12px !important">
            <tbody>
              <tr>
                <td>Registered At:</td>
                <td>{{date("d-m-Y", strtotime(data_get($data_api,'appl_date')))}}</td>
              </tr>
              <tr>
                <td>Registered By</td>
                <td class="users-view-latest-activity">{{data_get($data_api,'regby')}}</td>
              </tr>
            <tr>
                <td>Status API:</td>
                 @if(data_get($data_api,'api_status')==1)
                <td class="users-view-verified">Active</td>
                @elseif(data_get($data_api,'api_status')==2)
                <td class="users-view-verified">Inactive</td>
                 @elseif(data_get($data_api,'api_status')==3)
                <td class="users-view-verified">Maintenance</td>
                @else
                <td class="users-view-verified"></td>
                
                @endif
              </tr>
             
            </tbody>
          </table>
        </div>
         <div class="col s12 m6">
          <table class="striped" style="font-size: 12px !important">
            <tbody>
              <tr>
                <td>API Purpose:</td>
                <td>{{data_get($data_api,'api_purpose')}}</td>
              </tr>
              <tr>
                <td>Version:</td>
                <td>{{data_get($data_api,'version')}}</td>
              </tr>

               <tr>
                <td>Status:</td>
                <td><span class=" users-view-status chip green lighten-5 green-text">{{data_get($data_api,'status_name')}}</span></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
  <!-- users view card data ends -->
      <div class="card border-radius-6">
    <div class="card-content">
       <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> API Scheme</h6>
        <hr>
      <div class="row">
        <div class="col s12 m6">
          <table class="striped" style="font-size: 12px !important">
            <tbody>
              <tr>
                <td>API Protocol:</td>
                <td>{{data_get($data_api_scheme,'api_protocol')}}</td>
              </tr>
              <tr>
                <td>API Data Format:</td>
                <td class="users-view-latest-activity">{{data_get($data_api_scheme,'data_format')}}</td>
              </tr>
              <tr>
                <td>Port:</td>
                <td class="users-view-verified">{{data_get($data_api_scheme,'port')}}</td>
              </tr>
             
            </tbody>
          </table>
        </div>
         <div class="col s12 m6">
          <table class="striped" style="font-size: 12px !important">
            <tbody>
              <tr>
                <td>API Type:</td>
                <td>{{data_get($data_api_scheme,'api_type')}}</td>
              </tr>
              <tr>
                <td>Host:</td>
                <td>{{data_get($data_api_scheme,'host')}}</td>
              </tr>
               <tr>
                <td>Tags:</td>
                <td>{{data_get($data_api_scheme,'tags')}}</td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>

    @if($countconsumer > 0)
  <div class="card border-radius-6">
    <div class="card-content">
       <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> API Request Info</h6>
        <hr>
      <div class="row">
        <div class="col s12 m12">
          <table  class="tabledata" style="width:100%;font-size: 12px">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>System</th>
                                  <th>Modules</th>
                                  <th>Name</th>
                                  <th>Status</th>
                                  <th>Status API</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tbody>
                                 <?php $i=1; ?>
                                @foreach($data_consumer as $key =>$data)
                               
                                  <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$data->system_name}}.</td>
                                    <td>{{$data->modules_name}}</td>
                                    <td>{{$data->api_name}}</td>
                                    <td>{{$data->status_name}}</td>
                                    @if($data->api_status==1)
                                    <td>Active</td>
                                    @elseif($data->api_status==2)
                                    <td>Inactive</td>
                                     @elseif($data->api_status==3)
                                    <td>Maintenance</td>
                                    @else
                                    <td></td>
                                    @endif

                                    <td>
                                      
                                      <a href="#" class="waves-effect waves-light btn-small right gradient-45deg-purple-deep-orange border-round mt-7 z-depth-4 btnviewo"
                                      data-purpose2='{{data_get($data,'purpose')}}'
                                      data-freq2='{{data_get($data,'expected_trans')}}'
                                      data-testprod2='{{data_get($data,'test_prod')}}'
                                      data-status2='{{data_get($data,'status_name')}}'

                                      >Request Info
                                      </a>




                                    </td>
                                
                                  </tr>
                                  <?php $i++;?>
                                @endforeach
                              </tbody>
                            </table>
        </div>
    

      </div>
    </div>
  </div>
  @endif


 
</div><!-- end overview-->