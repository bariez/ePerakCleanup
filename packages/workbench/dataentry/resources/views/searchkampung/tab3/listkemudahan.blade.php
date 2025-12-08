<h4 class="ui top attached header">
    Senarai Kemudahan Awam dan Infrastruktur
</h4>
<div class="ui attached segment">
    <div style="text-align: right; margin-bottom: 15px;">
        <button class="ui green button" onclick="gettab({{$id}},3,2,0)" id="addbutton">
            <i class="icon plus"></i>Tambah
        </button>
    </div>
    
    <table id="listkemudahan" class="ui celled padded table" style="width:100%">
        <thead>
            <tr class="center aligned">
                <th style="width: 5%;">Bil</th>
                <th>Kategori Kemudahan</th>
                <th>Jenis Kemudahan</th>
                <th>Nama Kemudahan</th>
                <th>Bilangan</th>
                <th>Unit</th>
                <th>Gambar</th>
                <th style="width: 15%;">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse($kemudahan as $key => $data)
                <tr class="center aligned middle aligned">
                    <td>{{ $i }}</td>
                    <td>{{ data_get($data, 'katkemudahan.description') }}</td>
                    <td>{{ data_get($data, 'jeniskemudahan.description') }}</td>
                    <td style="font-weight: bold;">{{ data_get($data, 'NamaKemudahan') }}</td>
                    <td>{{ data_get($data, 'Bilangan') }}</td>
                    <td>{{ data_get($data, 'unit.description') }}</td>
                    <td>
                        <div class="ui small image">
                            @if (data_get($data, 'Gambar_path') == '')
                                <a target="_blank" href="{{ URL::asset('logo.png') }}">
                                    <img src="{{ URL::asset('logo.png') }}" alt="ePerak" class="ui centered image" style="max-height: 80px; width: auto;">
                                </a>
                            @elseif(file_exists(public_path(data_get($data, 'Gambar_path'))))
                                <a target="_blank" href="{!! URL::to(data_get($data, 'Gambar_path')) !!}">
                                    <img src="{!! URL::to(data_get($data, 'Gambar_path')) !!}" alt="ePerak" class="ui centered image" style="max-height: 80px; width: auto;">
                                </a>
                            @else
                                <a target="_blank" href="{{ URL::asset('logo.png') }}">
                                    <img src="{{ URL::asset('logo.png') }}" alt="ePerak" class="ui centered image" style="max-height: 80px; width: auto;">
                                </a>
                            @endif
                        </div>
                    </td>
                    <td>
                        <a href="#" onclick="gettab({{ $id }},3,4,{{ data_get($data, 'id') }})"
                            data-tooltip="Paparan" data-position="top center" style="margin: 0 4px;">
                            <i class="eye blue icon" style="font-size: 1.2em;"></i>
                        </a>

                        <a href="#" onclick="gettab({{ $id }},3,3,{{ data_get($data, 'id') }})"
                            data-tooltip="Kemaskini" data-position="top center" style="margin: 0 4px;">
                            <i class="edit yellow icon" style="font-size: 1.2em;"></i>
                        </a>

                        <a onclick="return confirm('Adakah anda pasti untuk hapus?');"
                            href="{!! URL::to('dataentry/searchkampung/deletekemudahan/' . data_get($data, 'id') . '/' . $id) !!}"
                            data-tooltip="Padam" data-position="top center" style="margin: 0 4px;">
                            <i class="trash alternate red icon" style="font-size: 1.2em;"></i>
                        </a>
                    </td>
                </tr>
                <?php $i++; ?>
            @empty
                <tr>
                    <td colspan='8' class="center aligned">Tiada Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>