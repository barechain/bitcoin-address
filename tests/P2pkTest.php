<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Tests;

use Barechain\BitcoinAddress\Output\{OutputFactory, OutputInterface};
use Barechain\BitcoinAddress\Output\Outputs\P2pk;

class P2pkTest extends P2pkhTest
{
    /**
     * Get output
     */
    protected function getOutput(): OutputInterface
    {
        return OutputFactory::p2pk(hex2bin('0279be667ef9dcbbac55a06295ce870b07029bfcdb2dce28d959f2815b16f81798'));
    }

    /**
     * Test hex
     */
    public function testHex(): void
    {
        $this->assertEquals(
            '210279be667ef9dcbbac55a06295ce870b07029bfcdb2dce28d959f2815b16f81798ac',
            $this->getOutput()->hex()
        );
    }

    /**
     * Test asm
     */
    public function testAsm(): void
    {
        $this->assertEquals(
            'PUSHDATA(33)[0279be667ef9dcbbac55a06295ce870b07029bfcdb2dce28d959f2815b16f81798] CHECKSIG',
            $this->getOutput()->asm()
        );
    }

    /**
     * Test fromScript
     */
    public function testFromScript(): void
    {
        $output = $this->getOutput();
        $this->assertEquals($output->script(), P2pk::fromScript($output->script())->script());
    }
}