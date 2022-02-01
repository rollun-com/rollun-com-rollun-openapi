<?php
declare(strict_types=1);

namespace DataStoreExample\OpenAPI\V1\DTO;

use Articus\DataTransfer\Annotation as DTA;

/**
 */
class UsersResult
{
    /**
     * @DTA\Data(field="data", nullable=true)
     * TODO check validator and strategy are correct and can handle container item type
     * @DTA\Strategy(name="ObjectArray", options={"type":\DataStoreExample\OpenAPI\V1\DTO\User::class})
     * @DTA\Validator(name="Collection", options={"validators":{
     *     {"name":"TypeCompliant", "options":{"type":\DataStoreExample\OpenAPI\V1\DTO\User::class}}
     * }})
     * @var \DataStoreExample\OpenAPI\V1\DTO\User[]
     */
    public $data;
    /**
     * @DTA\Data(field="messages", nullable=true)
     * TODO check validator and strategy are correct and can handle container item type
     * @DTA\Strategy(name="ObjectArray", options={"type":\DataStoreExample\OpenAPI\V1\DTO\Message::class})
     * @DTA\Validator(name="Collection", options={"validators":{
     *     {"name":"TypeCompliant", "options":{"type":\DataStoreExample\OpenAPI\V1\DTO\Message::class}}
     * }})
     * @var \DataStoreExample\OpenAPI\V1\DTO\Message[]
     */
    public $messages;
}
