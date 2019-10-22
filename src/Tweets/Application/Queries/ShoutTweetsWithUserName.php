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

namespace Shoutter\Tweets\Application\Queries;

final class ShoutTweetsWithUserName
{
    /** @var string */
    private $userName;

    /** @var int */
    private $limit;

    public function __construct(string $userName, int $limit)
    {
        $this->userName = $userName;
        $this->limit = $limit;
    }

    public function userName(): string
    {
        return $this->userName;
    }

    public function limit(): int
    {
        return $this->limit;
    }
}
