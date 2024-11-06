<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Events\TestEvent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class TestComand extends Command{
    
    protected $signature = 'app:test-comand';
    
    protected $description = 'Command description';
    
    public function handle(){
        
        Log::info('test_Event_TestComand');
        TestEvent::dispatch();
    }
}
