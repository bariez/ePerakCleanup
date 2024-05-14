<?php

namespace Workbench\Site\Model\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravolt\Support\Traits\AutoFilter;
use Laravolt\Support\Traits\AutoSearch;
use Laravolt\Support\Traits\AutoSort;

class KampungRangkaian extends Model
{
    use AutoFilter;
    use AutoSearch;
    use AutoSort;
    use HasFactory;
    use Notifiable;

    /**
     * @var string[]
     */
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'kampung';
    // protected $fillable = ['name', 'email', 'username', 'password', 'status', 'timezone','jabatan','jawatan','kategori','notel','email_verified_at'];

    // public function parlimen()
    // {
    //     return $this->belongsTo('Workbench\Site\Model\Lookup\Parlimen','fk_parlimen');
    // }
    // public function profil_aktiviti()
    // {
    //     return $this->hasMany('Workbench\Site\Model\Lookup\ProfilAktiviti','fk_kampung');
    // }
}
