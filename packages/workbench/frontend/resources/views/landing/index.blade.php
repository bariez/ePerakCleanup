@extends('laravolt::eperak.layouts.base')

@section('content')
<div class="time-date-center-wrapper">
    <div class="time-date-integrated">
        <div class="info-badge-small" id="date-badge">
            <i class="icon-small">🗓️</i>
            <span id="current-date-small"></span>
        </div>
        <div class="info-badge-small" id="time-badge">
            <i class="icon-small">⏰</i>
            <span id="current-time-small"></span>
        </div>
    </div>
</div>


    @push('style')
    {{-- MULA: Tambah Google Font 'Poppins' --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- TAMAT: Tambah Google Font 'Poppins' --}}
    <style type="text/css">
        /* Styling untuk popup */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            max-width: 400px;
            width: 80%;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            cursor: pointer;
        }
        button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }

        /* MULA: Override Font Family untuk 'Poppins' */
        html, body {
            font-family: 'Poppins', sans-serif !important;
        }
        /* TAMAT: Override Font Family */
    </style>
@endpush

    @push('script')
    <script type="text/javascript">
        // JavaScript untuk menutup popup
        document.addEventListener('DOMContentLoaded', function () {
            var popup = document.getElementById('infoPopup');
            popup.style.display = 'flex'; // Popup akan muncul apabila halaman dibuka

            var closePopupBtn = document.getElementById('closePopupBtn');
            var closePopupX = document.getElementById('closePopup');

            closePopupBtn.addEventListener('click', function () {
                popup.style.display = 'none';
            });

            closePopupX.addEventListener('click', function () {
                popup.style.display = 'none';
            });
        });
    </script>
@endpush


@push('style')
<style type="text/css">
/* KOD CSS UNTUK MASA/TARIKH BERPUSAT PADA HEADER */
.time-date-center-wrapper {
    position: absolute; 
    top: 5px; 
    width: 100%;
    text-align: center;
    z-index: 10000;
}

/* KOD PENTING BARU: Ini cuba sasarkan tajuk besar PORTAL RASMI E-PERAK dalam base layout */
/* Sila tukar 'header .h1' jika tidak berfungsi (cuba .logo-text atau .main-header-title) */
.header .h1, 
.header .logo a strong { 
    font-size: 1.2em !important; /* Contoh pengecilan font */
    padding: 3px 10px; /* Padding untuk background */
    border-radius: 15px;
    color: white !important;
    background: linear-gradient(
        to right, 
        #0056b3 0%, #007bff 50%, #0056b3 100%
    );
}

.time-date-integrated {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}


.info-badge-small {
    padding: 3px 8px;
    border-radius: 15px;
    background: linear-gradient(
        to right, 
        #000000 0%, #FFFFFF 50%, #FFD700 100%
    );
    background-size: 300% 100%;
    animation: gradient-move 8s linear infinite;
    color: black; 
    font-weight: bold;
    font-size: 12px; 
    display: flex;
    align-items: center;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
    margin: 0 5px;
    cursor: default;
}
@keyframes gradient-move {
    0% { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
}
.icon-small {
    margin-right: 4px;
    font-size: 1em;
}

/* KOD PENTING BARU/DIUBAH UNTUK SELARAS KETINGGIAN PAUTAN LUAR */

/* 1. Paksa setiap kad (swiper-slide) menjadi flex container untuk menyelaraskan kandungan di dalamnya */
.swiper-slide.autosizinghyperlink {
    display: flex;
}

/* 2. Pastikan card itu sendiri mengambil ruang yang tersedia */
.card-grid-2.hover-up.h-100 {
    display: flex;
    flex-direction: column; /* Susun kandungan (gambar dan teks) secara menegak */
    height: 100%; /* Pastikan card mengisi ketinggian swiper-slide */
}

/* 3. Gunakan flexbox pada card-block-info untuk menolak butang ke bawah (jika perlu) */
.card-block-info {
    display: flex;
    flex-direction: column;
    justify-content: flex-end; /* Paksa kandungan (terutamanya butang) ke bahagian bawah */
    align-items: center; /* Pastikan kandungan di tengah horizontal */
    flex-grow: 1; /* Biarkan ia mengambil semua ruang vertikal yang tersisa */
    min-height: 50px; /* Nilai asas minimum ketinggian ruang teks */
}

/* 4. Pastikan butang pautan (anchor tag) mempunyai ketinggian yang konsisten */
.portal-link-style {
    display: inline-block;
    padding: 6px 10px; /* Menambah padding untuk ketinggian yang jelas */
    border-radius: 8px; 
    font-size: 12px !important; 
    font-weight: bolder;
    color: white !important; 
    text-decoration: none; 
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
    background: linear-gradient(
        to right, 
        #007BFF 0%, 
        #00A3FF 100% 
    );
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    align-self: center; 
    width: 90%; 
    text-align: center;
    margin-bottom: 5px; /* Tambah margin bawah sedikit */
}

/* KOD LAMA ASAL */
    .autosizing
    {
        height: auto;
    }
    .autosizingnotis
    {
        height: auto;
    }
    .autosizingaktiviti
    {
        height: auto;
    }
    .autosizinghyperlink
    {
        height: auto;
    }
    .autosizinghyperlinktwo
    {
        height: auto;
    }
    #goto
    {
        position: absolute;
        bottom: 2%;
        right: 2%;
    }
    .capitalall
    {
        text-transform: uppercase;
    }

    #viewDiv {
      padding: 0;
      margin: 0;
      height: 100%;
      width: 100%;
    }
