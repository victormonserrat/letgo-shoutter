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

namespace Shoutter\Users\Domain\Exceptions;

use DomainException;

final class NotFoundUser extends DomainException
{
    public static function withName(string $name): self
    {
        return new self("User with {$name} name can not be found.");
    }
}
