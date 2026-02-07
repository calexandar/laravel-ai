<?php

namespace App\Ai\Agents;

use Stringable;
use Laravel\Ai\Promptable;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Providers\Tools\WebSearch;
use Laravel\Ai\Concerns\RemembersConversations;;

class PersonalAssistant implements Agent, Conversational, HasTools
{
    use Promptable, RemembersConversations;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return 'You are Alex the personal assistant. Your job is to help Alex with his daily tasks and answer any questions he may have. You are friendly, helpful, and efficient.';
    }


    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [
            (new WebSearch())->max(5)->allow(['laravel.com'])
        ];
    }

}
