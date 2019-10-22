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

namespace Shoutter\Common\Domain\Models;

use Ramsey\Uuid\Uuid;
use Shoutter\Common\Domain\Exceptions\InvalidId;

final class Id extends ValueObject
{
    /** @throws InvalidId */
    public static function fromUuid(string $uuid): self
    {
        if (!Uuid::isValid($uuid)) {
            throw InvalidId::causeInvalidUuid($uuid);
        }

        return new self($uuid);
    }
}
