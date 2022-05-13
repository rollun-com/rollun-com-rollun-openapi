<?php
declare(strict_types=1);

namespace HelloUser\OpenAPI\V1\DTO;

use Articus\DataTransfer\Annotation as DTA;
use OpenAPI\DataTransfer\Annotation as ODTA;
use ReflectionProperty;

/**
 * @property \HelloUser\OpenAPI\V1\DTO\User $data
 * @property array $messages
 */
class UserResult
{
    /**
     * @ODTA\Data(field="data", required=false)
     * @DTA\Strategy(name="Object", options={"type":\HelloUser\OpenAPI\V1\DTO\User::class})
     * @DTA\Validator(name="TypeCompliant", options={"type":\HelloUser\OpenAPI\V1\DTO\User::class})
     * @var \HelloUser\OpenAPI\V1\DTO\User
     */
    private \HelloUser\OpenAPI\V1\DTO\User $data;
    /**
     * @ODTA\Data(field="messages", required=false)
     * @DTA\Strategy(name="ObjectArray", options={"type":\HelloUser\OpenAPI\V1\DTO\Message::class})
     * @DTA\Validator(name="Collection", options={"validators":{
     *     {"name":"TypeCompliant", "options":{"type":\HelloUser\OpenAPI\V1\DTO\Message::class}}
     * }})
     * @var \HelloUser\OpenAPI\V1\DTO\Message[]
     */
    private array $messages;

    public function __get($name)
    {
        return $this->isInitialized($name) ? $this->{$name} : null;
    }

    public function __set(string $name, $value): void
    {
        $this->{$name} = $value;
    }

    public function getData(): \HelloUser\OpenAPI\V1\DTO\User
    {
        return $this->data;
    }

    public function setData(\HelloUser\OpenAPI\V1\DTO\User $data): void
    {
        $this->data = $data ;
    }

    public function hasData(): bool
    {
        return $this->isInitialized('data');
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function setMessages(array $messages): void
    {
        $this->messages = $messages ;
    }

    public function hasMessages(): bool
    {
        return $this->isInitialized('messages');
    }

    private function isInitialized(string $property): bool
    {
        $rp = new ReflectionProperty(self::class, $property);
        $rp->setAccessible(true);
        return $rp->isInitialized($this);
    }
}
