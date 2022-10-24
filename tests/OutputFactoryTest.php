<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Tests;

use Barechain\BitcoinAddress\Output\OutputFactory;
use Barechain\BitcoinAddress\Output\Outputs\{P2ms, P2pk, P2pkh, P2sh, P2wpkh, P2wsh};
use PHPUnit\Framework\TestCase;

class OutputFactoryTest extends TestCase
{
    /**
     * Test from hex P2PK
     */
    public function testFromHexP2PK(): void
    {
        $output = OutputFactory::fromHex('210279be667ef9dcbbac55a06295ce870b07029bfcdb2dce28d959f2815b16f81798ac');
        $this->assertInstanceOf(P2pk::class, $output);
    }

    /**
     * Test from hex P2PKH
     */
    public function testFromHexP2PKH(): void
    {
        $output = OutputFactory::fromHex('76a914751e76e8199196d454941c45d1b3a323f1433bd688ac');
        $this->assertInstanceOf(P2pkh::class, $output);
    }

    /**
     * Test from hex P2MS
     */
    public function testFromHexP2MS(): void
    {
        $output = OutputFactory::fromHex('51210279be667ef9dcbbac55a06295ce870b07029bfcdb2dce28d959f2815b16f8179851ae');
        $this->assertInstanceOf(P2ms::class, $output);
    }

    /**
     * Test from hex P2SH
     */
    public function testFromHexP2SH(): void
    {
        $output = OutputFactory::fromHex('a91483eebb7d79aa1d388e3b0ac65b98ac580c4da01a87');
        $this->assertInstanceOf(P2sh::class, $output);
    }

    /**
     * Test from hex P2WPKH
     */
    public function testFromHexP2WPKH(): void
    {
        $output = OutputFactory::fromHex('0014751e76e8199196d454941c45d1b3a323f1433bd6');
        $this->assertInstanceOf(P2wpkh::class, $output);
    }

    /**
     * Test from hex P2WSH
     */
    public function testFromHexP2WSH(): void
    {
        $output = OutputFactory::fromHex('002028205333db922f66e8a941b4a32d66de5cea03d9cda46e3e6658935272b9b24f');
        $this->assertInstanceOf(P2wsh::class, $output);
    }
}