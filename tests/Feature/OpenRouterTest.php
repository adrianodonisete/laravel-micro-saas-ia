<?php

use App\Services\OpenRouter;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    config()->set('services.openrouter.key', 'test-key');
    config()->set('services.openrouter.base_url', 'https://openrouter.ai/api/v1');
    config()->set('services.openrouter.model', 'openai/gpt-4o-mini');
    config()->set('services.openrouter.site_url', 'https://example.test');
    config()->set('services.openrouter.app_name', 'Test App');

    Http::preventStrayRequests();
});

it('sends a chat completion request to OpenRouter', function () {
    Http::fake([
        'openrouter.ai/api/v1/chat/completions' => Http::response([
            'choices' => [
                ['message' => ['role' => 'assistant', 'content' => 'pong']],
            ],
        ]),
    ]);

    $response = app(OpenRouter::class)->chat([
        ['role' => 'user', 'content' => 'ping'],
    ]);

    expect($response)->toHaveKey('choices');

    Http::assertSent(function (Request $request) {
        return $request->url() === 'https://openrouter.ai/api/v1/chat/completions'
            && $request->method() === 'POST'
            && $request->hasHeader('Authorization', 'Bearer test-key')
            && $request->hasHeader('HTTP-Referer', 'https://example.test')
            && $request->hasHeader('X-Title', 'Test App')
            && $request['model'] === 'openai/gpt-4o-mini'
            && $request['messages'] === [['role' => 'user', 'content' => 'ping']];
    });
});

it('returns the assistant reply via the reply helper', function () {
    Http::fake([
        'openrouter.ai/*' => Http::response([
            'choices' => [
                ['message' => ['role' => 'assistant', 'content' => 'Olá, mundo!']],
            ],
        ]),
    ]);

    $reply = app(OpenRouter::class)->reply(
        prompt: 'Diga olá',
        system: 'Responda em pt-BR.',
    );

    expect($reply)->toBe('Olá, mundo!');

    Http::assertSent(function (Request $request) {
        return $request['messages'] === [
            ['role' => 'system', 'content' => 'Responda em pt-BR.'],
            ['role' => 'user', 'content' => 'Diga olá'],
        ];
    });
});

it('allows overriding the model per request', function () {
    Http::fake([
        'openrouter.ai/*' => Http::response([
            'choices' => [['message' => ['role' => 'assistant', 'content' => 'ok']]],
        ]),
    ]);

    app(OpenRouter::class)->chat(
        messages: [['role' => 'user', 'content' => 'hi']],
        options: ['model' => 'anthropic/claude-3.5-sonnet', 'temperature' => 0.2],
    );

    Http::assertSent(function (Request $request) {
        return $request['model'] === 'anthropic/claude-3.5-sonnet'
            && $request['temperature'] === 0.2;
    });
});

it('throws a RequestException on HTTP errors', function () {
    Http::fake([
        'openrouter.ai/*' => Http::response(['error' => ['message' => 'unauthorized']], 401),
    ]);

    app(OpenRouter::class)->chat([['role' => 'user', 'content' => 'hi']]);
})->throws(RequestException::class);
