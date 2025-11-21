@extends('layouts.app')

@section('content')
<!-- Modal -->
<div class="modal fade" id="importantModal" tabindex="-1" aria-labelledby="importantModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importantModalLabel">Makluman Penting</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <p>Selamat datang ke portal rasmi kami.</p>
        <p>Maklumat ini akan dipaparkan setiap kali halaman dibuka.</p>
      </div>
    </div>
  </div>
</div>

<div class="container mt-4">
    <h1>Halaman Utama</h1>
    <p>Ini adalah kandungan portal anda.</p>
</div>
@endsection

@section('scripts')
<script>
    window.onload = function () {
        const myModal = new bootstrap.Modal(document.getElementById('importantModal'), {
            backdrop: 'static',
            keyboard: true
        });
        myModal.show();
    };
</script>
@endsection
