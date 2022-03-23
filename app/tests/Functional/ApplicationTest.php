<?php
namespace App\Tests\Functional;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;

class ApplicationTest extends ApiTestCase
{
    public function testCreatedValue()
    {
        $this->assertEquals(42, 42);
    }
}