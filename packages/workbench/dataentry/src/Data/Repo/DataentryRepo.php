<?php

namespace Workbench\Dataentry\Data\Repo;

use App\Events\AuditLog;
use Auth;
use Carbon\Carbon;
use DB;
use Event;
use File;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Workbench\Site\Model\Lookup\GaleriDetail;
use Workbench\Site\Model\Lookup\GaleriMast;
use Workbench\Site\Model\Lookup\Isirumah;
use Workbench\Site\Model\Lookup\Kampung;
use Workbench\Site\Model\Lookup\Pemilikanrumah;
use Workbench\Site\Model\Lookup\ProfilAktiviti;
use Workbench\Site\Model\Lookup\ProfilKemudahan;
use Workbench\Site\Model\Lookup\ProfilPencapaian;
use Workbench\Site\Model\Lookup\ProfilPengeluar;
use Workbench\Site\Model\Lookup\ProfilPentadbiran;
use Workbench\Site\Model\Lookup\ProfilProduk;
//use Workbench\Site\Model\Lookup\vcetaktengah;
use Workbench\Site\Model\Lookup\ProfilProjek;
use Workbench\Site\Model\Lookup\VcetakKIR;

/**
 * @laravolt site
 * @author fezrul@3fresources.com
 **/
class DataentryRepo
{
    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    public function savekampung($request)
    {
        $searchkampung = Kampung::find($request->idkampung);

        $old_value = json_encode($searchkampung);

        $searchkampung->NamaJPKK = $request->get('namejpkk');
        //$searchkampung->Namapengerusi = $request->get('namepengerusi');
        $searchkampung->AlamatJPKK = $request->get('alamtsurat');
        // $searchkampung->TelNo = $request->get('telefon');
        $searchkampung->Sejarah = $request->get('sejarah');

        $searchkampung->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Profil Kampung';

        Event::dispatch(new AuditLog(auth()->user()->id, $searchkampung->id, $activities, $old_value, json_encode($new_value)));

        //simpan dlm table profilpentadbiran untuk pengerusi

        //check pengerusi untuk

        $currentyear = date('Y');

        $namapengerusi = ProfilPentadbiran::where('fk_kampung', $request->idkampung)
                          ->where('jawatan', '141')->orderBy('Sesi', 'desc')->where('status', 1)
                          ->first();

        if (data_get($namapengerusi, 'NamaAhli') == '') {//add

            $data = new ProfilPentadbiran;
            $data->fk_kampung = $request->idkampung;
            $data->Sesi = $currentyear;
            $data->NamaAhli = $request->get('namepengerusi');
            $data->Jawatan = 141;
            $data->Status = 1;
            $data->Notel = $request->get('telpengerusi');
            $data->save();

            $new_value = $request->except(['_token', 'action']);
            $activities = 'Tambah Profil Pentadbiran';

            Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));
        } else {//update or add

            if ($request->get('namepengerusi') != data_get($namapengerusi, 'NamaAhli')) {//ada edit nama pengerusi
                $currentyearpengerusi = ProfilPentadbiran::where('fk_kampung', $request->idkampung)
                          ->where('jawatan', '141')->where('Sesi', $currentyear)->where('status', 1)
                          ->first();

                if (data_get($currentyearpengerusi, 'NamaAhli') == '') {//check pengerusi current year

                    $data = new ProfilPentadbiran;
                    $data->fk_kampung = $request->idkampung;
                    $data->Sesi = $currentyear;
                    $data->NamaAhli = $request->get('namepengerusi');
                    $data->Jawatan = 141;
                    $data->Status = 1;
                    $data->Notel = $request->get('telpengerusi');
                    $data->save();

                    $activities = 'Tambah Profil Pentadbiran';
                    $idtable = $data->id;
                    $old_value = '';
                } else {
                    $old_value = json_encode($currentyearpengerusi);

                    $currentyearpengerusi->NamaAhli = $request->get('namepengerusi');
                    $currentyearpengerusi->Notel = $request->get('telpengerusi');
                    $currentyearpengerusi->save();

                    $activities = 'Kemaskini Profil Pentadbiran';
                    $idtable = $currentyearpengerusi->id;
                }

                $new_value = $request->except(['_token', 'action']);

                Event::dispatch(new AuditLog(auth()->user()->id, $idtable, $activities, $old_value, json_encode($new_value)));
            }
        }
    }//

    public function savestruktur($request)
    {
        $data = new ProfilPentadbiran;
        $data->fk_kampung = $request->idkampung;
        $data->Sesi = $request->tahun;
        $data->NamaAhli = $request->nama;
        $data->NoKP = $request->nokp;
        $data->Jawatan = $request->jawatan;
        $data->Biro = $request->biro;
        $data->Notel = $request->telefon;
        $data->Status = $request->status;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Profil Pentadbiran';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));

        $this->upload('gambarorg', $request->gambar, $data->id, 1);
    }

