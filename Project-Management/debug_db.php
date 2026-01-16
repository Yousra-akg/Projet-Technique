<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Task Count: " . \App\Models\Task::count() . PHP_EOL;
    
    $service = app(\App\Services\TaskService::class);
    // Mock request correctly
    $request = \Illuminate\Http\Request::create('/', 'GET', ['search' => 'Concevoir']);
    
    $tasks = $service->getTasks($request);
    echo "Filtered Count: " . $tasks->count() . PHP_EOL;
    if ($tasks->count() > 0) {
        echo "First Title: " . $tasks->first()->title . PHP_EOL;
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString();
}