</style>
@endpush

    @if($popupShown)
    <div id="infoPopup" class="popup-overlay">
        <div class="popup-content">
            <span class="close-btn" id="closePopup">&times;</span>
            <h4>Panduan Pengguna</h4>
            <p>Sila klik Info Petempatan untuk mendapatkan maklumat kampung Negeri Perak</p>
                            <button id="closePopupBtn">Tutup</button>
        </div>
    </div>
    @endif

        <section class="section-box" style="padding-top: 0px">
            <div class="row">
                <div class="col-md-12" style="padding-left: 0px; padding-right: 0px; ">
                    <center>
                        <div class="box-swiper" style="width: 100%">
                            <div class="swiper-container swiper-group-1">
                                <div class="swiper-wrapper">
                                    @foreach($banner as $key => $banners)
                                        <div class="swiper-slide">

                                            @if( $banners->path )
                                                @if( file_exists( public_path( data_get($banners, 'path') ) ) )
                                                    <a target="_blank" href="{!! URL::to(data_get($banners, 'path')) !!}">
                                                        <img src="{!! URL::to(data_get($banners, 'path')) !!}" alt="{{ data_get($banners, 'filename') }}" width="100%" height="100%" title="{{ data_get($banners, 'tajuk') }}">
                                                    </a>
                                                @else
                                                    <center style="background-color: white;">
                                                        <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($banners, 'filename') }}" style="max-height: 250px" title="{{ data_get($banners, 'tajuk') }}">
                                                    </center>
                                                @endif
                                            @else
                                                <center style="background-color: white;">
                                                    <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($banners, 'filename') }}" style="max-height: 250px" title="{{ data_get($banners, 'tajuk') }}">
                                                </center>
                                            @endif

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="swiper-button-next" id="next-banner" style="margin-right: 68px; margin-top: -25px;"></div>
                            <div class="swiper-button-prev" id="prev-banner" style="margin-left: 68px; margin-top: -25px;"></div>
                        </div>
                    </center>
                </div>
            </div>
        </section>
    <section class="section-box">
            <div class="container autosizing" style="">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-12 col-12" style="">
                        <div class="container" style="padding-right: 0px; padding-left: 0px">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 m-auto">
                                    <section class="">
                                        <div class="row">
                                            <div class="col-xl-12 col-md-12 mx-auto">
                                                <div class="contact-from-area padding-20-row-col">
                                                    <h4 class="section-title mt-15 mb-5 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s"
                                                            style="color: white; text-shadow: 2px 2px #000000;">
                                                    </h4>
                                                    </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                        <div class="container h-100" style="padding-right: 0px; padding-left: 0px">
                            <div class="autosizingnotis">
                                <div class="mt-10">
                                    <div class="fade show active">
                                        <div class="row">

                                            <div id="searchpapar" style="">

                                            </div>

                                            <div class="row" id="loadingpapar" style="display: none; margin-left: 0px;margin-right: 0px;">
                                                <center>
                                                    <img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
                                                </center>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($notis->count() != 0)
                        <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                            <div class="container" style="padding-right: 0px; padding-left: 0px">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 m-auto">
                                        <section class="">
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12 mx-auto">
                                                    <div class="contact-from-area padding-20-row-col">
                                                        <h4 class="section-title mt-15 mb-5 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".1s"
                                                               style="color: white; text-shadow: 2px 2px #000000;">
                                                               <div class="hover-up">
                                                                   <a href="news?page=1" style="color: white" class="" title="Senarai Berita e-Perak">BERITA</a>
                                                               </div>
                                                         </h4>
                                                     </div>

                                                         </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>


                            <div class="container h-100" style="padding-right: 0px; padding-left: 10px">
                                <div class="autosizingnotis">
                                    <div class="mt-10">
                                        <div class="fade show active">
                                            <div class="row">

                                                <div class="box-swiper">
                                                    <div class="swiper-container swiper-group-notis">
                                                        <div class="swiper-wrapper">

                                                            @foreach($notis as $key => $notiss)
                                                                
                                                                <div class="swiper-slide">
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 wow animate__animated animate__fadeInUp hover-up" 
                                                                        data-wow-delay=".5s" 
                                                                        onclick="location.href = '/news/{{ data_get($notiss, 'id') }}';"
                                                                        style="cursor: pointer">
                                                <div class="card-grid-2 h-100" style="border-top-width: 0px; border-left-width: 0px; border-right-width: 0px; border-bottom-width: 10px;">
                                                                    <div class="text-center card-grid-2-image">
                                                                    <a href="javascript:;">
                                                                                                        <figure>

                                                                                                        
                                                                                                            @if( data_get($notiss, 'path') )
                                                                                                                @if( file_exists( public_path( data_get($notiss, 'path') ) ) )
                                                                                                                    <img src="{!! URL::to(data_get($notiss, 'path')) !!}" alt="{{ data_get($notiss, 'filename') }}" title="{{ data_get($notiss, 'tajuk') }}"
                                                                                                                        style="height: 200px !important">
                                                                                                                @else
                                                                                                                    <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($notiss, 'filename') }}" title="{{ data_get($notiss, 'tajuk') }}"
                                                                                                                        style="height: 50% !important; width: 50% !important">
                                                                                                                @endif
                                                                                                            @else
                                                                                                                <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($notiss, 'filename') }}" title="{{ data_get($notiss, 'tajuk') }}"
                                                                                                                        style="height: 50% !important; width: 50% !important">
                                                                                                            @endif

                                                                                                        </figure>
                                                                                                    </a>
                                                                                                    </div>
                                                                        <div class="card-block-info" style="padding-top: 5px; padding-bottom: 5px"><h6 class="">
                                                                        <a href="javascript:;">
                                                                            {{ data_get($notiss, 'tajuk') }}
                                                                                                        </a>
                                                                                                        </h6>
                                                                                                        <div class="row">
                                                                    <a href="javascript:;" class="">
                                                                                                            <span>
                                                                                                            {{ data_get($notiss, 'ringkasan') }}
                                                                                                            </span>
                                                                                                        </a>
                                                                                                        </div>
                                                                        <div class="card-2-bottom mt-30 mb-30">
                                                                            <div class="row ml-0">
                                                                                <span class="card-calender">{{ data_get($notiss, 'tarikh_notis') }}</span>
                                                                                </div>
                                                                        </div>
                                                                        </div>
                                                                                            </div>
                                                                                    </div>
                                                                            </div>

                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="swiper-button-next" id="next-notis"></div>
                                                    <div class="swiper-button-prev" id="prev-notis"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        @else
                        @endif
                    </div>
            </div>
        </section>
    <section class="section-box"> 
            <div class="container">
                <div class="autosizing">
                    <div class="row">

                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-5 wow animate__animated animate__fadeInUp pb-70" data-wow-delay=".5s">
                                <div class="container" style="padding-right: 0px; padding-left: 0px">
                                    <div class="row">
                                        <div class="col-xl-10 col-lg-12 m-auto">
                                            <section class="">
                                                <div class="row">
                                                    <div class="col-xl-12 col-md-12 mx-auto">
                                                        <div class="contact-from-area padding-20-row-col">
                                                            <h4 class="section-title mt-15 mb-5 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s"
                                                                    style="color: white; text-shadow: 2px 2px #000000;">
                                                                   <div class="hover-up">
                                                                       <a class="" href="activity?page=1" style="color: white" title="Senarai Aktiviti e-Perak">AKTIVITI</a>
                                                                   </div>
                                                             </h4>
                                                             </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                                <div class="sidebar-shadow shadow-lg mt-10 wow animate__animated animate__fadeInUp" data-wow-delay=".5s" style="padding-top: 0px !important; padding-bottom: 0px !important"> <div class="sidebar-heading">
                                             <div class="avatar-sidebar">
                                                     </div>
                                                 </div>

                                                 <div class="sidebar-list-job" style="border-top: 0px; padding-top: 0px; margin-top: 0px"> <ul>
                                                            @foreach($aktiviti->take(3) as $key => $aktivitis)
                                                                <li>
                                                                    <div class="sidebar-text-info">

                                                                        <div class="row hover-up" onclick="location.href = '/eperak/activity/{{ data_get($aktivitis, 'id') }}';" style="cursor: pointer">
                                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">

                                                                                @if( data_get($aktivitis, 'Gambar_path') )
                                                                                    @if( file_exists( public_path( data_get($aktivitis, 'Gambar_path') ) ) )
                                                                                        <a href="javascript:;">
                                                                                            <img src="{!! URL::to(data_get($aktivitis, 'Gambar_path')) !!}"
                                                                                                alt="{{ data_get($aktivitis, 'NamaAktiviti') }}"
                                                                                                title="{{ data_get($aktivitis, 'NamaAktiviti') }}" 
                                                                                                style="width: 160px; height: 115px; object-fit: cover;">
                                                                                        </a>
                                                                                    @else
                                                                                        <a href="javascript:;">
                                                                                            <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" title="{{ data_get($aktivitis, 'NamaAktiviti') }}" style="width: 100px">
                                                                                        </a>
                                                                                    @endif
                                                                                @else
                                                                                    <a href="javascript:;">
                                                                                        <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="{{ data_get($aktivitis, 'NamaAktiviti') }}" title="{{ data_get($aktivitis, 'NamaAktiviti') }}" style="width: 100px">
                                                                                    </a>
                                                                                @endif

                                                                            </div>

                                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-8">
                                                                                <strong class="small-heading pt-0 mb-10">
                                                                                    <a href="javascript:;">
                                                                                        {{ data_get($aktivitis, 'NamaAktiviti') }}
                                                                                    </a>
                                                                                </strong>
                                                                                <span class="text-description"><i class="fi fi-rr-paper-plane"></i>
                                                                                    <span class="ml-5">{{ data_get($aktivitis, 'kategori.description') }}</span>
                                                                                </span>
                                                                                <span class="text-description"><i class="fi fi-rr-marker"></i>
                                                                                    <span class="ml-5">{{ data_get($aktivitis, 'kampung.NamaKampung') }}</span>
                                                                                </span>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                 </div>
                                </div>
                            </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-12 mt-5 wow animate__animated animate__fadeInUp pb-70" data-wow-delay=".5s">
                            <div class="container" style="padding-right: 0px; padding-left: 0px">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 m-auto">
                                        <section class="">
                                            <div class="row">
                                                <div class="col-xl-12 col-md-12 mx-auto">
                                                    <div class="contact-from-area padding-20-row-col">
                                                        <h4 class="section-title mt-15 mb-5 text-center wow animate__animated animate__fadeInUp" data-wow-delay=".2s"
                                                               style="color: white; text-shadow: 2px 2px #000000;">
                                                               <span style="color: white">PRODUK TEMPATAN</span>
                                                         </h4>
                                                         </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-10 wow animate__animated animate__fadeInUp" data-wow-delay=".5s" style="padding-top: 0px !important; padding-bottom: 0px !important"> <div class="sidebar-heading">
                                                 <div class="avatar-sidebar">
                                                     </div>
                                             </div>

                                             <div class="section-box wow animate__animated animate__fadeIn wow animate__animated animate__fadeInUp" data-wow-delay=".7s"> <div class="container">
                                                     <center>
                                                         <div class="box-swiper" style="width: 100%">
                                                             <div class="swiper-container swiper-group-2">
                                                                 <div class="swiper-wrapper"> @foreach($lkpproduk->take(2) as $key => $lkpproduks)

                                                                     <div class="swiper-slide">
                                                                         <div class="card-grid-3 hover-up" style="border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
                                                                             <div class="text-center card-grid-3-image">
                                                                                 <a href="/eperak/product/{{ $lkpproduks->id }}?page=1">
                                                                                     <figure style="padding: 25px">

                                                                                         @forelse($lkpproduks->product_icon->where('status', 1)->take(1) as $key => $icons)
                                                                                             <img src="{!! URL::to(data_get($icons, 'path')) !!}"
                                                                                                     alt="{{ data_get($icons, 'filename') }}" 
                                                                                                     style="width: 40%">
                                                                                         @empty
                                                                                             <img src="{{ asset('theme/assets/imgs/theme/perak/deafulticon.png') }}"
                                                                                                     alt="{{ data_get($aktivitis, 'NamaAktiviti') }}"
                                                                                                     style="width: 40%">
                                                                                         @endforelse

                                                                                     </figure>
                                                                                 </a>
                                                                             </div>
                                                                             <div class="card-block-info">
                                                                                 <h5 class="heading-md">
                                                                                     <a href="/eperak/product/{{ $lkpproduks->id }}?page=1" style="font-weight: bolder">
                                                                                         {{ data_get($lkpproduks, 'description') }}
                                                                                     </a>
                                                                                 </h5>
                                                                                 </div>
                                                                         </div>
                                                                     </div>

                                                                 @endforeach

                                                                 </div>
                                                             </div>

                                                             <div class="swiper-container swiper-group-2">
                                                                 <div class="swiper-wrapper mt-15"> @foreach($lkpproduk->skip(2) as $key => $lkpproduks)

                                                                     <div class="swiper-slide">
                                                                         <div class="card-grid-3 hover-up" style="border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
                                                                             <div class="text-center card-grid-3-image">
                                                                                 <a href="/eperak/product/{{ $lkpproduks->id }}?page=1">
                                                                                     <figure style="padding: 25px">

                                                                                         @forelse($lkpproduks->product_icon->where('status', 1)->take(1) as $key => $icons)
                                                                                             <img src="{!! URL::to(data_get($icons, 'path')) !!}"
                                                                                                     alt="{{ data_get($icons, 'filename') }}" 
                                                                                                     style="width: 40%">
                                                                                         @empty
                                                                                             <img src="{{ asset('theme/assets/imgs/theme/perak/deafulticon.png') }}"
                                                                                                     alt="{{ data_get($aktivitis, 'NamaAktiviti') }}"
                                                                                                     style="width: 40%">
                                                                                         @endforelse

                                                                                     </figure>
                                                                                 </a>
                                                                             </div>
                                                                             <div class="card-block-info">
                                                                                 <h5 class="heading-md">
                                                                                     <a href="/eperak/product/{{ $lkpproduks->id }}?page=1" style="font-weight: bolder">
                                                                                         {{ data_get($lkpproduks, 'description') }}
                                                                                     </a>
                                                                                 </h5>
                                                                                 </div>
                                                                         </div>
                                                                     </div>

                                                                 @endforeach

                                                                 </div>
                                                             </div>
                                                             <div class="swiper-button-next" id="next-produk" style="margin-top: -20px"></div>
                                                             <div class="swiper-button-prev" id="prev-produk" style="margin-top: -20px"></div>
                                                         </div>
                                                     </center>
                                                 </div>
                                             </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </section>
    <section class="section-box" style="margin-bottom: -60px">
            <div class="row">

                <div class="">

                        <div class="section-box wow animate__animated animate__fadeIn mt-10">
                            <center>
                                        <div class="box-swiper" style="width: 95%">
                                            <div class="swiper-container swiper-group-5">
                                                <div class="swiper-wrapper pb-70 pt-5">

                                                    <div class="swiper-slide autosizinghyperlink" onclick="show1()" style="cursor: pointer">
                                                        <div class="card-grid-2 hover-up h-100"
                                                             style="margin-bottom: 0px; padding: 5px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
                                                             <div class="text-center card-grid-2-image">
                                                                 <a href="javascript:;">
                                                                     <figure class="">
                                                                         <img alt="" src="{{ asset('theme/assets/imgs/theme/perak/logo-malaysia.jpg') }}" style="width: 50%" title="Portal Kerajaan Malaysia"/>
                                                                     </figure>
                                                                 </a>
                                                             </div>
                                                             <div class="card-block-info" style="padding: 0px !important">
                                                                 <h6 class="mt-5 heading-md">
                                                                     <a href="javascript:;" class="portal-link-style">
                                                                         Portal Kerajaan Malaysia
                                                                     </a>
                                                                 </h6>
                                                             </div>
                                                        </div>
                                                    </div>

                                                    <div class="swiper-slide autosizinghyperlink" onclick="show2()" style="cursor: pointer">
                                                        <div class="card-grid-2 hover-up h-100"
                                                             style="margin-bottom: 0px; padding: 5px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
                                                             <div class="text-center card-grid-2-image">
                                                                 <a href="javascript:;">
                                                                     <figure class="">
                                                                         <img alt="jobhub" src="{{ asset('theme/assets/imgs/theme/perak/logo-mampu.jpg') }}" style="width: 50%" title="MAMPU"/>
                                                                     </figure>
                                                                 </a>
                                                             </div>
                                                             <div class="card-block-info" style="padding: 0px !important">
                                                                 <h6 class="mt-5 heading-md">
                                                                     <a href="javascript:;" class="portal-link-style">
                                                                         MAMPU
                                                                     </a>
                                                                 </h6>
                                                             </div>
                                                        </div>
                                                    </div>

                                                    <div class="swiper-slide autosizinghyperlink" onclick="show3()" style="cursor: pointer">
                                                        <div class="card-grid-2 hover-up h-100"
                                                             style="margin-bottom: 0px; padding: 5px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
                                                             <div class="text-center card-grid-2-image">
                                                                 <a href="javascript:;">
                                                                     <figure class="">
                                                                         <img alt="jobhub" src="{{ asset('theme/assets/imgs/theme/perak/logo-mdec.jpg') }}" style="width: 50%" title="Malaysia Digital Economy Corporation"/>
                                                                     </figure>
                                                                 </a>
                                                             </div>
                                                             <div class="card-block-info" style="padding: 0px !important">
                                                                 <h6 class="mt-5 heading-md">
                                                                     <a href="javascript:;" class="portal-link-style">
                                                                         Malaysia Digital Economy Corporation
                                                                     </a>
                                                                 </h6>
                                                             </div>
                                                        </div>
                                                    </div>

                                                    <div class="swiper-slide autosizinghyperlink" onclick="show4()" style="cursor: pointer">
                                                        <div class="card-grid-2 hover-up h-100"
                                                             style="margin-bottom: 0px; padding: 5px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
                                                             <div class="text-center card-grid-2-image">
                                                                 <a href="javascript:;">
                                                                     <figure class="">
                                                                         <img alt="jobhub" src="{{ asset('theme/assets/imgs/theme/perak/favicon-perak.png') }}" style="width: 12%" title="Portal Rasmi Perak"/>
                                                                     </figure>
                                                                 </a>
                                                             </div>
                                                             <div class="card-block-info" style="padding: 0px !important">
                                                                 <h6 class="mt-5 heading-md">
                                                                     <a href="javascript:;" class="portal-link-style"> 
                                                                         Portal Rasmi Perak
                                                                     </a>
                                                                 </h6>
                                                             </div>
                                                        </div>
                                                    </div>

                                                    <div class="swiper-slide autosizinghyperlink" onclick="show5()" style="cursor: pointer">
                                                        <div class="card-grid-2 hover-up h-100"
                                                             style="margin-bottom: 0px; padding: 5px; border-top-width: 1px; border-left-width: 1px; border-right-width: 1px; border-bottom-width: 10px;">
                                                             <div class="text-center card-grid-2-image">
                                                                 <a href="javascript:;">
                                                                     <figure class="">
                                                                         <img alt="jobhub" src="{{ asset('theme/assets/imgs/theme/perak/favicon-perak.png') }}" style="width: 12%" title="Portal Rasmi PerakGIS"/>
                                                                     </figure>
                                                                 </a>
                                                             </div>
                                                             <div class="card-block-info" style="padding: 0px !important">
                                                                 <h6 class="mt-5 heading-md">
                                                                     <a href="javascript:;" class="portal-link-style">
                                                                         Portal Rasmi PerakGIS
                                                                     </a>
                                                                 </h6>
                                                             </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="swiper-button-next" id="next-pautan"></div>
                                            <div class="swiper-button-prev" id="prev-pautan"></div>
                                        </div>
                                    </center>
                                </div>

                </div>
            </div>
        </section>
    @endsection


