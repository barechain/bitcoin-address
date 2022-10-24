<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network\Networks;

use Barechain\BitcoinAddress\Exception;
use Barechain\BitcoinAddress\Output\OutputInterface;
use Barechain\BitcoinAddress\Output\Outputs\{P2pkh, P2sh};
use CashAddr\CashAddress;

class BitcoinCash extends Bitcoin
{
    protected string $prefixP2pkh = 'bitcoincash';
    protected string $prefixP2sh = 'bitcoincash';
    protected ?string $prefixBech32 = null;

    /**
     * Get p2pkh address
     */
    public function getAddressP2pkh(string $pubKeyHash): string
    {
        return CashAddress::encode($this->prefixP2pkh, 'pubkeyhash', $pubKeyHash);
    }

    /**
     * Get p2sh address
     */
    public function getAddressP2sh(string $scriptHash): string
    {
        return CashAddress::encode($this->prefixP2sh, 'scripthash', $scriptHash);
    }

    /**
     * Decode address
     *
     * @throws Exception
     */
    public function decodeAddress(string $address): OutputInterface
    {
        if (strpos($address, $this->prefixP2pkh) !== 0 ||
            strpos($address, $this->prefixP2sh) !== 0) {
            throw new Exception('Cannot decode address.');
        }

        list(, $scriptType, $hash) = CashAddress::decode($address);

        if ($scriptType == 'pubkeyhash') {
            return new P2pkh($hash);
        } else {
            return new P2sh($hash);
        }
    }
}