<?php

namespace App\Services;

use App\Models\Item;
use OpenAI\Laravel\Facades\OpenAI;

class ChatGPTService
{
    const PROMPT = 'Übersetze das folgende HTML in atx Markdown und übersetze es in Englisch. Gib mir nur das Markdown zurück ohne Einleitungstext und Abschlusstext. Der Text:';

    static public function translateAndMarkdown(string $title, string $message) :array
    {
        $title = self::prompt("Translate the following text into english:\n" . $title);
        $story = self::prompt(static::PROMPT . "\n" . $message);

        return [
            'title' => $title,
            'story' => $story,
        ];
    }

    static public function optimizeItem(Item $item, string $comment): void
    {
        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => "Optimiere folgende vorhandene UserStory anhand eines Kommentars. Gib mir nur das Markdown zurück ohne Einleitungstext und Abschlusstext."],
                ['role' => 'user', 'content' => "Die UserStory: " . $item->story],
                ['role' => 'user', 'content' => "Das Kommentar: " . $comment],
            ],
        ]);

        $item->story = $result->choices[0]->message->content;
        $item->translated = self::translateAndMarkdown($item->title, $item->story);
        $item->save();
    }

    static private function prompt(string $prompt) :string
    {
        $result = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);
        \Log::info(print_r($result, 1));
        return $result->choices[0]->message->content;
    }
}