@push('script')

<script>
    function updateDateTimeSmall() {
        const now = new Date();
        
        // Tetapkan timezone ke Kuala Lumpur (GMT+8)
        const optionsDate = { 
            weekday: 'long', 
            day: 'numeric', 
            month: 'long', 
            year: 'numeric', 
            timeZone: 'Asia/Kuala_Lumpur' 
        };
        const optionsTime = { 
            hour: 'numeric', 
            minute: 'numeric', 
            second: 'numeric', 
            hour12: true, 
            timeZone: 'Asia/Kuala_Lumpur' 
        };
        
        // Format mengikut locale Malaysia (ms-MY)
        const dateFormatter = new Intl.DateTimeFormat('ms-MY', optionsDate);
        const timeFormatter = new Intl.DateTimeFormat('en-US', optionsTime); 
        
        let formattedDate = dateFormatter.format(now);
        formattedDate = formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1);

        let formattedTime = timeFormatter.format(now);
        formattedTime = formattedTime.replace('PM', 'PTG').replace('AM', 'PG'); 

        const dateElement = document.getElementById('current-date-small');
        const timeElement = document.getElementById('current-time-small');

        if (dateElement) {
            dateElement.textContent = formattedDate;
        }
        if (timeElement) {
            timeElement.textContent = formattedTime + ' MYT';
        }
    }

    // Panggil fungsi sekali untuk paparan segera
    updateDateTimeSmall();
    
    // Panggil fungsi setiap 1 saat
    setInterval(updateDateTimeSmall, 1000);
