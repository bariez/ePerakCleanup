@extends('laravolt::layout.app2')

@section('content')

<style type="text/css">
  input[type=file]::-webkit-file-upload-button {
    visibility: hidden;
  }

  .file {
    position: relative;
    height: 30px;
    width: 100px;
  }

  .file > input[type="file"] {
    position: absoulte;
    opacity: 0;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0
  }

  .file > label {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    background-color: #666;
    color: #fff;
    line-height: 30px;
    text-align: center;
    cursor: pointer;
  }
</style>

<style>
  img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    width: 150px;
  }

  img:hover {
    box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
  }
/*.ui.menu.eight.item .item {
    width: 12.5%!important;
    background-color: #00439e!important;
    color: white!important;
}*/
.ui.menu .active.item {
    background: #000!important;
    color: white!important;
    font-weight: 400!important;
    -webkit-box-shadow: none!important;
    box-shadow: none!important;
}
</style>


<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0">
  <div class="column middle aligned">
    <h3 class="ui header m-t-xs">
      Kemaskini Maklumat Kampung
    </h3>
  </div>
  <div class="column right aligned middle aligned">

    <a class="ui button" id="backbutton" href="{!! URL::to('dataentry/searchkampung/mainmenu/'.$id.'/'.$tabmain.'/'.$tabdetail.'/'.$iddetail) !!}"><i class="material-icons left"></i><span>Kembali</span></a>
  </div>
</div>
<div class="ui blue sliding indeterminate progress" id="loading" style="display: none;">
  <div class="bar">
    <div class="progress">Sila Tunggu Sebentar</div>
  </div>

</div>

<div class="ui eight item stackable tabs menu">
  <a class="item" data-tab="tprofil" id="profil"><b>Profil Kampung</b></a>
  <a class="item" data-tab="tstrukorg" id="strukorg"><b>Struktur Organisasi</b></a>
  <a class="item" data-tab="tkemudahan" id="kemudahan"><b>Kemudahan Awam & Infrastruktur</b></a>
  <a class="item" data-tab="tcapai" id="capai"><b>Pencapaian</b></a>
  <a class="item" data-tab="taktiviti" id="aktiviti"><b>Aktiviti</b></a>
  <a class="item" data-tab="tproduk" id="produk"><b>Produk</b></a>
  <a class="item" data-tab="tprojek" id="projek"><b>Projek</b></a>
  <a class="item" data-tab="tgeleri" id="geleri"><b>Galeri</b></a>
</div>
<div class="ui tab" data-tab="tprofil" id="segprofil"></div>
<div class="ui tab" data-tab="tstrukorg" id="segstrukorg"></div>
<div class="ui tab" data-tab="tkemudahan" id="segkemudahan"></div>
<div class="ui tab" data-tab="tcapai" id="segcapai"></div>
<div class="ui tab" data-tab="taktiviti" id="segaktiviti"></div>
<div class="ui tab" data-tab="tproduk" id="segproduk"></div>
<div class="ui tab" data-tab="tprojek" id="segprojek"></div>
<div class="ui tab" data-tab="tgeleri" id="segpgeleri"></div>

@endsection



@push('script')

