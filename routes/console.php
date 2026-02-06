<?php

use App\Models\User;
use App\Ai\Agents\PersonalAssistant;
use Illuminate\Support\Facades\Artisan;
use Laravel\Ai\Files\Document;

use function Laravel\Prompts\text;

Artisan::command('test:agent', function() {
    $user = User::query()->first();

    while (true) {
        $promt = text('Prompt:');
        
        $response = PersonalAssistant::make()
        ->continue(conversationId: 'first_conversation', as: $user)
        ->prompt(prompt: $promt, attachments: [
            Document::fromStorage(path: 'example.pdf', disk: 'local'),
        ]);

        $this->info((string) $response);
    }
});