//
    public function editstruktur($request)
    {
        $search = ProfilPentadbiran::find($request->iddetail);
        $old_value = json_encode($search);

        $search->fk_kampung = $request->idkampung;
        $search->Sesi = $request->tahun;
        $search->NamaAhli = $request->nama;
        $search->NoKP = $request->nokp;
        $search->Jawatan = $request->jawatan;
        $search->Biro = $request->biro;
        $search->Notel = $request->telefon;
        $search->Status = $request->status;
        $search->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Profil Pentadbiran';

        Event::dispatch(new AuditLog(auth()->user()->id, $search->id, $activities, $old_value, json_encode($new_value)));

        $this->upload('gambarorg', $request->gambar, $request->iddetail, 1);
    }//

    public function savekemudahan($request)
    {
        $data = new ProfilKemudahan;
        $data->fk_kampung = $request->idkampung;
        $data->KatKemudahan = $request->catkemudahan;
        $data->JenisKemudahan = $request->jeniskemudahan;
        $data->Bilangan = $request->bil;
        $data->Unit = $request->unit;
        $data->Longitud = $request->longitud;
        $data->Latitud = $request->latitud;
        $data->NamaKemudahan = $request->nama;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Profil Kemudahan';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));

        $this->upload('gambarkemudahan', $request->gambar, $data->id, 2);
    }//

    public function editkemudahan($request)
    {
        $search = ProfilKemudahan::find($request->iddetail);
        $old_value = json_encode($search);

        $search->fk_kampung = $request->idkampung;
        $search->KatKemudahan = $request->catkemudahan;
        $search->JenisKemudahan = $request->jeniskemudahan;
        $search->Bilangan = $request->bil;
        $search->Unit = $request->unit;
        $search->Longitud = $request->longitud;
        $search->Latitud = $request->latitud;
        $search->NamaKemudahan = $request->nama;
        $search->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemkasini Profil Kemudahan';

        Event::dispatch(new AuditLog(auth()->user()->id, $search->id, $activities, $old_value, json_encode($new_value)));

        $this->upload('gambarkemudahan', $request->gambar, $request->iddetail, 2);
    }//

    public function savepencapaian($request)
    {
        $data = new ProfilPencapaian;
        $data->fk_kampung = $request->idkampung;
        $data->Peringkat = $request->peringkat;
        $data->Tahun = $request->tahun;
        $data->Aktiviti = $request->aktiviti;
        $data->Keterangan = $request->keterangan;
        $data->Pencapaian = $request->pencapaian;
        $data->Penganjur = $request->penganjur;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Profil Pencapaian';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));

        //$this->upload('gambarpencapaian',$request->gambar,$data->id,1);
    }

//
    public function editpencapaian($request)
    {
        $search = ProfilPencapaian::find($request->iddetail);
        $old_value = json_encode($search);

        $search->fk_kampung = $request->idkampung;
        $search->Peringkat = $request->peringkat;
        $search->Tahun = $request->tahun;
        $search->Aktiviti = $request->aktiviti;
        $search->Keterangan = $request->keterangan;
        $search->Pencapaian = $request->pencapaian;
        $search->Penganjur = $request->penganjur;
        $search->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemkasini Profil Pencapaian';

        Event::dispatch(new AuditLog(auth()->user()->id, $search->id, $activities, $old_value, json_encode($new_value)));

        //$this->upload('gambarpencapaian',$request->gambar,$data->id,1);
    }

