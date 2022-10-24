<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network\Networks;

use Barechain\BitcoinAddress\Exception;
use Barechain\BitcoinAddress\Network\NetworkInterface;
use Barechain\BitcoinAddress\Output\OutputInterface;
use Barechain\BitcoinAddress\Output\Outputs\{P2pkh, P2sh, P2wpkh, P2wsh};
use Barechain\BitcoinAddress\Utils;
use Barechain\BitcoinAddress\Validate;
use function BitWasp\Bech32\{decodeSegwit, encodeSegwit};

class Bitcoin implements NetworkInterface
{
    protected string $prefixP2pkh = "\x00";
    protected string $prefixP2sh = "\x05";
    protected ?string $prefixBech32 = 'bc';

    /**
     * Get p2pkh address
     */
    public function getAddressP2pkh(string $pubKeyHash): string
    {
        return Utils::base58encode($pubKeyHash, $this->prefixP2pkh);
    }

    /**
     * Get p2sh address
     */
    public function getAddressP2sh(string $scriptHash): string
    {
        return Utils::base58encode($scriptHash, $this->prefixP2sh);
    }

    /**
     * Get bech32 prefix
     *
     * @throws Exception
     */
    public function getPrefixBech32(): string
    {
        if (!$this->prefixBech32) {
            throw new Exception('Empty bech32 prefix.');
        }

        return $this->prefixBech32;
    }

    /**
     * Get p2wpkh address
     */
    public function getAddressP2wpkh(string $pubKeyHash): string
    {
        return encodeSegwit($this->getPrefixBech32(), 0, $pubKeyHash);
    }

    /**
     * get p2wsh address
     */
    public function getAddressP2wsh(string $witnessHash): string
    {
        return encodeSegwit($this->getPrefixBech32(), 0, $witnessHash);
    }

    /**
     * Decode address
     *
     * @throws Exception
     */
    public function decodeAddress(string $address): OutputInterface
    {
        if ($this->prefixBech32 && 0 === strpos($address, $this->prefixBech32)) {
            list(, $hash) = decodeSegwit($this->prefixBech32, $address);
            $hashLen = strlen($hash);

            if (Validate::SCRIPT_HASH_LEN == $hashLen) {
                return new P2wpkh($hash);
            } elseif (Validate::WITNESS_HASH_LEN == $hashLen) {
                return new P2wsh($hash);
            }
        }

        list($hash, $prefix) = Utils::base58decode($address);

        if ($prefix == $this->prefixP2pkh) {
            return new P2pkh($hash);
        } elseif ($prefix == $this->prefixP2sh) {
            return new P2sh($hash);
        }

        throw new Exception('Cannot decode address.');
    }
}