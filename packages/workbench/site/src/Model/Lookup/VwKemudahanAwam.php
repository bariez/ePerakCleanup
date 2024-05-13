<?php

namespace Workbench\Site\Model\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class VwKemudahanAwam extends \Laravolt\Platform\Models\User
{
    use AutoFilter;
    use AutoSearch;
    use AutoSort;
    use HasFactory;
    use Notifiable;

    /**
     * @var string[]
     */
    protected $table = 'vw_kemudahan_awam';

    public function daerah()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\Daerah', 'fk_daerah');
    }

    public function mukim()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\Mukim', 'fk_mukim');
    }

    public function profilkemudahan()
    {
        return $this->hasMany('Workbench\Site\Model\Lookup\ProfilKemudahan', 'fk_kampung');
    }

    public function lkp_detail()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\LkpDetail', 'KatKemudahan');
    }
}
