@component('laravolt::mail.body')
    @component('laravolt::mail.headline')
        Perlu Kelulusan Pengguna
    @endcomponent

    @component('laravolt::mail.message')
       <p>YBhg. Datuk/Dato' /Datin/Tuan/Puan,<p>

		<p>Mohon tindakan dan kelulusan bagi permohonan seperti dibawah:</p>

		<p><b>Nama:</b> {{ $dataemail['name'] }}</p>

		<p><b>Emel:</b> {{ $dataemail['email'] }}</p>

		<p><b>Jabatan / Agensi:</b> {{ $dataemail['jabatan'] }}</p>

		<p><b>Jawatan:</b> {{ $dataemail['jawatan'] }}</p>

		<p><b>No. Tel:</b> {{ $dataemail['notel'] }}</p>


		<p>Sehubungan itu, mohon tindakan dari YBhg. Datuk/Dato' /Datin/Tuan/Puan, untuk mengambil tindakan.</p>

		<p>Sekian, terima kasih.</p>
    @endcomponent

   

   

@endcomponent
