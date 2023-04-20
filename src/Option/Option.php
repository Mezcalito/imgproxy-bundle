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

use function Symfony\Component\String\u;

abstract class Option implements OptionInterface
{
    public function __construct(
        protected readonly array $params,
    ) {
    }

    abstract public function getParts(): array;

    public function resolve(): string
    {
        return \implode(':', [$this->getName(), ...$this->getParts()]);
    }

    public function getName(): string
    {
        $fqcn = \explode('\\', static::class);
        $className = \array_pop($fqcn);

        return u($className)->lower()->snake()->toString();
    }
}
