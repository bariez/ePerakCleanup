<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Permission extends Enum
{
    // sample permission
    // const POST_MANAGE = 'post.manage';

    const MANAGE_AUDIT_LOG = 'audit.log';
    const MANAGE_SYSTEM = 'laravolt::manage-app-system';
    const MANAGE_FRONT_END = 'laravolt::manage-app-front-end';
    const MANAGE_DATA_ENTRY = 'laravolt::manage-app-data-entry';
    const MANAGE_DASHBOARD = 'laravolt::manage-app-dashboard';
    const MANAGE_GIS = 'laravolt::manage-app-gis';
    const MANAGE_LAPORAN = 'laravolt::manage-app-laporan';
    // const MANAGE_LOKASI = 'laravolt::manage-lokasi';

}
