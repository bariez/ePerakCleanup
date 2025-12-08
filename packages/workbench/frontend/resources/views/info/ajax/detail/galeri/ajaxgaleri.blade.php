<style type="text/css">
    /* Gaya untuk memastikan saiz gambar sekata */
    .gallery-img-wrapper {
        width: 100%;
        height: 220px; /* Tetapkan ketinggian tetap di sini */
        overflow: hidden;
        position: relative;
        border-radius: 10px 10px 0 0;
    }

    .gallery-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ini magik untuk memastikan gambar tidak terpenyet */
        object-position: center;
        transition: transform 0.4s ease;
    }

    /* Efek Zoom bila cursor di atas gambar */
    .card-grid-2:hover .gallery-img-wrapper img {
        transform: scale(1.1);
    }

    /* Gaya Kad yang lebih kemas */
    .card-grid-2 {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .card-grid-2:hover {
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }

    .card-block-info {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .heading-title a {
        color: #333;
        font-weight: 600;
        text-decoration: none;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Hadkan tajuk kepada 2 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .heading-title a:hover {
        color: #0d6efd; /* Tukar warna ikut tema anda */
    }

    /* Tarikh Badge (Optional - jika ada data tarikh) */
    .date-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0, 0, 0, 0.6);
        color: #fff;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
    }
</style>

<div class="container">
    
    {{-- LOGIK SUSUNAN: Menyusun data mengikut tarikh (Terkini di atas) --}}
    @php
        // Pastikan $data adalah collection, kemudian sort. 
        // Nota: 'created_at' perlu ditukar kepada nama column tarikh sebenar dalam database anda (cth: 'Tarikh', 'updated_at')
        $sortedData = collect($data)->sortByDesc('created_at'); 
    @endphp

    <div class="row mt-10">
        @foreach($sortedData as $key => $value)
            <div class="col-lg-3 col-md-6 col-sm-12 col-12 mt-4 mb-4">
                <div class="card-grid-2">
                    
                    {{-- BAHAGIAN GAMBAR --}}
                    <div class="gallery-img-wrapper">
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#galeriModal" data-idgaleri="{{ data_get($value, 'id') }}" onclick="forwardgaleriid(this)">
                            
                            {{-- Logic Gambar --}}
                            @php
                                $imgSrc = asset('theme/assets/imgs/theme/perak/noimage.jpg'); // Default
                                if(data_get($value, 'Gambar_path') && file_exists(public_path(data_get($value, 'Gambar_path')))){
                                    $imgSrc = URL::to(data_get($value, 'Gambar_path'));
                                }
                            @endphp

                            <img src="{{ $imgSrc }}" 
                                 alt="{{ data_get($value, 'Tajuk') }}" 
                                 title="{{ data_get($value, 'Tajuk') }}">
                            
                            {{-- Jika ada data tarikh, boleh paparkan di sini --}}
                            @if(data_get($value, 'created_at'))
                                <span class="date-badge"><i class="fi-rr-calendar"></i> {{ \Carbon\Carbon::parse(data_get($value, 'created_at'))->format('d M Y') }}</span>
                            @endif
                        </a>
                    </div>

                    {{-- BAHAGIAN KANDUNGAN --}}
                    <div class="card-block-info">
                        <h6 class="heading-title text-center mb-3">
                            <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#galeriModal" data-idgaleri="{{ data_get($value, 'id') }}" onclick="forwardgaleriid(this)">
                                {{ data_get($value, 'Tajuk') }}
                            </a>
                        </h6>
                        
                        <div class="text-center mt-auto">
                            <a href="javascript:;" onclick="forwardgaleriid(this)" 
                               class="btn btn-primary btn-sm w-100 hover-up" 
                               style="border-radius: 5px;"
                               data-bs-toggle="modal" 
                               data-bs-target="#galeriModal" 
                               data-idgaleri="{{ data_get($value, 'id') }}">
                               <i class="fi-rr-eye mr-5"></i> Lihat Galeri
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="galeriModal" tabindex="-1" aria-labelledby="galeriModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content" id="modalpapar-galeri" style="display: none;">
            {{-- Kandungan akan dimasukkan melalui AJAX --}}
        </div>

        <div class="modal-content p-30" id="modalloadingpapar-galeri">
            <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
                <img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="Loading..." style="height: 100px; width: auto;" />
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalimagegaleri" tabindex="-1" aria-labelledby="modalimagegaleriLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content" id="modalimage-galeri" style="display: none;">
             {{-- Kandungan gambar AJAX --}}
        </div>

        <div class="modal-content p-30" id="modalimageloadingpapar-galeri">
            <center>
                <img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="Loading..." style="height: 150px; width: auto;" />
            </center>
        </div>
    </div>
</div>
<script type="text/javascript">
    // Fungsi JavaScript kekal sama, cuma dikemaskan sedikit
    function forwardgaleriid(data) {
        var idgaleri = $(data).data('idgaleri');

        $.ajax({
            type: "GET",
            url: "{{ URL::to('/info/ajax/detail/galeri/modal/')}}" + "/" + idgaleri,
            datatype: 'json',
            beforeSend: function () {
                $('#modalpapar-galeri').hide().html('');
                $('#modalloadingpapar-galeri').show();
            },
            success: function(data) {
                $('#modalloadingpapar-galeri').hide();
                $('#modalpapar-galeri').html(data).fadeIn();
            },
            error: function() {
                alert('Ralat semasa memuatkan data.');
                $('#modalloadingpapar-galeri').hide();
            }
        });
    }

    function gambargaleriid(data) {
        var idgambargaleri = $(data).data('idgambargaleri');

        $.ajax({
            type: "GET",
            url: "{{ URL::to('/info/ajax/detail/galeri/modalimage/')}}" + "/" + idgambargaleri,
            datatype: 'json',
            beforeSend: function () {
                $('#modalimage-galeri').hide().html('');
                $('#modalimageloadingpapar-galeri').show();
            },
            success: function(data) {
                $('#modalimageloadingpapar-galeri').hide();
                $('#modalimage-galeri').html(data).fadeIn();
            },
            error: function() {
                 alert('Ralat semasa memuatkan gambar.');
                 $('#modalimageloadingpapar-galeri').hide();
            }
        });
    }
</script>