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

namespace Shoutter\Tests\Behat\Tweets\Contexts;

use Behat\Behat\Context\Context;
use Exception;
use Shoutter\Tests\Services\HttpClientInterface;

final class ApiContext implements Context
{
    /** @var HttpClientInterface */
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /** @When /^I shout last (\d+) tweets? from ("[^"]+")$/ */
    public function iShoutLastTweetsFrom(int $limit, string $userName): void
    {
        $this->client->get("/users/{$userName}/tweets?limit={$limit}");
    }

    /** @When /^I shout last (\d+) tweets? from invalid username$/ */
    public function iShoutLastTweetsFromInvalidUsername(int $limit): void
    {
        $this->client->get("/users/    /tweets?limit={$limit}");
    }

    /** @Then /^I should see (\d+) shouted tweets?$/ */
    public function iShouldSeeTweetsShouted(int $number): void
    {
        $content = json_decode($this->client->response()->getContent());
        $tweetsCount = count($content);

        if ($tweetsCount !== $number) {
            throw new Exception("Expected {$number} tweets, received {$tweetsCount}.");
        }

        array_walk($content, function ($tweetView) {
            if (
                strtoupper($tweetView->content) !== $tweetView->content ||
                substr($tweetView->content, -1) !== '!'
            ) {
                throw new Exception('Expected shouted tweets, received unshouted.');
            }
        });
    }

    /** @Then /^I should see it is not possible$/ */
    public function iShouldSeeItIsNotPossible(): void
    {
        if ($this->client->response()->getStatusCode() !== 400) {
            throw new Exception('Expected Bad Request response.');
        }
    }

    /** @Then /^I should see it is not found$/ */
    public function iShouldSeeItIsNotFound(): void
    {
        if ($this->client->response()->getStatusCode() !== 404) {
            throw new Exception('Expected Not Found response.');
        }
    }
}
