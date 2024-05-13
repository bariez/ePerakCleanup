<?php

namespace Workbench\Site\Model\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class ProfilProjek extends Model
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

    protected $table = 'profil_projek';
    // protected $fillable = ['name', 'email', 'username', 'password', 'status', 'timezone','jabatan','jawatan','kategori','notel','email_verified_at'];

    public function kampung()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\Kampung', 'fk_kampung');
    }

    public function jenisprojek()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\LkpDetail', 'JenisProjek');
    }
}
