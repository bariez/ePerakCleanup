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
                                <?php echo $app->content_en; ?>
                            @else
                                <?php echo $app->content_bm; ?>
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

             $.get('{!! $url !!}', {}, function(ssodata) 
             {

                  var datas = JSON.stringify(ssodata);
                  var myObj = JSON.parse(datas);

                  console.log(myObj.Encrypt_ExtResult);

                 if (myObj.Encrypt_ExtResult !=="") 
                 {
                    $('#kemaskini').html("<a href='https://ekls.hasil.gov.my/ssoprod/ujikemaskini/makkemaskini.php?ssoref1=" + myObj.Encrypt_ExtResult + "' target='_blank'>@lang('homepage.kemaskini')</a>");


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

 <script type="text/javascript">

    $(document).ready(function () 
    {
        var taxno = <?php echo "'".$user->tax_no."'" ?>;
        var doctype = <?php echo "'".$user->doc_type."'" ?>;
        var idtype = <?php echo "'".$user->reference_type."'" ?>;

             $.get('{!! $urlepc1 !!}', {}, function(ssodataidtype) 
             {

                  var datasidtype = JSON.stringify(ssodataidtype);
                  var myObjidtype = JSON.parse(datasidtype);

                  console.log(myObjidtype.Encrypt_ExtResult);

                 if (myObjidtype.Encrypt_ExtResult !=="") 
                 {
                         $.get('{!! $urlepc2 !!}', {}, function(ssodatataxno) 
                         {

                              var datastaxno = JSON.stringify(ssodatataxno);
                              var myObjtaxno = JSON.parse(datastaxno);

                              console.log(myObjtaxno.Encrypt_ExtResult);

                             if (myObjtaxno.Encrypt_ExtResult !=="") 
                             {
                                     $.get('{!! $urlepc3 !!}', {}, function(ssodatadoc) 
                                     {

                                          var datasdoc = JSON.stringify(ssodatadoc);
                                          var myObjdoc = JSON.parse(datasdoc);

                                          console.log(myObjdoc.Encrypt_ExtResult);

                                         if (myObjdoc.Encrypt_ExtResult !=="") 
                                         {

                                            $.get('{!! $urlepc4 !!}', {}, function(ssodataic) 
                                             {

                                                  var datasic = JSON.stringify(ssodataic);
                                                  var myObjic = JSON.parse(datasic);

                                                  console.log(myObjic.Encrypt_ExtResult);

                                                 if (myObjic.Encrypt_ExtResult !=="") 
                                                 {

                                                        $.get('{!! $urlepc5 !!}', {}, function(ssodatalang) 
                                                         {

                                                              var datalang = JSON.stringify(ssodatalang);
                                                              var myObjlang = JSON.parse(datalang);

                                                              console.log(myObjlang.Encrypt_ExtResult);

                                                             if (myObjlang.Encrypt_ExtResult !=="") 
                                                             {

                                                                    $('#espc').html("<a href='https://ez.hasil.gov.my/CI/eSPC.aspx?IdNo=" + myObjic.Encrypt_ExtResult + "&RefNo="  + myObjtaxno.Encrypt_ExtResult + "&IdType=" + myObjidtype.Encrypt_ExtResult + "&CertType=" +  myObjdoc.Encrypt_ExtResult + "&Lang=" + myObjlang.Encrypt_ExtResult +"' target='_blank'>@lang('homepage.espcurl')</a>");

                                                             }
                                                             else 
                                                             {
                                                                console.log('error');

                                                             }


                                                        }, 'jsonp');

                                                 }
                                                 else 
                                                 {
                                                    console.log('error');

                                                 }


                                                }, 'jsonp');
                                         }
                                         else 
                                         {
                                            console.log('error');

                                         }


                                        }, 'jsonp');

                             }
                             else 
                             {
                                console.log('error');

                             }


                            }, 'jsonp');


                 }
                 else 
                 {
                    console.log('error');

                 }


                }, 'jsonp');





    });

</script>




@endpush