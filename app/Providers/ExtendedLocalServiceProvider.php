<?php
namespace App\Providers;

use App\Filesystem\Plugins\ZipExtractTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class ExtendedLocalServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Storage::extend('local', function($app, $config) {
            return Storage::createLocalDriver($config)->addPlugin(new ZipExtractTo());
        });
    }
}