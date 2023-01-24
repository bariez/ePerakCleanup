<?php

namespace Workbench\Site\Model\Lookup;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use AutoFilter;
    use AutoSearch;
    use AutoSort;
    // use HasFactory;
    use Notifiable;

    /**
     * @var string[]
     */
  
   protected $table = 'audit_log';
    // protected $fillable = ['name', 'email', 'username', 'password', 'status', 'timezone','jabatan','jawatan','kategori','notel','email_verified_at'];


public function users()
{
    return $this->belongsTo('Workbench\Site\Model\Lookup\Users','fk_user');
}
    
}
