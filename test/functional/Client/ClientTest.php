<?php

namespace rollun\test\OpenAPI\functional\Client;

use Articus\DataTransfer\Service as DataTransferService;
use ClientTest\OpenAPI\V1\DTO\ResourceListResult;
use ClientTest\OpenAPI\V1\DTO\ResourceResult;
use Exception;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use OpenAPI\Client\Factory\ApiAbstractFactory;
use OpenAPI\Client\RequestTimedOut;
use OpenAPI\Client\Rest\ClientInterface;
use OpenAPI\Client\ServiceUnavailable;
use OpenAPI\Server\Response\Message;
use Psr\Log\LoggerInterface;
use rollun\test\OpenAPI\functional\GuzzleMockTrait;

class ClientTest extends ClientTestCase
{
    use GuzzleMockTrait;

    private const MANIFEST_PATH = __DIR__ . '/openapi.yaml';

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::removeGenerated(self::MANIFEST_PATH);
        self::generateClient(self::MANIFEST_PATH);
    }

    public function testClientGenerated(): void
    {
        $clientPath = self::getGeneratedPath(self::MANIFEST_PATH);
        self::assertFileExists($clientPath . '/V1/Client/Rest/Resource.php');
    }

    public function timeOutDataProvider(): array
    {
        return [
            '504 code' => [
                new Response(504, [], "<error>504 Gateway Timeout</error>")
            ],
            '524 code' => [
                new Response(524, [], "<error>524 A Timeout Occurred</error>")
            ],
            'Server not respond by timeout' => [
                new ConnectException(
                    'cURL error 28: Operation timed out after 1001 milliseconds with 0 bytes received (see https://curl.haxx.se/libcurl/c/libcurl-errors.html)',
                    new Request('GET', '/resource')
                ),
            ],
        ];
    }

    /**
     * @dataProvider timeOutDataProvider
     */
    public function testTimeoutError(Response|Exception $response): void
    {
        $this->getGuzzleMockHandler()->append($response);

        self::expectException(RequestTimedOut::class);

        $this->getClient()->get();
    }

    public function serviceUnavailableDataProvider(): array
    {
        return [
            '503 code' => [
                new Response(503, [], "<error>503 Service Unavailable</error>")
            ],
        ];
    }

    /**
     * @dataProvider serviceUnavailableDataProvider
     */
    public function testServiceUnavailable(Response|Exception $response): void
    {
        $this->getGuzzleMockHandler()->append($response);

        self::expectException(ServiceUnavailable::class);

        $this->getClient()->get();
    }

    public function testResetFunction(): void
    {
        $result = new ResourceResult();
        $result->messages = [$message = self::createMessage()];

        self::assertEquals($message, reset($result->messages));
    }

    public function testAppendToArray(): void
    {
        $result = new ResourceResult();
        $result->messages = [];

        $result->messages[] = $message = self::createMessage();

        self::assertEquals([$message], $result->messages);
    }

    private static function assertErrorOfType(ResourceListResult $response, string $errorType): void
    {
        self::assertCount(1, $response->messages);

        /** @var \ClientTest\OpenAPI\V1\DTO\Message $message */
        $message = $response->messages[0];
        self::assertEquals(Message::ERROR, $message->level);
        self::assertEquals($errorType, $message->type);
    }

    private function getClient(): ClientInterface
    {
        $className = 'ClientTest\OpenAPI\V1\Client\Rest\Resource';
        $api = self::$container->build($className::API_NAME, [
            ApiAbstractFactory::KEY_CLIENT => $this->getGuzzleClient()
        ]);
        return new $className(
            $api,
            self::$container->get(DataTransferService::class),
            self::$container->get(LoggerInterface::class)
        );
    }

    private static function createMessage(
        string $level = Message::ERROR, ?string $text = null, string $type = Message::UNDEFINED_TYPE
    ): \ClientTest\OpenAPI\V1\DTO\Message
    {
        $message = new \ClientTest\OpenAPI\V1\DTO\Message();
        $message->level = $level;
        $message->type = Message::UNDEFINED_TYPE;
        $message->text = $text ?? uniqid();
        return $message;
    }
}