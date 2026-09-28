# SPHP

SPHP (*Simplified PHP*) is a tiny configuration file format for PHP.

## Requirements

- PHP >= 8.3

## Documentation

The documentation is not ready yet (not even started, if I'm being honest) but I'll update this README when it is. In the meantime, you can find examples in the [`examples`](examples) directory.

## Usage

Here's a simple use case with the SPHP parser.

```php
use Sphp\Parser;

public function __construct(private Parser $parser) {}

public function something()
{
    // Parse a SPHP string
    $configuration = $this->parser->parse("name: 'My Application'");

    // Parse a SPHP file
    $configuration = $this->parser->parseFile('../path/to/the/file');
}

```

## Installation

```bash
composer require devtrope/sphp
```

## Development

If you want to help build SPHP, run the tests to make sure everything still works. Feel free to add tests as well.

```bash
composer install
vendor/bin/phpunit tests
```