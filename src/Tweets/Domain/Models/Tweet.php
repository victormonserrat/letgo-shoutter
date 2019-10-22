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

use Shoutter\Common\Domain\Models\AggregateRoot;
use Shoutter\Common\Domain\Models\Id;

final class Tweet extends AggregateRoot
{
    /** @var TweetContent */
    private $content;

    public static function with(Id $id, TweetContent $content): self
    {
        $tweet = new self($id);
        $tweet->content = $content;

        return $tweet;
    }

    public function content(): TweetContent
    {
        return $this->content;
    }
}
