<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Tests;

use Barechain\BitcoinAddress\Output\{OutputFactory, OutputInterface};
use Barechain\BitcoinAddress\Output\Outputs\P2ms;
use PHPUnit\Framework\TestCase;

class P2msTest extends TestCase
{
    /**
     * Get output
     */
    protected function getOutput(): OutputInterface
    {
        return OutputFactory::p2ms(1, [hex2bin('0279be667ef9dcbbac55a06295ce870b07029bfcdb2dce28d959f2815b16f81798')]);
    }

    /**
     * Test hex
     */
    public function testHex(): void
    {
        $this->assertEquals(
            '51210279be667ef9dcbbac55a06295ce870b07029bfcdb2dce28d959f2815b16f8179851ae',
            $this->getOutput()->hex()
        );
    }

    /**
     * Test asm
     */
    public function testAsm(): void
    {
        $this->assertEquals(
            '1 PUSHDATA(33)[0279be667ef9dcbbac55a06295ce870b07029bfcdb2dce28d959f2815b16f81798] 1 CHECKMULTISIG',
            $this->getOutput()->asm()
        );
    }

    /**
     * Test fromScript
     */
    public function testFromScript(): void
    {
        $output = $this->getOutput();
        $this->assertEquals($output->script(), P2ms::fromScript($output->script())->script());
    }
}