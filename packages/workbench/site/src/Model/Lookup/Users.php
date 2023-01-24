<?php

namespace Workbench\Site\Model\Lookup;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;
use Illuminate\Database\Eloquent\Model;

class Users extends \Laravolt\Platform\Models\User
{
    use AutoFilter;
    use AutoSearch;
    use AutoSort;
    // use HasFactory;
    use Notifiable;

    /**
     * @var string[]
     */

    protected $table = 'users';
    // protected $fillable = ['name', 'email', 'username', 'password', 'status', 'timezone','jabatan','jawatan','kategori','notel','email_verified_at'];

    public function user_role()
    {
        return $this->hasOne('Workbench\Site\Model\Lookup\AclRoleUser','user_id');
    }

    public function daerah()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\Daerah', 'Daerah');
    }

    public function mukim()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\Mukim', 'Mukim');
    }



    
}
