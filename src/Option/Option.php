<?php

declare(strict_types=1);

/*
 * This file is part of the Mezcalito ImgproxyBundle.
 *
 * (c) Mezcalito <dev@mezcalito.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mezcalito\ImgproxyBundle\Option;

abstract class Option implements OptionInterface
{
    public function __construct(
        protected readonly array $params,
    ) {
    }

    public function getParts(): array
    {
        return $this->params;
    }

    public function resolve(): string
    {
        $result = $this->getName();
        foreach ($this->getParts() as $part) {
            if (\is_bool($part)) {
                $result .= ':'.($part ? 'true' : 'false');
            } else {
                $result .= ':'.$part;
            }
        }

        return $result;
    }

    public function getName(): string
    {
        $fqcn = \explode('\\', static::class);
        $className = \array_pop($fqcn);

        return \strtolower(\preg_replace('/(?<!^)[A-Z]/', '_$0', $className));
    }
}