<script type="text/javascript">
  $(document).ready(function() {



    $('.ui.dropdown')
      .dropdown();

    $('#listpentadbiran').DataTable({
      "lengthChange": false,
    });


    var tabmain = "{{$tabmain}}";
    var tabdetail = "{{$tabdetail}}";
    var id = "{{$id}}";
    var iddetail = "{{$iddetail}}";

    $('.menu .item').tab();

    if (tabmain == 1) {

      var tab = 'tprofil';

    } else if (tabmain == 2) {
      var tab = 'tstrukorg';

    } else if (tabmain == 3) {

      var tab = 'tkemudahan';

    } else if (tabmain == 4) {
      var tab = 'tcapai';

    } else if (tabmain == 5) {

      var tab = 'taktiviti';

    } else if (tabmain == 6) {
      var tab = 'tproduk';

    } else if (tabmain == 7) {

      var tab = 'tprojek';

    } else {
      var tab = 'tgeleri';


    }
    activetab(tab);


    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/searchkampung/gettab/')}}" + "/" + id + "/" + tabmain + "/" + tabdetail + "/" + iddetail,
      //datatype : 'json',

      beforeSend: function() {
        $('#loading').show();

      },

      success: function(data) {

        $(document).ready(function() {

          //////////////////////////////tab1///////////////////////////////////
          $('#namepengerusi').keyup(function() {
            $(this).val($(this).val().toUpperCase());
          });

          $('#alamtsurat').keyup(function() {
            $(this).val($(this).val().toUpperCase());
          });
          $('#sejarah').keyup(function() {
            $(this).val($(this).val().toUpperCase());
          });
          //////////////////////////////tab1///////////////////////////////////

          ////////////////////////////tab2/////////////////////////////////////
          $('#nama').keyup(function() {
            $(this).val($(this).val().toUpperCase());
          });

          $('#biro').keyup(function() {
            $(this).val($(this).val().toUpperCase());
          });

          ////////////////////////////tab2/////////////////////////////////////


          $('.ui.dropdown')
            .dropdown();
          $('#listpentadbiran').DataTable({
            "lengthChange": false,
            "language": {
              "search": "Carian:",
              "info": "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
              "infoEmpty": "Paparan 0 hingga 0 daripada 0 jumlah data",
              "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Seterusnya",
                "previous": "Sebelumnya"
              },
            }
          });
          $('#listkemudahan').DataTable({
            "lengthChange": false,
            "language": {
              "search": "Carian:",
              "info": "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
              "infoEmpty": "Paparan 0 hingga 0 daripada 0 jumlah data",
              "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Seterusnya",
                "previous": "Sebelumnya"
              },
            }
          });
          $('#listpencapaian').DataTable({
            "lengthChange": false,
            "language": {
              "search": "Carian:",
              "info": "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
              "infoEmpty": "Paparan 0 hingga 0 daripada 0 jumlah data",
              "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Seterusnya",
                "previous": "Sebelumnya"
              },
            }
          });



          $("#latitud").on("keypress", function() {
            var valid = /^\d{0,9}(\.\d{0,8})?$/.test(this.value),
              val = this.value;

            if (!valid) {
              console.log("Invalid input!");
              this.value = val.substring(0, val.length - 1);
            }
          });

          $("#longitud").on("keypress", function() {
            var valid = /^\d{0,9}(\.\d{0,8})?$/.test(this.value),
              val = this.value;

            if (!valid) {
              console.log("Invalid input!");
              this.value = val.substring(0, val.length - 1);
            }
          });

          $('.btnadd').click(function() {


            $("#divpreview").hide();
            $("#notesdiv").hide();
            $("#notesgambar").hide();
            var idgalerimast = $(this).data('idgalerimast');

            document.getElementById("idgalerimast").value = idgalerimast;

            var idkampung = $(this).data('idkampung');

            document.getElementById("idkampung").value = idkampung;




            $('#view')
              .modal({
                blurring: true
              })
              .modal('show');




          });
          $('.btnclose').click(function() {


            $('#view').modal('hide');
            return false;

          });
          $('.btncloseedit').click(function() {


            $('#edit').modal('hide');
            return false;

          });
          $('.btnedit').click(function() {


            $("#divpreviewedit").hide();
            $("#notesgambaredit").hide();
            $("#notesdivedit").hide();


            var idgalerimastedit = $(this).data('idgalerimastedit');

            document.getElementById("idgalerimastedit").value = idgalerimastedit;

            var idkampungedit = $(this).data('idkampungedit');

            document.getElementById("idkampungedit").value = idkampungedit;

            var idgaleridetailedit = $(this).data('idgaleridetailedit');

            document.getElementById("idgaleridetailedit").value = idgaleridetailedit;




            //document.getElementById("typeedit").value =145;

            var status = $(this).data('status');

            var type = $(this).data('typeedit');


            //ocument.getElementById("statusedit").value =1;

            $('.typeedit2').dropdown('set selected', type);
            $('.statusedit2').dropdown('set selected', status);


            var urledit = $(this).data('url');


            $("#divpreviewedit").hide();



            $.ajax({
              type: "GET",
              url: "{{ URL::to('dataentry/typefile/')}}" + "/" + type + "/edit",
              datatype: 'json',

              beforeSend: function() {
                $('#typefileedit').html('');



              },

              success: function(data) {



                $('#typefileedit').html(data);


                if (type == 146) {
                  document.getElementById("urledit").value = urledit;
                  $("#notesgambaredit").hide();
                  $("#notesdivedit").show();

                }else{
                  $("#notesgambaredit").show();
                  $("#notesdivedit").hide();

                }

                $("input[id=getFile]").change(function() {

                  filename = this.files[0].name;


                  var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

                  if (!allowedExtensions.exec(filename)) {



                    alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')


                    var icon = "error";
                    $("input[id=getFile]").val("");
                    return false;
                  }


                  const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                  if (fileSize > 3) {
                    alert('Saiz fail melebihi 3 MB')

                    var icon = "error";
                    //alertSwal(text,icon);
                    // alert('File size exceeds 10 MiB');
                    $("input[id=getFile]").val("");
                    return false;

                  }


                });
                //sini pulak
                getFile.onchange = evt => {


                  const [file] = getFile.files
                  if (file) {
                     $("#divpreviewedit").show();
                    blahedit.src = URL.createObjectURL(file)
                  }
                }

              }


            });


            $.ajax({
              type: "GET",
              url: "{{ URL::to('dataentry/gambaredit')}}" + "/" + idgaleridetailedit,
              datatype: 'json',

              beforeSend: function() {
                $('#gambaredit').html('');

              },

              success: function(data) {

                $('#gambaredit').html(data);


              }


            });





            $('#edit')
              .modal({
                blurring: true
              })
              .modal('show');

          });



        });



        $('#loading').hide();

        // alert(data);

        // $('#segprofil').html('data');

        view(tabmain, data);

        $("input[id=\'getFile_" + tab + "\']").change(function() {



          filename = this.files[0].name;



          var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;


          if (!allowedExtensions.exec(filename)) {



            alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')


            var icon = "error";
            $("input[id=\'getFile_" + tab + "\']").val("");

            return false;
          }

          const fileSize = this.files[0].size / 1024 / 1024; // in MiB



          if (fileSize > 3) {
            alert('Saiz fail melebihi 3 MB')

            var icon = "error";
            //alertSwal(text,icon);
            // alert('File size exceeds 10 MiB');
            $("input[id=\'getFile_" + tab + "\']").val("");
            return false;

          }

        });

      }


    });


    $(".item").click(function() {


      var id = "{{$id}}";
      var tab = $(this).attr("data-tab");





      if (tab == 'tprofil') {
        var tabmain = 1;
        var tabdetail = 1;
        var iddetail = 0;


      } else if (tab == 'tstrukorg') {

        var tabmain = 2;
        var tabdetail = 1;
        var iddetail = 0;

      } else if (tab == 'tkemudahan') {


        var tabmain = 3;
        var tabdetail = 1;
        var iddetail = 0;

      } else if (tab == 'tcapai') {


        var tabmain = 4;
        var tabdetail = 1;
        var iddetail = 0;




      } else if (tab == 'taktiviti') {


        var tabmain = 5;
        var tabdetail = 1;
        var iddetail = 0;




      } else if (tab == 'tproduk') {


        var tabmain = 6;
        var tabdetail = 1;
        var iddetail = 0;




      } else if (tab == 'tprojek') {


        var tabmain = 7;
        var tabdetail = 1;
        var iddetail = 0;




      } else {


        var tabmain = 8;
        var tabdetail = 1;
        var iddetail = 0;


      }

      $.ajax({
        type: "GET",
        url: "{{ URL::to('dataentry/searchkampung/gettab/')}}" + "/" + id + "/" + tabmain + "/" + tabdetail + "/" + iddetail,
        //datatype : 'json',

        beforeSend: function() {
          $('#loading').show();



        },

        success: function(data) {




          $(document).ready(function() {



            $('#namepengerusi').keyup(function() {
              $(this).val($(this).val().toUpperCase());
            });

            $('#alamtsurat').keyup(function() {
              $(this).val($(this).val().toUpperCase());
            });
            $('#sejarah').keyup(function() {
              $(this).val($(this).val().toUpperCase());
            });

            ////////////////////////////tab2/////////////////////////////////////
            $('#nama').keyup(function() {
              $(this).val($(this).val().toUpperCase());
            });

            $('#biro').keyup(function() {
              $(this).val($(this).val().toUpperCase());
            });

            ////////////////////////////tab2/////////////////////////////////////




            $('.ui.dropdown')
              .dropdown();



            $("#latitud").on("keypress", function() {
              var valid = /^\d{0,9}(\.\d{0,8})?$/.test(this.value),
                val = this.value;

              if (!valid) {
                console.log("Invalid input!");
                this.value = val.substring(0, val.length - 1);
              }
            });

            $("#longitud").on("keypress", function() {
              var valid = /^\d{0,9}(\.\d{0,8})?$/.test(this.value),
                val = this.value;

              if (!valid) {
                console.log("Invalid input!");
                this.value = val.substring(0, val.length - 1);
              }
            });

            $('.btnadd').click(function() {
              $("#divpreview").hide();
              $("#notesdiv").hide();
              $("#notesgambar").hide();


              var idgalerimast = $(this).data('idgalerimast');

              document.getElementById("idgalerimast").value = idgalerimast;

              var idkampung = $(this).data('idkampung');

              document.getElementById("idkampung").value = idkampung;

              $("input[id=getFile_add]").change(function() {




              });


              getFile_add.onchange = evt => {
                $("#divpreview").show();

                const [file] = getFile_add.files
                if (file) {
                  blah.src = URL.createObjectURL(file)
                }
              }



              $('#view')
                .modal({
                  blurring: true
                })
                .modal('show');



            });
            $('.btnclose').click(function() {


            $('#view').modal('hide');
            return false;

          });
            $('.btncloseedit').click(function() {


            $('#edit').modal('hide');
            return false;

          });
            $('.btnedit').click(function() {
              $("#divpreviewedit").hide();
              $("#noteseditdiv").hide();

              $("#notesgambaredit").hide();



              var idgalerimastedit = $(this).data('idgalerimastedit');

              document.getElementById("idgalerimastedit").value = idgalerimastedit;

              var idkampungedit = $(this).data('idkampungedit');

              document.getElementById("idkampungedit").value = idkampungedit;

              var idgaleridetailedit = $(this).data('idgaleridetailedit');

              document.getElementById("idgaleridetailedit").value = idgaleridetailedit;




              //document.getElementById("typeedit").value =145;

              var status = $(this).data('status');

              var type = $(this).data('type');


              //ocument.getElementById("statusedit").value =1;

              $('.typeedit2').dropdown('set selected', type);
              $('.statusedit2').dropdown('set selected', status);


              var urledit = $(this).data('url');



              $.ajax({
                type: "GET",
                url: "{{ URL::to('dataentry/typefile/')}}" + "/" + type + "/edit",
                datatype: 'json',

                beforeSend: function() {
                  $('#typefileedit').html('');



                },

                success: function(data) {



                  $('#typefileedit').html(data);

                    if (type == 146) {
                  document.getElementById("urledit").value = urledit;
                  $("#notesgambaredit").hide();
                  $("#notesdivedit").show();

                }else{
                  $("#notesgambaredit").show();
                  $("#notesdivedit").hide();

                }

                }


              });


              $.ajax({
              type: "GET",
              url: "{{ URL::to('dataentry/gambaredit')}}" + "/" + idgaleridetailedit,
              datatype: 'json',

              beforeSend: function() {
                $('#gambaredit').html('');

              },

              success: function(data) {

                $('#gambaredit').html(data);


              }


            });





              $('#edit')
                .modal({
                  blurring: true
                })
                .modal('show');

            });




          });


          $('#loading').hide();

          // alert(data);

          // $('#segprofil').html('data');



          view(tabmain, data);






        }


      });

    });

  });



  function gettab($id, $tabmain, $tabdetail, $iddetail) {
    // alert('111');

    var tabmain = $tabmain;
    var tabdetail = $tabdetail;
    var id = $id;
    var iddetail = $iddetail;




    if (tabmain == 1) {

      var tab = 'tprofil';

    } else if (tabmain == 2) {
      var tab = 'tstrukorg';

    } else if (tabmain == 3) {

      var tab = 'tkemudahan';

    } else if (tabmain == 4) {
      var tab = 'tcapai';

    } else if (tabmain == 5) {

      var tab = 'taktiviti';

    } else if (tabmain == 6) {
      var tab = 'tproduk';

    } else if (tabmain == 7) {

      var tab = 'tprojek';

    } else {
      var tab = 'tgeleri';


    }


    // alert(tab);

    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/searchkampung/gettab/')}}" + "/" + id + "/" + tabmain + "/" + tabdetail + "/" + iddetail,
      //datatype : 'json',

      beforeSend: function() {
        $('#loading').show();

      },

      success: function(data) {

        $(document).ready(function() {


          $("#divpreview_tstrukorg").hide();
          $("#divpreview_tstrukorg_edit").hide();
          $("#divpreview_tkemudahan").hide();
          $("#divpreview_tkemudahan_edit").hide();
          $("#divpreview_taktiviti").hide();
          $("#divpreview_taktiviti_edit").hide();
          $("#divpreview_tproduk").hide();
          $("#divpreview_tproduk_edit").hide();
          $("#divpreview_tprojek").hide();
          $("#divpreview_tprojek_edit").hide();
          $("#divpreviewmain").hide();
          $("#divpreviewmain_edit").hide();




          $('#namepengerusi').keyup(function() {
            $(this).val($(this).val().toUpperCase());
          });

          $('#alamtsurat').keyup(function() {
            $(this).val($(this).val().toUpperCase());
          });
          $('#sejarah').keyup(function() {
            $(this).val($(this).val().toUpperCase());
          });

          ////////////////////////////tab2/////////////////////////////////////
          $('#nama').keyup(function() {
            $(this).val($(this).val().toUpperCase());
          });

          $('#biro').keyup(function() {
            $(this).val($(this).val().toUpperCase());
          });

          ////////////////////////////tab2/////////////////////////////////////


          $('.ui.dropdown')
            .dropdown();


          $('.btnadd').click(function() {

            $("#divpreview").hide();
            $("#notesdiv").hide();
            $("#notesgambar").hide();


            var idgalerimast = $(this).data('idgalerimast');

            document.getElementById("idgalerimast").value = idgalerimast;

            var idkampung = $(this).data('idkampung');

            document.getElementById("idkampung").value = idkampung;


            // $("input[id=getFile_add]").change(function() {

            //       alert('sini');


            //   });

            $('#view').modal({
                blurring: true
              })
              .modal('show');





          });
          $('.btnclose').click(function() {


            $('#view').modal('hide');
            return false;

          });
          $('.btncloseedit').click(function() {


            $('#edit').modal('hide');
            return false;

          });

          $('.btnedit').click(function() {


            $("#divpreviewedit").hide();

            $("#notesgambaredit").hide();
            $("#notesdivedit").hide();


            var idgalerimastedit = $(this).data('idgalerimastedit');

            document.getElementById("idgalerimastedit").value = idgalerimastedit;

            var idkampungedit = $(this).data('idkampungedit');

            document.getElementById("idkampungedit").value = idkampungedit;

            var idgaleridetailedit = $(this).data('idgaleridetailedit');

            document.getElementById("idgaleridetailedit").value = idgaleridetailedit;




            //document.getElementById("typeedit").value =145;

            var status = $(this).data('status');

            var type = $(this).data('typeedit');




            //ocument.getElementById("statusedit").value =1;

            $('.typeedit2').dropdown('set selected', type);
            $('.statusedit2').dropdown('set selected', status);


            var urledit = $(this).data('url');



            $.ajax({
              type: "GET",
              url: "{{ URL::to('dataentry/typefile/')}}" + "/" + type + "/edit",
              datatype: 'json',

              beforeSend: function() {
                $('#typefileedit').html('');
                $("#notesgambaredit").hide();
                $("#notesdivedit").hide();



              },

              success: function(data) {



                $('#typefileedit').html(data);


                if (type == 146) {
                  document.getElementById("urledit").value = urledit;
                  $("#notesgambaredit").hide();
                  $("#notesdivedit").show();

                }else{
                  $("#notesgambaredit").show();
                  $("#notesdivedit").hide();

                }

                $("input[id=getFile]").change(function() {

                  filename = this.files[0].name;


                  var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

                  if (!allowedExtensions.exec(filename)) {



                    alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')


                    var icon = "error";
                    $("input[id=getFile]").val("");
                    return false;
                  }


                  const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                  if (fileSize > 3) {
                    alert('Saiz fail melebihi 3 MB')

                    var icon = "error";
                    //alertSwal(text,icon);
                    // alert('File size exceeds 10 MiB');
                    $("input[id=getFile]").val("");
                    return false;

                  }


                });




                getFile.onchange = evt => {


                  const [file] = getFile.files
                  if (file) {
                    $("#divpreviewedit").show();
                    blahedit.src = URL.createObjectURL(file)
                  }
                }




              }


            });


             $.ajax({
              type: "GET",
              url: "{{ URL::to('dataentry/gambaredit')}}" + "/" + idgaleridetailedit,
              datatype: 'json',

              beforeSend: function() {
                $('#gambaredit').html('');

              },

              success: function(data) {

                $('#gambaredit').html(data);


              }


            });





            $('#edit')
              .modal({
                blurring: true
              })
              .modal('show');



          });



          $("#latitud").on("keypress", function() {
            var valid = /^\d{0,9}(\.\d{0,8})?$/.test(this.value),
              val = this.value;

            if (!valid) {
              console.log("Invalid input!");
              this.value = val.substring(0, val.length - 1);
            }
          });

          $("#longitud").on("keypress", function() {
            var valid = /^\d{0,9}(\.\d{0,8})?$/.test(this.value),
              val = this.value;

            if (!valid) {
              console.log("Invalid input!");
              this.value = val.substring(0, val.length - 1);
            }
          });




        });



        $('#loading').hide();


        view(tabmain, data);

        // alert(tabmain);

        if (tabmain == 1) {

          var tab = 'tprofil';

        } else if (tabmain == 2) {

            if(tabdetail==2){
                getFile_tstrukorg.onchange = evt => {
                $("#divpreview_tstrukorg").show();
                const [file] = getFile_tstrukorg.files
                if (file) {
                  preview_tstrukorg.src = URL.createObjectURL(file)
                }
              }

              $("input[id=getFile_tstrukorg]").change(function() {
                filename = this.files[0].name;

                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (!allowedExtensions.exec(filename)) {
                  alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')
                  var icon = "error";
                  $("#divpreview_tstrukorg").hide();
                  $("input[id=getFile_tstrukorg").val("");

                  return false;
                }

                const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                if (fileSize > 3) {
                  alert('Saiz fail melebihi 3 MB')

                  var icon = "error";
                  //alertSwal(text,icon);
                  // alert('File size exceeds 10 MiB');
                  $("#divpreview_tstrukorg").hide();
                  $("input[id=getFile_tstrukorg").val("");
                  return false;

                }

              });

            }

            if(tabdetail==3){

                  getFile_tstrukorg_edit.onchange = evt => {
                  $("#divpreview_tstrukorg_edit").show();
                  const [file] = getFile_tstrukorg_edit.files
                  if (file) {
                    preview_tstrukorg_edit.src = URL.createObjectURL(file)
                  }
                }

             $("input[id=getFile_tstrukorg_edit]").change(function() {
                filename = this.files[0].name;

                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (!allowedExtensions.exec(filename)) {
                  alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')
                  var icon = "error";
                  $("#divpreview_tstrukorg_edit").hide();
                  $("input[id=getFile_tstrukorg_edit").val("");

                  return false;
                }

                const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                if (fileSize > 3) {
                  alert('Saiz fail melebihi 3 MB')

                  var icon = "error";
                  //alertSwal(text,icon);
                  // alert('File size exceeds 10 MiB');
                  $("#divpreview_tstrukorg_edit").hide();
                  $("input[id=getFile_tstrukorg_edit").val("");
                  return false;

                }

              });

            }

        } else if (tabmain == 3) {

          if(tabdetail==2){
              getFile_tkemudahan.onchange = evt => {
              $("#divpreview_tkemudahan").show();
              const [file] = getFile_tkemudahan.files
              if (file) {
                preview_tkemudahan.src = URL.createObjectURL(file)
              }
            }

           $("input[id=getFile_tkemudahan]").change(function() {
                filename = this.files[0].name;

                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (!allowedExtensions.exec(filename)) {
                  alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')
                  var icon = "error";
                  $("#divpreview_tkemudahan").hide();
                  $("input[id=getFile_tkemudahan").val("");

                  return false;
                }

                const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                if (fileSize > 3) {
                  alert('Saiz fail melebihi 3 MB')

                  var icon = "error";
                  //alertSwal(text,icon);
                  // alert('File size exceeds 10 MiB');
                  $("#divpreview_tkemudahan").hide();
                  $("input[id=getFile_tkemudahan").val("");
                  return false;

                }

              });

          }
          if(tabdetail==3){
             getFile_tkemudahan_edit.onchange = evt => {
              $("#divpreview_tkemudahan_edit").show();
              const [file] = getFile_tkemudahan_edit.files
              if (file) {
                preview_tkemudahan_edit.src = URL.createObjectURL(file)
              }
            }

           $("input[id=getFile_tkemudahan_edit]").change(function() {
                filename = this.files[0].name;

                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (!allowedExtensions.exec(filename)) {
                  alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')
                  var icon = "error";
                  $("#divpreview_tkemudahan_edit").hide();
                  $("input[id=getFile_tkemudahan_edit").val("");

                  return false;
                }

                const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                if (fileSize > 3) {
                  alert('Saiz fail melebihi 3 MB')

                  var icon = "error";
                  //alertSwal(text,icon);
                  // alert('File size exceeds 10 MiB');
                  $("#divpreview_tkemudahan_edit").hide();
                  $("input[id=getFile_tkemudahan_edit").val("");
                  return false;

                }

              });


          }


        } else if (tabmain == 4) {
          var tab = 'tcapai';

        } else if (tabmain == 5) {

          if(tabdetail==2){

            getFile_taktiviti.onchange = evt => {
            $("#divpreview_taktiviti").show();
            const [file] = getFile_taktiviti.files
            if (file) {
              preview_taktiviti.src = URL.createObjectURL(file)
            }
          }

             $("input[id=getFile_taktiviti]").change(function() {
                filename = this.files[0].name;

                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (!allowedExtensions.exec(filename)) {
                  alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')
                  var icon = "error";
                  $("#divpreview_taktiviti").hide();
                  $("input[id=getFile_taktiviti").val("");

                  return false;
                }

                const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                if (fileSize > 3) {
                  alert('Saiz fail melebihi 3 MB')

                  var icon = "error";
                  //alertSwal(text,icon);
                  // alert('File size exceeds 10 MiB');
                  $("#divpreview_taktiviti").hide();
                  $("input[id=getFile_taktiviti").val("");
                  return false;

                }

              });

          }
          if(tabdetail==3){

            getFile_taktiviti_edit.onchange = evt => {
            $("#divpreview_taktiviti_edit").show();

            const [file] = getFile_taktiviti_edit.files
            if (file) {
              preview_taktiviti_edit.src = URL.createObjectURL(file)
            }
          }

           $("input[id=getFile_taktiviti_edit]").change(function() {
                filename = this.files[0].name;

                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (!allowedExtensions.exec(filename)) {
                  alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')
                  var icon = "error";
                  $("#divpreview_taktiviti_edit").hide();
                  $("input[id=getFile_taktiviti_edit").val("");

                  return false;
                }

                const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                if (fileSize > 3) {
                  alert('Saiz fail melebihi 3 MB')

                  var icon = "error";
                  //alertSwal(text,icon);
                  // alert('File size exceeds 10 MiB');
                  $("#divpreview_taktiviti_edit").hide();
                  $("input[id=getFile_taktiviti_edit").val("");
                  return false;

                }

              });

          }



        }
         else if (tabmain == 6) {
            var tab = 'tproduk';
         
            if (tabdetail == 6) {

                // alert(tabdetail);

                getFile_tproduk.onchange = evt => {
            
                    $("#divpreview_tproduk").show();

                    const [file] = getFile_tproduk.files
                    if (file) {
                        preview_tproduk.src = URL.createObjectURL(file)
                    }
                }

                $("input[id=getFile_tproduk]").change(function() {
                    filename = this.files[0].name;

                    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                    if (!allowedExtensions.exec(filename)) {
                        alert(
                            'Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')
                        var icon = "error";
                        $("#divpreview_tproduk").hide();
                        $("input[id=getFile_tproduk").val("");

                        return false;
                    }

                    const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                    if (fileSize > 3) {
                        alert('Saiz fail melebihi 3 MB')

                        var icon = "error";
                        //alertSwal(text,icon);
                        // alert('File size exceeds 10 MiB');
                        $("#divpreview_tproduk").hide();
                        $("input[id=getFile_tproduk").val("");
                        return false;

                    }

                });

            }

            if (tabdetail == 8) {

                getFile_tproduk_edit.onchange = evt => {
                    $("#divpreview_tproduk_edit").show();

                    const [file] = getFile_tproduk_edit.files
                    if (file) {
                        preview_tproduk_edit.src = URL.createObjectURL(file)
                    }
                }

                $("input[id=getFile_tproduk_edit]").change(function() {
                    filename = this.files[0].name;

                    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                    if (!allowedExtensions.exec(filename)) {
                        alert(
                            'Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')
                        var icon = "error";
                        $("#divpreview_tproduk_edit").hide();
                        $("input[id=getFile_tproduk_edit").val("");

                        return false;
                    }

                    const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                    if (fileSize > 3) {
                        alert('Saiz fail melebihi 3 MB')

                        var icon = "error";
                        //alertSwal(text,icon);
                        // alert('File size exceeds 10 MiB');
                        $("#divpreview_tproduk_edit").hide();
                        $("input[id=getFile_tproduk_edit").val("");
                        return false;

                    }

                });

            }

        } else if (tabmain == 7) {

          var tab = 'tprojek';

          if(tabdetail==2){
            getFile_tprojek.onchange = evt => {
            $("#divpreview_tprojek").show();

            const [file] = getFile_tprojek.files
            if (file) {
              preview_tprojek.src = URL.createObjectURL(file)
            }
          }

           $("input[id=getFile_tprojek]").change(function() {
                filename = this.files[0].name;

                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (!allowedExtensions.exec(filename)) {
                  alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')
                  var icon = "error";
                  $("#divpreview_tprojek").hide();
                  $("input[id=getFile_tprojek").val("");

                  return false;
                }

                const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                if (fileSize > 3) {
                  alert('Saiz fail melebihi 3 MB')

                  var icon = "error";
                  //alertSwal(text,icon);
                  // alert('File size exceeds 10 MiB');
                  $("#divpreview_tprojek").hide();
                  $("input[id=getFile_tprojek").val("");
                  return false;

                }

              });


          }
          if(tabdetail==3){

           getFile_tprojek_edit.onchange = evt => {
            $("#divpreview_tprojek_edit").show();
            const [file] = getFile_tprojek_edit.files
            if (file) {
              preview_tprojek_edit.src = URL.createObjectURL(file)
            }
          }

           $("input[id=getFile_tprojek_edit]").change(function() {
                filename = this.files[0].name;

                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (!allowedExtensions.exec(filename)) {
                  alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')
                  var icon = "error";
                  $("#divpreview_tprojek_edit").hide();
                  $("input[id=getFile_tprojek_edit").val("");

                  return false;
                }

                const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                if (fileSize > 3) {
                  alert('Saiz fail melebihi 3 MB')

                  var icon = "error";
                  //alertSwal(text,icon);
                  // alert('File size exceeds 10 MiB');
                  $("#divpreview_tprojek_edit").hide();
                  $("input[id=getFile_tprojek_edit").val("");
                  return false;

                }

              });

          }


        } else {
          var tab = 'tgeleri';
          $("#divpreviewmain").hide();
          if ($tabdetail == 2) {

            getFile_tgeleri.onchange = evt => {
              $("#divpreviewmain").show();


              const [file] = getFile_tgeleri.files
              if (file) {
                preview_tgeleri.src = URL.createObjectURL(file)
              }
            }

              $("input[id=getFile_tgeleri]").change(function() {
                filename = this.files[0].name;

                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (!allowedExtensions.exec(filename)) {
                  alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')
                  var icon = "error";
                  $("#divpreviewmain").hide();
                  $("input[id=getFile_tgeleri").val("");

                  return false;
                }

                const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                if (fileSize > 3) {
                  alert('Saiz fail melebihi 3 MB')

                  var icon = "error";
                  //alertSwal(text,icon);
                  // alert('File size exceeds 10 MiB');
                  $("#divpreviewmain").hide();
                  $("input[id=getFile_tgeleri").val("");
                  return false;

                }

              });
          }
          if ($tabdetail == 3) {
            getFile_tgeleri_edit.onchange = evt => {
              $("#divpreviewmain_edit").show();
              const [file] = getFile_tgeleri_edit.files
              if (file) {
                preview_tgeleri_edit.src = URL.createObjectURL(file)
              }
            }

            $("input[id=getFile_tgeleri_edit]").change(function() {
                filename = this.files[0].name;

                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                if (!allowedExtensions.exec(filename)) {
                  alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')
                  var icon = "error";
                  $("#divpreviewmain_edit").hide();
                  $("input[id=getFile_tgeleri_edit").val("");

                  return false;
                }

                const fileSize = this.files[0].size / 1024 / 1024; // in MiB

                if (fileSize > 3) {
                  alert('Saiz fail melebihi 3 MB')

                  var icon = "error";
                  //alertSwal(text,icon);
                  // alert('File size exceeds 10 MiB');
                  $("#divpreviewmain_edit").hide();
                  $("input[id=getFile_tgeleri_edit").val("");
                  return false;

                }

              });
          }


        }

      }


      ////////////////

    });
  }

  function activetab($tabmain) {

    var tabmain = $tabmain;


    if (tabmain == 'tprofil') {


      $('#profil').addClass("active");
      $('#segprofil').addClass("active");
      $('#strukorg').removeClass("active");
      $('#segstrukorg').removeClass("active");
      $('#kemudahan').removeClass("active");
      $('#segkemudahan').removeClass("active");
      $('#capai').removeClass("active");
      $('#segcapai').removeClass("active");
      $('#aktiviti').removeClass("active");
      $('#segaktiviti').removeClass("active");
      $('#produk').removeClass("active");
      $('#segproduk').removeClass("active");
      $('#projek').removeClass("active");
      $('#segprojek').removeClass("active");
      $('#geleri').removeClass("active");
      $('#segpgeleri').removeClass("active");

    } else if (tabmain == 'tstrukorg') {




      $('#profil').removeClass("active");
      $('#segprofil').removeClass("active");
      $('#strukorg').addClass("active");
      $('#segstrukorg').addClass("active");
      $('#kemudahan').removeClass("active");
      $('#segkemudahan').removeClass("active");
      $('#capai').removeClass("active");
      $('#segcapai').removeClass("active");
      $('#aktiviti').removeClass("active");
      $('#segaktiviti').removeClass("active");
      $('#produk').removeClass("active");
      $('#segproduk').removeClass("active");
      $('#projek').removeClass("active");
      $('#segprojek').removeClass("active");
      $('#geleri').removeClass("active");
      $('#segpgeleri').removeClass("active");



    } else if (tabmain == 'tkemudahan') {




      $('#profil').removeClass("active");
      $('#segprofil').removeClass("active");
      $('#strukorg').removeClass("active");
      $('#segstrukorg').removeClass("active");
      $('#kemudahan').addClass("active");
      $('#segkemudahan').addClass("active");
      $('#capai').removeClass("active");
      $('#segcapai').removeClass("active");
      $('#aktiviti').removeClass("active");
      $('#segaktiviti').removeClass("active");
      $('#produk').removeClass("active");
      $('#segproduk').removeClass("active");
      $('#projek').removeClass("active");
      $('#segprojek').removeClass("active");
      $('#geleri').removeClass("active");
      $('#segpgeleri').removeClass("active");


    } else if (tabmain == 'tcapai') {




      $('#profil').removeClass("active");
      $('#segprofil').removeClass("active");
      $('#strukorg').removeClass("active");
      $('#segstrukorg').removeClass("active");
      $('#kemudahan').removeClass("active");
      $('#segkemudahan').removeClass("active");
      $('#capai').addClass("active");
      $('#segcapai').addClass("active");
      $('#aktiviti').removeClass("active");
      $('#segaktiviti').removeClass("active");
      $('#produk').removeClass("active");
      $('#segproduk').removeClass("active");
      $('#projek').removeClass("active");
      $('#segprojek').removeClass("active");
      $('#geleri').removeClass("active");
      $('#segpgeleri').removeClass("active");


    } else if (tabmain == 'taktiviti') {



      $('#profil').removeClass("active");
      $('#segprofil').removeClass("active");
      $('#strukorg').removeClass("active");
      $('#segstrukorg').removeClass("active");
      $('#kemudahan').removeClass("active");
      $('#segkemudahan').removeClass("active");
      $('#capai').removeClass("active");
      $('#segcapai').removeClass("active");
      $('#aktiviti').addClass("active");
      $('#segaktiviti').addClass("active");
      $('#produk').removeClass("active");
      $('#segproduk').removeClass("active");
      $('#projek').removeClass("active");
      $('#segprojek').removeClass("active");
      $('#geleri').removeClass("active");
      $('#segpgeleri').removeClass("active");


    } else if (tabmain == 'tproduk') {




      $('#profil').removeClass("active");
      $('#segprofil').removeClass("active");
      $('#strukorg').removeClass("active");
      $('#segstrukorg').removeClass("active");
      $('#kemudahan').removeClass("active");
      $('#segkemudahan').removeClass("active");
      $('#capai').removeClass("active");
      $('#segcapai').removeClass("active");
      $('#aktiviti').removeClass("active");
      $('#segaktiviti').removeClass("active");
      $('#produk').addClass("active");
      $('#segproduk').addClass("active");
      $('#projek').removeClass("active");
      $('#segprojek').removeClass("active");
      $('#geleri').removeClass("active");
      $('#segpgeleri').removeClass("active");


    } else if (tabmain == 'tprojek') {




      $('#profil').removeClass("active");
      $('#segprofil').removeClass("active");
      $('#strukorg').removeClass("active");
      $('#segstrukorg').removeClass("active");
      $('#kemudahan').removeClass("active");
      $('#segkemudahan').removeClass("active");
      $('#capai').removeClass("active");
      $('#segcapai').removeClass("active");
      $('#aktiviti').removeClass("active");
      $('#segaktiviti').removeClass("active");
      $('#produk').removeClass("active");
      $('#segproduk').removeClass("active");
      $('#projek').addClass("active");
      $('#segprojek').addClass("active");
      $('#geleri').removeClass("active");
      $('#segpgeleri').removeClass("active");


    } else {




      $('#profil').removeClass("active");
      $('#segprofil').removeClass("active");
      $('#strukorg').removeClass("active");
      $('#segstrukorg').removeClass("active");
      $('#kemudahan').removeClass("active");
      $('#segkemudahan').removeClass("active");
      $('#capai').removeClass("active");
      $('#segcapai').removeClass("active");
      $('#aktiviti').removeClass("active");
      $('#segaktiviti').removeClass("active");
      $('#produk').removeClass("active");
      $('#segproduk').removeClass("active");
      $('#projek').removeClass("active");
      $('#segprojek').removeClass("active");
      $('#geleri').addClass("active");
      $('#segpgeleri').addClass("active");

    }
  }


  function view($tabmain, $data) {




    if ($tabmain == 1) {
      document.getElementById("segprofil").innerHTML = $data;

    } else if ($tabmain == 3) {



      document.getElementById("segkemudahan").innerHTML = $data;


    } else if ($tabmain == 4) {



      document.getElementById("segcapai").innerHTML = $data;


    } else if ($tabmain == 5) {



      document.getElementById("segaktiviti").innerHTML = $data;


    } else if ($tabmain == 6) {



      document.getElementById("segproduk").innerHTML = $data;


    } else if ($tabmain == 7) {

      document.getElementById("segprojek").innerHTML = $data;


    } else if ($tabmain == 8) {

      document.getElementById("segpgeleri").innerHTML = $data;


    } else {

      document.getElementById("segstrukorg").innerHTML = $data;


    }
  }

  function foo() {

    var jawatan = document.getElementById("jawatan").value; // added .value
    var status = document.getElementById("status").value; // added .value
    var tahun = document.getElementById("tahun").value; // added .value
    var gambar = document.getElementById("getFile_tstrukorg").value; //



    if (jawatan === '' || jawatan === null) {

      //alert('yyy');
      alert('Sila masukan jawatan');
      return false;

    } else {

      if (jawatan == 141) { //pengerusi

        $('#biro').removeAttr('required');
      } else {

        $('#biro').attr('required', 'required');
      }



      if (status === '' || status === null) {

        alert('Sila masukan status');
        return false;

      } else {

        if (tahun === '' || tahun === null) {

          alert('Sila masukan tahun');
          return false;

        } else {
          if (gambar === '' || gambar === null) {
            alert('Sila masukan Gambar');
            return false;
          } else {

            return true;
          }

        }



      }



    }


  }

  function validatekemudahan() {

    var catkemudahan = document.getElementById("catkemudahan").value; // added .value
    var jeniskemudahan = document.getElementById("jeniskemudahan").value; // added .value
    var unit = document.getElementById("unit").value; // added .value
    var gambar = document.getElementById("getFile_tkemudahan").value; //


    if (catkemudahan === '' || catkemudahan === null) {

      //alert('yyy');
      alert('Sila masukan Kategori Kemudahan');
      return false;

    } else {



      if (jeniskemudahan === '' || jeniskemudahan === null) {

        alert('Sila masukan Jenis Kemudahan');
        return false;

      } else {

        if (unit === '' || unit === null) {

          alert('Sila masukan Unit');
          return false;

        } else {

          if (gambar === '' || gambar === null) {
            alert('Sila masukan Gambar');
            return false;
          } else {

            return true;
          }

        }

      }

    }


  }

  function validatepencapaian() {

    var peringkat = document.getElementById("peringkat").value; // added .value
    var tahun = document.getElementById("tahun").value; // added .value




    if (peringkat === '' || peringkat === null) {

      //alert('yyy');
      alert('Sila masukan Peringkat');
      return false;

    } else {

      if (tahun === '' || tahun === null) {

        //alert('yyy');
        alert('Sila masukan Tahun');
        return false;

      } else {
        return true;

      }


    }


  }

  function validateprojek() {

    var jenisprojek = document.getElementById("jenisprojek").value;

    var gambar = document.getElementById("getFile_tprojek").value; //

    if (jenisprojek === '' || jenisprojek === null) {

      //alert('yyy');
      alert('Sila masukan Jenis Projek');
      return false;

    } else {

      if (gambar === '' || gambar === null) {
        alert('Sila masukan Gambar');
        return false;
      } else {

        return true;
      }


    }


  }

  function validateaktiviti() {

    var peringkat = document.getElementById("peringkat").value; // added .value
    var jenisaktiviti = document.getElementById("jenisaktiviti").value; // added .value
    var tahun = document.getElementById("tahun").value; // added .value
    var gambar = document.getElementById("getFile_taktiviti").value; //


    if (peringkat === '' || peringkat === null) {

      //alert('yyy');
      alert('Sila masukan Peringkat');
      return false;

    } else {

      if (jenisaktiviti === '' || jenisaktiviti === null) {

        //alert('yyy');
        alert('Sila masukan Jenis Aktiviti');
        return false;

      } else {


        if (tahun === '' || tahun === null) {

          //alert('yyy');
          alert('Sila masukan Tahun');
          return false;

        } else {
          if (gambar === '' || gambar === null) {
            alert('Sila masukan Gambar');
            return false;
          } else {

            return true;
          }

        }

      }



    }


  }
  // function validatepengeluar() {

  //    var mediasosial = document.getElementById("mediasosial").value; // added .value


  //    if(mediasosial === '' || mediasosial=== null){

  //      //alert('yyy');
  //      alert('Sila masukan Media Sosial');
  //       return false;

  //    }else{
  //     return true;

  //    }


  // }
  function validategalerimain() {


    var status = document.getElementById("status").value; // added


    var gambar = document.getElementById("getFile_tgeleri").value; //



    if (status === '' || status === null) {

      //alert('yyy');
      alert('Sila masukan Status');
      return false;

    } else {

      if (gambar === '' || gambar === null) {
        alert('Sila masukan Gambar');
        return false;
      } else {

        return true;
      }
    }


  }

  function validategaleri() {

    var type = $('#type').val();
    var status = document.getElementById("status").value; // added .value

    if(type==145){
    var gambar = document.getElementById("getFile_add").value; //
    }



    if (type === '' || type === null) {

      //alert('yyy');
      alert('Sila masukan Jenis File');
      return false;

    } else {

      if (status === '' || status === null) {

        //alert('yyy');
        alert('Sila masukan Status');
        return false;

      } else {
        if (gambar === '' || gambar === null) {
          alert('Sila masukan Gambar');
          return false;
        } else {

          return true;
        }


      }


    }


  }

  function jeniskemudahan(id) {


    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/jeniskemudahan/')}}" + "/" + id,
      datatype: 'json',

      beforeSend: function() {
        document.getElementById("pilihjeniskemudahan").innerHTML = "Sila Pilih";
        $('#selectjeniskemudahan').html('');
        $('#loading').show();



      },

      success: function(data) {

        $('#loading').hide();
        $('#selectjeniskemudahan').html(data);


      }


    });

  };

  function jenisproduk(id) {


    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/jenisproduk/')}}" + "/" + id,
      datatype: 'json',

      beforeSend: function() {
        document.getElementById("pilihjenisproduk").innerHTML = "Sila Pilih";
        $('#selectjenisproduk').html('');
        $('#loading').show();



      },

      success: function(data) {

        $('#loading').hide();
        $('#selectjenisproduk').html(data);


      }


    });

  };

  function validateproduk() {

    var catproduk = document.getElementById("catproduk").value; // added .value
    var jenisproduk = document.getElementById("jenisproduk").value; // added .value
    var gambar = document.getElementById("getFile_tproduk").value; // added .value
     var gambar = document.getElementById("getFile_tproduk").value; //


    if (catproduk === '' || catproduk === null) {

      //alert('yyy');
      alert('Sila masukan Kategori Produk');
      return false;

    } else {



      if (jenisproduk === '' || jenisproduk === null) {

        alert('Sila masukan Jenis Produk');
        return false;

      } else {
         if (gambar === '' || gambar === null) {
          alert('Sila masukan Gambar');
          return false;
        } else {

          return true;
        }

      }



    }


  }

  function validatepengeluar() {

    var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    var emel = document.getElementById("emel").value;


    if (email_reg.test(emel) == false) {

      alert('Sila masukkan alamat emel yang betul');
      return false;
    } else {
      return true;
    }





  }

  function validateeditgaleri() {

    var type = document.getElementById("typeedit").value; // added .value
    var status = document.getElementById("statusedit").value; // added .value



    if(type==145){
      var gambar = document.getElementById("getFile").value; //
    }


    if (type === '' || type === null) {

      //alert('yyy');
      alert('Sila masukan Jenis File');
      return false;

    } else {

      if (status === '' || status === null) {

        //alert('yyy');
        alert('Sila masukan Status');
        return false;

      } else {
        // if (gambar === '' || gambar === null) {
        //   alert('Sila masukan Gambar');
        //   return false;
        // } else {

          return true;
        //}



      }


    }


  }

  function typefile(id, type) {


    $.ajax({
      type: "GET",
      url: "{{ URL::to('dataentry/typefile/')}}" + "/" + id + "/" + type,
      datatype: 'json',

      beforeSend: function() {

          $('#typefile').html('');
          $('#notes').hide();
          $('#typefileedit').html('');
          $('#notesedit').hide();
          $("#notesgambaredit").hide();
          $("#notesdivedit").hide();
          $('#notesdiv').hide();
          $('#notesgambar').hide();
          $("#gambaredit").hide();


      },

      success: function(data) {

        if (type == 'add') {
          $('#typefile').html(data);

          if(id == 146){
          $('#notesdiv').show();
          $('#notesgambar').hide();

          }else{

          $('#notesdiv').hide();
          $('#notesgambar').show();


          }

        } else {
          $('#typefileedit').html(data);

           if(id == 146){

          $("#notesgambaredit").hide();
          $("#notesdivedit").show();
          $("#gambaredit").hide();

          }else{

          $("#notesgambaredit").show();
          $("#notesdivedit").edit();
          $("#gambaredit").show();

          }


        }




        $("input[id=getFile_add]").change(function() {

          filename = this.files[0].name;


          var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

          if (!allowedExtensions.exec(filename)) {



            alert('Jenis fail tidak sah. Jenis fail yang dibenarkan .jpg,.jpeg,.png')


            var icon = "error";
            $("input[id=getFile_add]").val("");
            return false;
          }


          const fileSize = this.files[0].size / 1024 / 1024; // in MiB

          if (fileSize > 3) {
            alert('Saiz fail melebihi 3 MB')

            var icon = "error";
            //alertSwal(text,icon);
            // alert('File size exceeds 10 MiB');
            $("input[id=getFile_add]").val("");
            return false;

          }

        });

        //sini
        if (type == 'add') {
          $("#divpreview").hide();
          getFile_add.onchange = evt => {
            $("#divpreview").show();




            const [file] = getFile_add.files
            if (file) {
              blah.src = URL.createObjectURL(file)
            }
          }

        }






      }


    });



  }
</script>

@endpush
