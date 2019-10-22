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

namespace Shoutter\Common\Domain\Models;

abstract class Entity
{
    /** @var Id */
    private $id;

    protected function __construct(Id $id)
    {
        $this->id = $id;
    }

    final public function isTheSameAs(self $entity): bool
    {
        return $entity->id()->isEqualTo($this->id());
    }

    final public function id(): Id
    {
        return $this->id;
    }
}
