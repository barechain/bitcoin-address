<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network;

use Barechain\BitcoinAddress\Output\OutputInterface;

interface NetworkInterface
{
    /**
     * Get p2pkh address
     */
    public function getAddressP2pkh(string $pubKeyHash): string;

    /**
     * Get p2sh address
     */
    public function getAddressP2sh(string $scriptHash): string;

    /**
     * Get p2wpkh address
     */
    public function getAddressP2wpkh(string $pubKeyHash): string;

    /**
     * Get p2wsh address
     */
    public function getAddressP2wsh(string $witnessHash): string;

    /**
     * Decode address
     */
    public function decodeAddress(string $address): OutputInterface;
}