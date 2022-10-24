<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Output;

use Barechain\BitcoinAddress\Network\NetworkInterface;

interface OutputInterface
{

    /**
     * Get script
     */
    public function script(): string;

    /**
     * Get hex
     */
    public function hex(): string;

    /**
     * Get hash
     */
    public function hash(): string;

    /**
     * Get witness hash
     */
    public function witnessHash(): string;

    /**
     * Get asm
     */
    public function asm(): string;

    /**
     * Get address
     */
    public function address(?NetworkInterface $network = null): string;

    /**
     * Validate script
     */
    static public function validateScript(string $script): void;

    /**
     * From script
     */
    static public function fromScript(string $script): OutputInterface;

    /**
     * From hex
     */
    static public function fromHex(string $hex): OutputInterface;
}