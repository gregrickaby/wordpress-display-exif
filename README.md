# WordPress Display Exif

Display image Exif data via shortcode.

![screenshot](https://dl.dropbox.com/s/rxc2lzpcqwkyiqh/Screenshot%202020-06-23%2020.41.48.png?dl=0)

*Note: WordPress doesn't save location or lens data, but you can pass that in as an argument.*

## Arguments

- **id** - (string/int) Required. The image ID. Can be found in the Media Library.
- **location** - (string) Optional. Any location. HTML allowed.
- **lens** - (string) Optional. Any lens. HTML allowed.

## Usage

Add the shortcode function to `functions.php`, and then use `[exif id="12345"]` on any post or page to display exif data.

```php
[exif id="12345" location="Anytown, USA" lens="Panasonic G Vario 45-150mm"]
```

## Find Image ID

Open any image in the Media Library, and the ID is in the address bar: 

![screenshot](https://dl.dropbox.com/s/mlr21rhs7pu1l0e/Screenshot%202020-06-23%2020.44.22.png?dl=0)
