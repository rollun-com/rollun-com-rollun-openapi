<?php
declare(strict_types=1);

namespace Test\OpenAPI\V1_0_1\DTO;

use Articus\DataTransfer\Annotation as DTA;
use OpenAPI\DataTransfer\Annotation as ODTA;
use ReflectionProperty;
use Traversable;

/**
 * Query parameters for testGET
 * @property array $test
 * @property string $name
 * @property array $id
 */
class TestGETQueryData implements \IteratorAggregate, \JsonSerializable
{
    /**
     * @ODTA\Data(field="test", required=false)
     * @DTA\Strategy(name="QueryParameterArray", options={"type":"int", "format":"multi"})
     * @DTA\Validator(name="QueryParameterArrayType", options={"type":"int", "format":"multi"})
     * @var int[]
     */
    private array $test;
    /**
     * @ODTA\Data(field="name", required=false)
     * @DTA\Strategy(name="QueryParameter", options={"type":"string"})
     * @DTA\Validator(name="QueryParameterType", options={"type":"string"})
     * @var string
     */
    private string $name;
    /**
     * @ODTA\Data(field="id", required=false)
     * @DTA\Strategy(name="QueryParameterArray", options={"type":"string", "format":"multi"})
     * @DTA\Validator(name="QueryParameterArrayType", options={"type":"string", "format":"multi"})
     * @var string[]
     */
    private array $id;

    public function __get($name)
    {
        return $this->isInitialized($name) ? $this->{$name} : null;
    }

    public function __set(string $name, $value): void
    {
        $this->{$name} = $value;
    }

    public function __isset(string $name): bool
    {
        return $this->isInitialized($name) && isset($this->{$name});
    }

    public function __unset(string $name): void
    {
        unset($this->{$name});
    }

    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->toArray());
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        $result = [];
        foreach (self::getAllPropertyNames() as $propertyName) {
            if ($this->isInitialized($propertyName)) {
                $result[$propertyName] = $this->{$propertyName};
            }
        }
        return $result;
    }

    private static function getAllPropertyNames(): array
    {
        return ['test', 'name', 'id'];
    }

    public function getTest(): array
    {
        return $this->test;
    }

    public function setTest(array $test): self
    {
        $this->test = $test;
        return $this;
    }

    public function hasTest(): bool
    {
        return $this->isInitialized('test');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function hasName(): bool
    {
        return $this->isInitialized('name');
    }

    public function getId(): array
    {
        return $this->id;
    }

    public function setId(array $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function hasId(): bool
    {
        return $this->isInitialized('id');
    }

    private function isInitialized(string $property): bool
    {
        $rp = new ReflectionProperty(self::class, $property);
        $rp->setAccessible(true);
        return $rp->isInitialized($this);
    }
}
