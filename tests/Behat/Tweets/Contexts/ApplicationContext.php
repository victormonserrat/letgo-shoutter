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
use Shoutter\Common\Infrastructure\Services\QueryBusInterface;
use Shoutter\Tweets\Application\Exceptions\InvalidQueryLimit;
use Shoutter\Tweets\Application\Models\TweetView;
use Shoutter\Tweets\Application\Queries\ShoutTweetsWithUserName;
use Shoutter\Users\Domain\Exceptions\NotFoundUser;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

final class ApplicationContext implements Context
{
    /** @var QueryBusInterface */
    private $queryBus;

    /** @var TweetView[] */
    private $tweetViews;

    /** @var Exception */
    private $exception;

    public function __construct(QueryBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /** @When /^I shout last (\d+) tweets? from ("[^"]+")$/ */
    public function iShoutLastTweetsFrom(int $limit, string $userName): void
    {
        try {
            $this->tweetViews = $this->queryBus->dispatch(new ShoutTweetsWithUserName(
                $userName,
                $limit
            ));
        } catch (HandlerFailedException $exception) {
            $this->exception = $exception->getPrevious();
        }
    }

    /** @When /^I shout last (\d+) tweets? from invalid username$/ */
    public function iShoutLastTweetsFromInvalidUsername(int $limit): void
    {
        try {
            $this->tweetViews = $this->queryBus->dispatch(new ShoutTweetsWithUserName(
                '    ',
                $limit
            ));
        } catch (HandlerFailedException $exception) {
            $this->exception = $exception->getPrevious();
        }
    }

    /** @Then /^I should see (\d+) shouted tweets?$/ */
    public function iShouldSeeTweetsShouted(int $number): void
    {
        $viewsCount = count($this->tweetViews);

        if ($viewsCount !== $number) {
            throw new Exception("Expected {$number} tweets, received {$viewsCount}.");
        }

        array_walk($this->tweetViews, function (TweetView $tweetView) {
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
        if (!$this->exception instanceof InvalidQueryLimit) {
            throw new Exception('Expected InvalidQueryLimit exception thrown.');
        }
    }

    /** @Then /^I should see it is not found$/ */
    public function iShouldSeeItIsNotFound(): void
    {
        if (!$this->exception instanceof NotFoundUser) {
            throw new Exception('Expected NotFoundUser exception thrown.');
        }
    }
}
