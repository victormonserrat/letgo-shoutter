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

namespace Shoutter\Tweets\Application\Models;

abstract class TweetView
{
    /** @var string */
    public $id;

    /** @var string */
    public $content;

    abstract public static function with(string $id, string $content): self;
}
