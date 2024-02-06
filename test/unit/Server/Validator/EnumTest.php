<?php

namespace rollun\test\OpenAPI\unit\Server\Validator;

use OpenAPI\Server\Validator\Enum;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    public function testStringCastsToBool(): void
    {
        $validator = new Enum(['allowed' => ['false']]);
        self::assertTrue($validator->isValid(false));
        self::assertEmpty($validator->getMessages());
    }

    public function testDuplications(): void
    {
        $validator = new Enum(['allowed' => ['foo', 'foo']]);
        self::assertTrue($validator->isValid('foo'));
        self::assertEmpty($validator->getMessages());
    }

    public function testStringBoolNotValid(): void
    {
        $validator = new Enum(['allowed' => ['false']]);
        self::assertFalse($validator->isValid('false'));
        self::assertNotEmpty($messages = $validator->getMessages());
        // false converts to empty string since we use implode
        self::assertEquals([
            Enum::INVALID => "The value 'false' not in enum list."
        ],$messages);
    }

    public function testStringCastsToInt()
    {
        $validator = new Enum(['allowed' => ['10']]);
        self::assertTrue($validator->isValid(10));
        self::assertEmpty($validator->getMessages());

        self::assertFalse($validator->isValid('10'));
        self::assertFalse($validator->isValid(20));
        self::assertFalse($validator->isValid('string'));
    }

    public function testStringWithQuotes()
    {
        $validator = new Enum(['allowed' => ["'random'"]]);
        self::assertTrue($validator->isValid("random"));
        self::assertEmpty($validator->getMessages());

        self::assertFalse($validator->isValid('another'));
        self::assertNotEmpty($messages = $validator->getMessages());
        self::assertEquals([
            Enum::INVALID => "The value 'another' not in enum list."
        ],$messages);
    }

    public function testString()
    {
        $validator = new Enum(['allowed' => ["random"]]);
        self::assertTrue($validator->isValid("random"));
        self::assertEmpty($validator->getMessages());

        self::assertFalse($validator->isValid('another'));
        self::assertNotEmpty($messages = $validator->getMessages());
        self::assertEquals([
            Enum::INVALID => "The value 'another' not in enum list."
        ],$messages);
    }
}