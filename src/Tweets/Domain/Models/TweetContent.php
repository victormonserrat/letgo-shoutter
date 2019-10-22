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

namespace Shoutter\Tweets\Domain\Models;

use Shoutter\Common\Domain\Models\ValueObject;
use Shoutter\Tweets\Domain\Exceptions\InvalidTweetContent;

final class TweetContent extends ValueObject
{
    /** @throws InvalidTweetContent */
    public static function fromString(string $string): self
    {
        $content = trim($string);

        if ($content === '') {
            throw InvalidTweetContent::causeBlank();
        }

        if (strlen($content) > 280) {
            throw InvalidTweetContent::causeLongerThan(280);
        }

        return new self($content);
    }
}
