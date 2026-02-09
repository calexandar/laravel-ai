<?php

use App\Models\User;
use Laravel\Ai\Image;
use Laravel\Ai\Audio
use Laravel\Ai\agent;
use Laravel\Ai\Files;
use Laravel\Prompts\text;
use App\Ai\Agents\PersonalAssistant;
use Illuminate\Support\Facades\Artisan;
use App\Ai\Tools\GiveOneOfMySubscribers;

use function Symfony\Component\String\s;

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

    $image = Image::of('A guy on attachment driving a lambo')->generate()
                ->attachments([
                    Files\Image::fromPath(storage_path('alex.jpg')),
                ]);
 
    $image->storeAs('image.jpg');

    $this->info('Image generated and stored as image.jpg');
});


Artisan::command('generate:audio', function() {

   $audio = Audio::of('I love coding with Laravel.')
    ->voice('voice-id-or-name')
    ->generate();
 
    $audio->storeAs('audio.mp3');

    $this->info('Audio generated and stored as audio.mp3');
});

Artisan::command('generate:transcript', function() {

  $transcript = Transcription::fromStorage('audio.mp3')->generate(provider: ['gemini', 'xai']);


    $this->info((string) $transcript);
});


