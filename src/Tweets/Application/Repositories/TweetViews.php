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

namespace Shoutter\Tweets\Application\Repositories;

use Shoutter\Tweets\Application\Models\TweetView;

interface TweetViews
{
    /** @return TweetView[] */
    public function withUserName(string $userName, int $limit);
}
