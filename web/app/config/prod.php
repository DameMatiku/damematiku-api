<?php

// Timezone.
date_default_timezone_set('Europe/Prague');

// Cache
$app['cache.path'] = __DIR__ . '/../cache';

// Emails.
$app['admin_email'] = 'marek.lisy@vcelka.cz';
$app['site_email'] = 'marek.lisy@vcelka.cz';

// Doctrine (db)
$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'host'     => ' uvds199.active24.cz',
    'dbname'   => 'damematiku',
    'user'     => 'damematiku',
    'password' => 'eE8gSLpD',
);