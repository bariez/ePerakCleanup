<?php

namespace Workbench\Site\Model\Lookup;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;
use Illuminate\Database\Eloquent\Model;

class LkpDetail extends Model
{
    use AutoFilter;
    use AutoSearch;
    use AutoSort;
    // use HasFactory;
    use Notifiable;

    /**
     * @var string[]
     */
  
   protected $table = 'lkp_detail';
    // protected $fillable = ['name', 'email', 'username', 'password', 'status', 'timezone','jabatan','jawatan','kategori','notel','email_verified_at'];


    public function profil_kemudahan()
    {
        return $this->hasMany('Workbench\Site\Model\Lookup\ProfilKemudahan','KatKemudahan');
    }

    public function profil_projek()
    {
        return $this->hasMany('Workbench\Site\Model\Lookup\ProfilProjek','JenisProjek');
    }

    public function profil_produk()
    {
        return $this->hasMany('Workbench\Site\Model\Lookup\ProfilProduk','KategoriProduk');
    }
    public function product_icon()
    {
        return $this->hasMany('Workbench\Site\Model\Frontend\ProductIcon', 'fk_lkp_detail');
    }

public function scopeWhereLike($query, $column, $value)
{
    return $query->where($column, 'like', '%'.$value.'%');
}

public function scopeOrWhereLike($query, $column, $value)
{
    return $query->orWhere($column, 'like', '%'.$value.'%');
}
public function lkpmaster()
{
    return $this->belongsTo('Workbench\Site\Model\Lookup\LkpMaster','fk_lkp_master');
}
public function getPermalinkAttribute()
{

    return route('site::lkpdetail.geteditkdetail', $this->id);
}




    
}
