<?php

    use Workbench\Site\Model\Frontend\Hubungi;

    use Workbench\Site\Model\Frontend\Counter;

    use Workbench\Site\Model\Lookup\AuditLog;



    $contactus = Hubungi::where('status', 1)->first();

    $counter = Counter::first();

    $editdate = AuditLog::orderBy('id', 'desc')->first();

?>



<style>

    /* 1. PENETAPAN ASAS FOOTER (LUTSINAR) */

    .footer-modern {

        position: relative;

        padding: 100px 0 40px 0;

        /* Menambah sedikit lapisan putih pada keseluruhan footer */

        background: rgba(255, 255, 255, 0.05) !important; 

        font-family: 'Poppins', sans-serif !important;

        color: white;

        border-top: 1px solid rgba(255, 255, 255, 0.2);

    }



    /* 2. GAYA KAD GLASSMORPHISM (ROUNDED RECTANGULAR) */

    .glass-card {

        background: rgba(255, 255, 255, 0.08); /* Ketelusan rendah untuk nampak video */

        backdrop-filter: blur(12px); /* Kesan kabur di belakang kad */

        -webkit-backdrop-filter: blur(12px);

        border: 1px solid rgba(255, 255, 255, 0.15);

        border-radius: 25px; /* Sizing Rounded yang ketara */

        padding: 35px 25px;

        height: 100%;

        transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);

        text-align: center;

        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);

    }



    /* Kesan Interaktif apabila Mouse Hover */

    .glass-card:hover {

        transform: translateY(-20px) scale(1.02);

        background: rgba(255, 255, 255, 0.15);

        border-color: #ffc33d; /* Warna Kuning Perak */

        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.4);

    }



    /* 3. ICONOGRAPHY */

    .card-icon-wrap {

        width: 70px;

        height: 70px;

        background: linear-gradient(135deg, #ffc33d 0%, #ff9800 100%);

        border-radius: 20px; /* Rounded Rectangular Icon Box */

        display: flex;

        align-items: center;

        justify-content: center;

        margin: 0 auto 25px auto;

        box-shadow: 0 10px 20px rgba(255, 195, 61, 0.3);

    }



    .card-icon-wrap i.icon {

        font-size: 2rem !important;

        color: #0d214a !important; /* Biru Gelap Perak */

        margin: 0 !important;

    }



    /* 4. TYPOGRAPHY */

    .glass-card h4 {

        color: #ffc33d;

        text-transform: uppercase;

        font-weight: 800;

        letter-spacing: 1.5px;

        margin-bottom: 20px;

    }



    .stat-number {

        font-size: 2.5rem;

        font-weight: 800;

        color: white;

        display: block;

        margin: 10px 0;

        text-shadow: 0 0 15px rgba(255, 255, 255, 0.3);

    }



    /* 5. BOTTOM INFO */

    .footer-bottom {

        margin-top: 80px;

        padding-top: 30px;

        border-top: 1px solid rgba(255, 255, 255, 0.1);

        text-align: center;

        opacity: 0.6;

        font-size: 0.85rem;

    }



    /* Mobile Responsive */

    @media (max-width: 768px) {

        .footer-modern { padding: 50px 0 20px 0; }

        .glass-card { margin-bottom: 20px; }

    }

</style>



<footer class="footer-modern">

    <div class="container">

        <div class="row d-flex align-items-stretch">

            

            <div class="col-lg-4 col-md-6 mb-4">

                <div class="glass-card">

                    <div class="card-icon-wrap">

                        <i class="chart area icon"></i>

                    </div>

                    <h4>Statistik Pelawat</h4>

                    <span class="stat-number">{{ number_format(data_get($counter, 'count')) }}</span>

                    <p style="color: #ffc33d; font-weight: 600;">Jumlah Capaian Keseluruhan</p>

                    <small>Kemaskini: {{ date('d-M-Y', strtotime(data_get($editdate, 'created_at'))) }}</small>

                </div>

            </div>



            <div class="col-lg-4 col-md-6 mb-4">

                <div class="glass-card">

                    <div class="card-icon-wrap">

                        <i class="map marked alternate icon"></i>

                    </div>

                    <h4>Hubungi Kami</h4>

                    <p style="font-size: 0.95rem; line-height: 1.8;">

                        {{ data_get($contactus, 'alamat') }}

                    </p>

                    <div style="margin-top: 15px;">

                        <i class="phone icon" style="color: #ffc33d;"></i> {{ data_get($contactus, 'no_tel') }}<br>

                        <i class="envelope outline icon" style="color: #ffc33d;"></i> {{ data_get($contactus, 'email') }}

                    </div>

                </div>

            </div>



            <div class="col-lg-4 col-md-12 mb-4">

                <div class="glass-card">

                    <div class="card-icon-wrap">

                        <i class="paper plane icon"></i>

                    </div>

                    <h4>Sokongan Sistem</h4>

                    <div class="d-grid gap-2" style="display: flex; flex-direction: column; gap: 12px; padding: 0 20px;">

                        <a href="{{ url('/faq') }}" class="ui inverted yellow basic button" style="border-radius: 12px; font-weight: 700;">

                            <i class="map icon"></i> Soalan Lazim

                        </a>

                        <a href="{{ url('/Manual%20Pengguna%20-%20Laman%20Utama.pdf') }}" class="ui inverted yellow basic button" style="border-radius: 12px; font-weight: 700;">

                            <i class="chart pie icon"></i> Manual Panduan Sistem

                        </a>

                    </div>

                </div>

            </div>



        </div>



        <div class="footer-bottom">

            <p>

                Hakcipta Terpelihara &copy; {{ date('Y') }} <strong>Kerajaan Negeri Perak Darul Ridzuan</strong><br>

                <span style="font-size: 11px;">Paparan terbaik menggunakan resolusi 1920x1080 (Google Chrome & Mozilla Firefox terkini)</span>

            </p>

        </div>

    </div>

</footer>

