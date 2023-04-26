# imgproxy Bundle

This bundle provides [imgproxy](https://imgproxy.net/) integration for
[Symfony](https://symfony.com/) based projects.

## Installation

Run this command in your terminal:

```bash
composer require mezcalito/imgproxy-bundle
```

If you don't use Symfony Flex, you must enable the bundle manually in the
application:

```php
<?php

return [
    // ...
    Mezcalito\ImgproxyBundle\ImgproxyBundle::class => ['all' => true]
];
```

## Basic Usage

This bundle works by applying presets on images, from template or from your
code. Your presets are defined within the application's configuration file
(`/config/packages/imgproxy.yaml`).

At the moment, there is only one preset available with this bundle: the
`resize` preset. More possibilities will be added later.

To use this bundle, create the following file:

```yaml
# config/packages/imgproxy.yaml

imgproxy:
    host: localhost
    media_url: https://media.localhost

    # set the same key and salt in imgproxy environment (https://docs.imgproxy.net/signing_the_url)
    signature:
        key: c27f2c1d
        salt: fa242e79

    # default settings applied for all presets
    default_preset_settings:
        format: webp
        encode: true

    presets:
        # this is a preset example with all the configuration available
        png_thumbnail:
            format: png
            resize:
                resizing_type: fit
                width: 150
                height: 75
                enlarge: true
                extend:
                    extend: true
                    gravity:
                        type: no
                        x_offset: 10
                        y_offset: 10
```

Then, you can use your preset in your templates:

```html
<img src="{{ asset('/relative/path/to/image.jpg') | imgproxy_preset('png_thumbnail') }}" />
```

## Issues and feature requests

Please report issues and request features
at https://github.com/mezcalito/imgproxy-bundle/issues.

## License

This bundle is under the MIT license. For the whole copyright, see
the [LICENSE](LICENSE) file distributed with this source code.
