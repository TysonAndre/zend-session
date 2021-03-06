<?php
/**
 * @see       https://github.com/zendframework/zend-session for the canonical source repository
 * @copyright Copyright (c) 2019 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-session/blob/master/LICENSE.md New BSD License
 */

namespace ZendTest\Session\SaveHandler\DbTableGateway;

use Zend\Db\Adapter\Adapter;
use Zend\Session\SaveHandler\DbTableGateway;
use ZendTest\Session\SaveHandler\DbTableGatewayTest;

class PgsqlAdapterTest extends DbTableGatewayTest
{
    /**
     * @return Adapter
     */
    protected function getAdapter()
    {
        if (! getenv('TESTS_ZEND_SESSION_ADAPTER_DRIVER_PGSQL')) {
            $this->markTestSkipped(sprintf(
                '%s tests with Pgsql adapter are disabled',
                DbTableGateway::class
            ));
        }

        if (! extension_loaded('mysqli')) {
            $this->markTestSkipped(sprintf(
                '%s tests with Pgsql adapter are not enabled due to missing Pgsql extension',
                DbTableGateway::class
            ));
        }

        return new Adapter([
            'driver' => 'pgsql',
            'host' => getenv('TESTS_ZEND_SESSION_ADAPTER_DRIVER_PGSQL_HOSTNAME'),
            'user' => getenv('TESTS_ZEND_SESSION_ADAPTER_DRIVER_PGSQL_USERNAME'),
            'password' => getenv('TESTS_ZEND_SESSION_ADAPTER_DRIVER_PGSQL_PASSWORD'),
            'dbname' => getenv('TESTS_ZEND_SESSION_ADAPTER_DRIVER_PGSQL_DATABASE'),
        ]);
    }
}
