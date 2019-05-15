<?php

namespace asdfklgash\IngenicoMarketplaceAPI\Tests;

use asdfklgash\IngenicoMarketplaceAPI\Connection\Environment;
use PHPUnit\Framework\TestCase;

class EnvironmentTest extends TestCase
{

    public function testConstruct()
    {
        $env = new Environment();
        self::assertTrue( $env->isSandbox(), 'Sandbox not set' );
        self::assertFalse( $env->isProduction(), 'Production set' );
        self::assertEquals( $env::SANDBOX, $env->getBaseUrl(), 'URL not correct' );
    }

    public function testSandbox()
    {
        $env = new Environment();
        $env->setSandbox();
        self::assertTrue( $env->isSandbox(), 'Sandbox not set' );
        self::assertFalse( $env->isProduction(), 'Production set' );
        self::assertEquals( $env::SANDBOX, $env->getBaseUrl(), 'URL not correct' );
    }

    public function testProduction()
    {
        $env = new Environment();
        $env->setProduction();
        self::assertFalse( $env->isSandbox(), 'Sandbox not set' );
        self::assertTrue( $env->isProduction(), 'Production set' );
        self::assertEquals( $env::PRODUCTION, $env->getBaseUrl(), 'URL not correct' );
    }

}
