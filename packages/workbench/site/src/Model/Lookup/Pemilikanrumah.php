<?php

namespace Workbench\Site\Model\Lookup;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravolt\Support\Traits\AutoFilter;
use Laravolt\Support\Traits\AutoSearch;
use Laravolt\Support\Traits\AutoSort;

class Pemilikanrumah extends Model
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

    protected $table = 'pemilikanrumah';

    protected $fillable = ['fk_kampung', 'IdRumah', 'AlamatRumah1', 'AlamatRumah2', 'Poskod', 'StatusMilikan', 'JenisRumah', 'JenisBinaan', 'BilTingkat', 'BilBilik', 'KElektrik', 'KTelefon', 'KAir', 'KInternet', 'KAstro', 'Longitud', 'Latitud'];

    public function kampung()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\Kampung', 'fk_kampung');
    }
}
