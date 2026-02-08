<?php

namespace App\Ai\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class GiveOneOfMySubscribers implements Tool
{
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): Stringable|string
    {
        return 'Gives one of my subscribers. This tool is useful when you want to share something with one of your subscribers or when you want to ask a subscriber a question.';
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): string
    {
        $subscriberName = ['John', 'Jane', 'Bob', 'Alice', 'Tom'];

        return collect($subscriberName)->random();
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'subscriber_name' => $schema->string()->required(),
        ];
    }
}
