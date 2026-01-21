@extends('laravolt::layout.app2')

@section('content')
    <style type="text/css">
        :root {
            --primary-dark-blue: #0d214a; 
            --primary-blue: #1e3a8a; 
            --soft-bg: #f8fafc;
            --border-color: #e2e8f0;
        }

        /* 1. KEMASKAN GAP: Merapatkan kandungan dengan Top Bar */
        .layout--app .layout__content {
            padding-top: 85px !important; /* Dikurangkan supaya lebih rapat ke atas */
            background-color: var(--soft-bg);
        }

        /* 2. PENETAPAN FONT TAJUK (BIRU GELAP) */
        .page-main-title {
            color: var(--primary-dark-blue) !important;
            font-weight: 800 !important;
            font-size: 2.2rem !important;
            margin: 0 !important;
        }

        .sub.header {
            color: #64748b !important;
            margin-top: 2px !important;
        }

        /* 3. KAWALAN ACTION BAR - Membuang margin berlebihan */
        #actionbar {
            margin-top: -10px !important;
            margin-bottom: 15px !important;
            padding: 0 1.5rem;
            width: 100%;
        }

        /* 4. DESIGN HEADER JADUAL (IKON KUNING) */
        .ui.top.attached.header.custom-header {
            background: #ffffff !important;
            color: var(--primary-blue) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 12px 12px 0 0 !important;
            padding: 15px !important;
            display: flex; 
            align-items: center;
        }

        .custom-header i.icon { 
            color: #fecb3a !important; /* Ikon kuning e-Perak */
            margin-right: 12px !important; 
        }

        /* 5. DESIGN SEGMENT JADUAL */
        .ui.attached.segment.raised {
            border-radius: 0 0 12px 12px !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05) !important;
            border: 1px solid var(--border-color) !important;
            border-top: none !important;
            padding: 1.2rem !important;
            background: white !important;
        }

        /* Styling Table Header */
        #listuser thead th {
            background: #f8fafc !important;
            color: var(--primary-blue) !important;
            text-transform: uppercase;
            font-size: 0.85rem;
            text-align: center !important;
        }

        /* PENYELARASAN BUTANG TINDAKAN (SAMA SAIZ & GAYA) */
        .ui.button.mini-custom {
            padding: 8px 10px !important;
            border-radius: 6px !important;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <div id="actionbar" class="ui grid">
        <div class="row">
            <div class="eight wide column middle aligned">
                <h1 class="ui header page-main-title">
                    <i class="user check icon" style="color: var(--primary-dark-blue);"></i>
                    <div class="content">
                        Kelulusan Pengguna
                        <div class="sub header">Pengurusan kelulusan akaun dan akses sistem</div>
                    </div>
                </h1>
            </div>
        </div>
    </div>

    <div class="ui container-fluid content__body p-x-3">
        <h4 class="ui top attached header custom-header">
            <i class="address card outline icon"></i> Senarai Kelulusan Pengguna
        </h4>
        
        <div class="ui attached segment raised">
            <table id="listuser" class="ui celled table selectable" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 50px;">Bil</th>
                        <th>Nama</th>
                        <th>Emel</th>
                        <th>Status</th>
                        <th>Tarikh Daftar</th>
                        <th style="width: 120px;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @forelse($data as $key => $row)
                        <tr style="text-align: center;">
                            <td>{{$i}}</td>
                            <td style="text-align: left;"><strong>{{data_get($row,'name')}}</strong></td>
                            <td style="text-align: left;">{{data_get($row,'email')}}</td>
                            <td>
                                <div class="ui label orange basic mini">{{data_get($row,'status')}}</div>
                            </td>
                            <td>{{ \Carbon\Carbon::parse(data_get($row,'created_at'))->format('d/m/Y') }}</td>
                            <td>
                                <div class="ui icon buttons">
                                    <a href="{!! URL::to('/site/users/approve/'.data_get($row,'id')) !!}" 
                                       data-tooltip="Kelulusan" 
                                       data-position="top center" 
                                       class="ui button basic blue mini-custom">
                                        <i class="edit icon"></i>
                                    </a>

                                    <form id="delete-form-{{ data_get($row,'id') }}"  
                                          action="{{ route('users.delete.pending', data_get($row,'id')) }}" 
                                          method="POST" 
                                          style="display:inline-block;">
                                        @csrf
                                        <button type="button" 
                                                class="ui button basic red mini-custom" 
                                                data-tooltip="Padam" 
                                                data-position="top center"
                                                onclick="padamData('{{ data_get($row,'id') }}')">
                                            <i class="trash icon"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php $i++;?>
                    @empty
                        <tr>
                            <td colspan='6' class="center aligned grey text">Tiada Data Kelulusan Pengguna</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function padamData(id) {
        Swal.fire({
            title: 'Padam Permohonan?',
            text: "Data ini akan dibuang secara kekal dari sistem.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Padam!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    $(document).ready(function() {
        $('#listuser').DataTable({
            "lengthChange": false,
            "pageLength": 10,
            "language": {
                "search": "Carian Pantas:",
                "paginate": { "next": "Seterusnya", "previous": "Sebelumnya" },
            }
        });
        $('[data-tooltip]').popup();
    });
</script>
@endpush