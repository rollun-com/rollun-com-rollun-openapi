<?php

namespace rollun\test\OpenAPI\functional;

use Laminas\ServiceManager\ServiceManager;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use rollun\dic\InsideConstruct;

/**
 * У Функциональных тестов APP_ENV = 'test' согласно phpunit.xml
 *
 * @package rollun\test\Functional
 */
class FunctionalTestCase extends PHPUnitTestCase
{
    private static string $localServerPid;

    /**
     * @var ServiceManager|null
     */
    private $container = null;

    protected function getContainer(): ServiceManager
    {
        if ($this->container === null) {
            $this->container = require __DIR__ . '/../../config/container.php';
            InsideConstruct::setContainer($this->container);
        }

        return $this->container;
    }

    protected static function php(string $args): string|false
    {
        return exec(static::getPhpBinaryPath() . ' ' . $args);
    }

    public static function setUpBeforeClass(): void
    {
        if (self::shouldRunLocalServer()) {
            static::runLocalServer();
        }
    }

    private static function runLocalServer(): void
    {
        $result = static::php('-S localhost:8001 public/index.php 1>/dev/null & echo $!');
        if ($result === false) {
            throw new \RuntimeException('Cannot start local server.');
        }
        self::$localServerPid = $result;
    }

    public static function tearDownAfterClass(): void
    {
        if (self::shouldRunLocalServer()) {
            static::stopLocalServer();;
        }
    }

    private static function stopLocalServer(): void
    {
        exec('kill -9 ' . self::$localServerPid);
    }

    protected static function shouldRunLocalServer(): bool
    {
        return getenv('IS_DOCKER') != 1;
    }

    protected static function getPhpBinaryPath(): string
    {
        return PHP_BINARY;
    }
}
