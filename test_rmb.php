<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$kelas = \App\Models\Kelas::first();
echo "Kelas ID: " . $kelas->id . "\n";

$request = Illuminate\Http\Request::create('/kelas/' . $kelas->id, 'DELETE');
// bypass CSRF for testing
$app->make(\Illuminate\Contracts\Http\Kernel::class)->pushMiddleware(\Illuminate\Session\Middleware\StartSession::class);
$request->setSession($app->make('session.store'));
$request->session()->put('_token', 'test');
$request->headers->set('X-CSRF-TOKEN', 'test');

// We need to bypass auth, so let's just create a route manually that uses the controller to test binding
$router = app('router');
$route = $router->getRoutes()->match($request);
echo "Matched Route: " . $route->getName() . "\n";
echo "Parameter names: " . implode(', ', $route->parameterNames()) . "\n";

$controller = $app->make(\App\Http\Controllers\KelasController::class);
try {
    $controller->destroy($kelas);
    echo "Destroy called directly successfully\n";
} catch (\Exception $e) {
    echo "Direct call failed: " . $e->getMessage() . "\n";
}
