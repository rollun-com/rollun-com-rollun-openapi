<?php
/**
 * Configuration
 * PHP version 7.2
 *
 * @category Class
 * @package  Test\OpenAPI\V1_0_1\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * Test
 *
 * No description provided (generated by Openapi Generator https://github.com/openapitools/openapi-generator)
 *
 * The version of the OpenAPI document: 1.0.1
 * 
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 4.3.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Test\OpenAPI\V1_0_1\Client;


use \OpenAPI\Client\Configuration\ConfigurationAbstract;

/**
 * Configuration Class Doc Comment
 * PHP version 7.2
 *
 * @category Class
 * @package  Test\OpenAPI\V1_0_1\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class Configuration extends ConfigurationAbstract
{
    /**
     * @var array
     */
    public static $additionalData = [
        
        'blaGet' => [
            'className' => 'BlaApi',
            'returnType' => '\Test\OpenAPI\V1_0_1\Client\Model\BlaResult',
            'params' => [
                [
                    'paramName' => 'name',
                    'paramType' => 'string',
                    'required' => false,
                    'style' => 'form',
                    'explode' => true
                ],
                [
                    'paramName' => 'id',
                    'paramType' => 'string[]',
                    'required' => false,
                    'style' => 'form',
                    'explode' => false
                ],
            ]
        ],
        'blaPost' => [
            'className' => 'BlaApi',
            'returnType' => '',
            'params' => [
            ]
        ],
        'customOperationGet' => [
            'className' => 'TestApi',
            'returnType' => '\Test\OpenAPI\V1_0_1\Client\Model\TestCustomResponse',
            'params' => [
                [
                    'paramName' => 'pathParam',
                    'paramType' => 'string',
                    'required' => true,
                    'style' => 'simple',
                    'explode' => false
                ],
                [
                    'paramName' => 'queryParam',
                    'paramType' => 'string',
                    'required' => false,
                    'style' => 'form',
                    'explode' => true
                ],
            ]
        ],
        'customOperationPost' => [
            'className' => 'TestApi',
            'returnType' => '\Test\OpenAPI\V1_0_1\Client\Model\Test',
            'params' => [
                [
                    'paramName' => 'pathParam',
                    'paramType' => 'string',
                    'required' => true,
                    'style' => 'simple',
                    'explode' => false
                ],
                [
                    'paramName' => 'test',
                    'paramType' => '\Test\OpenAPI\V1_0_1\Client\Model\Test',
                    'required' => true,
                    'style' => '',
                    'explode' => false
                ],
            ]
        ],
        'testGet' => [
            'className' => 'TestApi',
            'returnType' => '\Test\OpenAPI\V1_0_1\Client\Model\Collection',
            'params' => [
                [
                    'paramName' => 'name',
                    'paramType' => 'string',
                    'required' => false,
                    'style' => 'form',
                    'explode' => false
                ],
                [
                    'paramName' => 'id',
                    'paramType' => 'string[]',
                    'required' => false,
                    'style' => 'form',
                    'explode' => true
                ],
                [
                    'paramName' => 'test',
                    'paramType' => 'int[]',
                    'required' => false,
                    'style' => 'form',
                    'explode' => true
                ],
            ]
        ],
        'testIdDelete' => [
            'className' => 'TestApi',
            'returnType' => '\Test\OpenAPI\V1_0_1\Client\Model\OkResponse',
            'params' => [
                [
                    'paramName' => 'id',
                    'paramType' => 'string',
                    'required' => true,
                    'style' => 'simple',
                    'explode' => false
                ],
            ]
        ],
        'testIdGet' => [
            'className' => 'TestApi',
            'returnType' => '\Test\OpenAPI\V1_0_1\Client\Model\Test',
            'params' => [
                [
                    'paramName' => 'id',
                    'paramType' => 'string',
                    'required' => true,
                    'style' => 'simple',
                    'explode' => false
                ],
            ]
        ],
        'testPathParamCustomGet' => [
            'className' => 'TestApi',
            'returnType' => '\Test\OpenAPI\V1_0_1\Client\Model\TestCustomResponse',
            'params' => [
                [
                    'paramName' => 'pathParam',
                    'paramType' => 'string',
                    'required' => true,
                    'style' => 'simple',
                    'explode' => false
                ],
                [
                    'paramName' => 'queryParam',
                    'paramType' => 'string',
                    'required' => false,
                    'style' => 'form',
                    'explode' => true
                ],
                [
                    'paramName' => 'arrayParam',
                    'paramType' => 'string[]',
                    'required' => false,
                    'style' => 'form',
                    'explode' => false
                ],
            ]
        ],
        'testPathParamCustomPost' => [
            'className' => 'TestApi',
            'returnType' => '\Test\OpenAPI\V1_0_1\Client\Model\Test',
            'params' => [
                [
                    'paramName' => 'pathParam',
                    'paramType' => 'string',
                    'required' => true,
                    'style' => 'simple',
                    'explode' => false
                ],
                [
                    'paramName' => 'test',
                    'paramType' => '\Test\OpenAPI\V1_0_1\Client\Model\Test',
                    'required' => true,
                    'style' => '',
                    'explode' => false
                ],
            ]
        ],
        'testPost' => [
            'className' => 'TestApi',
            'returnType' => '\Test\OpenAPI\V1_0_1\Client\Model\Test',
            'params' => [
                [
                    'paramName' => 'test',
                    'paramType' => '\Test\OpenAPI\V1_0_1\Client\Model\Test',
                    'required' => true,
                    'style' => '',
                    'explode' => false
                ],
            ]
        ],
    ];

    /**
     * The host
     *
     * @var string
     */
    protected $host = 'http://localhost:8001/openapi/Test/v1_0_1';

    /**
     * User agent of the HTTP request, set to "OpenAPI-Generator/{version}/PHP" by default
     *
     * @var string
     */
    protected $userAgent = 'OpenAPI-Generator/1.0.0/PHP';

    /**
     * Gets the essential information for debugging
     *
     * @return string The report for debugging
     */
    public static function toDebugReport()
    {
        $report  = 'PHP SDK (Test\OpenAPI\V1_0_1\Client) Debug Report:' . PHP_EOL;
        $report .= '    OS: ' . php_uname() . PHP_EOL;
        $report .= '    PHP Version: ' . PHP_VERSION . PHP_EOL;
        $report .= '    The version of the OpenAPI document: 1.0.1' . PHP_EOL;
        $report .= '    Temp Folder Path: ' . self::getDefaultConfiguration()->getTempFolderPath() . PHP_EOL;

        return $report;
    }

    /**
     * Returns an array of host settings
     *
     * @return array an array of host settings
     */
    public function getHostSettings(): array
    {
        return [
            [
                "url" => "http://localhost:8001/openapi/Test/v1_0_1",
                "description" => "No description provided",
            ],
            [
                "url" => "http://localhost:8082/openapi/Test/v1_0_1",
                "description" => "No description provided",
            ],
            [
                "url" => "http://rollun-openapi/openapi/Test/v1_0_1",
                "description" => "No description provided",
            ]
        ];
    }
}