//
    public function upload($folder, $files, $id, $type)
    {

        //$type==1 //struktur
        //$type=2//kemudahan
        //$typw=3//aktiviti
        //type=4 //projek
        //type=5 //galeri

        if ($type == 1) {
            $data = ProfilPentadbiran::find($id);

            $activities = 'Kemkasini Gambar Profil Pentadbiran';
        } elseif ($type == 3) {
            $data = ProfilAktiviti::find($id);
            $activities = 'Kemkasini Gambar Profil Aktiviti';
        } elseif ($type == 4) {
            $data = ProfilProjek::find($id);
            $activities = 'Kemkasini Gambar Profil Projek';
        } elseif ($type == 5) {
            $data = GaleriMast::find($id);
            $activities = 'Kemkasini Gambar Galari';
        } elseif ($type == 6) {
            $data = GaleriDetail::find($id);

            $activities = 'Kemkasini Gambar Galari Detail';
        } elseif ($type == 7) {
            $data = Pemilikanrumah::find($id);
            $activities = 'Kemkasini Gambar Pemilikan Rumah';
        } elseif ($type == 8) {
            $data = ProfilProduk::find($id);

            $activities = 'Kemkasini Gambar Produk';
        } else {
            $data = ProfilKemudahan::find($id);

            $activities = 'Kemkasini Gambar Profil Kemudahan';
        }

      $old_value = data_get($data, 'Gambar_path');

    if ($files != null) {
        
        $date = date('Ymd');
        
        // 1. Tentukan laluan penuh dan URL awam
        $folder_path = public_path('uploads/eperak/'.$folder.'/'.$date);
        
        // 2. Guna fungsi PHP mkdir yang rekursif dan semak kebenaran
        // Argument ke-3 (true) = rekursif
        if (! file_exists($folder_path)) {
            // Kita cuba gunakan mod 0775, tetapi kebenaran Windows tetap dominan
            if (! mkdir($folder_path, 0775, true)) {
                 // JIKA GAGAL, buang ralat yang jelas.
                 throw new \Exception('Failed to create directory: ' . $folder_path . '. Check IIS/Folder Permissions.');
            }
        }

        // 3. Pindahkan fail ke laluan yang sudah disahkan
        $filename = $files->getClientOriginalName();
        $files->move($folder_path, $filename);
        
        // 4. Simpan laluan relatif ke database (BUKAN storage/)
        $shortpath = '/uploads/eperak/'.$folder.'/'.$date.'/'.$filename; 
        
        // Simpan laluan baru
        $data->Gambar_path = $shortpath; 
        $data->filename = $filename; 
        $data->save();

        // ... logik audit log (KEKAL SAMA) ...
    }
}

    public function saveaktiviti($request)
    {
        $data = new ProfilAktiviti;
        $data->fk_kampung = $request->idkampung;
        $data->Peringkat = $request->peringkat;
        $data->Tahun = $request->tahun;
        $data->NamaAktiviti = $request->aktiviti;
        $data->Keterangan = $request->keterangan;
        $data->Penganjur = $request->penganjur;
        $data->Kategori = $request->jenisaktiviti;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Profil Aktiviti';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));

        $this->upload('gambaraktiviti', $request->gambar, $data->id, 3);
    }

//
    public function editaktiviti($request)
    {
        $search = ProfilAktiviti::find($request->iddetail);
        $old_value = json_encode($search);

        $search->fk_kampung = $request->idkampung;
        $search->Peringkat = $request->peringkat;
        $search->Tahun = $request->tahun;
        $search->NamaAktiviti = $request->aktiviti;
        $search->Keterangan = $request->keterangan;
        $search->Penganjur = $request->penganjur;
        $search->Kategori = $request->jenisaktiviti;
        $search->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaksini Profil Aktiviti';

        Event::dispatch(new AuditLog(auth()->user()->id, $search->id, $activities, $old_value, json_encode($new_value)));

        $this->upload('gambaraktiviti', $request->gambar, $request->iddetail, 3);
    }

