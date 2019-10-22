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

namespace spec\Shoutter\Common\Domain\Models;

use PhpSpec\ObjectBehavior;
use Shoutter\Common\Domain\Exceptions\InvalidId;
use Shoutter\Common\Domain\Models\ValueObject;

final class IdSpec extends ObjectBehavior
{
    public function it_is_a_value_object(): void
    {
        $this->shouldHaveType(ValueObject::class);
    }

    public function it_can_be_created_from_uuid(): void
    {
        $this->beConstructedThrough('fromUuid', ['b0fd1a9e-1918-4c98-8bdf-b7cc632986e9']);
        $this->shouldNotThrow()->duringInstantiation();
    }

    public function it_can_not_be_created_from_invalid_uuid(): void
    {
        $this->beConstructedThrough('fromUuid', ['invalidUuid']);
        $this->shouldThrow(InvalidId::causeInvalidUuid('invalidUuid'))->duringInstantiation();
    }
}
