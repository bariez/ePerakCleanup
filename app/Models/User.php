<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravolt\Support\Traits\AutoFilter;
use Laravolt\Support\Traits\AutoSearch;
use Laravolt\Support\Traits\AutoSort;

class User extends \Laravolt\Platform\Models\User
{
    use AutoFilter;
    use AutoSearch;
    use AutoSort;

    // use HasFactory;
    use Notifiable;

    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $fillable = [
        'name', 'email', 'username', 'password',
        'status', 'timezone', 'jabatan', 'jawatan',
        'kategori', 'notel', 'email_verified_at',
        'Ulasan', 'Daerah', 'Mukim', 'Kampung',
    ];

    public function getPermalinkAttribute()
    {
        return route('site::users.edit', $this->id);
    }

    public function getApprovelinkAttribute()
    {
        return route('site::users.approve', $this->id);
    }

    public function getAccesslinkAttribute()
    {
        return route('site::users.accesslog', $this->id);
    }
    //  public function getStatusAttribute($value)
    // {
    //         if($value=='BLOCKED'){
    //           $result = "Gagal";

    //         }elseif($value=='ACTIVE'){

    //           $result = "Aktif";

    //         }elseif($value=='INACTIVE'){

    //           $result = "Tidak Aktif";

    //         }elseif($value=='PENDING'){

    //           $result = "Dalam Proses";

    //         }else{
    //           $result = "Tiada Status";

    //         }
    //         return $result;
    // }
}