//
    public function savepengeluar($request)
    {
        $data = new ProfilPengeluar;
        $data->fk_kampung = $request->idkampung;
        $data->NamaSyarikat = $request->nama;
        $data->NamaWakil = $request->namawakil;
        $data->TelNoPejabat = $request->notelpejabat;
        $data->TelNoBimbit = $request->notelbimbit;
        $data->Faks = $request->faks;
        $data->Email = $request->emel;
        $data->MediaSosial = $request->mediasosial;
        $data->LinkMediaSosial = $request->linkmedia;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Profil Pengeluar';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));
    }

//
    public function editpengeluar($request)
    {
        $search = ProfilPengeluar::find($request->iddetail);
        $old_value = json_encode($search);

        $search->fk_kampung = $request->idkampung;
        $search->NamaSyarikat = $request->nama;
        $search->NamaWakil = $request->namawakil;
        $search->TelNoPejabat = $request->notelpejabat;
        $search->TelNoBimbit = $request->notelbimbit;
        $search->Faks = $request->faks;
        $search->Email = $request->emel;
        $search->MediaSosial = $request->mediasosial;
        $search->LinkMediaSosial = $request->linkmedia;
        $search->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaksini Profil Pengeluar';

        Event::dispatch(new AuditLog(auth()->user()->id, $search->id, $activities, $old_value, json_encode($new_value)));
    }

//
    public function saveproduk($request)
    {
        $data = new ProfilProduk;
        $data->fk_kampung = $request->idkampung;
        $data->fk_pengeluar = $request->iddetail;
        $data->NamaProduk = $request->namaproduk;
        $data->Keterangan = $request->keterangan;
        $data->KategoriProduk = $request->catproduk;
        $data->JenisProduk = $request->jenisproduk;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Profil Produk';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));

        $this->upload('gambarproduk', $request->gambar, $data->id, 8);
    }

//
    public function editproduk($request)
    {
        $search = ProfilProduk::find($request->iddetail);
        $old_value = json_encode($search);

        $search->fk_kampung = $request->idkampung;
        $search->fk_pengeluar = $request->pengeluar;
        $search->NamaProduk = $request->namaproduk;
        $search->Keterangan = $request->keterangan;
        $search->KategoriProduk = $request->catproduk;
        $search->JenisProduk = $request->jenisproduk;
        $search->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Profil Produk';

        Event::dispatch(new AuditLog(auth()->user()->id, $search->id, $activities, $old_value, json_encode($new_value)));

        $this->upload('gambarproduk', $request->gambar, $request->iddetail, 8);
    }

    //s
    public function saveprojek($request)
    {
        $data = new ProfilProjek;
        $data->fk_kampung = $request->idkampung;
        $data->Tahun = $request->tahun;
        $data->NamaProjek = $request->namaprojek;
        $data->JenisProjek = $request->jenisprojek;
        $data->Lokasi = $request->lokasi;
        $data->Sumber = $request->sumber;
        $data->Agensi = $request->agensi;
        $data->objektif = $request->objektif;
        $data->keterangan = $request->keterangan;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Profil Projek';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));

        $this->upload('gambarprojek', $request->gambar, $data->id, 4);
    }

//
    public function editprojek($request)
    {
        $search = ProfilProjek::find($request->iddetail);
        $old_value = json_encode($search);
        $search->fk_kampung = $request->idkampung;
        $search->Tahun = $request->tahun;
        $search->NamaProjek = $request->namaprojek;
        $search->JenisProjek = $request->jenisprojek;
        $search->Lokasi = $request->lokasi;
        $search->Sumber = $request->sumber;
        $search->Agensi = $request->agensi;
        $search->objektif = $request->objektif;
        $search->keterangan = $request->keterangan;
        $search->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Profil Projek';

        Event::dispatch(new AuditLog(auth()->user()->id, $search->id, $activities, $old_value, json_encode($new_value)));

        $this->upload('gambarprojek', $request->gambar, $request->iddetail, 4);
    }

//
    public function savegaleri($request)
    {
        $data = new GaleriMast;
        $data->fk_kampung = $request->idkampung;
        $data->Tajuk = $request->tajuk;
        $data->Keterangan = $request->keterangan;
        $data->Status = $request->status;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Galeri';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));

        $this->upload('gambarprojek', $request->gambar, $data->id, 5);
    }

