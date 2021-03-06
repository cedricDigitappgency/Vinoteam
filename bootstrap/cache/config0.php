<?php return array (
  'app' =>
  array (
    'debug' => true,
    'url' => 'http://vino-team.appspot.com/',
    'timezone' => 'UTC',
    'locale' => 'fr',
    'fallback_locale' => 'en',
    'key' => 'PqXMEcgn4xROGjgRXKgjYKtnMzrNHibd',
    'cipher' => 'AES-256-CBC',
    'log' => 'syslog',
    'providers' =>
    array (
      0 => 'Illuminate\\Foundation\\Providers\\ArtisanServiceProvider',
      1 => 'Illuminate\\Auth\\AuthServiceProvider',
      2 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      3 => 'Illuminate\\Bus\\BusServiceProvider',
      4 => 'Illuminate\\Cache\\CacheServiceProvider',
      5 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      6 => 'Illuminate\\Routing\\ControllerServiceProvider',
      7 => 'Illuminate\\Cookie\\CookieServiceProvider',
      8 => 'Illuminate\\Database\\DatabaseServiceProvider',
      9 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      10 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      11 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      12 => 'Illuminate\\Hashing\\HashServiceProvider',
      13 => 'Shpasser\\GaeSupportL5\\Mail\\MailServiceProvider',
      14 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      15 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      16 => 'Shpasser\\GaeSupportL5\\Queue\\QueueServiceProvider',
      17 => 'Illuminate\\Redis\\RedisServiceProvider',
      18 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      19 => 'Illuminate\\Session\\SessionServiceProvider',
      20 => 'Illuminate\\Translation\\TranslationServiceProvider',
      21 => 'Illuminate\\Validation\\ValidationServiceProvider',
      22 => 'Illuminate\\View\\ViewServiceProvider',
      23 => 'App\\Providers\\AppServiceProvider',
      24 => 'App\\Providers\\AuthServiceProvider',
      25 => 'App\\Providers\\EventServiceProvider',
      26 => 'App\\Providers\\RouteServiceProvider',
      27 => 'Cviebrock\\LaravelMangopay\\ServiceProvider',
      28 => 'Shpasser\\GaeSupportL5\\GaeSupportServiceProvider',
    ),
    'aliases' =>
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Input' => 'Illuminate\\Support\\Facades\\Input',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
    ),
  ),
  'auth' =>
  array (
    'driver' => 'eloquent',
    'model' => 'App\\User',
    'table' => 'users',
    'password' =>
    array (
      'email' => 'emails.password',
      'table' => 'password_resets',
      'expire' => 60,
    ),
  ),
  'broadcasting' =>
  array (
    'default' => 'pusher',
    'connections' =>
    array (
      'pusher' =>
      array (
        'driver' => 'pusher',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' =>
        array (
        ),
      ),
      'redis' =>
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' =>
      array (
        'driver' => 'log',
      ),
    ),
  ),
  'cache' =>
  array (
    'default' => 'memcached',
    'stores' =>
    array (
      'apc' =>
      array (
        'driver' => 'apc',
      ),
      'array' =>
      array (
        'driver' => 'array',
      ),
      'database' =>
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' =>
      array (
        'driver' => 'file',
        'path' => storage_path().'/framework/cache',
      ),
      'memcached' =>
      array (
        'driver' => 'memcached',
        'servers' =>
        array (
          0 =>
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' =>
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'laravel',
  ),
  'compile' =>
  array (
    'files' =>
    array (
    ),
    'providers' =>
    array (
    ),
  ),
  'database' =>
  array (
    'fetch' => 8,
    'default' => 'mysql',
    'connections' =>
    array (
      'mysql' =>
      array (
        'driver' => 'mysql',
        'unix_socket' => '/cloudsql/vino-team:europe-west1:vinoteam-sql-1',
        'host' => '',
        'database' => 'vinoteam',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => false,
      ),
      'sqlite' =>
      array (
        'driver' => 'sqlite',
        'database' => base_path().'/database/database.sqlite',
        'prefix' => '',
      ),
      'cloudsql' =>
      array (
        'driver' => 'mysql',
        'host' => '',
        'database' => 'vinoteam-sql-1',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'strict' => false,
      ),
      'pgsql' =>
      array (
        'driver' => 'pgsql',
        'host' => '',
        'database' => 'vinoteam-sql-1',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
      ),
      'sqlsrv' =>
      array (
        'driver' => 'sqlsrv',
        'host' => '',
        'database' => 'vinoteam-sql-1',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' =>
    array (
      'cluster' => false,
      'default' =>
      array (
        'host' => '127.0.0.1',
        'password' => '',
        'port' => '6379',
        'database' => 0,
      ),
    ),
  ),
  'filesystems' =>
  array (
    'default' => 'gae',
    'cloud' => 's3',
    'disks' =>
    array (
      'gae' =>
      array (
        'driver' => 'gae',
        'root' => storage_path().'/app',
      ),
      'local' =>
      array (
        'driver' => 'local',
        'root' => storage_path().'/app',
      ),
      'ftp' =>
      array (
        'driver' => 'ftp',
        'host' => 'ftp.example.com',
        'username' => 'your-username',
        'password' => 'your-password',
      ),
      's3' =>
      array (
        'driver' => 's3',
        'key' => 'your-key',
        'secret' => 'your-secret',
        'region' => 'your-region',
        'bucket' => 'your-bucket',
      ),
      'rackspace' =>
      array (
        'driver' => 'rackspace',
        'username' => 'your-username',
        'key' => 'your-key',
        'container' => 'your-container',
        'endpoint' => 'https://identity.api.rackspacecloud.com/v2.0/',
        'region' => 'IAD',
        'url_type' => 'publicURL',
      ),
    ),
  ),
  'mail' =>
  array (
  "driver" => "smtp",
  "host" => "SSL0.OVH.NET",
  "port" => 587,
  "from" => array(
      "address" => "admin@vino-team.appspotmail.com",
      "name" => "VinoTeam"
  ),
  "username" => "d.arnalis@digitappgency.com",
  "password" => "Uv48SCgr6",
  "sendmail" => "/usr/sbin/sendmail -bs",
  "pretend" => false
  ),
  'mangopay' =>
  array (
    'key' => 'digitappgency',
  ),
  'queue' =>
  array (
    'default' => 'gae',
    'connections' =>
    array (
      'gae' =>
      array (
        'driver' => 'gae',
        'queue' => 'default',
        'url' => '/tasks',
        'encrypt' => true,
      ),
      'sync' =>
      array (
        'driver' => 'sync',
      ),
      'database' =>
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'expire' => 60,
      ),
      'beanstalkd' =>
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'ttr' => 60,
      ),
      'sqs' =>
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'queue' => 'your-queue-url',
        'region' => 'us-east-1',
      ),
      'iron' =>
      array (
        'driver' => 'iron',
        'host' => 'mq-aws-us-east-1.iron.io',
        'token' => 'your-token',
        'project' => 'your-project-id',
        'queue' => 'your-queue-name',
        'encrypt' => true,
      ),
      'redis' =>
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'expire' => 60,
      ),
    ),
    'failed' =>
    array (
      'database' => 'cloudsql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' =>
  array (
    'mailgun' =>
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'mandrill' =>
    array (
      'secret' => NULL,
    ),
    'ses' =>
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'stripe' =>
    array (
      'model' => 'App\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
    'mangopay' =>
    array (
      'env' => 'sandbox',
      'key' => 'digitappgency',
      'secret' => 'TFDL8WpADa29MR5QJZh6aTNzmT5ViC0wzCokXxdv2vZbTNWBR5',
    ),
  ),
  'session' =>
  array (
    'driver' => 'memcached',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => storage_path().'/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'lottery' =>
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
  ),
  'view' =>
  array (
    'paths' =>
    array (
      0 => base_path().'/resources/views',
    ),
    'compiled' => storage_path().'/framework/views',
  ),
  'vinoteam' =>
  array (
    'noreplay_email' => 'no-reply@vinoteam.fr',
    'sitename' => 'VinoTeam',
  ),
);
