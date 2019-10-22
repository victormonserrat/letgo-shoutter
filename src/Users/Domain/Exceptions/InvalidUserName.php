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

final class InvalidUserName extends DomainException
{
    public static function causeBlank(): self
    {
        return new self('User name can not be blank.');
    }
}
