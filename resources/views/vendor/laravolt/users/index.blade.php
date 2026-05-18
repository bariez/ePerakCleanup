@extends('laravolt::layout.app2')

@section('content')
    <style type="text/css">
        :root {
            --primary-dark-blue: #0d214a; 
            --primary-blue: #1e3a8a; 
            --soft-bg: #f8fafc;
            --border-color: #e2e8f0;
        }

        .layout--app .layout__content {
            padding-top: 110px !important; 
            background-color: var(--soft-bg);
        }

        .page-main-title {
            color: var(--primary-dark-blue) !important;
            font-weight: 1000 !important;
            font-size: 2.6rem !important;
            margin: 0 !important;
        }

        .sub.header {
            color: #64748b !important;
            margin-top: 5px !important;
        }

        #actionbar {
            margin-bottom: 30px !important;
            padding: 0 1.5rem;
            width: 100%;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 35px;
            padding: 0 1.5rem;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 16px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover { 
            transform: translateY(-8px); 
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 15px;
        }

        .stat-info h3 { margin: 0; font-size: 26px; color: var(--primary-dark-blue); font-weight: 800; }
        .stat-info p { margin: 0; color: #64748b; font-size: 14px; font-weight: 600; }

        .ui.top.attached.header.custom-header {
            background: #ffffff !important;
            color: var(--primary-blue) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 12px 12px 0 0 !important;
            padding: 18px !important;
            display: flex; align-items: center;
        }

        .custom-header i.icon { color: #fecb3a !important; margin-right: 12px !important; }

        .ui.attached.segment.raised {
            border-radius: 0 0 12px 12px !important;
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.05) !important;
            border: 1px solid var(--border-color) !important;
            border-top: none !important;
            padding: 1.5rem !important;
            background: white !important;
        }

        .ui.button.primary-custom {
            background-color: #16a34a !important; 
            color: white !important;
            border-radius: 10px !important;
            padding: 12px 25px !important;
            font-weight: bold !important;
            box-shadow: 0 4px 6px rgba(22, 163, 74, 0.2);
        }
    </style>

    <div id="actionbar" class="ui grid">
        <div class="row">
            <div class="eight wide column middle aligned">
                <h1 class="ui header page-main-title">
                    <i class="users icon" style="color: var(--primary-dark-blue);"></i>
                    <div class="content">
                        Pengguna
                        <div class="sub header">Pengurusan akaun dan akses sistem</div>
                    </div>
                </h1>
            </div>
            <div class="eight wide column right aligned middle aligned">
                <a href="/site/users/create" class="ui button primary-custom">
                    <i class="plus icon"></i> Tambah Pengguna
                </a>
            </div>
        </div>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon" style="background: #eff6ff; color: #1e40af;"><i class="users icon"></i></div>
            <div class="stat-info">
                <h3>{{ $data->count() }}</h3>
                <p>Jumlah Pengguna</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #f0fdf4; color: #166534;"><i class="check circle icon"></i></div>
            <div class="stat-info">
                <h3>{{ $data->where('status', 'ACTIVE')->count() }}</h3>
                <p>Pengguna Aktif</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: #fefce8; color: #854d0e;"><i class="user plus icon"></i></div>
            <div class="stat-info">
                <h3>{{ $data->where('created_at', '>=', now()->startOfMonth())->count() }}</h3>
                <p>Pendaftaran Baru (Bulan Ini)</p>
            </div>
        </div>
    </div>
    
    <div class="ui container-fluid content__body p-x-3">
        <h4 class="ui top attached header custom-header">
            <i class="address card outline icon"></i> Senarai Pengguna Terkini
        </h4>
        
        <div class="ui attached segment raised">
            <table id="listuser" class="ui celled table selectable" style="width:100%">
                <thead>
                    <tr>
                        <th style="text-align: center; width: 50px;">Bil</th>
                        <th style="text-align: center;">Nama</th>
                        <th style="text-align: center;">Emel</th>
                        <th style="text-align: center;">Kategori</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Tarikh Daftar</th>
                        <th style="text-align: center; width: 120px;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $row)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td><strong>{{ data_get($row,'name') }}</strong></td>
                            <td>{{ data_get($row,'email') }}</td>
                            <td style="text-align: center;">
                                <div class="ui label basic small">{{ data_get($row,'namerole') }}</div>
                            </td>
                            <td style="text-align: center;">
                                @if(Str::upper(data_get($row,'status')) == 'ACTIVE')
                                    <span class="ui green tiny label">Aktif</span>
                                @else
                                    <span class="ui grey tiny label">{{ data_get($row,'status') }}</span>
                                @endif
                            </td>
                            <td style="text-align: center;">{{ \Carbon\Carbon::parse(data_get($row,'created_at'))->format('d/m/Y') }}</td>
                            <td style="text-align: center;">
                                <div class="ui icon buttons tiny">
                                    <a href="{!! URL::to('/site/users/edit/'.data_get($row,'id')) !!}" class="ui button basic blue" data-tooltip="Kemas kini"><i class="user icon"></i></a>
                                    <a href="{!! URL::to('/site/users/accesslog/'.data_get($row,'id')) !!}" class="ui button basic grey" data-tooltip="Log Akses"><i class="history icon"></i></a>
                                    <button type="button" class="ui button basic red btn-delete" 
                                            data-id="{{ data_get($row,'id') }}" 
                                            data-name="{{ data_get($row,'name') }}" 
                                            data-tooltip="Padam">
                                        <i class="trash icon"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Inisialisasi DataTable
            $('#listuser').DataTable({
                "lengthChange": false,
                "pageLength": 10,
                "language": { "search": "Carian Pantas:" }
            });

            // Guna Event Delegation supaya butang berfungsi pada page 2, 3 dan seterusnya
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var name = $(this).data('name');

                Swal.fire({
                    title: 'Padam Pengguna?',
                    text: "Adakah anda pasti mahu memadam pengguna " + name + "?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Padam!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/site/users/delete/" + id,
                            type: 'DELETE',
                            data: { 
                                "_token": "{{ csrf_token() }}" 
                            },
                            success: function(response) { 
                                Swal.fire('Berjaya!', 'Data telah dipadam.', 'success');
                                location.reload(); 
                            },
                            error: function(xhr) {
                                Swal.fire('Gagal!', 'Ralat pelayan: ' + xhr.status + '. Sila semak controller.', 'error');
                            }
                        });
                    }
                });
            });

            // Aktifkan tooltip Semantic UI
            $('[data-tooltip]').popup();
        });
    </script>
@endpush