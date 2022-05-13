<?php
declare(strict_types=1);

namespace HelloUser\OpenAPI\V1\DTO;

use Articus\DataTransfer\Annotation as DTA;
use OpenAPI\DataTransfer\Annotation as ODTA;
use ReflectionProperty;

/**
 * @property string $id
 * @property string $name
 * @property \DateTime $createdAt
 */
class User
{
    /**
     * @ODTA\Data(field="id")
     * @DTA\Validator(name="Type", options={"type":"string"})
     * @var string
     */
    private string $id;
    /**
     * @ODTA\Data(field="name")
     * @DTA\Validator(name="Type", options={"type":"string"})
     * @var string
     */
    private string $name;
    /**
     * @ODTA\Data(field="created_at", required=false)
     * @DTA\Strategy(name="DateTime")
     * @DTA\Validator(name="Date", options={"format": "RFC3339"})
     * @var \DateTime
     */
    private \DateTime $createdAt;

    public function __get($name)
    {
        return $this->isInitialized($name) ? $this->{$name} : null;
    }

    public function __set(string $name, $value): void
    {
        $this->{$name} = $value;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id ;
    }

    public function hasId(): bool
    {
        return $this->isInitialized('id');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name ;
    }

    public function hasName(): bool
    {
        return $this->isInitialized('name');
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt ;
    }

    public function hasCreatedAt(): bool
    {
        return $this->isInitialized('createdAt');
    }

    private function isInitialized(string $property): bool
    {
        $rp = new ReflectionProperty(self::class, $property);
        $rp->setAccessible(true);
        return $rp->isInitialized($this);
    }
}
