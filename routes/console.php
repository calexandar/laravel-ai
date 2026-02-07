<?php

use App\Models\User;
use App\Ai\Agents\PersonalAssistant;
use Illuminate\Support\Facades\Artisan;
use Laravel\Ai\Files\Image;

use function Laravel\Prompts\text;

Artisan::command('test:agent', function() {
    $user = User::query()->first();

    while (true) {
        $promt = text('Prompt:');
        
        $response = PersonalAssistant::make()
        ->continue(conversationId: 'first_conversation', as: $user)
        ->prompt($promt);

        $this->info((string) $response);


    }
});
