<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Tests;

use Barechain\BitcoinAddress\Network\NetworkFactory;
use Barechain\BitcoinAddress\Output\Outputs\{P2pkh, P2sh, P2wpkh, P2wsh};
use PHPUnit\Framework\TestCase;

class BitcoinTest extends TestCase
{
    /**
     * Test decode P2PKH
     */
    public function testDecodeP2PKH(): void
    {
        $this->assertInstanceOf(
            P2pkh::class,
            NetworkFactory::bitcoin()->decodeAddress('1BgGZ9tcN4rm9KBzDn7KprQz87SZ26SAMH')
        );
    }

    /**
     * Test decode P2SH
     */
    public function testDecodeP2SH(): void
    {
        $this->assertInstanceOf(
            P2sh::class,
            NetworkFactory::bitcoin()->decodeAddress('3DicS6C8JZm59RsrgXr56iVHzYdQngiehV')
        );
    }

    /**
     * Test decode P2WPKH
     */
    public function testDecodeP2WPKH(): void
    {
        $this->assertInstanceOf(
            P2wpkh::class,
            NetworkFactory::bitcoin()->decodeAddress('bc1qw508d6qejxtdg4y5r3zarvary0c5xw7kv8f3t4')
        );
    }

    /**
     * Test decode P2WSH
     */
    public function testDecodeP2WSH(): void
    {
        $this->assertInstanceOf(
            P2wsh::class,
            NetworkFactory::bitcoin()->decodeAddress('bc1q9qs9xv7mjghkd69fgx62xttxmeww5q7eekjxu0nxtzf4yu4ekf8s4plngs')
        );
    }
}