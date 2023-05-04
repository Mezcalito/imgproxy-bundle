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
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class PresetExtension extends AbstractExtension
{
    public function __construct(
        private readonly Resolver $resolver,
    ) {
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('imgproxy_preset', [$this, 'preset']),
        ];
    }

    public function preset(string $path, string $preset): string
    {
        return $this->resolver->getBrowserPath($path, $preset);
    }
}
