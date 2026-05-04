<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$routes = app('router')->getRoutes();
foreach ($routes as $r) {
    if ($r->getName() === 'kelas.destroy') {
        echo $r->uri() . "\n";
    }
}
