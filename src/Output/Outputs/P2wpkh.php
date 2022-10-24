<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Output\Outputs;

use Barechain\BitcoinAddress\Exception;
use Barechain\BitcoinAddress\Network\NetworkInterface;
use Barechain\BitcoinAddress\Output\{AbstractOutput, OutputInterface};
use Barechain\BitcoinAddress\Validate;

class P2wpkh extends AbstractOutput
{
    public const SCRIPT_LEN = 22;

    protected string $pubKeyHash;

    /**
     * P2wpkh constructor
     */
    public function __construct(string $pubKeyHash)
    {
        $this->pubKeyHash = Validate::pubKeyHash($pubKeyHash);
    }

    /**
     * Get script
     */
    public function script(): string
    {
        return "\x00\x14" . $this->pubKeyHash;
    }

    /**
     * Get asm
     */
    public function asm(): string
    {
        return sprintf('0 PUSHDATA(20)[%s]', bin2hex($this->pubKeyHash));
    }

    /**
     * Get address
     */
    public function address(?NetworkInterface $network = null): string
    {
        return $this->network($network)->getAddressP2wpkh($this->pubKeyHash);
    }

    /**
     * Validate script
     *
     * @throws Exception
     */
    static public function validateScript(string $script): void
    {
        if (static::SCRIPT_LEN != strlen($script)) {
            throw new Exception('Invalid P2WPKH script length.');
        }

        if ("\x00" != $script[0] ||
            "\x14" != $script[1]) {
            throw new Exception('Invalid P2WPKH script format.');
        }
    }

    /**
     * Get from script
     */
    static public function fromScript(string $script): OutputInterface
    {
        static::validateScript($script);

        $pubKeyHash = substr($script, 2, 20);

        return new static($pubKeyHash);
    }
}