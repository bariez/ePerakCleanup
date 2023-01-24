<?php

namespace Workbench\Site\Model\Lookup;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GaleriDetail extends Model
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
   protected $table = 'galeri_detail';
    // protected $fillable = ['name', 'email', 'username', 'password', 'status', 'timezone','jabatan','jawatan','kategori','notel','email_verified_at'];

public function galerimast()
{
    return $this->belongsTo('Workbench\Site\Model\Lookup\GaleriMast','fk_galeri_mast');
}
public function type()
{
    return $this->belongsTo('Workbench\Site\Model\Lookup\LkpDetail','kategori');
}

    
}