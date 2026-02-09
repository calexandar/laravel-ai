<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Ai\Agents\PersonalAssistant;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_personal_assistant(): void
    {
       PersonalAssistant::fake();
       User::factory()->create();

       $response = Artisan::call('test:agent')::make()
        ->prompt('What is the name of one of my subscribers?');

       PersonalAssistant::assertPrompted('What is the name of one of my subscribers?');
    }
}
