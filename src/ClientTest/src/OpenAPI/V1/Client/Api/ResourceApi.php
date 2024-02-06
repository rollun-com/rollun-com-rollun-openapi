<?php
/**
 * ResourceApi
 * PHP version 7.2
 *
 * @category Class
 * @package  ClientTest\OpenAPI\V1\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * ClientTest
 *
 * Simple manifest for tests
 *
 * The version of the OpenAPI document: 1
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.3.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace ClientTest\OpenAPI\V1\Client\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Query;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use InvalidArgumentException;
use OpenAPI\Client\Api\ApiInterface;
use OpenAPI\Client\ApiException;
use ClientTest\OpenAPI\V1\Client\Configuration;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\ObjectSerializer;
use OpenAPI\Server\Response\Message;
use Psr\Log\LoggerInterface;

/**
 * ResourceApi Class Doc Comment
 *
 * @category Class
 * @package  ClientTest\OpenAPI\V1\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ResourceApi implements ApiInterface
{
    public const CONFIGURATION_CLASS = 'ClientTest\OpenAPI\V1\Client\Configuration';

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    /**
     * @param ClientInterface|null $client
     * @param Configuration|null $config
     * @param HeaderSelector|null $selector
     * @param int $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0,
        LoggerInterface $logger = null
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: Configuration::getDefaultConfiguration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
        $this->logger = $logger;
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    public function setHostIndex(int $hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int
     */
    public function getHostIndex(): int
    {
        return $this->hostIndex;
    }

    /**
     * {@inheritDoc}
     */
    public function getHosts(): array
    {
        return $this->config->getHostSettings();
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation resourceGet
     *
     * Get list of resource
     *
     * @param mixed $filter Returning orders with by a specific filter. (optional)
     *
     * @throws ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array
     */
    public function resourceGet($filter = null)
    {
        list($response) = $this->resourceGetWithHttpInfo($filter);
        return $response;
    }

    /**
     * Operation resourceGetWithHttpInfo
     *
     * Get list of resource
     *
     * @param mixed $filter Returning orders with by a specific filter. (optional)
     *
     * @throws ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array
     */
    public function resourceGetWithHttpInfo($filter = null)
    {
        $request = $this->resourceGetRequest($filter);

        $this->log('info', 'Openapi send request.', [
            'requestBody' => (string)$request->getBody(),
            'requestUri' => (string)$request->getUri()
        ]);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);

                $this->log('info', 'Openapi response successfully received.', [
                    'class' => self::class,
                    'responseBody' => (string)$response->getBody(),
                    'responseStatusCode' => $response->getStatusCode()
                ]);
            } catch (ConnectException $e) {
                if (str_contains($e->getMessage(), 'Operation timed out')) {
                    return self::timeoutErrorResponse($e->getMessage());
                }
                throw $e;
            } catch (RequestException $e) {
                if (!$e->hasResponse()) {
                    throw $e;
                }
                $response = $e->getResponse();

                $this->log('info', 'Openapi not 2xx response received.', [
                    'class' => self::class,
                    'responseBody' => (string)$response->getBody(),
                    'responseStatusCode' => $response->getStatusCode()
                ]);

                switch ($response->getStatusCode()) {
                    case 504:
                    case 524:
                        return self::timeoutErrorResponse(
                            $e->getMessage(),
                            $response->getStatusCode(),
                            $response->getHeaders()
                        );
                    case 503:
                        return self::serviceUnavailableResponse(
                            $e->getMessage(),
                            $response->getStatusCode(),
                            $response->getHeaders()
                        );
                }
            }

            $statusCode = $response->getStatusCode();

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    return [
                        $this->deserialize((string) $responseBody),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    return [
                        $this->deserialize((string) $responseBody),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            return [
                $this->deserialize((string) $responseBody),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->deserialize((string) $e->getResponseBody());
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = $this->deserialize((string) $e->getResponseBody());
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation resourceGetAsync
     *
     * Get list of resource
     *
     * @param mixed $filter Returning orders with by a specific filter. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resourceGetAsync($filter = null)
    {
        return $this->resourceGetAsyncWithHttpInfo($filter)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation resourceGetAsyncWithHttpInfo
     *
     * Get list of resource
     *
     * @param mixed $filter Returning orders with by a specific filter. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resourceGetAsyncWithHttpInfo($filter = null)
    {
        $request = $this->resourceGetRequest($filter);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) {
                    return [
                        $this->deserialize((string) $response->getBody()),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'resourceGet'
     *
     * @param mixed $filter Returning orders with by a specific filter. (optional)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function resourceGetRequest($filter = null)
    {

        $resourcePath = '/resource';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($filter !== null) {
            if('form' === 'form' && is_array($filter)) {
                foreach($filter as $key => $value) {
                    $queryParams['filter'][$key] = $value;
                }
            }
            else {
                $queryParams['filter'] = $filter;
            }
        }



        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($_tempBody);
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'GET',
            $this->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation resourceIdGet
     *
     * Get info about specific resource
     *
     * @param mixed $id Id of resource (required)
     *
     * @throws ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array
     */
    public function resourceIdGet($id)
    {
        list($response) = $this->resourceIdGetWithHttpInfo($id);
        return $response;
    }

    /**
     * Operation resourceIdGetWithHttpInfo
     *
     * Get info about specific resource
     *
     * @param mixed $id Id of resource (required)
     *
     * @throws ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array
     */
    public function resourceIdGetWithHttpInfo($id)
    {
        $request = $this->resourceIdGetRequest($id);

        $this->log('info', 'Openapi send request.', [
            'requestBody' => (string)$request->getBody(),
            'requestUri' => (string)$request->getUri()
        ]);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);

                $this->log('info', 'Openapi response successfully received.', [
                    'class' => self::class,
                    'responseBody' => (string)$response->getBody(),
                    'responseStatusCode' => $response->getStatusCode()
                ]);
            } catch (ConnectException $e) {
                if (str_contains($e->getMessage(), 'Operation timed out')) {
                    return self::timeoutErrorResponse($e->getMessage());
                }
                throw $e;
            } catch (RequestException $e) {
                if (!$e->hasResponse()) {
                    throw $e;
                }
                $response = $e->getResponse();

                $this->log('info', 'Openapi not 2xx response received.', [
                    'class' => self::class,
                    'responseBody' => (string)$response->getBody(),
                    'responseStatusCode' => $response->getStatusCode()
                ]);

                switch ($response->getStatusCode()) {
                    case 504:
                    case 524:
                        return self::timeoutErrorResponse(
                            $e->getMessage(),
                            $response->getStatusCode(),
                            $response->getHeaders()
                        );
                    case 503:
                        return self::serviceUnavailableResponse(
                            $e->getMessage(),
                            $response->getStatusCode(),
                            $response->getHeaders()
                        );
                }
            }

            $statusCode = $response->getStatusCode();

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    return [
                        $this->deserialize((string) $responseBody),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    return [
                        $this->deserialize((string) $responseBody),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            return [
                $this->deserialize((string) $responseBody),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->deserialize((string) $e->getResponseBody());
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = $this->deserialize((string) $e->getResponseBody());
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation resourceIdGetAsync
     *
     * Get info about specific resource
     *
     * @param mixed $id Id of resource (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resourceIdGetAsync($id)
    {
        return $this->resourceIdGetAsyncWithHttpInfo($id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation resourceIdGetAsyncWithHttpInfo
     *
     * Get info about specific resource
     *
     * @param mixed $id Id of resource (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resourceIdGetAsyncWithHttpInfo($id)
    {
        $request = $this->resourceIdGetRequest($id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) {
                    return [
                        $this->deserialize((string) $response->getBody()),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'resourceIdGet'
     *
     * @param mixed $id Id of resource (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function resourceIdGetRequest($id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling resourceIdGet'
            );
        }

        $resourcePath = '/resource/{id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{' . 'id' . '}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($_tempBody);
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'GET',
            $this->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation resourcePost
     *
     * Make an resource
     *
     * @param mixed $resourcePostRequest resourcePostRequest (required)
     *
     * @throws ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array
     */
    public function resourcePost($resourcePostRequest)
    {
        list($response) = $this->resourcePostWithHttpInfo($resourcePostRequest);
        return $response;
    }

    /**
     * Operation resourcePostWithHttpInfo
     *
     * Make an resource
     *
     * @param mixed $resourcePostRequest (required)
     *
     * @throws ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array
     */
    public function resourcePostWithHttpInfo($resourcePostRequest)
    {
        $request = $this->resourcePostRequest($resourcePostRequest);

        $this->log('info', 'Openapi send request.', [
            'requestBody' => (string)$request->getBody(),
            'requestUri' => (string)$request->getUri()
        ]);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);

                $this->log('info', 'Openapi response successfully received.', [
                    'class' => self::class,
                    'responseBody' => (string)$response->getBody(),
                    'responseStatusCode' => $response->getStatusCode()
                ]);
            } catch (ConnectException $e) {
                if (str_contains($e->getMessage(), 'Operation timed out')) {
                    return self::timeoutErrorResponse($e->getMessage());
                }
                throw $e;
            } catch (RequestException $e) {
                if (!$e->hasResponse()) {
                    throw $e;
                }
                $response = $e->getResponse();

                $this->log('info', 'Openapi not 2xx response received.', [
                    'class' => self::class,
                    'responseBody' => (string)$response->getBody(),
                    'responseStatusCode' => $response->getStatusCode()
                ]);

                switch ($response->getStatusCode()) {
                    case 504:
                    case 524:
                        return self::timeoutErrorResponse(
                            $e->getMessage(),
                            $response->getStatusCode(),
                            $response->getHeaders()
                        );
                    case 503:
                        return self::serviceUnavailableResponse(
                            $e->getMessage(),
                            $response->getStatusCode(),
                            $response->getHeaders()
                        );
                }
            }

            $statusCode = $response->getStatusCode();

            $responseBody = $response->getBody();
            switch($statusCode) {
                case 200:
                    return [
                        $this->deserialize((string) $responseBody),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                case 500:
                    return [
                        $this->deserialize((string) $responseBody),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
            }

            return [
                $this->deserialize((string) $responseBody),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->deserialize((string) $e->getResponseBody());
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = $this->deserialize((string) $e->getResponseBody());
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation resourcePostAsync
     *
     * Make an resource
     *
     * @param mixed $resourcePostRequest (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resourcePostAsync($resourcePostRequest)
    {
        return $this->resourcePostAsyncWithHttpInfo($resourcePostRequest)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation resourcePostAsyncWithHttpInfo
     *
     * Make an resource
     *
     * @param mixed $resourcePostRequest (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function resourcePostAsyncWithHttpInfo($resourcePostRequest)
    {
        $request = $this->resourcePostRequest($resourcePostRequest);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) {
                    return [
                        $this->deserialize((string) $response->getBody()),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'resourcePost'
     *
     * @param mixed $resourcePostRequest (required)
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function resourcePostRequest($resourcePostRequest)
    {
        // verify the required parameter 'resourcePostRequest' is set
        if ($resourcePostRequest === null || (is_array($resourcePostRequest) && count($resourcePostRequest) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $resourcePostRequest when calling resourcePost'
            );
        }

        $resourcePath = '/resource';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;




        // body params
        $_tempBody = null;
        if (isset($resourcePostRequest)) {
            $_tempBody = $resourcePostRequest;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            // $_tempBody is the method argument, if present
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($_tempBody);
            } else {
                $httpBody = $_tempBody;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                // for HTTP post (form)
                $httpBody = Query::build($formParams);
            }
        }


        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        return $options;
    }

    /**
     * Returns host by hostIndex
     *
     * @return string
     */
    protected function getHost(): string
    {
        return $this->config->getHostFromSettings($this->hostIndex);
    }

    /**
     * Decodes response body
     *
     * @param string $responseBody
     * @return array
     */
    protected function deserialize(string $responseBody): array
    {
        try {
            return ObjectSerializer::deserialize($responseBody);
        } catch (InvalidArgumentException $exception) {
            return [
                'messages' => [
                    [
                        'level' => 'error',
                        'type' => 'INVALID_RESPONSE',
                        'text' => 'Response body decoding error: "' . $exception->getMessage() . '"'
                    ]
                ]
            ];
        }
    }

    /*protected function deserialize(string $responseBody, ?string $mimeType = null)
    {
        $mimeType = $mimeType ?? 'application/json';
        switch ($mimeType) {
            case 'application/json':
            case 'application/vnd.api+json':
            try {
                return ObjectSerializer::deserialize($responseBody);
            } catch (InvalidArgumentException $exception) {
                return [
                    'data' => null,
                    'messages' => [
                        [
                            'level' => 'error',
                            'type' => 'INVALID_RESPONSE',
                            'text' => 'Response body decoding error: "' . $exception->getMessage() . '"'
                        ]
                    ]
                ];
            }
        }

        return $responseBody;
    }*/

    protected function log(string $level, string $message, array $context): void
    {
        if ($this->logger) {
            $this->logger->log($level, $message, $context);
        }
    }

    private static function timeoutErrorResponse(string $text, ?int $statusCode = null, ?array $headers = null): array
    {
        return [
            [
                'messages' => [
                    [
                        'level' => Message::ERROR,
                        'type' => Message::REQUEST_TIMEOUT,
                        'text' => $text
                    ]
                ]
            ],
            $statusCode,
            $headers
        ];
    }

    private static function serviceUnavailableResponse(string $text, ?int $statusCode = null, ?array $headers = null): array
    {
        return [
            [
                'messages' => [
                    [
                        'level' => Message::ERROR,
                        'type' => Message::SERVICE_UNAVAILABLE,
                        'text' => $text
                    ]
                ]
            ],
            $statusCode,
            $headers
        ];
    }
}
