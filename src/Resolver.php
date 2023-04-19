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

namespace Mezcalito\ImgproxyBundle;

use Mezcalito\ImgproxyBundle\Url\Encoder;
use Mezcalito\ImgproxyBundle\Url\Signer;

readonly class Resolver
{
    public function __construct(
        private string $host,
        private array $presets,
        private Signer $signer,
        private Encoder $encoder,
    ) {
    }

    public function getBrowserPath(string $src, string $presetName): string
    {
        if (!\array_key_exists($presetName, $this->presets)) {
            throw new \InvalidArgumentException(\sprintf('Unknown preset "%s"', $presetName));
        }

        $preset = $this->presets[$presetName];

        $options = \sprintf('resize:%s:%s:%s:1',
            $preset['resize']['mode'],
            $preset['resize']['width'],
            $preset['resize']['height'],
        );

        $separator = '@';
        $source = \str_replace('@', '%40', 'plain/'.$src);
        if ($preset['encode']) {
            $separator = '.';
            $source = $this->encoder->encode($src, true);
        }

        $path = $options.'/'.$source.$separator.$preset['format'];
        $signature = $this->encoder->encode($this->signer->generateSignature($path));

        return $this->host.'/'.$signature.'/'.$path;
    }
}
