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

namespace Shoutter\Common\Infrastructure\Services;

use Symfony\Component\Messenger\Envelope;

interface QueryBusInterface
{
    /**
     * @param object|Envelope $query
     *
     * @return mixed The handler returned value
     */
    public function dispatch($query);
}
