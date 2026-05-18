@extends('laravolt::eperak.layouts.base')

@section('content')


    @push('style')
    {{-- MULA: Tambah Google Font 'Poppins' --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- TAMAT: Tambah Google Font 'Poppins' --}}
    <style type="text/css">
        /* Styling untuk popup sedia ada */
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

        /* --- KOD BARU: CSS PANEL MAKLUM BALAS BELAH KIRI --- */
        #feedback-float {
            position: fixed;
            bottom: 25px;
            left: 25px;
            /* Sizing disamakan dengan chatbot anda (contoh: 120px) */
            width: 120px; 
            height: 140px;
            cursor: pointer;
            z-index: 10001;
            transition: transform 0.3s ease-in-out;
            
            /* MENGHILANGKAN LATAR BELAKANG & BORDER */
            background-color: transparent; 
            border: none;
            overflow: visible; /* Tukar ke visible supaya drop-shadow nampak */
            
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #feedback-float:hover { 
            transform: scale(1.1); 
            /* Menggunakan drop-shadow supaya bayang ikut bentuk logo lutsinar */
            filter: drop-shadow(0 8px 15px rgba(0,0,0,0.3));
        }

        /* Tetapan imej di dalam butang */
        #feedback-float img { 
            width: 100%; 
            height: 100%; 
            object-fit: contain; /* Guna contain supaya logo tidak terpotong */
            display: block;
        }

        /* Bahagian Panel Kekal Sama */
        #feedback-panel {
            display: none;
            position: fixed;
            bottom: 30px;
            left: 30px;
            width: 420px;
            background: rgba(255,255,255,0.98);
            border-radius: 10px;
            z-index: 10002;
            box-shadow: 0 10px 30px rgba(0,0,0,.4);
            flex-direction: column;
            font-family: 'Poppins', sans-serif;
        }

        .fb-header { 
            background: #198754; 
            color: white; 
            padding: 15px; 
            font-weight: 600; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            border-top-left-radius: 10px; 
            border-top-right-radius: 10px; 
        }

        .fb-body { padding: 20px; }
        #feedback-close { cursor: pointer; font-size: 20px; }
        /* Mengikuti gaya modern portal rujukan */
    .hero-section {
        padding: 40px 0;
        background: #fdfdfd;
    }
    .custom-card {
        border-radius: 15px !important;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05) !important;
        border: none !important;
        transition: all 0.3s ease;
        text-align: center;
        padding: 20px;
    }
    .custom-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }
    .icon-wrapper {
        background: #f0f4ff;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin: 0 auto 15px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .icon-wrapper i {
        font-size: 2.5rem !important;
        color: #1a3352;
    }
    .section-title {
        color: #1a3352 !important;
        font-weight: 800 !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 30px !important;
    }
    .news-card {
        border-radius: 10px !important;
        overflow: hidden;
    }
    .news-card img {
        height: 200px;
        object-fit: cover;
    }

    /* --- CSS BARU UNTUK GRID CARD AKTIVITI & PRODUK --- */
    .activity-custom-wrapper {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-top: 20px;
        width: 100%;
    }
    
    .activity-custom-item {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding-bottom: 15px;
        overflow: hidden;
        border: 1px solid #eee;
        transition: 0.3s;
    }

    .activity-custom-item:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }

    .activity-custom-image-box {
        width: 100%;
        height: 220px;
        overflow: hidden;
    }

    .activity-custom-image-box img { width: 100%; height: 100%; object-fit: cover; }

    .activity-custom-title-text {
        font-size: 14px;
        font-weight: 700;
        color: #3b00b9; 
        line-height: 1.3;
        padding: 10px 10px 5px;
        display: block;
        text-decoration: none;
        text-transform: uppercase;
    }
    
    .activity-custom-date-text { font-size: 11px; color: #888; text-transform: uppercase; }

    /* PRODUK TEMPATAN KAD PUTIH IMPROVEMENT */
    .produk-card-putih {
        background: #fff;
        border-radius: 15px;
        padding: 20px;
        border: 1px solid #eee;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: 0.3s;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .produk-card-putih:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }

    .produk-icon-fix {
        width: 80px;
        height: 80px;
        background: #f9f9f9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        padding: 15px;
    }
    .produk-icon-fix img { max-width: 100%; max-height: 100%; object-fit: contain; }

    /* --- NAIKKAN COLOUR BUTANG LIHAT SEMUA --- */
    .btn-lihat-semua-custom {
        background: #003366 !important; /* Biru Gelap e-Perak */
        color: #fecb3a !important;   /* Kuning e-Perak */
        font-weight: 800 !important;
        border: 2px solid #fecb3a !important;
        padding: 12px 35px !important;
        border-radius: 30px !important;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(0,51,102,0.3);
    }
    .btn-lihat-semua-custom:hover {
        background: #fecb3a !important;
        color: #003366 !important;
        transform: scale(1.05);
    }

        .ai-options-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .ai-option-btn {
            background-color: #ffffff;
            border: 1.5px solid #007bff;
            color: #007bff;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .ai-option-btn:hover {
            background-color: #007bff;
            color: white;
            transform: translateY(-2px);
        }

    @media (max-width: 768px) { .activity-custom-wrapper { grid-template-columns: 1fr; } }
    </style>
@endpush

    @push('script')
    <script type="text/javascript">
        // JavaScript untuk menutup popup sedia ada
        document.addEventListener('DOMContentLoaded', function () {
            var popup = document.getElementById('infoPopup');
            if(popup) popup.style.display = 'flex'; 

            var closePopupBtn = document.getElementById('closePopupBtn');
            var closePopupX = document.getElementById('closePopup');

            if(closePopupBtn) {
                closePopupBtn.addEventListener('click', function () { popup.style.display = 'none'; });
            }
            if(closePopupX) {
                closePopupX.addEventListener('click', function () { popup.style.display = 'none'; });
            }
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

.header .h1, 
.header .logo a strong { 
    font-size: 1.2em !important; 
    padding: 3px 10px; 
    border-radius: 15px;
    color: white !important;
    background: linear-gradient(to right, #0056b3 0%, #007bff 50%, #0056b3 100%);
}

.time-date-integrated { display: inline-flex; align-items: center; justify-content: center; }

.info-badge-small {
    padding: 3px 8px; border-radius: 15px;
    background: linear-gradient(to right, #000000 0%, #FFFFFF 50%, #FFD700 100%);
    background-size: 300% 100%; animation: gradient-move 8s linear infinite;
    color: black; font-weight: bold; font-size: 12px; display: flex; align-items: center;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.5); margin: 0 5px; cursor: default;
}
@keyframes gradient-move { 0% { background-position: 0% 50%; } 100% { background-position: 100% 50%; } }

.autosizing, .autosizingnotis, .autosizingaktiviti, .autosizinghyperlink, .autosizinghyperlinktwo { height: auto; }
.portal-link-style {
    display: inline-block; padding: 6px 10px; border-radius: 8px; font-size: 12px !important; 
    font-weight: bolder; color: white !important; text-decoration: none; 
    background: linear-gradient(to right, #007BFF 0%, #00A3FF 100%);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); align-self: center; width: 90%; text-align: center;
}

#ai-chatbot-float {
    position: fixed; bottom: 25px; right: 25px; width: 120px; height: 140px;
    cursor: pointer; z-index: 10001; transition: transform .3s; border-radius: 50%; 
}
#ai-chatbot-float img { width: 100%; height: 100%; border-radius: 50%; }
#ai-chatbot-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.25); backdrop-filter: blur(6px); z-index: 10002; }
#ai-chatbot-panel {
    position: absolute; bottom: 30px; right: 30px; width: 420px; height: 570px;
    background: rgba(255,255,255,0.95); border-radius: 10px; display: flex;
    flex-direction: column; box-shadow: 0 10px 30px rgba(0,0,0,.4);
}
.ai-header { background: #003366; color: white; padding: 15px; font-weight: 600; display: flex; justify-content: space-between; align-items: center; border-radius: 10px 10px 0 0; }
.ai-body { flex: 1; padding: 15px; overflow-y: auto; background: #f5f7fa; }
.ai-bot-msg { background: #e0f7fa; padding: 10px 12px; margin-bottom: 10px; border-radius: 10px; max-width: 85%; font-size: 13px; }
.ai-user-msg { background: #bbdefb; padding: 10px 12px; margin-bottom: 10px; border-radius: 10px; max-width: 85%; font-size: 13px; margin-left: auto; }
.ai-footer { display: flex; padding: 10px; border-top: 1px solid #ccc; background: rgba(255,255,255,0.95); }
.ai-footer input { flex: 1; padding: 10px; border-radius: 20px; border: 1px solid #ccc; }
.ai-footer button { margin-left: 8px; padding: 8px 14px; border-radius: 20px; background: #007bff; color: white; border: none; cursor: pointer; }
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

    {{-- SEKSYEN BANNER --}}
    <section class="section-box" style="padding-top: 0px">
        <div class="row">
            <div class="col-md-12" style="padding-left: 0px; padding-right: 0px; ">
                <center>
                    <div class="box-swiper" style="width: 100%">
                        <div class="swiper-container swiper-group-1">
                            <div class="swiper-wrapper">
                                @foreach($banner as $key => $banners)
                                    <div class="swiper-slide">
                                        @if($banners->path && file_exists(public_path($banners->path)))
                                            <a target="_blank" href="{!! URL::to($banners->path) !!}">
                                                <img src="{!! URL::to($banners->path) !!}" alt="Banner" width="100%" height="100%">
                                            </a>
                                        @else
                                            <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" style="max-height: 250px">
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

    {{-- SEKSYEN BERITA --}}
<section class="section-box">
    <div class="container">
        <div class="autosizing">
            <center>
                <h4 class="section-title mt-15 mb-10 wow animate__animated animate__fadeInUp" data-wow-delay=".2s" style="color: white; text-shadow: 2px 2px #000000;">
                    BERITA
                </h4>
                <div style="width: 60px; height: 3px; background: #ffcc00; margin-bottom: 30px;"></div>
            </center>

            <div class="activity-custom-wrapper">
                @if(isset($notis) && $notis->count() > 0)
                    @foreach($notis->take(3) as $key => $notiss)
                    <div class="activity-custom-item wow animate__animated animate__fadeInUp" data-wow-delay=".{{ $key }}s">
                        {{-- Bahagian Gambar --}}
                        <div class="activity-custom-image-box" onclick="location.href = '/eperak/news/{{ $notiss->id }}';" style="cursor: pointer">
                            @if($notiss->path && file_exists(public_path($notiss->path)))
                                <img src="{!! URL::to($notiss->path) !!}" alt="Berita">
                            @else
                                <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" alt="No Image">
                            @endif
                        </div>
                        
                        {{-- Tajuk Berita --}}
                        <a href="/eperak/news/{{ $notiss->id }}" class="activity-custom-title-text">
                            {{ $notiss->tajuk }}
                        </a>
                        
                        {{-- Tarikh Berita --}}
                        <div class="activity-custom-date-text">
                            {{ \Carbon\Carbon::parse($notiss->tarikh_notis)->format('d F Y') }}
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <p style="color: white; text-align: center;">Tiada berita terkini.</p>
                    </div>
                @endif
            </div>

            <center class="mt-40">
                <a href="news?page=1" class="btn btn-lihat-semua-custom hover-up">Lihat Semua Berita</a>
            </center>
        </div>
    </div>
</section>

{{-- SEKSYEN AKTIVITI (KEKAL SAMA) --}}
<section class="section-box">
    {{-- ... kod aktiviti anda yang sedia ada ... --}}
</section>
    
    {{-- SEKSYEN AKTIVITI (LIMIT 3 KAD PUTIH) --}}
    <section class="section-box"> 
            <div class="container">
                <div class="autosizing">
                    <center>
                        <h4 class="section-title mt-15 mb-10 wow animate__animated animate__fadeInUp" data-wow-delay=".2s" style="color: white; text-shadow: 2px 2px #000000;">
                            AKTIVITI
                        </h4>
                        <div style="width: 60px; height: 3px; background: #ffcc00; margin-bottom: 30px;"></div>
                    </center>

                    <div class="activity-custom-wrapper">
                        @foreach($aktiviti->take(3) as $key => $aktivitis)
                        <div class="activity-custom-item wow animate__animated animate__fadeInUp" data-wow-delay=".{{ $key }}s">
                            <div class="activity-custom-image-box" onclick="location.href = '/eperak/activity/{{ data_get($aktivitis, 'id') }}';" style="cursor: pointer">
                                @if( data_get($aktivitis, 'Gambar_path') && file_exists( public_path( data_get($aktivitis, 'Gambar_path') ) ) )
                                    <img src="{!! URL::to(data_get($aktivitis, 'Gambar_path')) !!}" alt="Activity">
                                @else
                                    <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}">
                                @endif
                            </div>
                            <a href="/eperak/activity/{{ data_get($aktivitis, 'id') }}" class="activity-custom-title-text">{{ data_get($aktivitis, 'NamaAktiviti') }}</a>
                            <div class="activity-custom-date-text">{{ \Carbon\Carbon::parse($aktivitis->created_at)->format('d F Y') }}</div>
                        </div>
                        @endforeach
                    </div>
                    
                    <center class="mt-40">
                        <a href="activity?page=1" class="btn btn-lihat-semua-custom hover-up">Lihat Semua Aktiviti</a>
                    </center>
                </div>
            </div>
    </section>

    {{-- SEKSYEN PRODUK TEMPATAN (LIMIT 3 KAD PUTIH) --}}
    <section class="section-box mt-80">
    <div class="container">
        <center><h4 class="section-title mt-15 mb-5" style="color: white; text-shadow: 2px 2px #000000;">PRODUK TEMPATAN</h4></center>
        <div class="row">
            @foreach($lkpproduk->take(3) as $key => $lkpproduks)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-20">
                <div class="produk-card-putih text-center wow animate__animated animate__fadeInUp" data-wow-delay=".{{ $key }}s">
                    <div class="produk-icon-fix mx-auto" style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                        
                        {{-- Logik pemilihan icon berdasarkan nama/ID produk --}}
                        @php 
                            $desc = strtolower(data_get($lkpproduks, 'description'));
                            if(str_contains($desc, 'kesihatan')) {
                                $customIcon = asset('theme/assets/imgs/theme/perak/health.png');
                            } elseif(str_contains($desc, 'kraftangan')) {
                                $customIcon = asset('theme/assets/imgs/theme/perak/craft.png');
                            } elseif(str_contains($desc, 'makanan') || str_contains($desc, 'food')) {
                                $customIcon = asset('theme/assets/imgs/theme/perak/food.png');
                            } else {
                                // Default sekiranya tiada padanan
                                $icon = $lkpproduks->product_icon->where('status', 1)->first();
                                $customIcon = $icon ? URL::to($icon->path) : asset('theme/assets/imgs/theme/perak/deafulticon.png');
                            }
                        @endphp

                        <img src="{{ $customIcon }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                    <h5 style="font-weight: 800; color: #333; min-height: 45px; margin-top: 15px;">{{ data_get($lkpproduks, 'description') }}</h5>
                    <a href="/eperak/product/{{ $lkpproduks->id }}?page=1" class="btn btn-default btn-shadow hover-up mt-20" style="font-size: 11px;">Lihat Produk</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

    {{-- SEKSYEN AGENSI 5 BAWAH --}}
    <section class="section-box mt-80 mb-50">
        <center>
            <div class="box-swiper" style="width: 95%" >
                <div class="swiper-container swiper-group-5">
                    <div class="swiper-wrapper pb-70 pt-5">
                        <div class="swiper-slide" onclick="show1()" style="cursor: pointer">
                            <div class="card-grid-2 hover-up h-100" style="padding: 10px; background:#fff; border-radius:10px; border-bottom: 10px solid #007bff;">
                                <center><img src="{{ asset('theme/assets/imgs/theme/perak/logo-malaysia.jpg') }}" style="width: 50%"/></center>
                                <div class="card-block-info mt-10"><a class="portal-link-style">Portal Malaysia</a></div>
                            </div>
                        </div>
                        <div class="swiper-slide" onclick="show2()" style="cursor: pointer">
                            <div class="card-grid-2 hover-up h-100" style="padding: 10px; background:#fff; border-radius:10px; border-bottom: 10px solid #007bff;">
                                <center><img src="{{ asset('theme/assets/imgs/theme/perak/logo-mampu.jpg') }}" style="width: 50%"/></center>
                                <div class="card-block-info mt-10"><a class="portal-link-style">MAMPU</a></div>
                            </div>
                        </div>
                        <div class="swiper-slide" onclick="show3()" style="cursor: pointer">
                            <div class="card-grid-2 hover-up h-100" style="padding: 10px; background:#fff; border-radius:10px; border-bottom: 10px solid #007bff;">
                                <center><img src="{{ asset('theme/assets/imgs/theme/perak/logo-mdec.jpg') }}" style="width: 50%"/></center>
                                <div class="card-block-info mt-10"><a class="portal-link-style">MDEC</a></div>
                            </div>
                        </div>
                        <div class="swiper-slide" onclick="show4()" style="cursor: pointer">
                            <div class="card-grid-2 hover-up h-100" style="padding: 10px; background:#fff; border-radius:10px; border-bottom: 10px solid #007bff;">
                                <center><img src="{{ asset('theme/assets/imgs/theme/perak/favicon-perak.png') }}" style="width: 12%"/></center>
                                <div class="card-block-info mt-10"><a class="portal-link-style">Portal Perak</a></div>
                            </div>
                        </div>
                        <div class="swiper-slide" onclick="show5()" style="cursor: pointer">
                            <div class="card-grid-2 hover-up h-100" style="padding: 10px; background:#fff; border-radius:10px; border-bottom: 10px solid #007bff;">
                                <center><img src="{{ asset('theme/assets/imgs/theme/perak/favicon-perak.png') }}" style="width: 12%"/></center>
                                <div class="card-block-info mt-10"><a class="portal-link-style">PerakGIS</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next" id="next-pautan"></div>
                <div class="swiper-button-prev" id="prev-pautan"></div>
            </div>
        </center>
    </section>
    
    {{-- FEEDBACK ELEMENTS --}}
    <div id="feedback-float"><img src="{{ asset('theme/assets/imgs/theme/perak/goodfeedback.png') }}" style="filter: hue-rotate(90deg);"></div>
   <div id="feedback-panel">

        <div class="fb-header">

            <span>📝 Maklum Balas Portal</span>

            <span id="feedback-close">&times;</span>

        </div>

        <div class="fb-body">

            <form action="{{ url('/eperak/hantar-maklumbalas') }}" method="POST">

                @csrf

                <div class="mb-2">

                    <label class="small fw-bold">Nama Penuh</label>

                    <input type="text" name="nama" class="form-control" placeholder="Nama anda" required>

                </div>

                <div class="mb-2">

                    <label class="small fw-bold">E-mel</label>

                    <input type="email" name="emel" class="form-control" placeholder="emel@contoh.com" required>

                </div>

                <div class="mb-2">

                    <label class="small fw-bold">Rating</label>

                    <select name="rating" class="form-select" required>

                        <option value="5">Sangat Puas Hati</option>

                        <option value="4">Puas Hati</option>

                        <option value="3">Sederhana</option>

                        <option value="2">Kurang Memuaskan</option>

                        <option value="1">Tidak Puas Hati</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="small fw-bold">Komen / Cadangan</label>

                    <textarea name="komen_cadangan" class="form-control" rows="4" placeholder="Tuliskan di sini..."></textarea>

                </div>

                <button type="submit" class="btn btn-success w-100">Hantar Maklum Balas</button>

            </form>

        </div>

    </div>

    {{-- AI CHATBOT ELEMENTS --}}
    <div id="ai-chatbot-float"><img src="{{ asset('theme/assets/imgs/theme/perak/chatbot.png') }}"></div>
    <div id="ai-chatbot-overlay">
        <div id="ai-chatbot-panel">
            <div class="ai-header"><span>🤖 Pembantu PerakGIS AI</span><span id="ai-chatbot-close" style="cursor:pointer;">&times;</span></div>
            <div class="ai-body" id="ai-chat-messages"><div class="ai-bot-msg">Assalamualaikum dan Selamat Sejahtera👋 Saya pembantu AI e-Perak. Ada apa yang boleh saya bantu?</div></div>
            <div class="ai-footer"><input type="text" id="ai-chat-input" placeholder="Tanya..." /><button id="ai-chat-send">Hantar</button></div>
        </div>
    </div>
@endsection


@push('script')
<script>
    function updateDateTimeSmall() {
        const now = new Date();
        const optionsDate = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric', timeZone: 'Asia/Kuala_Lumpur' };
        const optionsTime = { hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: true, timeZone: 'Asia/Kuala_Lumpur' };
        const dateFormatter = new Intl.DateTimeFormat('ms-MY', optionsDate);
        const timeFormatter = new Intl.DateTimeFormat('en-US', optionsTime); 
        let formattedDate = dateFormatter.format(now);
        formattedDate = formattedDate.charAt(0).toUpperCase() + formattedDate.slice(1);
        let formattedTime = timeFormatter.format(now);
        formattedTime = formattedTime.replace('PM', 'PTG').replace('AM', 'PG'); 
        if(document.getElementById('current-date-small')) document.getElementById('current-date-small').textContent = formattedDate;
        if(document.getElementById('current-time-small')) document.getElementById('current-time-small').textContent = formattedTime + ' MYT';
    }
    setInterval(updateDateTimeSmall, 1000);

    document.addEventListener('DOMContentLoaded', function () {
        // Feedback
        const fbBtn = document.getElementById('feedback-float');
        const fbPanel = document.getElementById('feedback-panel');
        if(fbBtn) fbBtn.onclick = () => { fbPanel.style.display = 'flex'; fbBtn.style.display = 'none'; };
        if(document.getElementById('feedback-close')) document.getElementById('feedback-close').onclick = () => { fbPanel.style.display = 'none'; fbBtn.style.display = 'block'; };

        // Chatbot
        const floatBtn = document.getElementById('ai-chatbot-float');
        const overlay = document.getElementById('ai-chatbot-overlay');
        const closeBtn = document.getElementById('ai-chatbot-close');
        const input = document.getElementById('ai-chat-input');
        const sendBtn = document.getElementById('ai-chat-send');
        const messages = document.getElementById('ai-chat-messages');

        if(floatBtn) floatBtn.onclick = () => { overlay.style.display = 'block'; floatBtn.style.display = 'none'; input.focus(); };
        if(closeBtn) closeBtn.onclick = () => { overlay.style.display = 'none'; floatBtn.style.display = 'block'; };

        function addBotMsg(text) {
            const div = document.createElement('div');
            div.className = 'ai-bot-msg';
            div.textContent = text;
            messages.appendChild(div);
            messages.scrollTop = messages.scrollHeight;
        }

        function addUserMsg(text) {
            const div = document.createElement('div');
            div.className = 'ai-user-msg';
            div.textContent = text;
            messages.appendChild(div);
            messages.scrollTop = messages.scrollHeight;
        }

        function sendMessage() {
            const msg = input.value.trim();
            if (!msg) return;
            addUserMsg(msg);
            input.value = '';
            fetch("{{ url('/api/chatbot') }}", {
                method: "POST",
                headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: JSON.stringify({ message: msg })
            })
            .then(res => res.json())
            .then(data => addBotMsg(data.reply))
            .catch(() => addBotMsg("Ralat sistem AI."));
        }
        if(sendBtn) sendBtn.onclick = sendMessage;
        if(input) input.addEventListener('keypress', e => { if (e.key === 'Enter') sendMessage(); });

        // AJAX Map Info
        if (typeof jQuery !== 'undefined') {
            $(document).ready(function () {
                $.ajax({
                    type: "GET",
                    url: "{{ URL::to('/ajax/mapinfo')}}",
                    datatype : 'json',
                    beforeSend: () => { $('#searchpapar').hide(); $('#loadingpapar').show(); },
                    success: (data) => { $('#loadingpapar').hide(); $('#searchpapar').html(data).show(); }
                });
            });
        }


        







    });

    function show1() { window.open('https://www.malaysia.gov.my/portal/index', '_blank'); }
    function show2() { window.open('https://www.mampu.gov.my/', '_blank'); }
    function show3() { window.open('https://mdec.my/', '_blank'); }
    function show4() { window.open('https://www.perak.gov.my/', '_blank'); }
    function show5() { window.open('https://www.perakgis.my/', '_blank'); }
</script>
@endpush