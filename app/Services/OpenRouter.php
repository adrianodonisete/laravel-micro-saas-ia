<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class OpenRouter
{
    public function __construct(
        protected ?string $apiKey = null,
        protected ?string $baseUrl = null,
        protected ?string $defaultModel = null,
    ) {
        $this->apiKey ??= config('services.openrouter.key');
        $this->baseUrl ??= config('services.openrouter.base_url');
        $this->defaultModel ??= config('services.openrouter.model');
    }

    /**
     * Send a chat completion request and return the decoded payload.
     *
     * @param  array<int, array{role: string, content: string}>  $messages
     * @param  array<string, mixed>  $options  Extra OpenRouter parameters (model, temperature, max_tokens, stream, ...).
     * @return array<string, mixed>
     *
     * @throws RequestException
     */
    public function chat(array $messages, array $options = []): array
    {
        return $this->client()
            ->post('/chat/completions', [
                'model' => $options['model'] ?? $this->defaultModel,
                'messages' => $messages,
                ...$options,
            ])
            ->throw()
            ->json();
    }

    /**
     * Convenience helper: send a single user prompt and return the assistant's text reply.
     *
     * @throws RequestException
     */
    public function reply(string $prompt, ?string $system = null, array $options = []): string
    {
        $messages = [];

        if ($system !== null) {
            $messages[] = ['role' => 'system', 'content' => $system];
        }

        $messages[] = ['role' => 'user', 'content' => $prompt];

        return (string) data_get($this->chat($messages, $options), 'choices.0.message.content', '');
    }

    protected function client(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl)
            ->withToken($this->apiKey)
            ->acceptJson()
            ->asJson()
            ->withHeaders(array_filter([
                'HTTP-Referer' => config('services.openrouter.site_url'),
                'X-Title' => config('services.openrouter.app_name'),
            ]))
            ->timeout((int) config('services.openrouter.timeout', 60))
            ->connectTimeout((int) config('services.openrouter.connect_timeout', 10))
            ->retry(2, 200, throw: false);
    }
}
