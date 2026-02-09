<?php

namespace App\Ai\Agents;

use Stringable;
use Laravel\Ai\Promptable;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Attributes\MaxSteps;
use Laravel\Ai\Attributes\MaxTokens;
use Laravel\Ai\Attributes\Temperature;
use App\Ai\Tools\GiveOneOfMySubscribers;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Concerns\RemembersConversations;;



#[MaxSteps(10)]
#[MaxTokens(4096)]
#[Temperature(0.7)]
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
            new GiveOneOfMySubscribers(),
        ];
    }

}
