<?php 
namespace Workbench\Site\Model\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;
use Illuminate\Database\Eloquent\Model;

/**
 *
 * @package 
 * @author afif
 **/
class Hubungi extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    // use SoftDeletes;

    protected $table = 'contact_us';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/

} // END class  
