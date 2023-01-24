@component('laravolt::mail.body')
    @component('laravolt::mail.headline')
        @if($dataemail['status']=='BLOCKED')
		Permohonan Penggunaan Sistem e-Perak Tidak Diluluskan
		@else
		Permohonan Penggunaan Sistem e-Perak Telah Diluluskan
		@endif
    @endcomponent

    @component('laravolt::mail.message')

    	<p>YBhg. Datuk/Dato' /Datin/Tuan/Puan,<p>


		@if($dataemail['status']=='BLOCKED')
		<p><b>Permohonan Pengguna Dibawah Tidak Diluluskan :-</b></p>
		@else
		<p><b>Permohonan Pengguna Dibawah Telah Diluluskan :- </b></p>
		@endif
			

        <p><b>Nama:</b> {{ $dataemail['name'] }}</p>

		<p><b>Emel:</b> {{ $dataemail['email'] }}</p>

		<p><b>Jabatan / Agensi:</b> {{ $dataemail['jabatan'] }}</p>

		<p><b>Jawatan:</b> {{ $dataemail['jawatan'] }}</p>

		<p><b>No. Tel:</b> {{ $dataemail['notel'] }}</p>

		<p><b>Kategori Pengguna:</b> {{ $dataemail['roleuser'] }}</p>

		@if($dataemail['status']=='BLOCKED')
		<p><b>Ulasan:</b> {{ $dataemail['ulasan'] }}</p>
		@endif

		<p>Sekian, terima kasih.</p>

    @endcomponent

@endcomponent

