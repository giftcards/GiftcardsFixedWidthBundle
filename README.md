GiftcardsFixedWidthBundle [![Build Status](https://travis-ci.org/giftcards/GiftcardsFixedWidthBundle.svg?branch=master)](https://travis-ci.org/giftcards/GiftcardsFixedWidthBundle)
=========================

Bundle that integrates the [fixed width library](https://github.com/giftcards/FixedWidth) into symfony

Config
------

### Default config ###

```yml
# Default configuration for extension with alias: "giftcards_fixed_width"
giftcards_fixed_width:
    spec_loader:
        paths:                []
        id:                   giftcards.fixed_width.spec_loader
    value_formatter_id:   giftcards.fixed_width.sprintf_value_formatter
```

by default the `Resources/fixed_width` dir inside all registered bundles is added
 to the paths. as well as `app/Resources/{BundleName}/fixed_width/` dirs in the project
 as well as `app/Resources/fixed_width`. you can use the `paths` config above to add aditional
dirs to search for specs.

you can change the service used to load the specs by changing the `id` param.

you can change the value formatter service used by changing the
 `value_formatter_id` config.