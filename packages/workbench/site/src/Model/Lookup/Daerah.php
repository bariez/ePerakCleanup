<?php

namespace Workbench\Site\Model\Lookup;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class Daerah extends Model
{
    use AutoFilter;
    use AutoSearch;
    use AutoSort;

    // use HasFactory;
    use Notifiable;

    /**
     * @var string[]
     */
    protected $table = 'daerah';
    // protected $fillable = ['name', 'email', 'username', 'password', 'status', 'timezone','jabatan','jawatan','kategori','notel','email_verified_at'];

    /**
     * hasone/hasmany
     *
     * @return void
     * @author
     **/
    public function user()
    {
        // return $this->hasMany('Workbench\Site\Model\Lookup\Users', 'Daerah');
        return $this->hasOne('Workbench\Site\Model\Lookup\Users', 'Daerah');
    }
}
