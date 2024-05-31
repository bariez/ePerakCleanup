<?php

namespace App\Actions;

use Illuminate\Support\Collection;
use Lavary\Menu\Builder as Base;

class MenuBuilder extends Base
{
    public function reset()
    {
        $this->items = new Collection();
    }
}
