<?php

/*
 * This file is part of the Shoutter package.
 *
 * (c) Victor Monserrat.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Shoutter\Tests\Services;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class HttpClient implements HttpClientInterface
{
    private const HEADERS = [
        'CONTENT_TYPE' => 'application/json',
        'HTTP_ACCEPT' => 'application/json',
    ];

    /** @var KernelBrowser */
    private $client;

    public function __construct(KernelBrowser $client)
    {
        $this->client = $client;
    }

    public function get(string $uri): void
    {
        $this->client->request(Request::METHOD_GET, $uri, [], [], self::HEADERS);
    }

    public function post(string $uri, string $json): void
    {
        $this->client->request(Request::METHOD_POST, $uri, [], [], self::HEADERS, $json);
    }

    public function put(string $uri, string $json = null): void
    {
        $this->client->request(Request::METHOD_PUT, $uri, [], [], self::HEADERS, $json);
    }

    public function delete(string $uri): void
    {
        $this->client->request(Request::METHOD_DELETE, $uri, [], [], self::HEADERS);
    }

    public function response(): Response
    {
        return $this->client->getResponse();
    }
}
