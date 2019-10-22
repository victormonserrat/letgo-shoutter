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

namespace Shoutter\Common\Domain\Exceptions;

use DomainException;

final class InvalidId extends DomainException
{
    public static function causeInvalidUuid(string $uuid): self
    {
        return new self("{$uuid} is not a valid uuid.");
    }
}
