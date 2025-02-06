<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

class ChatGPTService
{
    const PROMPT = 'Übersetze das folgende HTML in atx Markdown und übersetze es in Englisch. Gib mir nur das Markdown zurück ohne Einleitungstext und Abschlusstext. Der Text:';

    static public function translateAndMarkdown(string $message) :string
    {
        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => static::PROMPT . "\n" . $message],
            ],
        ]);
        return $result->choices[0]->message->content;
    }
}
