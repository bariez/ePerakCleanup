<?php

namespace Workbench\Site\Model\Lookup;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Isirumah extends Model
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
   protected $table = 'isirumah';
   protected $fillable = ['fk_rumah','IdIsiRumah','flag_ketua_rumah','NoKP','Nama','Umur','Jantina','Bangsa','Pendapatan','PenerimaBantuan','BantuanLain','TarikhLahir','Warganegara','Agama','TarafKahwin','StatusPekerjaan','Pekerjaan','TelNo','Email','JenisPengenalan'];
    // protected $fillable = ['name', 'email', 'username', 'password', 'status', 'timezone','jabatan','jawatan','kategori','notel','email_verified_at'];

public function rumah()
{
    return $this->belongsTo('Workbench\Site\Model\Lookup\Pemilikanrumah','fk_rumah');
}

    
}
