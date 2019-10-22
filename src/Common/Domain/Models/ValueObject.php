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

abstract class ValueObject
{
    /** @var mixed */
    private $value;

    /** @param mixed $value */
    protected function __construct($value)
    {
        $this->value = $value;
    }

    final public function isEqualTo(self $valueObject): bool
    {
        return get_class($valueObject) === get_class($this) && $valueObject->value() === $this->value();
    }

    /** @return mixed */
    final public function value()
    {
        return $this->value;
    }
}
