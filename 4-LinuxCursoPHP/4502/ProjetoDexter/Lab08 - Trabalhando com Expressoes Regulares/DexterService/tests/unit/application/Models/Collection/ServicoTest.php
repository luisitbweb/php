<?php

namespace DexterService\Models\Collection;

class ServicoTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldBeInstanceOfArrayObject()
    {
        $this->assertInstanceOf('\\ArrayObject', new \DexterService\Models\Collection\Servico());
    }
}
