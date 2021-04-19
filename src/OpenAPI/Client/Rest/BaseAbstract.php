<?php
declare(strict_types=1);

namespace OpenAPI\Client\Rest;

use Articus\DataTransfer\Service as DataTransferService;
use Exception;
use GuzzleHttp\Client;
use InvalidArgumentException;
use OpenAPI\Client\Api\ApiInterface;
use OpenAPI\Client\Configuration\ConfigurationInterface;
use Psr\Log\LoggerInterface;

/**
 * Abstract class BaseAbstract
 *
 * @author r.ratsun <r.ratsun.rollun@gmail.com>
 */
abstract class BaseAbstract extends \OpenAPI\Server\Rest\BaseAbstract implements ClientInterface
{
    public const IS_API_CLIENT = true;

    /**
     * @var string
     */
    protected $apiName = '';

    /**
     * @var ApiInterface
     */
    protected $api;

    /**
     * @var DataTransferService
     */
    protected $dataTransfer;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * BaseAbstract constructor.
     *
     * @param DataTransferService $dataTransfer
     * @param LoggerInterface     $logger
     * @param string              $lifeCycleToken
     * @param ConfigurationInterface|null $config
     */
    public function __construct(
        DataTransferService $dataTransfer,
        LoggerInterface $logger,
        string $lifeCycleToken,
        ?ConfigurationInterface $config = null
    ) {
        // prepare api name
        $apiName = $this->apiName;
        if (empty($this->apiName)) {
            throw new InvalidArgumentException('Param $apiName is required!');
        }

        $this->api = $this->createApi($apiName, $lifeCycleToken, $config);
        $this->dataTransfer = $dataTransfer;
        $this->logger = $logger;
    }

    /**
     * @param string $apiName
     * @param string $lifeCycleToken
     * @param ConfigurationInterface|null $config
     *
     * @return ApiInterface
     */
    protected function createApi(
        string $apiName,
        string $lifeCycleToken,
        ?ConfigurationInterface $config = null
    ): ApiInterface {
        return new $apiName(new Client(['headers' => ['LifeCycleToken' => $lifeCycleToken]]), $config);
    }

    /**
     * @param array       $data
     * @param string      $dto
     * @param string|null $validationMessage
     *
     * @return object|array
     * @throws Exception
     */
    protected function transfer(array $data, string $dto, string $validationMessage = null)
    {
        // prepare validation message
        if ($validationMessage === null) {
            $validationMessage = 'Validation is failed!';
        }

        if (substr($dto, -2) == '[]') {
            // prepare class name
            $dto = str_replace('[]', '', $dto);

            $result = [];
            $errors = [];
            foreach ($data as $item) {
                $object = new $dto();
                $errors = array_merge($errors, $this->dataTransfer->transfer($item, $object));
                $result[] = $object;
            }
        } else {
            $result = new $dto();
            $errors = $this->dataTransfer->transfer($data, $result);
        }

        if (!empty($errors)) {
            throw new Exception($validationMessage . ' Details: ' . json_encode($errors));
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function setHostIndex(int $index): void
    {
        $this->api->setHostIndex($index);
    }

    /**
     * {@inheritDoc}
     */
    public function getHosts(): array
    {
        return $this->api->getHosts();
    }

    /**
     * @param string $key
     * @param $value
     * @todo
     */
    public function setConfig($key, $value): void
    {
        $config = $this->api->getConfig();
        $setter = 'set' . $key;
        if (method_exists($config,$setter)) {
            $config->{$setter}($value);
        }
    }
}