//
    public function editgaleri($request)
    {
        $search = GaleriMast::find($request->iddetail);
        $old_value = json_encode($search);
        $search->fk_kampung = $request->idkampung;
        $search->Tajuk = $request->tajuk;
        $search->Keterangan = $request->keterangan;
        $search->Status = $request->status;
        $search->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Galeri';

        Event::dispatch(new AuditLog(auth()->user()->id, $search->id, $activities, $old_value, json_encode($new_value)));

        $this->upload('gambargaleri', $request->gambar, $request->iddetail, 5);
    }

//
    public function addgaleridetail($request)
    {
        $data = new GaleriDetail;
        $data->fk_galeri_mast = $request->idgalerimast;
        $data->kategori = $request->type;
        $data->status = $request->status;
        $data->url = $request->url;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Galeri Detail';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));

        $this->upload('gambargaleri', $request->gambar, $data->id, 6);
    }

//
    public function editgaleridetail($request)
    {
        $search = GaleriDetail::find($request->idgaleridetailedit);
        $old_value = json_encode($search);
        // $search->fk_galeri_mast=$request->idgalerimast;
        $search->kategori = $request->typeedit;

        if ($request->typeedit == 146) {//url

            $search->gambar_path = null;
            $search->filename = null;
            $search->url = $request->urledit;
        } else {
            $search->url = null;
        }
        $search->status = $request->statusedit;
        $search->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Galeri Detail';

        Event::dispatch(new AuditLog(auth()->user()->id, $search->id, $activities, $old_value, json_encode($new_value)));

        $this->upload('gambargaleri', $request->gambar, $request->idgaleridetailedit, 6);
    }//

    public function cetakprofil($idkampung)
    {
        $cetakprofil = Kampung::with('parlimen', 'dun', 'daerah', 'mukim', 'catpetempatan')
                          ->where('id', $idkampung)->first();

        return $cetakprofil;
    }

    public function saveketuarumah($request)
    {

     //   dd($request->all());

        $ketua = new Pemilikanrumah;
        $ketua->fk_kampung = $request->idkampung;
        $ketua->IdRumah = $this->generateIdRumah($request->idkampung);
        $ketua->AlamatRumah1 = $request->alamat1;
        $ketua->AlamatRumah2 = $request->alamat2;
        $ketua->Poskod = $request->poskod;
        $ketua->StatusMilikan = $request->statusmilik;
        $ketua->JenisRumah = $request->jenisrumah;
        $ketua->JenisBinaan = $request->binaanrumah;
        $ketua->BilTingkat = $request->biltingkat;
        $ketua->BilBilik = $request->bilbilik;
        $ketua->KElektrik = $request->elektirk;
        $ketua->KTelefon = $request->ktel;
        $ketua->KAir = $request->paip;
        $ketua->KInternet = $request->internet;
        $ketua->KAstro = $request->astro;
        $ketua->Longitud = $request->Longitud;
        $ketua->Latitud = $request->Latitud;
        $ketua->StatusSemak = $request->Status1;
        $ketua->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Pemilikan Rumah';

        Event::dispatch(new AuditLog(auth()->user()->id, $ketua->id, $activities, '', json_encode($new_value)));

        $this->upload('gambarrumah', $request->file('gambar'), $ketua->id, 7);

        $data = new Isirumah;
        $data->fk_rumah = $ketua->id;
        $data->IdIsiRumah = $this->generateIdIsiRumah($ketua->id);
        $data->flag_ketua_rumah = 1;
        $data->Nama = $request->name;
        // $data->Umur=$request->umur;
        if ($request->typepengenalan == 150) {//kad pengenalan baru

            if ($request->jauto == 'Perempuan') {
                $data->Jantina = '114';
            } else {
                $data->Jantina = '113';
            }
            $data->NoKP = $request->noic;
            $data->TarikhLahir = date('Y-m-d', strtotime($request->tarikhlahirauto));
        } else {
            $data->Jantina = $request->jantina;
            $data->NoKP = $request->nopengenalan;
           // $data->TarikhLahir = date('Y-m-d', strtotime($request->tarikhlahir));
            // Guna str_replace('/', '-', ...) untuk memastikan format tarikh dibaca dengan betul oleh strtotime, dan simpan dalam YYYY-MM-DD
            $data->TarikhLahir = date('Y-m-d', strtotime(str_replace('/', '-', $request->tarikhlahir)));
        }

        $data->Bangsa = $request->bangsa;
        //$data->Pendapatan = $request->pendapat;
        $data->Pendapatan = str_replace(',', '', $request->pendapat); // PEMBETULAN PENDAPATAN
        $data->PenerimaBantuan = $request->bantuanbulan;
        $data->BantuanLain = $request->bantuanlain;

        $data->Warganegara = $request->wn;
        $data->Agama = $request->agama;
        $data->TarafKahwin = $request->taraf;
        $data->StatusPekerjaan = $request->statuskerja;
        $data->Pekerjaan = $request->kerja;
        $data->TelNo = $request->notel;
        $data->Email = $request->emel;
        $data->JenisPengenalan = $request->typepengenalan;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Isi Rumah';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));
    }

