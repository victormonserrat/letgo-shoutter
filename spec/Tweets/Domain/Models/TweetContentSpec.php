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
use Shoutter\Common\Domain\Models\ValueObject;
use Shoutter\Tweets\Domain\Exceptions\InvalidTweetContent;

final class TweetContentSpec extends ObjectBehavior
{
    public function it_is_a_value_object(): void
    {
        $this->shouldHaveType(ValueObject::class);
    }

    public function it_can_be_created_from_string(): void
    {
        $this->beConstructedThrough('fromString', ['Content']);
        $this->shouldNotThrow()->duringInstantiation();
    }

    public function it_can_not_be_blank(): void
    {
        $this->beConstructedThrough('fromString', ['    ']);
        $this->shouldThrow(InvalidTweetContent::causeBlank())->duringInstantiation();
    }

    public function it_can_not_have_more_than_280_characters(): void
    {
        $this->beConstructedThrough('fromString', [
            str_repeat('This content has more than 280 characters. ', 7),
        ]);
        $this->shouldThrow(InvalidTweetContent::causeLongerThan(280))->duringInstantiation();
    }

    public function it_is_trimmed(): void
    {
        $this->beConstructedThrough('fromString', ['  Content  ']);
        $this->value()->shouldBe('Content');
    }
}
