<?php

use App\Models\User;
use App\Ai\Agents\PersonalAssistant;
use Illuminate\Support\Facades\Artisan;

use function Laravel\Prompts\text;

Artisan::command('test:agent', function() {
    $user = User::query()->first();
    
    while (true) {
        $promt = text('Prompt:');
        
        $response = PersonalAssistant::make()
        ->continue(conversationId: 'first_conversation', as: $user)
        ->prompt(prompt: $promt);

        $this->info((string) $response);
    }
});
