<?php

namespace Workbench\Site\Model\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

/**
 * @author afif
 **/
class Counter extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    // use SoftDeletes;

    protected $table = 'counter';

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
