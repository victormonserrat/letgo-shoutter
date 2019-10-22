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

namespace spec\Shoutter\Tweets\Domain\Models;

use PhpSpec\ObjectBehavior;
use Shoutter\Common\Domain\Models\AggregateRoot;
use Shoutter\Common\Domain\Models\Id;
use Shoutter\Tweets\Domain\Models\TweetContent;

final class TweetSpec extends ObjectBehavior
{
    public function it_is_an_aggregate_root(): void
    {
        $this->shouldHaveType(AggregateRoot::class);
    }

    public function it_has_a_content(): void
    {
        $this->beConstructedThrough('with', [
            Id::fromUuid('b0fd1a9e-1918-4c98-8bdf-b7cc632986e9'),
            TweetContent::fromString('Content'),
        ]);
        $this->content()->shouldBeAnInstanceOf(TweetContent::class);
    }
}
