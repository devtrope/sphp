<?php

declare(strict_types=1);

namespace Tests;

use Sphp\Parser;
use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\ConfigurationFormatException;
use Throwable;
use UnexpectedValueException;

final class ParserErrorTest extends TestCase
{
    private Parser $parser;

    public function setUp(): void
    {
        $this->parser = new Parser();
    }

    public function testAnEntryMustHaveAColon(): void
    {
        $this->expectException(ConfigurationFormatException::class);
        $this->parser->parse("name 'Ludens'");
    }

    public function testAnEntryMustHaveAValue(): void
    {
        $this->expectException(ConfigurationFormatException::class);
        $this->parser->parse("name:");
    }

    public function testAnInvalidTokenCannotBeUsedAsValue(): void
    {
        $this->expectException(UnexpectedValueException::class);
        $this->parser->parse("name: @invalid");
    }

    public function testUppercaseBooleanIsNotValid(): void
    {
        $this->expectException(ConfigurationFormatException::class);
        $this->parser->parse("debug: TRUE");
    }

    public function testUppercaseNullIsNotValid(): void
    {
        $this->expectException(ConfigurationFormatException::class);
        $this->parser->parse("value: NULL");
    }

    public function testDuplicatedRootsAreInvalid(): void
    {
        $content = <<<'SPHP'
        name: 'Ludens'
        name: 'SPHP'
        SPHP;

        $this->expectException(ConfigurationFormatException::class);
        $this->parser->parse($content);
    }

    public function testDuplicatedNestedKeysAreInvalid(): void
    {
        $content = <<<'SPHP'
        database:
            host: 'localhost'
            host: 'https://www.example.fr'
        SPHP;

        $this->expectException(ConfigurationFormatException::class);
        $this->parser->parse($content);
    }
}
