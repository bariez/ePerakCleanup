<?php

namespace Workbench\Site\Model\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class VwKampungRumah extends \Laravolt\Platform\Models\User
{
    use AutoFilter;
    use AutoSearch;
    use AutoSort;
    use HasFactory;
    use Notifiable;

    /**
     * @var string[]
     */
    protected $table = 'vw_kampungrumah';
    // protected $fillable = ['name', 'email', 'username', 'password', 'status', 'timezone','jabatan','jawatan','kategori','notel','email_verified_at'];

    public function daerah()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\Daerah', 'fk_daerah');
    }

    public function mukim()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\Mukim', 'fk_mukim');
    }

    public function pemilikanrumah()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\Pemilikanrumah', 'fk_kampung');
    }
}
