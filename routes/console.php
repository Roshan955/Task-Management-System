<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// This example clears out completed tasks older than 30 days.
Artisan::command('tasks:cleanup', function () {
    $oldTasks = Task::where('status', 'Completed')
                    ->where('updated_at', '<', Carbon::now()->subDays(30))
                    ->delete();

    $this->info('Old completed tasks have been removed.');
})->describe('Clear old completed tasks from the database');
