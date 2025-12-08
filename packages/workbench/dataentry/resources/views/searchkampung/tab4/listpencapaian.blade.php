<h4 class="ui top attached header">
    Senarai Pencapaian
</h4>
<div class="ui attached segment">
    <div style="text-align: right; margin-bottom: 15px;">
        <button class="ui green button" onclick="gettab({{$id}},4,2,0)" id="addbutton">
            <i class="icon plus"></i>Tambah
        </button>
    </div>
    
    <table id="listpencapaian" class="ui celled padded table" style="width:100%">
        <thead>
            <tr class="center aligned">
                <th style="width: 5%;">Bil</th>
                <th>Tahun</th>
                <th>Peringkat</th>
                <th>Aktiviti</th>
                <th>Pencapaian</th>
                <th>Penganjur</th>
                <th style="width: 15%;">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @forelse($pencapaian as $key => $data)
                <tr class="center aligned middle aligned">
                    <td>{{ $i }}</td>
                    <td>{{ data_get($data, 'Tahun') }}</td>
                    <td>{{ data_get($data, 'peringkat.description') }}</td>
                    <td>{{ data_get($data, 'Aktiviti') }}</td>
                    <td style="font-weight: bold;">{{ data_get($data, 'Pencapaian') }}</td>
                    <td>{{ data_get($data, 'Penganjur') }}</td>
                    <td>
                        <a href="#" onclick="gettab({{ $id }},4,4,{{ data_get($data, 'id') }})"
                            data-tooltip="Paparan" data-position="top center" style="margin: 0 4px;">
                            <i class="eye blue icon" style="font-size: 1.2em;"></i>
                        </a>

                        <a href="#" onclick="gettab({{ $id }},4,3,{{ data_get($data, 'id') }})"
                            data-tooltip="Kemaskini" data-position="top center" style="margin: 0 4px;">
                            <i class="edit yellow icon" style="font-size: 1.2em;"></i>
                        </a>

                        <a onclick="return confirm('Adakah anda pasti untuk hapus?');"
                            href="{!! URL::to('dataentry/searchkampung/deletepencapaian/' . data_get($data, 'id') . '/' . $id) !!}"
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