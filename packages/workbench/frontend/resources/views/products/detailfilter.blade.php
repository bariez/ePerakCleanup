@extends('laravolt::eperak.layouts.base')

@section('content')
<?php

    use Workbench\Site\Model\Lookup\LkpDetail;
    use Workbench\Site\Model\Lookup\ProfilProduk;

?>
<!-- start-------------------------------------------------------------------------------------------------------- -->

@push('style')
<style type="text/css">
    .autosizing 
    { 
        height: auto; 
    }

    #warna
    {
        
    }
    .capitalall
    {
        text-transform: uppercase;
    }
</style>
@endpush

<!-- start -------------------------------------------------------------------------------------------------------- -->

    <!-- banner start -->
        <section class="section-box" style="padding-top: 0px">
            <div class="box-head-single" style="background-color: #f2f2f2 !important; padding-top: 0px; padding-bottom: 0px">
                <div class="container" style="min-width: 100%">
                    <div class="row">
                        <div class="col-md-12 capitalall" style="text-align: center; padding-bottom: 25px">
                            <b><h4 style="color: black; padding-top: 25px">
                                Kategori Produk Tempatan<br/>
                            </h4></b>
                            <h6 style="color: black">
                                Terokai produk dan barangan tempatan di Perak
                            </h6>
                            
                            <!-- <br><br> -->
                            <!-- <a href="#" class="btn btn-secondary btn-shadow ml-10 hover-up">Lihat Terperinci</a> -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- banner end   -->

    <!-- aktiviti start -->
        <section class="section-box mt-30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                        <!-- carian here --------------------------- -->
                            <div class="list-recent-jobs" style="margin-top: 10px;">
                                <div class="card-job wow animate__animated animate__fadeIn">
                                    <div class="card-job-top">

                                         <!-- Form::open()->url('/product/'.data_get($request, 'idtype').'/search')->method('POST')->class('ui form horizontal') !!} -->
                                        {!! form()->open()->post()->action(route('frontend.postProductSearch'))->attribute('id', 'formproductssearchlist')->multipart()->horizontal() !!}
                                        <input type="hidden" name="idtype" id="idtype" value="{{ data_get($request, 'idtype') }}" >

                                            <div class="input-group" id="searchpapar">

                                                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                                    <div class="banner-hero hero-1">
                                                        <div class="banner-inner">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="block-banner">
                                                                        <div class="form-find wow animate__animated animate__fadeInUp" data-wow-delay=".2s" id="seldaerah">
                                                                            <select class="form-input mr-10 select-active hover-up" id="iddaerah" style="border-radius: 0px  10px 10px 0px;" name="searchdaerah">
                                                                            
                                                                                <option value="0">Daerah</option>

                                                                                    @foreach($daerah->where('id', $request->daerah)->take(1) as $key => $daerahs)
                                                                                        <option value="{{ $request->daerah }}" selected="true">
                                                                                            {{ data_get($daerahs, 'NamaDaerah') }}
                                                                                        </option>
                                                                                    @endforeach

                                                                                    @foreach($daerah->where('id', '!=', $request->daerah) as $key => $daerahs)
                                                                                        <option value="{{ data_get($daerahs, 'id') }}">
                                                                                            {{ data_get($daerahs, 'NamaDaerah') }}
                                                                                        </option>
                                                                                    @endforeach

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                                    <div class="banner-hero hero-1">
                                                        <div class="banner-inner">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="block-banner">
                                                                        <div class="form-find wow animate__animated animate__fadeInUp" data-wow-delay=".2s" id="selmukim">
                                                                            <select class="form-input mr-10 select-active hover-up" id="idmukim" style="border-radius: 0px  10px 10px 0px;" name="searchmukim">
                                                                            
                                                                                <option value="0">Mukim</option>

                                                                                    @foreach($mukim->where('id', $request->mukim)->take(1) as $key => $mukims)
                                                                                        <option value="{{ $request->mukim }}" selected="true">
                                                                                            {{ data_get($mukims, 'NamaMukim') }}
                                                                                        </option>
                                                                                    @endforeach

                                                                                    @foreach($mukim->where('id', '!=', $request->mukim) as $key => $mukims)
                                                                                        <option value="{{ data_get($mukims, 'id') }}">
                                                                                            {{ data_get($mukims, 'NamaMukim') }}
                                                                                        </option>
                                                                                    @endforeach

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                                                    <div class="banner-hero hero-1">
                                                        <div class="banner-inner">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="block-banner">
                                                                        <div class="form-find wow animate__animated animate__fadeInUp" data-wow-delay=".2s" id="selkampung">
                                                                            <select class="form-input mr-10 select-active hover-up" id="idkampung" style="border-radius: 0px  10px 10px 0px;" name="searchkampung">
                                                                            
                                                                                <option value="0">Kampung</option>

                                                                                    @foreach($kampung->where('id', $request->kampung)->take(1) as $key => $kampungs)
                                                                                        <option value="{{ $request->kampung }}" selected="true">
                                                                                            {{ data_get($kampungs, 'NamaKampung') }}
                                                                                        </option>
                                                                                    @endforeach

                                                                                    @foreach($kampung->where('id', '!=', $request->kampung) as $key => $kampungs)
                                                                                        <option value="{{ data_get($kampungs, 'id') }}">
                                                                                            {{ data_get($kampungs, 'NamaKampung') }}
                                                                                        </option>
                                                                                    @endforeach

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <br><br><br>

                                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="btn-group" style="float: right;">
                                                                <div class="block-banner">
                                                                    <button type="submit" class="btn btn-default btn-shadow hover-up" 
                                                                            style="color: white; background-color: #432712; height: 50px ">
                                                                        Carian
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row mt-30" id="loadingpapar" style="display: none">
                                                <center>
                                                    <img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
                                                </center>

                                            </div>

                                        {!! Form::close() !!}

                                    </div>
                                </div>
                            </div>
                        <!-- carian end --------------------------- -->

                        <div class="container" id="listproduct">
                            <div class="row align-items-end">
                                    <h3 class="section-title wow animate__animated animate__fadeInUp capitalall" style="color: white; text-shadow: 2px 2px #000000;">Senarai Produk Tempatan</h3>
                            </div>
                            <div class="row align-items-end">
                                <div class="text-xl-end text-start" style="padding-top: 20px;">
                                    <!-- <ul class="nav nav-right float-xl-end float-start" role="tablist"> -->
                                    <ul class="nav nav-right " role="tablist" style="float: none; position: relative; left: 20%; right: 0; margin-left: auto; margin-right: auto;"> <!-- float-xl-end float-start -->
                                        @foreach($lkpproduk as $key => $lkpproduks)

                                            <li class="wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                                <button type="button" 
                                                        class="<?php if($request->segment(2) == $lkpproduks->id) {echo 'active';} ?>" 
                                                        role="tab" id="nav-tab-{{ data_get($lkpproduks, 'id') }}" 
                                                        data-bs-toggle="tab" 
                                                        data-bs-target="#tab-1" 
                                                        aria-controls="tab-1" 
                                                        aria-selected="true"
                                                        data-idtype="{{ data_get($lkpproduks, 'id') }}" 
                                                        onclick="produkkatid(this)"
                                                        style="color: white; text-shadow: 2px 2px #000000;">
                                                    {{ data_get($lkpproduks, 'description') }}&nbsp;&nbsp;
                                                    <span class="badge rounded-pill bg-danger" style="vertical-align: text-top"> <!-- position-absolute top-0 start-100  -->
                                                         
                                                        <?php

                                                            $profilproduk  = ProfilProduk::with('kampung.daerah', 'kampung.mukim', 'pengeluar', 'kategori', 'jenisproduk')
                                                                                         ->where('KategoriProduk', $lkpproduks->id)
                                                                                         ->whereHas('kampung.daerah', function ($query) use ($request)
                                                                                         {
                                                                                            if($request->daerah != '0')
                                                                                                $query->where('id', '=', $request->daerah);
                                                                                            else
                                                                                                $query;
                                                                                         })
                                                                                         ->whereHas('kampung.mukim', function ($query) use ($request)
                                                                                         {
                                                                                            if($request->mukim != '0')
                                                                                                $query->where('id', '=', $request->mukim);
                                                                                            else
                                                                                                $query;
                                                                                         })
                                                                                         ->whereHas('kampung', function ($query) use ($request)
                                                                                         {
                                                                                            if($request->kampung != '0')
                                                                                                $query->where('id', '=', $request->kampung);
                                                                                            else
                                                                                                $query;
                                                                                         })
                                                                                         ->get();
                                                        ?>

                                                        {{ count( $profilproduk ) }}
                                                    </span>
                                                </button>
                                            </li>

                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="mt-10">

                                <div class="tab-content" id="">

                                    <div class="fade show active autosizing">
                                        <div class="row" id="papar-produk">

                                            @foreach($produk as $key => $produks)

                                                <div class="col-lg-4 col-md-4 col-sm-12 col-12 hover-up wow animate__animated animate__fadeInUp mb-10" data-wow-delay=".5s">
                                                    <div class="card-grid-2 hover-up h-100" style="border-top-width: 0px; border-left-width: 0px; border-right-width: 0px; border-bottom-width: 10px;">
                                                        <div class="text-center card-grid-2-image">
                                                            <figure>

                                                                @if( data_get($produks, 'Gambar_path') )
                                                                    @if( file_exists( public_path( data_get($produks, 'Gambar_path') ) ) )
                                                                        <img src="{!! URL::to(data_get($produks, 'Gambar_path')) !!}" alt="{{ data_get($produks, 'NamaProduk') }}" title="{{ data_get($produks, 'NamaProduk') }}" 
                                                                             style="height: 300px !important">
                                                                    @else
                                                                        <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($produks, 'NamaProduk') }}" title="{{ data_get($produks, 'NamaProduk') }}"
                                                                             style="height: 50% !important; width: 50% !important">
                                                                    @endif
                                                                @else
                                                                    <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($produks, 'NamaProduk') }}" title="{{ data_get($produks, 'NamaProduk') }}"
                                                                         style="height: 50% !important; width: 50% !important">
                                                                @endif

                                                            </figure>
                                                        </div>
                                                        <div class="card-block-info capitalall" style="min-height: 210px !important">

                                                            <div class="avatar-sidebar">
                                                                <div class="sidebar-info">
                                                                    <span class="sidebar-company">
                                                                        <h5>
                                                                            <span style="font-weight: bolder">
                                                                                @if( data_get($produks, 'NamaProduk') )
                                                                                    {{ data_get($produks, 'NamaProduk') }}
                                                                                @else
                                                                                    NAMA PRODUK
                                                                                @endif
                                                                            </span>
                                                                        </h5>
                                                                    </span>
                                                                </div>
                                                                <div class="sidebar-list-job" style="padding-top: 15px">
                                                                    <span class="card-job-top--post-time text-md" style="font-size: 14px !important">
                                                                        &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;
                                                                            @if( data_get($produks, 'pengeluar.NamaSyarikat') )
                                                                                {{ data_get($produks, 'pengeluar.NamaSyarikat') }}
                                                                            @else
                                                                                {{ data_get($produks, 'pengeluar.NamaWakil') }}
                                                                            @endif
                                                                    </span><br>
                                                                </div>
                                                                <div class="sidebar-list-job" style="padding-top: 15px">
                                                                    <span class="card-job-top--post-time text-md" style="font-size: 14px !important">
                                                                        &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;
                                                                            @if( data_get($produks, 'Keterangan') )
                                                                                {{ data_get($produks, 'Keterangan') }}
                                                                            @else
                                                                                Keterangan
                                                                            @endif
                                                                    </span><br>
                                                                </div>
                                                                <div class="sidebar-list-job" style="padding-top: 15px">
                                                                    <span class="card-job-top--post-time text-md" style="font-size: 14px !important">
                                                                        &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;
                                                                            @if( data_get($produks, 'jenisproduk.description') )
                                                                                {{ data_get($produks, 'jenisproduk.description') }}
                                                                            @else
                                                                                Jenis Produk
                                                                            @endif
                                                                    </span><br>
                                                                </div>
                                                                <div class="sidebar-list-job" style="padding-top: 15px">
                                                                    <span class="card-job-top--post-time text-md" style="font-size: 14px !important">
                                                                        &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;
                                                                            @if( data_get($produks, 'pengeluar.mediasosial.description') )
                                                                                {{ data_get($produks, 'pengeluar.mediasosial.description') }}
                                                                            @else
                                                                                Media Sosial
                                                                            @endif
                                                                    </span><br>
                                                                </div>
                                                                <div class="sidebar-list-job" style="padding-top: 15px">
                                                                    <span class="card-job-top--post-time text-md" style="font-size: 14px !important">
                                                                        &nbsp;&nbsp;<i class="fi fi-rr-play"></i>&nbsp;&nbsp;

                                                                        @if( data_get($produks, 'pengeluar.LinkMediaSosial') )
                                                                            <a href="http://{{ data_get($produks, 'pengeluar.LinkMediaSosial') }}" style="font-weight: bolder;" target="_blank">
                                                                                {{ data_get($produks, 'pengeluar.LinkMediaSosial') }}
                                                                            </a>
                                                                        @else
                                                                            Link Media Sosial
                                                                        @endif

                                                                    </span><br>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach

                                        </div>

                                        <div class="row mtb-30" id="ajaxloadingpapar-produk" style="display: none;">
                                            <center>
                                                <img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
                                            </center>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="paginations">
                                {!! $paginated !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="section-box mt-40">
        </section>
    <!-- aktiviti end -->

<!-- end ---------------------------------------------------------------------------------------------------------- -->
@endsection

@push('script')
<script type="text/javascript">

    // --------- function
    function produkkatid(data)
    {
        var idtype = $(data).data('idtype');
        var daer = "{{ $request->daerah }}";
        var muki = "{{ $request->mukim }}";
        var kamp = "{{ $request->kampung }}";

        $('#papar-produk').html('');
        $('#papar-produk').hide();
        $('#ajaxloadingpapar-produk').show();

        window.location.href = "/product/"+idtype+"/searchresult?daerah="+daer+"&mukim="+muki+"&kampung="+kamp+"&page=1";
    }

    // onselect oncahnge daerah
    $('#seldaerah').change(function()
    {
        var val_daerah   = document.getElementById("iddaerah").value;
        var val_mukim    = document.getElementById("idmukim").value;
        var val_kampung  = document.getElementById("idkampung").value;

        $.ajax({
            type: "GET", 
            url: "{{ URL::to('/info/ajax/mukim/')}}"+"/"+val_daerah,
            datatype : 'json',

            beforeSend: function ()
            {
                $('#selmukim').html('');
                $('#loadingpapar').show();
                $('#searchpapar').hide();
            },
            success: function(data)
            {
                $('#selmukim').html(data);
            },
            complete: function(data)
            {
                $('#searchpapar').show();
                $('#loadingpapar').hide();
            }
        });

        cariankampung(val_daerah, val_mukim, val_kampung);

    });

    $('#selmukim').change(function()
    {
        var val_daerah   = document.getElementById("iddaerah").value;
        var val_mukim    = document.getElementById("idmukim").value;
        var val_kampung  = document.getElementById("idkampung").value;

        cariankampung(val_daerah, val_mukim, val_kampung);

    });

    function cariankampung(f_daerah, f_mukim, f_kampung)
    {
        var f_parlimen = 0;
        var f_dun = 0;
        var f_cat = 0;

        $.ajax({
            type: "GET", 
            url: "{{ URL::to('/info/ajax/kampung/')}}"+"/"+f_parlimen+"/"+f_dun+"/"+f_daerah+"/"+f_mukim+"/"+f_cat+"/"+f_kampung,
            datatype : 'json',

            beforeSend: function ()
            {
                $('#selkampung').html('');
                $('#loadingpapar').show();
                $('#searchpapar').hide();
                $('#listproduct').hide();
                $('#paginate').hide();
            },
            success: function(data)
            {
                $('#selkampung').html(data);
            },
            complete: function(data)
            {
                $('#searchpapar').show();
                $('#loadingpapar').hide();
            }
        });
    }

</script>
@endpush