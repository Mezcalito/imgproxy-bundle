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

readonly class Signer
{
    private string $key;
    private string $salt;

    public function __construct(string $key, string $salt)
    {
        $this->key = \pack('H*', $key);
        $this->salt = \pack('H*', $salt);
    }

    public function generateSignature(string $path): string
    {
        return Encoder::encode(\hash_hmac('sha256', $this->salt.$path, $this->key, true));
    }
}
