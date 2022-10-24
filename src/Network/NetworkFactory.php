<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network;

use Barechain\BitcoinAddress\Exception;

class NetworkFactory
{
    static protected array $networks = [
        'bitcoin',
        'bitcoinTestnet',
        'bitcoinCash',
        'bitcoinGold',
        'litecoin',
        'litecoinTestnet',
        'dogecoin',
        'dogecoinTestnet',
        'viacoin',
        'viacoinTestnet',
        'dash',
        'dashTestnet',
        'zcash',
    ];

    static protected ?NetworkInterface $defaultNetwork = null;

    /**
     * Set default network
     */
    static public function setDefaultNetwork(NetworkInterface $network): void
    {
        static::$defaultNetwork = $network;
    }

    /**
     * Get default network
     */
    static public function getDefaultNetwork(): NetworkInterface
    {
        return static::$defaultNetwork ?: static::bitcoin();
    }

    /**
     * Create network
     *
     * @throws Exception
     */
    public function createNetwork(string $name, array $arguments): NetworkInterface
    {
        if (!in_array($name, static::$networks)) {
            throw new Exception(sprintf('Invalid network name: %s.', $name));
        }

        $class = 'Barechain\\BitcoinAddress\\Network\\Networks\\' . ucfirst($name);

        return new $class(...$arguments);
    }

    /**
     * Call
     */
    public function __call($name, $arguments): NetworkInterface
    {
        return $this->createNetwork($name, $arguments);
    }

    /**
     * Call static
     */
    public static function __callStatic($name, $arguments): NetworkInterface
    {
        return (new static)->createNetwork($name, $arguments);
    }
}