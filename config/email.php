<?php

return [
    'white-list-domains' => explode(',', env('EMAIL_WHITELIST_DOMAIN', 'gmail.com,yahoo.com')),
];