</script>
<script type="text/javascript">

document.addEventListener('DOMContentLoaded', function () {
    var popup = document.getElementById('infoPopup');
    console.log("Popup shown: " + localStorage.getItem('popupShown'));

    // Memastikan popup hanya muncul sekali
    if (!localStorage.getItem('popupShown')) {
        console.log("Popup is showing!");
        popup.style.display = 'flex';  
        localStorage.setItem('popupShown', 'true'); 
    }

    var closePopupBtn = document.getElementById('closePopupBtn');
    var closePopupX = document.getElementById('closePopup');

    closePopupBtn.addEventListener('click', function () {
        popup.style.display = 'none';
    });

    closePopupX.addEventListener('click', function () {
        popup.style.display = 'none';
    });
});

    $(document).ready(function ()
    {
        $.ajax({
            type: "GET",
            url: "{{ URL::to('/ajax/mapinfo')}}",
            datatype : 'json',

            beforeSend: function ()
            {
                $('#searchpapar').hide();
                $('#loadingpapar').show();
            },
            success: function(data)
            {
                $('#loadingpapar').hide();
                $('#searchpapar').html(data);
                $('#searchpapar').show();
            }
        });
    });

    function show1()
    {
        window.open(
            'https://www.malaysia.gov.my/portal/index',
            '_blank' // <- This is what makes it open in a new window.
            );
    }
    function show2()
    {
        window.open(
            'https://www.mampu.gov.my/',
            '_blank' // <- This is what makes it open in a new window.
            );
    }
    function show3()
    {
        window.open(
            'https://mdec.my/',
            '_blank' // <- This is what makes it open in a new window.
            );
    }
    function show4()
    {
        window.open(
            'https://www.perak.gov.my/',
            '_blank' // <- This is what makes it open in a new window.
            );
    }
    function show5()
    {
        window.open(
            'https://www.perakgis.my/',
            '_blank' // <- This is what makes it open in a new window.
            );
    }

</script>
@endpush