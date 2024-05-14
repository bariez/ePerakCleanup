<?php

namespace Workbench\Site\Model\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravolt\Support\Traits\AutoFilter;
use Laravolt\Support\Traits\AutoSearch;
use Laravolt\Support\Traits\AutoSort;

/**
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
