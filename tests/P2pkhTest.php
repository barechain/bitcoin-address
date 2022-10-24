<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Tests;

use Barechain\BitcoinAddress\Network\NetworkFactory;
use Barechain\BitcoinAddress\Output\{OutputFactory, OutputInterface};
use Barechain\BitcoinAddress\Output\Outputs\P2pkh;
use PHPUnit\Framework\TestCase;

class P2pkhTest extends TestCase
{
    /**
     * Get output
     */
    protected function getOutput(): OutputInterface
    {
        return OutputFactory::p2pkh(hex2bin('751e76e8199196d454941c45d1b3a323f1433bd6'));
    }

    /**
     * Test hex
     */
    public function testHex(): void
    {
        $this->assertEquals('76a914751e76e8199196d454941c45d1b3a323f1433bd688ac', $this->getOutput()->hex());
    }

    /**
     * Test asm
     */
    public function testAsm(): void
    {
        $this->assertEquals(
            'DUP HASH160 PUSHDATA(20)[751e76e8199196d454941c45d1b3a323f1433bd6] EQUALVERIFY CHECKSIG',
            $this->getOutput()->asm()
        );
    }

    /**
     * Test bitcoin address
     */
    public function testAddressBitcoin(): void
    {
        $this->assertEquals('1BgGZ9tcN4rm9KBzDn7KprQz87SZ26SAMH', $this->getOutput()->address());
    }

    /**
     * Test bitcoin testnet address
     */
    public function testAddressBitcoinTestnet(): void
    {
        $this->assertEquals(
            'mrCDrCybB6J1vRfbwM5hemdJz73FwDBC8r',
            $this->getOutput()->address(NetworkFactory::bitcoinTestnet())
        );
    }

    /**
     * Test bitcoin cash address
     */
    public function testAddressBitcoinCash(): void
    {
        $this->assertEquals(
            'bitcoincash:qp63uahgrxged4z5jswyt5dn5v3lzsem6cy4spdc2h',
            $this->getOutput()->address(NetworkFactory::bitcoinCash())
        );
    }

    /**
     * Test bitcoin gold address
     */
    public function testAddressBitcoinGold(): void
    {
        $this->assertEquals(
            'GUXByHDZLvU4DnVH9imSFckt3HEQ5cFgE5',
            $this->getOutput()->address(NetworkFactory::bitcoinGold())
        );
    }

    /**
     * Test litecoin address
     */
    public function testAddressLitecoin(): void
    {
        $this->assertEquals(
            'LVuDpNCSSj6pQ7t9Pv6d6sUkLKoqDEVUnJ',
            $this->getOutput()->address(NetworkFactory::litecoin())
        );
    }

    /**
     * Test litecoin testnet address
     */
    public function testAddressLitecoinTestnet(): void
    {
        $this->assertEquals(
            'mrCDrCybB6J1vRfbwM5hemdJz73FwDBC8r',
            $this->getOutput()->address(NetworkFactory::litecoinTestnet())
        );
    }

    /**
     * Test dogecoin address
     */
    public function testAddressDogecoin(): void
    {
        $this->assertEquals(
            'DFpN6QqFfUm3gKNaxN6tNcab1FArL9cZLE',
            $this->getOutput()->address(NetworkFactory::dogecoin())
        );
    }

    /**
     * Test dogecoin testnet address
     */
    public function testAddressDogecoinTestnet(): void
    {
        $this->assertEquals(
            'nesRpRaAbTDmZHwmzBkLd2AtF7Z9L9z5S2',
            $this->getOutput()->address(NetworkFactory::dogecoinTestnet())
        );
    }

    /**
     * Test viacoin address
     */
    public function testAddressViacoin(): void
    {
        $this->assertEquals(
            'Vkg6Ts44mskyD668xZkxFkjqovjXX9yUzZ',
            $this->getOutput()->address(NetworkFactory::viacoin())
        );
    }

    /**
     * Test viacoin testnet address
     */
    public function testAddressViacoinTestnet(): void
    {
        $this->assertEquals(
            'tHbsbwkCXyi31MtzL4QoQmyu4BAMJz8hS6',
            $this->getOutput()->address(NetworkFactory::viacoinTestnet())
        );
    }

    /**
     * Test dash address
     */
    public function testAddressDash(): void
    {
        $this->assertEquals('XmN7PQYWKn5MJFna5fRYgP6mxT2F7xpekE', $this->getOutput()->address(NetworkFactory::dash()));
    }

    /**
     * Test dash testnet address
     */
    public function testAddressDashTestnet(): void
    {
        $this->assertEquals(
            'y7f7RFKf49GYpZa2d6QdEHFLcEFfuoNcer',
            $this->getOutput()->address(NetworkFactory::dashTestnet())
        );
    }

    /**
     * Test zcach address
     */
    public function testAddressZcash(): void
    {
        $this->assertEquals(
            't1UYsZVJkLPeMjxEtACvSxfWuNmddpWfxzs',
            $this->getOutput()->address(NetworkFactory::zcash())
        );
    }

    /**
     * Test fromScript
     */
    public function testFromScript(): void
    {
        $output = $this->getOutput();
        $this->assertEquals($output->script(), P2pkh::fromScript($output->script())->script());
    }
}