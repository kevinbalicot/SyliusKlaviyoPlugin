<?php

declare(strict_types=1);

namespace Setono\SyliusKlaviyoPlugin\Client;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class RestClient implements RestClientInterface
{
    private HttpClientInterface $httpClient;

    private string $baseUri;

    private string $token;

    private string $revision;

    public function __construct(HttpClientInterface $httpClient, string $baseUri, string $token, string $revision = '2024-05-15')
    {
        $this->httpClient = $httpClient;
        $this->baseUri = rtrim($baseUri, '/');
        $this->token = $token;
        $this->revision = $revision;
    }

    public function get(string $endpoint, array $query = []): ResponseInterface
    {
        $endpoint = trim($endpoint, '/');
        if (str_starts_with($endpoint, 'http')) {
            $url = $endpoint;
        } else {
            $url = sprintf('%s/%s/', $this->baseUri, $endpoint);
        }

        return $this->httpClient->request(
            'GET',
            $url,
            [
                'headers' => $this->getDefaultHeaders(),
                'query' => $query,
            ],
        );
    }

    public function post(string $endpoint, array $data): ResponseInterface
    {
        $endpoint = trim($endpoint, '/');

        return $this->httpClient->request(
            'POST',
            sprintf('%s/%s/', $this->baseUri, $endpoint),
            [
                'headers' => $this->getDefaultHeaders(),
                'json' => $data,
            ],
        );
    }

    public function getDefaultHeaders(): array
    {
        return [
            'Authorization' => sprintf('Klaviyo-API-Key %s', $this->token),
            'Accept' => 'application/json',
            'Revision' => $this->revision,
        ];
    }
}
