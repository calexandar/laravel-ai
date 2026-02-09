<?php

use App\Models\User;
use Laravel\Ai\Image;
use function Laravel\Ai\agent;

use function Laravel\Prompts\text;
use App\Ai\Agents\PersonalAssistant;
use Illuminate\Support\Facades\Artisan;
use App\Ai\Tools\GiveOneOfMySubscribers;

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

Artisan::command('test:tool', function() {
   $response = agent(
    instructions: 'You are a helpful assistant that gives one of the subscribers of the user.',
    messages: [
        text('Give me one of my subscribers.'),
    ],
    tools: [
        new GiveOneOfMySubscribers(),
    ]
   )->prompt('Give me one of my subscribers.');
});

Artisan::command('generate:image', function() {
    $image = Image::of('A donut sitting on the kitchen counter')->generate();
 
    $image->storeAs('image.jpg');
    $this->info('Image generated and stored as image.jpg');
});
