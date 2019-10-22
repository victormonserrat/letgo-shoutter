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

namespace Shoutter\Users\Domain\Models;

use Shoutter\Common\Domain\Models\ValueObject;
use Shoutter\Users\Domain\Exceptions\InvalidUserName;

final class UserName extends ValueObject
{
    /** @throws InvalidUserName */
    public static function fromString(string $string): self
    {
        $name = trim($string);

        if ($name === '') {
            throw InvalidUserName::causeBlank();
        }

        return new self($name);
    }
}
