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

use Mezcalito\ImgproxyBundle\Option\Resize;
use Mezcalito\ImgproxyBundle\Url\Encoder;
use Mezcalito\ImgproxyBundle\Url\Signer;
use Symfony\Component\HttpFoundation\RequestStack;

readonly class Resolver
{
    public function __construct(
        private string $host,
        private ?string $mediaUrl,
        private array $presets,
        private Signer $signer,
        private RequestStack $requestStack,
    ) {
    }

    public function getBrowserPath(string $src, string $presetName): string
    {
        if (!\array_key_exists($presetName, $this->presets)) {
            throw new \InvalidArgumentException(\sprintf('Unknown preset "%s"', $presetName));
        }

        if (!\filter_var($src, \FILTER_VALIDATE_URL)) {
            if (null !== $this->mediaUrl) {
                $src = $this->mediaUrl.'/'.$src;
            } elseif ($request = $this->requestStack->getCurrentRequest()) {
                $src = $request->getHost().$src;
            } else {
                throw new \LogicException('No base URL');
            }
        }

        $preset = $this->presets[$presetName];
        $options = (new Resize($preset['resize']))->resolve();

        $separator = '@';
        $source = \str_replace('@', '%40', 'plain/'.$src);
        if ($preset['encode']) {
            $separator = '.';
            $source = Encoder::encode($src, true);
        }

        $path = $options.'/'.$source.$separator.$preset['format'];
        $signature = $this->signer->generateSignature($path);

        return $this->host.'/'.$signature.'/'.$path;
    }
}
