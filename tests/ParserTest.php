<?php

declare(strict_types=1);

namespace Tests;

use Sphp\Parser;
use PHPUnit\Framework\TestCase;

final class ParserTest extends TestCase
{
    private Parser $parser;

    public function setUp(): void
    {
        $this->parser = new Parser();
    }

    public function testItParsesAnEmptyString(): void
    {
        $this->assertSame([], $this->parser->parse(''));
    }

    public function testItParsesASingleEntry(): void
    {
        $this->assertSame(['name' => 'Ludens'], $this->parser->parse("name: 'Ludens'"));
    }

    public function testItParsesMultipleEntries(): void
    {
        $content = <<<'SPHP'
        name: 'Ludens'
        debug: true
        version: 0.1
        SPHP;

        $this->assertSame([
            'name' => 'Ludens',
            'debug' => true,
            'version' => 0.1
        ], $this->parser->parse($content));
    }

    public function testItParsesStrings(): void
    {
        $content = <<<'SPHP'
        name: 'Ludens'
        description: 'A lightweight PHP Framework'
        SPHP;

        $this->assertSame([
            'name' => 'Ludens',
            'description' => 'A lightweight PHP Framework'
        ], $this->parser->parse($content));
    }

    public function testItParsesIntegers(): void
    {
        $content = <<<'SPHP'
        port: 8080
        workers: 4
        SPHP;

        $this->assertSame([
            'port' => 8080,
            'workers' => 4
        ], $this->parser->parse($content));
    }

    public function testItParsesFloats(): void
    {
        $content = <<<'SPHP'
        version: 1.0
        ratio: 0.75
        SPHP;

        $this->assertSame([
            'version' => 1.0,
            'ratio' => 0.75
        ], $this->parser->parse($content));
    }

    public function testItParsesBooleans(): void
    {
        $content = <<<'SPHP'
        debug: true
        enabled: false
        SPHP;

        $this->assertSame([
            'debug' => true,
            'enabled' => false
        ], $this->parser->parse($content));
    }

    public function testItParsesNull(): void
    {
        $content = <<<'SPHP'
        value: null
        SPHP;

        $this->assertSame([
            'value' => null
        ], $this->parser->parse($content));
    }

    public function testItParsesANestedStructure(): void
    {
        $content = <<<'SPHP'
        database:
          host: 'localhost'
          port: 3306
        SPHP;

        $this->assertSame([
            'database' => [
                'host' => 'localhost',
                'port' => 3306
            ]
        ], $this->parser->parse($content));
    }

    public function testItParsesMultipleLevelOfNesting(): void
    {
        $content = <<<'SPHP'
        database:
          credentials:
            user: 'root'
            password: 'secret'
        SPHP;

        $this->assertSame([
            'database' => [
                'credentials' => [
                    'user' => 'root',
                    'password' => 'secret'
                ]
            ]
        ], $this->parser->parse($content));
    }

    public function testItIgnoresComments(): void
    {
        $content = <<<'SPHP'
        # Application configuration
        name: 'Ludens'
        SPHP;

        $this->assertSame([
            'name' => 'Ludens'
        ], $this->parser->parse($content));
    }

    public function testItIgnoresEmptyLines(): void
    {
        $content = <<<'SPHP'
        name: 'Ludens'

        debug: true

        version: 0.1
        SPHP;

        $this->assertSame([
            'name' => 'Ludens',
            'debug' => true,
            'version' => 0.1
        ], $this->parser->parse($content));
    }

    public function testItCanBeReused(): void
    {
        self::assertSame(['name' => 'first'], $this->parser->parse("name: 'first"));
        self::assertSame(['name' => 'second'], $this->parser->parse("name: 'second"));
    }
}
