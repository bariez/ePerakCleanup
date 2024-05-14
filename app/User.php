<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Laravolt\Platform\Models\User as Authenticatable;
use Laravolt\Support\Traits\AutoFilter;
use Laravolt\Support\Traits\AutoSort;
use NotificationChannels\WebPush\HasPushSubscriptions;

class User extends Authenticatable
{
    use AutoSort;
    use AutoFilter;
    use Notifiable;
    use HasPushSubscriptions;
}
