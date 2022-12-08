Koko Keyword PHP Client
============

A php client  for the [Koko Keywords API](https://developers.kokocares.org). The client handles caching to ensure very low latency.


## Install

### Ensure that php ffi module is installed
In php.ini make the extention is enabled:

```
extension=ffi
```

### Install php module

Install the module

```
composer require koko/koko-keywords
```

## Usage

Set the `KOKO_KEYWORDS_AUTH` environment to the authentication string provided
by Koko. To get an api key, complete our [sign up form](https://r.kokocares.org/api_signup).

```
export KOKO_KEYWORDS_AUTH=username:password
```

Import the module

```php
include 'vendor/autoload.php';

use Koko\Keywords;

$koko_keywords = new Keywords();
```

You may need to set the environment variable in PHP depending on your setup:

```php
include 'vendor/autoload.php';

putenv("KOKO_KEYWORDS_AUTH=username:password")
use Koko\Keywords;

$koko_keywords = new Keywords();
```

It's recommended to instantiate this once to minimize the overhead of loading
the library.

Then use the `match` function to check whether a query prompt matches a risky
keyword. The function returns a `bool` indicating whether there was a match or
not. The function will raise an exception if there is an issue.

```php
if ($koko_keywords->match("some value", "") {
  // Code if there is a match
}

```

There is one optional params, `filter`, set it to the empty
string if you are not using it.

### Filter
Filter the keyword based on the taxonomy using a colon delimited list of “dimension=value” filters. Omitting a dimension does not filter by that dimension e.g.

```php
$koko_keywords->match("sewerslide", "category=eating,parenting:confidence=1,2")
```

This matches "sewerslide" against eating eating and parenting, with a confidence of 1 and 2 and any intensity (as intensity was omitted).

## Performance
The underlying library is written in Rust and cross-compiled to the four major CPU targets. Regexes are cached based on the cache expiration headers (currently set to an hour). This ensures very low latency and overhead (< 1μs/req).


## Error Handling
The `match` function raises an exception if there is an issue.

## Logging
Minimal log messages are logged to STDERR

## License

```
WWWWWW||WWWWWW
 W W W||W W W
      ||
    ( OO )__________
     /  |           \
    /o o|    MIT     \
    \___/||_||__||_|| *
         || ||  || ||
        _||_|| _||_||
       (__|__|(__|__|
```

(The MIT License)

Copyright (c) 2017 Koko AI Inc. <us@kokocares.org>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the 'Software'), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