//
    public function editketuarumah($request)
    {
        $ketua = Pemilikanrumah::find($request->ketuaisirumah);
        $old_value = json_encode($ketua);
        $ketua->fk_kampung = $request->idkampung;
        //$ketua->IdRumah=$request->idrumah;
        $ketua->AlamatRumah1 = $request->alamat1;
        $ketua->AlamatRumah2 = $request->alamat2;
        $ketua->Poskod = $request->poskod;
        $ketua->StatusMilikan = $request->statusmilik;
        $ketua->JenisRumah = $request->jenisrumah;
        $ketua->JenisBinaan = $request->binaanrumah;
        $ketua->BilTingkat = $request->biltingkat;
        $ketua->BilBilik = $request->bilbilik;
        $ketua->KElektrik = $request->elektirk;
        $ketua->KTelefon = $request->ktel;
        $ketua->KAir = $request->paip;
        $ketua->KInternet = $request->internet;
        $ketua->KAstro = $request->astro;
        $ketua->Longitud = $request->Longitud;
        $ketua->Latitud = $request->Latitud;
        $ketua->StatusSemak = $request->StatusSemak; //add 24.04.2024
        $ketua->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaksini Pemilikan Rumah';

        Event::dispatch(new AuditLog(auth()->user()->id, $ketua->id, $activities, $old_value, json_encode($new_value)));

        $this->upload('gambarrumah', $request->gambar, $request->ketuaisirumah, 7);

        // $data = new Isirumah;
        $data = Isirumah::find($request->idisirumah);
        $old_value = json_encode($data);
        $data->fk_rumah = $ketua->id;
        // $data->IdIsiRumah=$request->idrumah;
        $data->flag_ketua_rumah = 1;
        $data->NoKP = $request->noic;
        $data->Nama = $request->name;
        // $data->Umur=$request->umur;
        //$data->Jantina=$request->jantina;

        if ($request->typepengenalan == 150) {//kad pengenalan baru

            if ($request->jauto == 'Perempuan') {
                $data->Jantina = '114';
            } else {
                $data->Jantina = '113';
            }
            $data->NoKP = $request->noic;
            $data->TarikhLahir = date('Y-m-d', strtotime($request->tarikhlahirauto));
        } else {
            $data->Jantina = $request->jantina;
            $data->NoKP = $request->nopengenalan;

            if (data_get($data, 'JenisPengenalan') == $request->typepengenalan) {
                $tarikh = $request->tarikhlahir;
            } else {
                $tarikh = $request->tarikhlahiredit;
            }

            $data->TarikhLahir = date('Y-d-m', strtotime($tarikh));
        }

        $data->Bangsa = $request->bangsa;
        $data->Pendapatan = str_replace(',', '', $request->pendapat);
        $data->PenerimaBantuan = $request->bantuanbulan;
        $data->BantuanLain = $request->bantuanlain;
        //$data->TarikhLahir=date("Y-d-m", strtotime($request->tarikhlahir));
        $data->Warganegara = $request->warga;
        $data->Agama = $request->agama;
        $data->TarafKahwin = $request->taraf;
        $data->StatusPekerjaan = $request->statuskerja;
        $data->Pekerjaan = $request->kerja;
        $data->TelNo = $request->notel;
        $data->Email = $request->emel;
        $data->JenisPengenalan = $request->typepengenalan;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaksini Isi Rumah';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, $old_value, json_encode($new_value)));
    }

