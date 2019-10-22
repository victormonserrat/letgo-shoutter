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

namespace spec\Shoutter\Tweets\Application\Queries;

use PhpSpec\ObjectBehavior;
use Shoutter\Tweets\Application\Queries\ShoutTweetsWithUserName;
use Shoutter\Tweets\Application\Repositories\TweetViews;
use Shoutter\Tweets\Infrastructure\Models\ApiTweetView;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class ShoutTweetsWithUserNameHandlerSpec extends ObjectBehavior
{
    public function let(TweetViews $tweetViews): void
    {
        $this->beConstructedWith($tweetViews);
    }

    public function it_is_a_message_handler(): void
    {
        $this->shouldImplement(MessageHandlerInterface::class);
    }

    public function it_shouts_tweets_with_username(TweetViews $tweetViews): void
    {
        $tweetView = ApiTweetView::with('b0fd1a9e-1918-4c98-8bdf-b7cc632986e9', 'Content');

        $tweetViews->withUserName('username', 1)->willReturn([
            $tweetView,
        ]);

        $tweetView->content = 'CONTENT!';

        $this(new ShoutTweetsWithUserName('username', 1))->shouldReturn([
            $tweetView,
        ]);
    }
}
