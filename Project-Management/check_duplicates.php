<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tasks = \App\Models\Task::all();
echo "Total Tasks: " . $tasks->count() . PHP_EOL;
foreach ($tasks as $task) {
    echo "ID: {$task->id} - Title: {$task->title}" . PHP_EOL;
}
