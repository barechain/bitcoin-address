<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Output;

use Barechain\BitcoinAddress\Exception;
use Barechain\BitcoinAddress\Output\Outputs\{P2ms, P2pk, P2pkh, P2sh, P2wpkh, P2wsh};
use Barechain\BitcoinAddress\Utils;

class OutputFactory
{
    /**
     * Get p2pk output
     */
    static public function p2pk(string $pubKey): OutputInterface
    {
        return new P2pk($pubKey);
    }

    /**
     * Get p2pkh output
     */
    static public function p2pkh(string $pubKeyHash): OutputInterface
    {
        return new P2pkh($pubKeyHash);
    }

    /**
     * Get p2ms output
     */
    static public function p2ms(int $m, array $pubKeys): OutputInterface
    {
        return new P2ms($m, $pubKeys);
    }

    /**
     * Get p2sh output
     */
    static public function p2sh(OutputInterface $output): OutputInterface
    {
        return new P2sh($output);
    }

    /**
     * Get p2wpkh output
     */
    static public function p2wpkh(string $pubKeyHash): OutputInterface
    {
        return new P2wpkh($pubKeyHash);
    }

    /**
     * Get p2wsh output
     */
    static public function p2wsh(OutputInterface $output): OutputInterface
    {
        return new P2wsh($output);
    }

    /**
     * Get output from script
     *
     * @throws Exception
     */
    static public function fromScript(string $script): OutputInterface
    {
        $map = [
            P2pk::COMPRESSED_SCRIPT_LEN => P2pk::class,
            P2pk::UNCOMPRESSED_SCRIPT_LEN => P2pk::class,
            P2pkh::SCRIPT_LEN => P2pkh::class,
            P2sh::SCRIPT_LEN => P2sh::class,
            P2wpkh::SCRIPT_LEN => P2wpkh::class,
            P2wsh::SCRIPT_LEN => P2wsh::class,
        ];

        $scriptLen = strlen($script);

        if (isset($map[$scriptLen])) {
            $class = $map[$scriptLen];
        } elseif ($scriptLen >= P2ms::MIN_SCRIPT_LEN) {
            $class = P2ms::class;
        } else {
            throw new Exception('Unknown script type.');
        }

        return call_user_func([$class, 'fromScript'], $script);
    }

    /**
     * Get from hex
     */
    static public function fromHex(string $hex): OutputInterface
    {
        return static::fromScript(Utils::hex2bin($hex));
    }
}