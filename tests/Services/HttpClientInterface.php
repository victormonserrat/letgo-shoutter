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

use Symfony\Component\HttpFoundation\Response;

interface HttpClientInterface
{
    public function get(string $uri): void;

    public function post(string $uri, string $json): void;

    public function put(string $uri, string $json = null): void;

    public function delete(string $uri): void;

    public function response(): Response;
}
