<style>
    /* Style Thumbnail (Kekal sama) */
    .gallery-thumb {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        border: 1px solid #ddd;
        margin: 2px;
        cursor: pointer;
        transition: transform 0.2s;
    }
    .gallery-thumb:hover {
        transform: scale(1.1);
        border-color: #2185d0;
    }

    /* Style untuk Modal Gambar */
    #modal-image-content {
        position: relative; /* Supaya butang absolute refer kotak ini */
        text-align: center;
        background-color: #000; /* Latar belakang gambar hitam */
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #modal-img-display {
        max-height: 70vh; /* Jangan tinggi sangat */
        max-width: 100%;
        width: auto;
    }

    /* Butang Navigasi (Kiri / Kanan) */
    .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(255, 255, 255, 0.3);
        color: white;
        border: none;
        font-size: 2em;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s;
        user-select: none;
    }
    .nav-btn:hover {
        background-color: rgba(255, 255, 255, 0.8);
        color: black;
    }
    .nav-prev { left: 10px; }
    .nav-next { right: 10px; }
</style>

<h4 class="ui top attached header">
    Senarai Aktiviti
</h4>
<div class="ui attached segment">
    <div style="text-align: right; margin-bottom: 15px;">
        <button class="ui green button" onclick="gettab({{$id}},5,2,0)" id="addbutton">
            <i class="icon plus"></i>Tambah
        </button>
    </div>
    
    <table id="listpencapaian" class="ui celled padded table" style="width:100%">
        <thead>
            <tr class="center aligned">
                <th style="width: 5%;">Bil</th>
                <th>Tahun</th>
                <th>Jenis Aktiviti</th>
                <th>Aktiviti</th>
                <th>Penganjur</th>
                <th style="width: 280px;">Gambar</th>
                <th style="width: 15%;">Tindakan</th>
            </tr>
        </thead>
        <tbody>
    <?php $i = 1; ?>
    @forelse($aktiviti as $key => $data)
        <tr class="center aligned middle aligned">
            <td>{{ $i }}</td>
            <td>{{ data_get($data, 'Tahun') }}</td>
            <td>{{ data_get($data, 'kategori.description') }}</td>
            <td style="font-weight: bold;">{{ data_get($data, 'NamaAktiviti') }}</td>
            <td>{{ data_get($data, 'Penganjur') }}</td>
            
            <td class="center aligned">
         @php
              $rawPath = data_get($data, 'Gambar_path');
                // Bersihkan path: Buang '/' di depan dan betulkan folder jika perlu
             $cleanPath = ltrim($rawPath, '/');
        
                     // Semak jika fail benar-benar wujud di server
             $exists = (!empty($cleanPath) && file_exists(public_path($cleanPath)));
         @endphp

    @if($exists)
        <img src="{{ asset($cleanPath) }}" class="ui small rounded image" 
             style="width:100px; cursor:pointer;" 
             onclick="openMyModal('{{ asset($cleanPath) }}')">
    @else
        <div style="text-align: center;">
            <img src="{{ asset('logo.png') }}" style="width:60px; opacity:0.4;">
            <br>
            <span style="color:red; font-size:9px;">Fail tidak ditemui</span>
        </div>
                @endif
            </td>
            <td>
                <a href="#" onclick="gettab({{ $id }},5,4,{{ data_get($data, 'id') }})"
                    data-tooltip="Paparan" data-position="top center" style="margin: 0 4px;">
                    <i class="eye blue icon" style="font-size: 1.2em;"></i>
                </a>

                <a href="#" onclick="gettab({{ $id }},5,3,{{ data_get($data, 'id') }})"
                    data-tooltip="Kemaskini" data-position="top center" style="margin: 0 4px;">
                    <i class="edit yellow icon" style="font-size: 1.2em;"></i>
                </a>

                <a onclick="return confirm('Adakah anda pasti untuk hapus?');"
                    href="{!! URL::to('dataentry/searchkampung/deleteaktiviti/' . data_get($data, 'id') . '/' . $id) !!}"
                    data-tooltip="Padam" data-position="top center" style="margin: 0 4px;">
                    <i class="trash alternate red icon" style="font-size: 1.2em;"></i>
                </a>
            </td>
        </tr>
        <?php $i++; ?>
    @empty
        <tr>
            <td colspan='7' class="center aligned">Tiada Data</td>
        </tr>
    @endforelse
</tbody>
    </table>
</div>

<div id="myImageModal" class="custom-modal-overlay" onclick="closeMyModal()">
    <span class="custom-close-btn" onclick="closeMyModal()">&times;</span>
    
    <img class="custom-modal-content" id="img01">
</div>

<script>
    // Fungsi Buka Modal
    function openMyModal(srcGambar) {
        var modal = document.getElementById("myImageModal");
        var modalImg = document.getElementById("img01");
        
        modal.style.display = "block"; // Tunjukkan modal
        modalImg.src = srcGambar;      // Masukkan url gambar
    }

    // Fungsi Tutup Modal
    function closeMyModal() {
        var modal = document.getElementById("myImageModal");
        modal.style.display = "none"; // Sembunyikan modal
    }
</script>