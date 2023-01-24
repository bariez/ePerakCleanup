
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{config('app.name')}}</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }

    .gray {
        background-color: #ecefef
    }
    .tabledata, .tabledata th, .tabledata td
    {
        border: 0px solid black; border-collapse: collapse;
    }
    .tdbreak {
  word-break: break-all
}
</style>

</head>
<body>


  <table width="100%">
    <tr>
        <td valign="top"><img src="http://localhost/theme/assets/images/lhdn.png" alt="" width="150"/></td>
        <td align="right">
            <h3>{{config('app.name')}}</h3>
            <pre>
               
                <b>Knowledge Info</b>
               
                {{$date}}
                
            </pre>
        </td>
    </tr>

  </table>

   <table width="100%" class="tabledata">
   
    <tbody>


      <tr>
        <td><label for="update-profile-form-1" class="form-label"><strong>API Name :</strong></label></td>
       </tr>
       <tr>
        <td class="gray">{{data_get($data_api,'api_name')}}</td>
       </tr>
       <tr>
        <td>&nbsp;</td>
       </tr>

       <tr>
        <td><label for="update-profile-form-1" class="form-label"><strong>Provider Name :</strong></label></td>
       </tr>
       <tr>
        <td class="gray">{{data_get($data_api,'regby')}}</td>
       </tr>
       <tr>
        <td>&nbsp;</td>
       </tr>

       <tr>
        <td><label for="update-profile-form-1" class="form-label"><strong>Consumer Name :</strong></label></td>
       </tr>
       <tr>
        <td class="gray">{{$mainsubname}}</td>
       </tr>
       <tr>
        <td>&nbsp;</td>
       </tr>

       <tr>
        <td><label for="update-profile-form-1" class="form-label"><strong>Sub Consumer Name :</strong></label></td>
       </tr>
        <tr>
        <td class="gray">{{$subname}}</td>
       </tr>
       <tr>
        <td>&nbsp;</td>
       </tr>
       
       <tr>
        <td><label for="update-profile-form-1" class="form-label"><strong>API Purpose :</strong></label></td>
       </tr>
        <tr>
        <td>&nbsp;</td>
       </tr>
       <tr>
        <td class="gray">{{data_get($data_api,'api_purpose')}}</td>
       </tr>
       <tr>
        <td>&nbsp;</td>
       </tr>
       <tr>
        <td><label for="update-profile-form-1" class="form-label"><strong>Method :</strong></label></td>
       </tr>
        <tr>
        <td>&nbsp;</td>
       </tr>
       <tr>
        <td class="gray">{{data_get($data_api_scheme,'api_protocol')}}</td>
       </tr>
       <tr>
        <td><label for="update-profile-form-1" class="form-label"><strong>API Type :</strong></label></td>
       </tr>
        <tr>
        <td>&nbsp;</td>
       </tr>
       <tr>
        <td class="gray">{{data_get($data_api_scheme,'api_type')}}</td>
       </tr>
      <tr>
        <td>&nbsp;</td>
       </tr>
        <tr>
        <td><label for="update-profile-form-1" class="form-label"><strong>Parameter :</strong></label></td>
       </tr>
       <tr>
        <td>&nbsp;</td>
       </tr>
       <tr>
        <td class="gray">
         <p class="text-muted">
           @if(!empty(count($parameter)))
              
               @foreach($api->api_main->parameter->where('param_type','<>','header') as $param)
 
                   <pre class=" language-markup border-radius-6">{ {{$param->param_type}} }  -  {{$param->param_name}}</pre>

               
              @endforeach
              @else
               <pre class=" language-markup border-radius-6">No Data</pre>
              @endif
        </p>
        </td>
       </tr>
       <tr>
        <td>&nbsp;</td>
       </tr>
        <tr>
        <td><label for="update-profile-form-1" class="form-label"><strong>Header Values :</strong></label></td>
       </tr>

       <tr>
        <td class="gray">
        
            <p class="text-muted">
              @if(count($api->api_main->parameter->where('param_type','=','header')) > 0)
                @foreach($api->api_main->parameter->where('param_type','=','header') as $param)
                 
                  <pre class=" language-markup border-radius-6">{{$param->param_name}} : '{{$param->sample_data}}'</pre>
                @endforeach
              @else
              <pre class=" language-markup border-radius-6">No Header Value specified</pre>
              @endif

            </p>
        </td>
       </tr>
        <tr>
        <td>&nbsp;</td>
       </tr>
       <tr>
        <td><label for="update-profile-form-1" class="form-label"><strong>Security</strong></label></td>
       </tr>
        <tr>
        <td class="gray">{{$usertoken}}</td>
       </tr>
        <tr>
        <td>&nbsp;</td>
       </tr>
        <tr>
        <td class="gray"> <p>
          <span style="color:blue"></span></p><pre class=" language-markup border-radius-6">Please use this in header request<br>OR<br>use as additional parameter<br>apikey = {{substr($usertoken, 0, 5)}}XXXXXXXXXXXXXX</pre>
       
        </td>
       </tr>
        <tr>
        <td>&nbsp;</td>
       </tr>
        </tbody>
       </table>
      <div style="page-break-after: always;"></div>
      @if($api->api_main->type->id == 1)
        <table width="100%" class="tabledata">
        <tbody>
                <tr>
                <td><label for="update-profile-form-1" class="form-label"><strong>Curl Usage Sample  :</strong></label></td>
               </tr>
                <tr>
                <td>&nbsp;</td>
               </tr>
               <tr>
                <td class="gray" style="font-size: 10px"><p>
                  <span style="color:blue"></span></p><pre class=" language-markup border-radius-6"><b>[Curls] :</b><br>----------------------------------
                  <br>curl -X {{$api->api_main->protocol->api_protocol}} -d "param1{PARAM1}{{'$'}}param2{PARAM2}" -H "apikey:{{substr($usertoken, 0, 5)}}XXXXXXXXXXXXXX'" {{env('CORE').$api->api_main->devurl->core_route}}
                  <br>---------------------------------
                  <br><b>[PHP file_get_contents] :<br>-------------------------------------</b>
                  <br>$url = "{{env('CORE').$api->api_main->devurl->core_route}}";<br>$parameters = array(<br>@foreach($api->api_main->parameter as $param)  '{{$param->param_name}}'=>'{{$param->sample_data}}',<br>@endforeach);<br><br>$options = array('http' => array(<br>  'header'  => 'apikey: {{substr($usertoken, 0, 5)}}XXXXXXXXXXXXXX',<br>  'header'  => 'Content-Type: application/x-www-form-urlencoded\r\n',<br>  'method'  => '{{$api->api_main->protocol->api_protocol}}',<br>  'content' => http_build_query($parameters)<br>));<br><br>$context  = stream_context_create($options);<br>$result = file_get_contents($url, false, $context);
                  <br>-------------------------------------</pre>
                </td>
              </tr>
              <tr>
                    <td class="gray" style="font-size: 10px">
                        <pre class=" language-markup border-radius-6"><b>[.NET-C# Curls] :</b><br>-------------------------------------
                      <br>using (var httpClient = new HttpClient())
                        {
                            using (var request = new HttpRequestMessage(new HttpMethod("{{$api->api_main->protocol->api_protocol}}"), "{{env('CORE').$api->api_main->devurl->core_route}}"))
                            {
                                request.Headers.TryAddWithoutValidation("apikey", "{{substr($usertoken, 0, 5)}}XXXXXXXXXXXXXX'"); 

                                request.Content = new StringContent("param1{PARAM1}{{'$'}}param2{PARAM2}");
                                request.Content.Headers.ContentType = MediaTypeHeaderValue.Parse("application/x-www-form-urlencoded"); 

                                var response = await httpClient.SendAsync(request);
                            }
                        }
                    </pre>
                   
                    </td>
               </tr>
                </tbody>
            </table>
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

              <table width="100%" class="tabledata">
                <tbody>
                <tr>
                <td><label for="update-profile-form-1" class="form-label"><strong>Curl Usage Sample Of SOAP API:</strong></label></td>
               </tr>
               <tr>
                <td>&nbsp;</td>
               </tr>
               <tr>
                <td class="gray" style="font-size: 10px"><p>
                  <span style="color:blue"></span></p><pre class=" language-markup border-radius-6"><b>[Curls] :<br>-------------------------------------</b><br>curl<br>--header "Content-Type: text/xml;charset=UTF-8"<br>--header "SOAPAction:{{$soupurl}}"<br>--data @request.xml {{env('CORE').$api->api_main->devurl->core_route}}<br>-------------------------------------<br><br><br><b>[XML Body Structure] :<br>-------------------------------------</b><?php echo "<pre>".str_replace("</span><span>","</span><br><span>",$formatted)."</pre>\n"; ?><br>-------------------------------------<br><br><br><b>[.NET-C# SOAP] :<br>-------------------------------------</b><br>The most basic approach is to add it as a Reference from the solution explorer within Visual Studio itself<br>-------------------------------------<br></pre>
                </td>
              </tr>
             </tbody>
           </table>
          @endif
            
            <table width="100%" class="tabledata">
                <tbody>
                
               <tr>
                    <td>&nbsp;</td>
               </tr>
                <tr>
                    <td><label for="update-profile-form-1" class="form-label"><strong>Usage Development :</strong></label></td>
               </tr>
                <tr>
                    <td>&nbsp;</td>
               </tr>
                <tr>

                    <td class="gray">@if($api->api_main->devurl->send_core == 1)            
                      <pre class=" language-markup border-radius-6">{{env('CORE').$api->api_main->devurl->core_route}}</pre>
                    @else
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
                    @endif
                </td>
               </tr>
               <tr>
                    <td>&nbsp;</td>
               </tr>
                <tr>
                    <td><label for="update-profile-form-1" class="form-label"><strong>Usage Staging :</strong></label></td>
               </tr>
                <tr>
                    <td>&nbsp;</td>
               </tr>
                <tr>
                    <td class="gray"> @if($api->api_main->stageurl->send_core == 1)
                      <pre class=" language-markup border-radius-6">{{env('CORE').$api->api_main->stageurl->core_route}} </pre>
                    @else
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
                   
                    @endif
                </td>
               </tr>
               <tr>
                    <td>&nbsp;</td>
               </tr>
                <tr>
                    <td><label for="update-profile-form-1" class="form-label"><strong>Usage Production :</strong></label></td>
               </tr>
                <tr>
                    <td>&nbsp;</td>
               </tr>
                <tr>
                    <td class="gray">  @if($api->api_main->produrl->send_core == 1)
                          <pre class=" language-markup border-radius-6">{{env('CORE').$api->api_main->produrl->core_route}}</pre>
                        @else
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
                       
                        @endif
                </td>
               </tr>
             </tbody>
           </table>
<div style="page-break-after: always;"></div>
                 <table width="100%" class="tabledata">
                <tbody>
                
               <tr>
                    <td>&nbsp;</td>
               </tr>
               <tr>
                    <td><label for="update-profile-form-1" class="form-label"><strong>Return : </strong></label></td>
               </tr>
               <tr>
                    <td>&nbsp;</td>
               </tr>
               <tr>
                <td class="gray">
                 <pre class=" language-markup border-radius-6">{{data_get($data_api_scheme,'data_format')}}</pre>
                </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
               </tr>
               <tr>
                    <td><label for="update-profile-form-1" class="form-label"><strong>Description : </strong></label></td>
               </tr>
                <tr>
                    <td>&nbsp;</td>
               </tr>
               <tr>
                <td class="gray">
                 <pre class=" language-markup border-radius-6">{!! data_get($knowledgeBase,'description') !!}</pre>
                </td>
                </tr>
            </tbody>
          </table>

</body>
</html>