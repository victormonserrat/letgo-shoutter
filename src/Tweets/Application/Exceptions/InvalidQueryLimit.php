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

namespace Shoutter\Tweets\Application\Exceptions;

use LogicException;

final class InvalidQueryLimit extends LogicException
{
    public static function causeLessThan(int $number): self
    {
        return new self("Limit should not be less than {$number}.");
    }

    public static function causeGreaterThan(int $number): self
    {
        return new self("Limit should not be greater than {$number}.");
    }
}
