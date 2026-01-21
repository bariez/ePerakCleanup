@extends('laravolt::layout.app2')

@section('content')

<style>
    /* Warna Biru Gelap dan Font Bold untuk Tajuk Utama */
    #actionbar h3.ui.header {
        color: #1a3352 !important; 
        font-weight: 800 !important;
        font-size: 1.8rem !important;
        margin-bottom: 0px !important;
    }

    /* Sub-teks di bawah tajuk */
    .header-subtext {
        color: #777 !important;
        font-size: 0.95rem;
        margin-top: -5px;
        display: block;
    }

    /* Penggayaan Ikon Header (Soalan Lazim / Help) */
    .header-icon-container {
        display: inline-block;
        vertical-align: middle;
        margin-right: 15px;
    }

    .header-icon-container i.icon {
        color: #1a3352 !important;
        font-size: 2.2rem !important;
        margin: 0 !important;
    }

    /* SOLUSI FONT TAK NAMPAK: Paksa semua teks dalam table nampak jelas */
    .ui.table, 
    .ui.table thead th,
    .ui.attached.header,
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_filter label {
        color: #2b2b2b !important;
    }

    /* Kad (Segments) ikut gaya modern */
    .ui.attached.segment {
        border: none !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08) !important;
        border-radius: 0 0 12px 12px !important;
    }

    .ui.top.attached.header {
        background-color: #f9fafb !important;
        border: none !important;
        border-bottom: 1px solid #eee !important;
        border-radius: 12px 12px 0 0 !important;
        color: #1a3352 !important;
        padding: 1.2rem !important;
    }

    /* Warna Butang Tambah (Hijau) */
    .ui.button.green {
        background-color: #28a745 !important;
        border-radius: 8px !important;
    }
</style>

<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0" >
    <div class="column middle aligned">
        <div class="header-icon-container">
            <i class="question circle outline icon"></i> 
        </div>
        <div style="display: inline-block; vertical-align: middle;">
            <h3 class="ui header m-t-xs">
                Soalan Lazim
            </h3>
            <span class="header-subtext">Pengurusan jawapan bagi kemusykilan umum pengguna</span>
        </div>
    </div> 
    <div class="column right aligned middle aligned">
        <a class="ui button green" href="{!! URL::to('site/soalan/add') !!}" id="addbutton">
            <i class="icon plus"></i><span>Tambah Soalan</span>
        </a>
    </div>
</div>

<br/>

<h4 class="ui top attached header">
    <i class="list icon"></i> Senarai Soalan Lazim
</h4>

<div class="ui attached segment">
    <table id="listfaq" class="ui celled table selectable" style="width:100%">
        <thead>
            <tr>
                <th style="text-align: center;">Bil</th>
                <th style="text-align: center;">Soalan</th>
                <th style="text-align: center;">Jawapan</th>
                <th style="text-align: center;">Susunan</th>
                <th style="text-align: center;">Status</th>
                <th style="text-align: center;">Tindakan</th>
            </tr>
        </thead>
            <tbody>
            <?php $i=1; ?>
            @forelse($data as $key => $value)
                <tr style="text-align: center;">
                    <td>{{ $i }}</td>
                    <td style="text-align: left;">{{ data_get($value, 'Soalan') }}</td>
                    <td style="text-align: left;">{{ data_get($value, 'Jawapan') }}</td>
                    <td>{{ data_get($value, 'Susunan') }}</td>
                    <td>
                        @if($value->Status == '1')
                            <div class="ui label green tiny">Aktif</div>
                        @elseif($value->Status == '0')
                            <div class="ui label grey tiny">Tidak Aktif</div>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <div style="display: flex; gap: 5px; justify-content: center;">
                            <a href="{!! URL::to('/site/soalan/edit/'.data_get($value, 'id')) !!}" class="ui button icon mini basic blue" title="Kemaskini">
                                <i class="edit icon"></i>
                            </a>

                            <form action="{!! URL::to('/site/soalan/delete/'.data_get($value, 'id')) !!}" method="POST" onsubmit="return confirm('Adakah anda pasti ingin memadam soalan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ui button icon mini basic red" title="Padam">
                                    <i class="trash icon"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php $i++; ?>
            @empty
                <tr>
                    <td colspan='6' class="center aligned">Tiada Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#listfaq').DataTable({
            "lengthChange" : false,
            "language" : {
                "search"    : "Carian Pantas:",
                "info"      : "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
                "infoEmpty" : "Paparan 0 hingga 0 daripada 0 jumlah data",
                "paginate"  : {
                    "first"     : "Pertama",
                    "last"      : "Terakhir",
                    "next"      : "Seterusnya",
                    "previous"  : "Sebelumnya"
                },
            }
        });
    });
</script>
@endpush