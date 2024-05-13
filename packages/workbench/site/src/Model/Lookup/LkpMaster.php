<?php

namespace Workbench\Site\Model\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class LkpMaster extends Model
{
    use AutoFilter;
    use AutoSearch;
    use AutoSort;
    use HasFactory;
    use Notifiable;

    /**
     * @var string[]
     */
    protected $table = 'lkp_master';
    // protected $fillable = ['name', 'email', 'username', 'password', 'status', 'timezone','jabatan','jawatan','kategori','notel','email_verified_at'];

    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%'.$value.'%');
    }

    public function scopeOrWhereLike($query, $column, $value)
    {
        return $query->orWhere($column, 'like', '%'.$value.'%');
    }

    public function master()
    {
        return $this->belongsTo('Workbench\Site\Model\Lookup\LkpMaster2', 'parent_id');
    }

    public function getPermalinkAttribute()
    {
        return route('site::lkpmaster.geteditmaster', $this->id);
    }

    public function getDatalinkAttribute()
    {
        return route('site::lkpmaster.listdatalookup', $this->id);
    }
}
