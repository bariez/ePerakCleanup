@extends('laravolt::layout.app2')

@section('content')
    <style type="text/css">
        input[type=file]::-webkit-file-upload-button {
            visibility: hidden;
        }

        .file {
            position: relative;
            height: 30px;
            width: 100px;
        }

        .file>input[type="file"] {
            position: absoulte;
            opacity: 0;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0
        }

        .file>label {
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            background-color: #666;
            color: #fff;
            line-height: 30px;
            text-align: center;
            cursor: pointer;
        }
    </style>

    <style>
        img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 150px;
        }

        img:hover {
            box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
        }
    </style>



    <div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0">
        <div class="column middle aligned">
            <h2 class="ui header m-t-xs">
                Maklumat Ketua Isi Rumah
            </h2>
        </div>
        <div class="column right aligned middle aligned">
            @if (data_get($roleuser, 'role_id') == 2)
                <a class="ui button" href="{!! URL::to('dataentry/searchkampung/index') !!}" id="backbutton"><i
                        class="material-icons left"></i><span>Kembali</span></a>
            @else
                <a class="ui button" href="{!! URL::to('dataentry/searchkampung/mainmenu/' . $idkampung . '/1/1/0') !!}" id="backbutton"><i
                        class="material-icons left"></i><span>Kembali</span></a>
            @endif

        </div>
    </div>
    <br>
    <h4 class="ui top attached header">
        Senarai Ketua Isi Rumah - {{ data_get($infokampung, 'NamaKampung') }}
    </h4>
    <div class="ui attached segment">
        <div align="right">
            @if (data_get($roleuser, 'role_id') != 2 && data_get($roleuser, 'role_id') != 4)
                <a class="ui green button" href="{!! URL::to('dataentry/searchkampung/isirumah/addketua/' . $idkampung) !!}"><i class="icon plus"></i><span>Tambah</span></a>
            @endif
            @if (data_get($roleuser, 'role_id') == '1' || data_get($roleuser, 'role_id') == 5)
                <a href='#' data-idkampung='{{ $idkampung }}' class='ui blue button btnimport'><i
                        class="upload icon"></i><span>Import data</span></a>
            @endif
            <a href="{!! URL::to('dataentry/searchkampung/cetakkirAll/1/' . $idkampung) !!}"class='ui yellow button'><i class="print icon"></i><span>Cetakan KIR</span></a>


        </div>
        <br>
        <table id="listketuaisirumah" class="ui celled table" style="width:100%">
            <thead>
                <tr>
                    <th style="text-align: center;">Bil</th>
                    <th style="text-align: center;">ID Rumah</th>
                    <th style="text-align: center;">Ketua Isi Rumah</th>
                    <th style="text-align: center;">Tindakan</th>

                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @forelse($ketuaisirumah as $key =>$data)
                    <tr style="text-align: center;">
                        <td>{{ $i }}</td>
                        <td>{{ data_get($data, 'rumah.IdRumah') }}</td>
                        <td>{{ data_get($data, 'Nama') }}</td>
                        <td><a href="{!! URL::to('/dataentry/searchkampung/isirumah/viewketua/' . data_get($data, 'id') . '/' . $idkampung) !!}" data-tooltip="Paparan" data-position="bottom center"><i
                                    class="eye icon"></i></a>
                            @if (data_get($roleuser, 'role_id') == 2 || data_get($roleuser, 'role_id') == 4)
                                <a href="{!! URL::to('/dataentry/searchkampung/isirumah/ahliisirumah/' . $idkampung . '/' . data_get($data, 'rumah.id')) !!}" data-tooltip="Ahli Isi Rumah"
                                    data-position="bottom center"><i class="user plus icon"></i></a>
                            @else
                                <a href="{!! URL::to('/dataentry/searchkampung/isirumah/editketua/' . data_get($data, 'id') . '/' . $idkampung) !!}" data-tooltip="Kemaskini" data-position="bottom center"><i
                                        class="edit icon"></i></a>
                                <a href="{!! URL::to('/dataentry/searchkampung/isirumah/ahliisirumah/' . $idkampung . '/' . data_get($data, 'rumah.id')) !!}" data-tooltip="Tambah Ahli Isi Rumah"
                                    data-position="bottom center"><i class="user plus icon"></i></a>
                            @endif
                            @if (data_get($roleuser, 'role_id') != 2 && data_get($roleuser, 'role_id') != 4)
                                <a onclick="return confirm('Adakah anda pasti untuk hapus?');"
                                    href="{!! URL::to(
                                        'dataentry/searchkampung/isirumah/deleteketua/' .
                                            data_get($data, 'id') .
                                            '/' .
                                            $idkampung .
                                            '/' .
                                            data_get($data, 'rumah.id'),
                                    ) !!}" data-tooltip="Padam" data-position="bottom center"><i
                                        class="trash alternate icon" style="color:red"></i></a>
                            @endif
                            <a href="{!! URL::to('dataentry/searchkampung/cetakkir/1/' . $idkampung . '/' . data_get($data, 'rumah.IdRumah')) !!}" data-tooltip="Cetakan" data-position="bottom center"><i
                                    class="print icon"></i></a>
                            @if (data_get($ketuaisirumah, 'rumah.Status') == 0)
                                <a href="" data-tooltip="Status Kemaskini" data-position="bottom center"><i
                                        class="check icon" style="color:black"></i></a>
                            @endif
                        </td>
                    </tr>

                    <?php $i++; ?>
                @empty
                    <tr>
                        <td colspan='8' class="center aligned">Tiada Data</td>
                    </tr>
                @endforelse


        </table>

    </div>

    <!-- start modal view-->
    <div class="ui modal" id="import">
        <i class="close icon"></i>
        <div class="header" id="headers">
            Import Data
        </div>
        <div class="content">
            {!! form()->open()->post()->action(route('dataentry::searchkampung.importketuarumah'))->attribute('id', 'formkemudahan')->multipart()->horizontal() !!}
            <input type="hidden" id="idkampung" name="idkampung">

            <div class="field">
                <label>File</label>
                <button type="button" style="display:block;width:20px; height:40px;"
                    onclick="document.getElementById('getFile').click()">Pilih Fail</button>
                <input type='file' id="getFile" name="fileimport" value="{{ old('fileimport') }}"
                    style="width: 570px;height: 40px;" required="required" onchange="this.setCustomValidity('')"
                    oninvalid="this.setCustomValidity('Medan ini Wajib') ">

            </div>
            <div class="field">
                <label>&nbsp;</label>
                <div class="inline fields">
                    <div class="field">
                        <a target="_blank" href="{{ URL::asset('importKetuaRumah2.xlsx') }}"><i
                                class="file alternate outline icon"></i><span>Contoh Fail</span>
                        </a>
                    </div>
                    <div class="field">
                        <a href='#' class="btnkamus"><i class="book open icon"></i><span>Kamus Data</span></a>
                    </div>
                </div>
            </div>
            <div class="ui divider section"></div>
            <div align="right">
                <button type="submit" class="ui button primary" id="addbutton" name="hantar"
                    onclick="return validategaleri();">
                    Simpan
                </button>

            </div>




            {!! Form::close() !!}
        </div>
    </div>
    <div class="ui modal" id="kamus">
        <i class="close icon"></i>
        <div class="header" id="headers">
            Kamus Data
        </div>
        <div class="content">
            <table id="listkamus" class="ui celled table" style="width:100%">
                <thead>
                    <tr>

                        <th style="text-align: center;">Id</th>
                        <th style="text-align: center;">Jenis</th>
                        <th style="text-align: center;">Keterangan</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    @forelse($kamusdata as $key =>$data)
                        <tr style="text-align: center;">

                            <td>{{ data_get($data, 'id') }}</td>
                            <td>{{ data_get($data, 'lkpmaster.name') }}</td>
                            <td>{{ data_get($data, 'description') }}</td>
                        </tr>

                        <?php $i++; ?>
                    @empty
                        <tr>
                            <td colspan='8' class="center aligned">Tiada Data</td>
                        </tr>
                    @endforelse


            </table>

        </div>

    </div>
@endsection
@push('script')
    <script type="text/javascript">
        $(document).ready(function() {

            $('#listketuaisirumah').DataTable({
                "lengthChange": false,
                "language": {
                    "search": "Carian:",
                    "info": "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
                    "infoEmpty": "Paparan 0 hingga 0 daripada 0 jumlah data",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Seterusnya",
                        "previous": "Sebelumnya"
                    },
                }
            });

            $('#listkamus').DataTable({
                "lengthChange": false,
                "language": {
                    "search": "Carian:",
                    "info": "Paparan _START_ hingga _END_ daripada _TOTAL_ jumlah data",
                    "infoEmpty": "Paparan 0 hingga 0 daripada 0 jumlah data",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Seterusnya",
                        "previous": "Sebelumnya"
                    },
                }
            });

            $('.btnimport').click(function() {

                var idkampung = $(this).data('idkampung');

                document.getElementById("idkampung").value = idkampung;

                $('#import')
                    .modal({
                        blurring: true
                    })
                    .modal('show');



            });
            $('.btnkamus').click(function() {


                $('#kamus')
                    .modal({
                        blurring: true
                    })
                    .modal('show');



            });


        });
    </script>
@endpush
