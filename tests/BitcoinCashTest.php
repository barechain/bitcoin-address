<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Tests;

use Barechain\BitcoinAddress\Network\NetworkFactory;
use Barechain\BitcoinAddress\Output\Outputs\{P2pkh, P2sh};
use PHPUnit\Framework\TestCase;

class BitcoinCashTest extends TestCase
{
    /**
     * Test decode P2PKH
     */
    public function testDecodeP2PKH(): void
    {
        $this->assertInstanceOf(
            P2pkh::class,
            NetworkFactory::bitcoinCash()->decodeAddress('bitcoincash:qp63uahgrxged4z5jswyt5dn5v3lzsem6cy4spdc2h')
        );
    }

    /**
     * Test decode P2SH
     */
    public function testDecodeP2SH(): void
    {
        $this->assertInstanceOf(
            P2sh::class,
            NetworkFactory::bitcoinCash()->decodeAddress('bitcoincash:pzp7awma0x4p6wyw8v9vvkuc43vqcndqrg9umkmd8g')
        );
    }
}