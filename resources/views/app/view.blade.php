@extends('ui::ablepro.dashboard')

@section('content')
      <div class="row">
            <!-- liveline-section start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body ">

                    @if($remkey == true)
                    @else
                         <a  style="float:right !important;margin-left:5px;cursor:pointer;" class="btn btn-primary btn-sm" href="javascript:addfav('{{$app->id}}');"<i class="feather icon-delete"></i> @lang('homepage.service-section-add')</a>
                    @endif


                    <button type="button" class="fc-month-button fc-button fc-state-default" onclick="location.href='/dashboard/apps'" style="float:right !important;margin:unset;cursor:pointer;">@lang('homepage.service-section-all')</button>

                        <h6 class="" style="font-size:14px;color:#377c97 !important">
                            @if($user->language == 'en')
                                <td>{{$app->service_en}}</td>
                            @else
                                <td>{{$app->service_bm}}</td>
                            @endif
                        </h6>
                        <p style="font-size:12px;">
                            @if($user->language == 'en')
                                <td>{{$app->description_en}}</td>
                            @else
                                <td>{{$app->description_bm}}</td>
                            @endif
                        </p>
                        
                        <div class="progress blue">
                            <div class="progress-bar bg-c-blue" style="width:100%"></div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="email-content" id="contentdiv">
                           @if($user->language == 'en')
                                <?php echo $app->content_en ;?>
                            @else
                                <?php echo $app->content_bm ;?>
                            @endif
                        </div>
                        
                    </div>
                </div>

               
            </div>
            <!-- liveline-section end -->
        </div>

<?php $locale = $user->language; ?>


@endsection
@push('script')

<script type="text/javascript">

    $(document).ready(function () 
    {
        var url2 = <?php echo "'".$url2."'" ?>;

        $('#pelepasan').html("<a href='" + url2 + "' target='_blank'>@lang('homepage.pelepasan')</a>");

    });

</script>


<script type="text/javascript">

    $(document).ready(function () 
    {
        var url2 = <?php echo "'".$urlhitsdemo."'" ?>;

        $('#iframehitsdemo').html("<iframe src='" + url2 + "'  onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+' px';}(this));'='' style='height:600px;width:100%;border:none;overflow:hidden;'></iframe> ");

    });

</script>

<script type="text/javascript">

    $(document).ready(function () 
    {
        var url2 = <?php echo "'".$urlhits."'" ?>;

        $('#iframehits').html("<iframe src='" + url2 + "'  onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+' px';}(this));'='' style='height:600px;width:100%;border:none;overflow:hidden;'></iframe> ");

    });

</script>

                                                                   

<script type="text/javascript">

    $(document).ready(function () 
    {

             $.get('{!! $url !!}', {}, function(ssodata) 
             {

                  var datas = JSON.stringify(ssodata);
                  var myObj = JSON.parse(datas);

                  console.log(myObj.Encrypt_ExtResult);

                 if (myObj.Encrypt_ExtResult !=="") 
                 {
                    $('#kemaskini').html("<a href='https://ekemaskini.hasil.gov.my/ssoprod/ujikemaskini/makkemaskini.php?ssoref1=" + myObj.Encrypt_ExtResult + "' target='_blank'>@lang('homepage.kemaskini')</a>");


                 }
                 else 
                 {
                    console.log('error');
                 }


                }, 'jsonp');





    });

</script>

<script type="text/javascript">

    $(document).ready(function () 
    {

             $.get('{!! $urlepc4 !!}', {}, function(ssodata) 
             {

                  var datas = JSON.stringify(ssodata);
                  var myObj = JSON.parse(datas);

                  console.log(myObj.Encrypt_ExtResult);

                 if (myObj.Encrypt_ExtResult !=="") 
                 {
                    $('#landingspc').html("<a href='{{$url3}}" + myObj.Encrypt_ExtResult + "' target='_blank'>@lang('homepage.landingspc')</a>");

                    $('#semakan').html("<span style='font-size: 12px;'><span style='font-weight: 600;''><a href='{{$semakan}}" + myObj.Encrypt_ExtResult + "' target='_blank'>@lang('homepage.landingsemakan')</a></span></span>");
                    $('#wht').html("<span style='font-size: 12px;'><span style='font-weight: 600;''><a href='{{$wht}}" + myObj.Encrypt_ExtResult + "' target='_blank'>@lang('homepage.landingwht')</a></span></span>");
                    $('#lodge').html("<span style='font-size: 12px;'><span style='font-weight: 600;''><a href='{{$lodge}}" + myObj.Encrypt_ExtResult + "' target='_blank'>@lang('homepage.landinglodge')</a></span></span>");
                    $('#pindaan').html("<span style='font-size: 12px;'><span style='font-weight: 600;''><a href='{{$pindaan}}" + myObj.Encrypt_ExtResult + "' target='_blank'>@lang('homepage.landingpindaan')</a></span></span>");
                    $('#linkkemaskini').html("<span style='font-size: 12px;'><span style='font-weight: 600;''><a href='{{$urlekemaskini}}" + myObj.Encrypt_ExtResult + "' target='_blank'>@lang('homepage.kemaskinicom')</a></span></span>");

                    var chc = <?php echo "'".$semak."'" ?>;
                    

                    if(chc == 1)
                    {
                        var chcnama = <?php echo "'".$nama."'" ?>;

                        $('#taksiran').html("<span style='font-size: 12px;'><span style='font-weight: 600;''><a href='{{$taksiran}}" + myObj.Encrypt_ExtResult + "' target='_blank'>e-" + chcnama + " @lang('homepage.landingtaksiran') {{(date('Y')-1)}}</a></span></span>");
                    }

                    $('#borang').html("<span style='font-size: 12px;'><span style='font-weight: 600;''><a href='{{$borang}}" + myObj.Encrypt_ExtResult + "' target='_blank'>@lang('homepage.landingborang')</a></span></span>");

                    

                 }
                 else 
                 {
                    console.log('error');
                 }


                }, 'jsonp');





    });

</script>



<script type="text/javascript">


$(document).ready(function () {

$("#contentdiv a").attr("target","_blank");

});

function openfav(id)
{
     $("#exampleModalCenter").modal('hide');
     $("#favmodal").modal('show');
    
     
}
</script>
<script type="text/javascript">

function addfav(id)
{

    var langs = <?php echo "'".$locale."'" ?>;

    if(langs === 'ms')
    {
        var titles = 'Harap Maaf, Anda hanya boleh menambah tetapan pilihan sehingga 4 pilihan';
        var stitle = 'Tetapan Pilihan Berjaya dikemaskini';

    }else
    {
        var titles = 'Sorry, you can only add favourite up to 4 services';
        var stitle = 'Successfully update your favourite';
    }

    if(<?php echo $appfavcount ?>  > 3)
    {
        swal(titles, {
            icon: "error",
        });

    }else
    {
        $.ajax({

            url: "{{ URL::to('app/addfav')}}"+"/"+id,
            type: "get",
           
            success: function(html)
            {       
                  swal(stitle, {
                        icon: "success",
                    });
            }


        });
    }


}
</script>



@endpush