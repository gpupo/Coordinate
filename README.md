## Coordinate conversion lib

See [Geographic coordinate conversion](http://en.wikipedia.org/wiki/Geographic_coordinate_conversion)

[![Build Status](https://secure.travis-ci.org/gpupo/Coordinate.png?branch=master)](http://travis-ci.org/gpupo/Coordinate)

## Features

* Convert a DMS (Degrees, Minutes, Seconds) coordinate such as W87°43′41″,
into decimal format longitude / latitude


## Usage

```php

<?php

use Gpupo\Coordinate\Conversion;

$conversion = new Conversion;
$dec = $conversion->dmsToDec('42°19\'58"N 87°50\'01"W');

echo $dec['lat']; // output 42,332778

echo $dec['lng'];// output: -87,833611

```

## Install

The recommended way to install is [through composer](http://getcomposer.org).

```JSON
{
    "require": {
        "gpupo/coordinate": "dev-master"
    }
}
```

## Todo

- [ ] Convert a Decimal format into DMS