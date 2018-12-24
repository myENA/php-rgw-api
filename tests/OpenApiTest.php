<?php declare(strict_types=1);

namespace MyENA\RGW\Tests;

use OpenApi\Analysis;
use OpenApi\Context;
use OpenApi\StaticAnalyser;
use PHPUnit\Framework\TestCase;
use function OpenApi\scan as openapi_scan;

/**
 * Class OpenApiTest
 * @package ENA\OpenApiTest\Tests
 */
class OpenApiTest extends TestCase
{
    public function testAnnotation()
    {
        set_error_handler(function ($severity, $message, $file, $line) {
            throw new \ErrorException($message, E_USER_WARNING, $severity, $file, $line);
        });
        $analysis = new Analysis();
        $analyser = new StaticAnalyser();
        $analysis->addAnalysis($analyser->fromCode(/** @lang PHP */
            <<<PHP
<?php
/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="php-rgw-api",
 *      description="php-rgw-api",
 *      @OA\Contact(
 *          email="andreil@ena.com",
*           email="dcarbone@ena.com"
 *      ),
 *      @OA\License(
 *         name="Mozilla Public License 2.0",
 *         url="https://www.mozilla.org/en-US/MPL/2.0/"
 *     )
 * )
 * @OA\PathItem(
 *      path="/"
 * )
 */
PHP
            ,
            new Context(['filename' => '/src/boostrap'])
        ));
        $openapi = openapi_scan(__DIR__ . '/../src', ['analysis' => $analysis, 'analyser' => $analyser]);

        $this->assertTrue(array_key_exists("\MyENA\RGW\AbstractParameter",$openapi->_analysis->classes));
        $this->assertTrue(array_key_exists("\MyENA\RGW\Chain\Bucket\Link",$openapi->_analysis->classes));
        $this->assertTrue(array_key_exists("\MyENA\RGW\Validator\BucketNameValidator",$openapi->_analysis->classes));
    }
}