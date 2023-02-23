<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    | 
    | Aquí puede especificar el disco del sistema de archivos predeterminado 
    | que se debe usar por el framework. El disco "local", así como una variedad 
    | de disco basados en la nube están disponibles para su aplicación. ¡Solo almacena!
    |
    | http://www.rephp.com/como-cambiar-la-carpeta-publica-a-public_html-en-laravel-5.html
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    |  JB : Para usar otra ruta establecer 
    |    'root' => public_path('micarpetaenpublic'),     
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],
        'publicbox' => [
            'driver' => 'local',
            //'root' => 'box/imgids', 
            'root' => 'box', 
            'visibility' => 'public',          
        ],
        'pdftemp' => [
            'driver' => 'local',             
            'root' => 'movscond1', 
            'visibility' => 'public',          
        ],
        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],           
        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],
        'uploads' => [
            'driver' => 'local',
            'root'   => public_path('uploads'),
        ],

    ],

];
