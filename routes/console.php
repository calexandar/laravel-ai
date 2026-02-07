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
        
        $stream = PersonalAssistant::make()
        ->continue(conversationId: 'first_conversation', as: $user)
        ->stream($promt);

       foreach ($stream as $message) {
            echo $message->content();
        }
    }
});