//
    public function saveahli($request)
    {
        $data = new Isirumah;
        $data->fk_rumah = $request->idrumah;
        $data->IdIsiRumah = $this->generateIdIsiRumah($request->idrumah);
        $data->flag_ketua_rumah = 0;
        //$data->NoKP=$request->noic;
        $data->Nama = $request->name;
        // $data->Umur=$request->umur;
        //$data->Jantina=$request->jantina;
        $data->Bangsa = $request->bangsa;
        $data->Pendapatan = $request->pendapat;
        $data->PenerimaBantuan = $request->bantuanbulan;
        $data->BantuanLain = $request->bantuanlain;
        // $data->TarikhLahir=date("Y-d-m", strtotime($request->tarikhlahir));
        $data->Warganegara = $request->wn;
        $data->Agama = $request->agama;
        $data->TarafKahwin = $request->taraf;
        $data->StatusPekerjaan = $request->statuskerja;
        $data->Pekerjaan = $request->kerja;
        $data->JenisPengenalan = $request->typepengenalan;

        if ($request->typepengenalan == 150) {//kad pengenalan baru

            if ($request->jauto == 'Perempuan') {
                $data->Jantina = '114';
            } else {
                $data->Jantina = '113';
            }
            $data->NoKP = $request->noic;
            $data->TarikhLahir = date('Y-m-d', strtotime($request->tarikhlahirauto));
        } else {
            $data->Jantina = $request->jantina;
            $data->NoKP = $request->nopengenalan;
            $data->TarikhLahir = date('Y-m-d', strtotime($request->tarikhlahir));
        }
        // $data->TelNo=$request->notel;
        // $data->Email=$request->emel;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Tambah Isi Rumah';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, '', json_encode($new_value)));
    }

    public function editahlirumah($request)
    {
        $data = Isirumah::find($request->idahli);
        $old_value = json_encode($data);
        $data->fk_rumah = $request->idrumah;
        //$data->IdIsiRumah='A001';
        $data->flag_ketua_rumah = 0;
        //$data->NoKP=$request->noic;
        $data->Nama = $request->name;
        // $data->Umur=$request->umur;
        //$data->Jantina=$request->jantina;
        $data->Bangsa = $request->bangsa;
        $data->Pendapatan = str_replace(',', '', $request->pendapat);
        $data->PenerimaBantuan = $request->bantuanbulan;
        $data->BantuanLain = $request->bantuanlain;
        //$data->TarikhLahir=date("Y-d-m", strtotime($request->tarikhlahir));
        $data->Warganegara = $request->wn;
        $data->Agama = $request->agama;
        $data->TarafKahwin = $request->taraf;
        $data->StatusPekerjaan = $request->statuskerja;
        $data->Pekerjaan = $request->kerja;
        $data->JenisPengenalan = $request->typepengenalan;

        if ($request->typepengenalan == 150) {//kad pengenalan baru

            if ($request->jauto == 'Perempuan') {
                $data->Jantina = '114';
            } else {
                $data->Jantina = '113';
            }
            $data->NoKP = $request->noic;
            $data->TarikhLahir = date('Y-m-d', strtotime($request->tarikhlahirauto));
        } else {
            $data->Jantina = $request->jantina;
            $data->NoKP = $request->nopengenalan;

            if (data_get($data, 'JenisPengenalan') == $request->typepengenalan) {
                $tarikh = $request->tarikhlahir;
            } else {
                $tarikh = $request->tarikhlahiredit;
            }

            $data->TarikhLahir = date('Y-d-m', strtotime($tarikh));
        }
        // $data->TelNo=$request->notel;
        // $data->Email=$request->emel;
        $data->save();

        $new_value = $request->except(['_token', 'action']);
        $activities = 'Kemaskini Isi Rumah';

        Event::dispatch(new AuditLog(auth()->user()->id, $data->id, $activities, $old_value, json_encode($new_value)));
    }

    public function generateIdRumah($idkampung)
    {
        $jumlah_rumah_kampung = Pemilikanrumah::where('fk_kampung', $idkampung)->count();

        if ($jumlah_rumah_kampung == 0) {
            $idrumah = 1;
        } else {
            $idrumah = $jumlah_rumah_kampung + 1;
        }

        return $idrumah;
    }

    public function generateIdIsiRumah($idrumah)
    {
        $jumlah_isirumah = Isirumah::where('fk_rumah', $idrumah)->count();

        if ($jumlah_isirumah == 0) {
            $idisirumah = 1;
        } else {
            $idisirumah = $jumlah_isirumah + 1;
        }

        return $idisirumah;
    }

    public function cetakKIR($idrumah, $idkampung)
    {
        $cetakKIR = VcetakKIR::selectRaw('IdRumah,alamat,StatusMilikan,JenisRumah,JenisBinaan,BilTingkat,BilBilik,susunan,KElektrikt,KTelefon,KAir,KInternet,KAstro,IdIsiRumah,flag_ketua_rumah,Nama,NoKP,Umur,Pekerjaan,Bantuan,Pendapatan,StatusSemak')
         //$cetakKIR  =vcetaktengah::selectRaw("IdRumah,alamat,StatusMilikan,JenisRumah,JenisBinaan,BilTingkat,BilBilik,susunan,KElektrikt,KTelefon,KAir,KInternet,KAstro,IdIsiRumah,flag_ketua_rumah,Nama,NoKP,Umur,Pekerjaan,Bantuan,Pendapatan,Status")
         ->where('IdRumah', $idrumah)
          ->where('fk_kampung', $idkampung)
          ->orderByRaw('CAST(IdRumah AS int)')
          ->get();

        return $cetakKIR;
    }

    public function cetakkirAll($idkampung)
    {
        $cetakKIR = VcetakKIR::selectRaw('IdRumah,alamat,StatusMilikan,JenisRumah,JenisBinaan,BilTingkat,BilBilik,susunan,KElektrikt,KTelefon,KAir,KInternet,KAstro,IdIsiRumah,flag_ketua_rumah,Nama,NoKP,Umur,Pekerjaan,Bantuan,Pendapatan,StatusSemak')
         //$cetakKIR  =vcetaktengah::selectRaw("IdRumah,alamat,StatusMilikan,JenisRumah,JenisBinaan,BilTingkat,BilBilik,susunan,KElektrikt,KTelefon,KAir,KInternet,KAstro,IdIsiRumah,flag_ketua_rumah,Nama,NoKP,Umur,Pekerjaan,Bantuan,Pendapatan,Status")
         ->where('fk_kampung', $idkampung)
          ->orderByRaw('CAST(IdRumah AS int)')
          ->get();

        return $cetakKIR;
    }

    public function resultsearch($request)
    {
        $parlimen = $request->parlimen;
        $dun = $request->dun;
        $daerah = $request->daerah;
        $mukim = $request->mukim;
        $cat = $request->catpetempatan;
        $kampung = $request->kampung;

        $data = Kampung::with('parlimen', 'dun', 'daerah', 'mukim', 'catpetempatan', 'kampung_rangkaian')
              ->where(function ($query) use ($parlimen) {
                  if ($parlimen != '0') {
                      $query->where('fk_parlimen', '=', $parlimen);
                  } else {
                  }
              })
              ->where(function ($query) use ($dun) {
                  if ($dun != '0') {
                      $query->where('fk_dun', '=', $dun);
                  } else {
                  }
              })
              ->where(function ($query) use ($daerah) {
                  if ($daerah != '0') {
                      $query->where('fk_daerah', '=', $daerah);
                  } else {
                  }
              })
              ->where(function ($query) use ($mukim) {
                  if ($mukim != '0') {
                      $query->where('fk_mukim', '=', $mukim);
                  } else {
                  }
              })
              ->where(function ($query) use ($cat) {
                  if ($cat != '0') {
                      if ($cat == 4) {//kampung tradisional
                          $query->where('KategoriPetempatan', '=', $cat)
                          ->whereNull('IdKampungInduk');
                      } else {
                          $query->where('KategoriPetempatan', '=', $cat);
                      }
                  } else {
                      $query->whereNull('IdKampungInduk');
                  }
              })
              ->where(function ($query) use ($kampung) {
                  if ($kampung != '0') {
                      $query->where('id', '=', $kampung);
                  } else {
                  }
              })
              ->get();

        return $data;
    }
} //end of clas->
