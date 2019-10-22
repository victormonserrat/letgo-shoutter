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

namespace spec\Shoutter\Users\Domain\Models;

use PhpSpec\ObjectBehavior;
use Shoutter\Common\Domain\Models\ValueObject;
use Shoutter\Users\Domain\Exceptions\InvalidUserName;

final class UserNameSpec extends ObjectBehavior
{
    public function it_is_a_value_object(): void
    {
        $this->shouldHaveType(ValueObject::class);
    }

    public function it_can_be_created_from_string(): void
    {
        $this->beConstructedThrough('fromString', ['username']);
        $this->shouldNotThrow()->duringInstantiation();
    }

    public function it_can_not_be_blank(): void
    {
        $this->beConstructedThrough('fromString', ['    ']);
        $this->shouldThrow(InvalidUserName::causeBlank())->duringInstantiation();
    }

    public function it_is_trimmed(): void
    {
        $this->beConstructedThrough('fromString', ['  username  ']);
        $this->value()->shouldBe('username');
    }
}
