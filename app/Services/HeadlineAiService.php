<?php
// app/Services/HeadlineAIService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HeadlineAiService
{
    public function rewrite($title)
    {
        $response = Http::withToken(config('services.openai.key'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Rewrite news headlines to maximize clicks. Keep it short, emotional, and urgent.'
                    ],
                    [
                        'role' => 'user',
                        'content' => $title
                    ]
                ],
            ]);

        return $response['choices'][0]['message']['content'] ?? $title;
    }
}