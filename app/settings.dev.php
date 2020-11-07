<?php

define('BASE_URL', 'http://localhost:8060/');
define('DATABASE_PATH', __DIR__ . '/../storage/data.sqlite3');
define('UPLOAD_DIRECTORY', __DIR__ . '/../storage/uploads');
define('THUMBNAIL_DIRECTORY', __DIR__ . '/../public/uploads');
define('ROUTER_CACHE_PATH', __DIR__ . '/../storage/var/cache/routes.cache.php');
define('CONTAINER_CACHE_PATH', __DIR__ . '/../storage/var/cache');

use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
  // Global Settings Object
  $containerBuilder->addDefinitions([
    'settings' => [
      'name' => 'slim-letterhead-app',
      'displayErrorDetails' => true, // Should be set to false in production
      'logger' => [
        'name' => 'LHApp',
        'path' => __DIR__ . '/../storage/logs/app.log',
        'level' => 100,
      ],
      'view' => [
        'path' => __DIR__ . '/../src/View',
        'settings' => []// Set ['cache' => __DIR__ . '/../storage/var/cache/views'] in production
      ],
      'auth' => [
        'sessionKey' => 'session_key',
        'login' => 'admin',
        'password' => 'admin',
      ],
      'mailer' => [
        'creds' => [
          'host' => 'smtp1.domena.pl',
          'login' => 'uzytkownik@domena.pl',
          'password' => 'secret_password',
          'username' => 'User Name',
          'port' => 587
        ]
      ]
    ],
  ]);
};