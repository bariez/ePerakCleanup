<?php

namespace Workbench\Site\Model\Lookup;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class Kampung extends Model
{
    use AutoFilter;
    use AutoSearch;
    use AutoSort;

    // use HasFactory;
    use Notifiable;

    /**
     * @var string[]
     */
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'kampung';
    // protected $fillable = ['name', 'email', 'username', 'password', 'status', 'timezone','jabatan','jawatan','kategori','notel','email_verified_at'];

    public function parlimen()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\Parlimen', 'fk_parlimen');
    }

    public function dun()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\Dun', 'fk_dun');
    }

    public function daerah()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\Daerah', 'fk_daerah');
    }

    public function mukim()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\Mukim', 'fk_mukim');
    }

    public function catpetempatan()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\LkpDetail', 'KategoriPetempatan');
    }

    public function kgtradisonal()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\LkpDetail', 'JenisKgTradisional');
    }

    // -----------------------------
    public function profil_aktiviti()
    {
        return $this->hasMany('Workbench\Site\Model\Lookup\ProfilAktiviti', 'fk_kampung');
    }

    public function profil_pencapaian()
    {
        return $this->hasMany('Workbench\Site\Model\Lookup\ProfilPencapaian', 'fk_kampung');
    }

    public function profil_infra()
    {
        return $this->hasMany('Workbench\Site\Model\Lookup\ProfilKemudahan', 'fk_kampung');
    }

    public function profil_produk()
    {
        return $this->hasMany('Workbench\Site\Model\Lookup\ProfilProduk', 'fk_kampung');
    }

    public function profil_projek()
    {
        return $this->hasMany('Workbench\Site\Model\Lookup\ProfilProjek', 'fk_kampung');
    }

    public function profil_galeri()
    {
        return $this->hasMany('Workbench\Site\Model\Lookup\GaleriMast', 'fk_kampung');
    }

    public function pemilikanrumah()
    {
        return $this->hasMany('Workbench\Site\Model\Lookup\Pemilikanrumah', 'fk_kampung');
    }

    public function kampung_rangkaian()
    {
        return $this->hasMany('Workbench\Site\Model\Lookup\KampungRangkaian', 'IdKampungInduk');
    }

    public function profil_pentadbiran()
    {
        return $this->hasMany('Workbench\Site\Model\Lookup\ProfilPentadbiran', 'fk_kampung');
    }
}
