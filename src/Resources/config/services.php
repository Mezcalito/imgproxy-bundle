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

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Mezcalito\ImgproxyBundle\Resolver;
use Mezcalito\ImgproxyBundle\Url\Encoder;
use Mezcalito\ImgproxyBundle\Url\Signer;

return static function (ContainerConfigurator $container) {
    $container->services()
        ->set('imgproxy.resolver', Resolver::class)
            ->args([
                abstract_arg('imgproxy host'),
                abstract_arg('imgproxy presets'),
                service('imgproxy.url.signer'),
                service('imgproxy.url.encoder'),
            ])
        ->alias(Resolver::class, 'imgproxy.resolver')

        ->set('imgproxy.url.signer', Signer::class)
            ->args([abstract_arg('Signature key'), abstract_arg('Signature salt')])
        ->alias(Signer::class, 'imgproxy.url.signer')

        ->set('imgproxy.url.encoder', Encoder::class)
        ->alias(Encoder::class, 'imgproxy.url.encoder')
    ;
};
