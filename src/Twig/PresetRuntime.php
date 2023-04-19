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

namespace Mezcalito\ImgproxyBundle\Twig;

use Mezcalito\ImgproxyBundle\Resolver;
use Twig\Extension\RuntimeExtensionInterface;

readonly class PresetRuntime implements RuntimeExtensionInterface
{
    public function __construct(
        private Resolver $resolver,
    ) {
    }

    public function preset(string $path, string $preset): string
    {
        return $this->resolver->getBrowserPath($path, $preset);
    }
}
