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

namespace Shoutter\Tweets\Application\Queries;

use Shoutter\Tweets\Application\Exceptions\InvalidQueryLimit;
use Shoutter\Tweets\Application\Models\TweetView;
use Shoutter\Tweets\Application\Repositories\TweetViews;
use Shoutter\Users\Domain\Exceptions\NotFoundUser;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class ShoutTweetsWithUserNameHandler implements MessageHandlerInterface
{
    /** @var TweetViews */
    private $tweetViews;

    public function __construct(TweetViews $tweetViews)
    {
        $this->tweetViews = $tweetViews;
    }

    /**
     * @throws InvalidQueryLimit
     * @throws NotFoundUser
     *
     * @return TweetView[]
     */
    public function __invoke(ShoutTweetsWithUserName $query)
    {
        $userName = $query->userName();
        $limit = $query->limit();

        $this->validate($userName, $limit);

        $tweetViews = $this->tweetViews->withUserName($userName, $limit);

        array_walk($tweetViews, function ($tweetView) {
            $upperContent = rtrim(strtoupper($tweetView->content), '.');
            $shoutContent = "{$upperContent}!";
            $tweetView->content = $shoutContent;
        });

        return $tweetViews;
    }

    /**
     * @throws InvalidQueryLimit
     * @throws NotFoundUser
     */
    private function validate(string $userName, int $limit): void
    {
        if ($limit < 1) {
            throw InvalidQueryLimit::causeLessThan(1);
        }

        if ($limit > 10) {
            throw InvalidQueryLimit::causeGreaterThan(10);
        }

        $trimmedUserName = trim($userName);

        if ($trimmedUserName === '' || $trimmedUserName !== $userName) {
            throw NotFoundUser::withName($userName);
        }
    }
}
