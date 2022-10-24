<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Tests;

use Barechain\BitcoinAddress\Network\NetworkFactory;
use Barechain\BitcoinAddress\Output\{OutputFactory, OutputInterface};
use Barechain\BitcoinAddress\Output\Outputs\P2wpkh;
use PHPUnit\Framework\TestCase;

class P2wpkhTest extends TestCase
{
    /**
     * Get output
     */
    protected function getOutput(): OutputInterface
    {
        return OutputFactory::p2wpkh(hex2bin('751e76e8199196d454941c45d1b3a323f1433bd6'));
    }

    /**
     * Test hex
     */
    public function testHex(): void
    {
        $this->assertEquals('0014751e76e8199196d454941c45d1b3a323f1433bd6', $this->getOutput()->hex());
    }

    /**
     * Test asm
     */
    public function testAsm(): void
    {
        $this->assertEquals('0 PUSHDATA(20)[751e76e8199196d454941c45d1b3a323f1433bd6]', $this->getOutput()->asm());
    }

    /**
     * Test bitcoin address
     */
    public function testAddressBitcoin(): void
    {
        $this->assertEquals('bc1qw508d6qejxtdg4y5r3zarvary0c5xw7kv8f3t4', $this->getOutput()->address());
    }

    /**
     * Test bitcoin testnet address
     */
    public function testAddressBitcoinTestnet(): void
    {
        $this->assertEquals(
            'tb1qw508d6qejxtdg4y5r3zarvary0c5xw7kxpjzsx',
            $this->getOutput()->address(NetworkFactory::bitcoinTestnet())
        );
    }

    /**
     * Test litecoin address
     */
    public function testAddressLitecoin(): void
    {
        $this->assertEquals(
            'ltc1qw508d6qejxtdg4y5r3zarvary0c5xw7kgmn4n9',
            $this->getOutput()->address(NetworkFactory::litecoin())
        );
    }

    /**
     * Test litecoin testnet address
     */
    public function testAddressLitecoinTestnet(): void
    {
        $this->assertEquals(
            'tltc1qw508d6qejxtdg4y5r3zarvary0c5xw7klfsuq0',
            $this->getOutput()->address(NetworkFactory::litecoinTestnet())
        );
    }

    /**
     * Test viacoin address
     */
    public function testAddressViacoin(): void
    {
        $this->assertEquals(
            'via1qw508d6qejxtdg4y5r3zarvary0c5xw7kxzdzsn',
            $this->getOutput()->address(NetworkFactory::viacoin())
        );
    }

    /**
     * Test viacoin testnet address
     */
    public function testAddressViacoinTestnet(): void
    {
        $this->assertEquals(
            'tvia1qw508d6qejxtdg4y5r3zarvary0c5xw7k3swtre',
            $this->getOutput()->address(NetworkFactory::viacoinTestnet())
        );
    }

    /**
     * Test fromScript
     */
    public function testFromScript(): void
    {
        $output = $this->getOutput();
        $this->assertEquals($output->script(), P2wpkh::fromScript($output->script())->script());
    }
}