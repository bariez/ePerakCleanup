<style>
    /* Style Thumbnail Gambar */
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
        box-shadow: 0 0 5px rgba(0,0,0,0.2);
    }
</style>

<h4 class="ui top attached header">
    Senarai Projek
</h4>
<div class="ui attached segment">
    <div style="text-align: right; margin-bottom: 15px;">
        <button class="ui green button" onclick="gettab({{$id}},7,2,0)" id="addbutton">
            <i class="icon plus"></i>Tambah
        </button>
    </div>
    
    <table id="listpencapaian" class="ui celled padded table" style="width:100%">
        <thead>
            <tr class="center aligned">
                <th style="width: 5%;">Bil</th>
                <th>Tahun</th>
                <th>Nama Projek</th>
                <th>Jenis Projek</th>
                <th>Lokasi</th>
                <th style="width: 280px;">Gambar (Max 3)</th>
                <th style="width: 15%;">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse($projek as $key => $data)
                <tr class="center aligned middle aligned">
                    <td>{{ $i }}</td>
                    <td>{{ data_get($data, 'Tahun') }}</td>
                    <td style="font-weight: bold;">{{ data_get($data, 'NamaProjek') }}</td>
                    <td>{{ data_get($data, 'jenisprojek.description') }}</td>
                    <td>{{ data_get($data, 'Lokasi') }}</td>
                    
                    <td>
                        <div class="ui center aligned">
                            @php
                                $imagesToShow = [];
                                $mainImage = data_get($data, 'Gambar_path');
                                
                                if (!empty($mainImage) && file_exists(public_path($mainImage))) {
                                    $imagesToShow[] = URL::to($mainImage);
                                }

                                // CONTOH: Logic tarik gambar tambahan (Jika table projek_gambar wujud)
                                // $extraImages = \DB::table('profil_projek_gambar')->where('fk_profil_projek', data_get($data, 'id'))->pluck('path_gambar');
                                // foreach($extraImages as $path) { ... }

                                $jsonImages = json_encode($imagesToShow);
                            @endphp

                            @if (count($imagesToShow) > 0)
                                @foreach (array_slice($imagesToShow, 0, 3) as $index => $imgUrl)
                                    <img src="{{ $imgUrl }}" 
                                         class="gallery-thumb" 
                                         alt="Projek"
                                         onclick='openGallery({{ $jsonImages }}, {{ $index }})'>
                                @endforeach
                            @else
                                <img src="{{ URL::asset('logo.png') }}" class="gallery-thumb" alt="Tiada Gambar" style="opacity: 0.5; cursor: default;">
                            @endif
                        </div>
                    </td>
                    <td>
                        <a href="#" onclick="gettab({{ $id }},7,4,{{ data_get($data, 'id') }})"
                            data-tooltip="Paparan" data-position="top center" style="margin: 0 4px;">
                            <i class="eye blue icon" style="font-size: 1.2em;"></i>
                        </a>

                        <a href="#" onclick="gettab({{ $id }},7,3,{{ data_get($data, 'id') }})"
                            data-tooltip="Kemaskini" data-position="top center" style="margin: 0 4px;">
                            <i class="edit yellow icon" style="font-size: 1.2em;"></i>
                        </a>

                        <a onclick="return confirm('Adakah anda pasti untuk hapus?');"
                            href="{!! URL::to('dataentry/searchkampung/deleteprojek/' . data_get($data, 'id') . '/' . $id) !!}"
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