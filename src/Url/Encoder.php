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

namespace Mezcalito\ImgproxyBundle\Url;

class Encoder
{
    private const SPLIT_SIZE = 16;

    public static function encode(string $raw, bool $split = false): string
    {
        $result = \rtrim(\strtr(\base64_encode($raw), '+/', '-_'), '=');

        if ($split) {
            $result = \wordwrap($result, self::SPLIT_SIZE, '/', true);
        }

        return $result;
    }
}
