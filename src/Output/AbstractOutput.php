<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Output;

use Barechain\BitcoinAddress\Exception;
use Barechain\BitcoinAddress\Network\{NetworkFactory, NetworkInterface};
use Barechain\BitcoinAddress\Utils;

abstract class AbstractOutput implements OutputInterface
{
    /**
     * Get hex
     */
    public function hex(): string
    {
        return bin2hex($this->script());
    }

    /**
     * Get hash
     */
    public function hash(): string
    {
        return Utils::hash160($this->script());
    }

    /**
     * Get witness hash
     */
    public function witnessHash(): string
    {
        return Utils::sha256($this->script());
    }

    /**
     * Get network
     */
    protected function network(?NetworkInterface $network = null): NetworkInterface
    {
        return $network ?: NetworkFactory::getDefaultNetwork();
    }

    /**
     * Get from hex
     *
     * @throws Exception
     */
    static public function fromHex(string $hex): OutputInterface
    {
        $script = hex2bin($hex);

        if ($script === false) {
            throw new Exception('Invalid hex-encoded string.');
        }

        return static::fromScript($script);
    }
}