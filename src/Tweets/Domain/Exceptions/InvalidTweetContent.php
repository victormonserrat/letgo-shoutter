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

namespace Shoutter\Tweets\Domain\Exceptions;

use DomainException;

final class InvalidTweetContent extends DomainException
{
    public static function causeBlank(): self
    {
        return new self('Tweet content can not be blank.');
    }

    public static function causeLongerThan(int $number): self
    {
        return new self("Tweet content can not have more than {$number} characters.");
    }
}
