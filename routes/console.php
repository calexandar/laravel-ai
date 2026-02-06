<?php

use App\Ai\Agents\PersonalAssistant;
use Illuminate\Support\Facades\Artisan;

Artisan::command('test:agent', function() {
    $response = (new PersonalAssistant)
    ->prompt('What is my name?');

    $this->info((string) $response);
});
