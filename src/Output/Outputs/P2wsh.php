<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Output\Outputs;

use Barechain\BitcoinAddress\Exception;
use Barechain\BitcoinAddress\Network\NetworkInterface;
use Barechain\BitcoinAddress\Output\{AbstractOutput, OutputInterface};
use Barechain\BitcoinAddress\Validate;

class P2wsh extends AbstractOutput
{
    public const SCRIPT_LEN = 34;

    protected string $witnessHash;

    /**
     * P2wsh constructor
     */
    public function __construct($witnessHash)
    {
        if ($witnessHash instanceof OutputInterface) {
            $witnessHash = $witnessHash->witnessHash();
        }

        $this->witnessHash = Validate::witnessHash($witnessHash);
    }

    /**
     * Get script
     */
    public function script(): string
    {
        return "\x00\x20" . $this->witnessHash;
    }

    /**
     * Get asm
     */
    public function asm(): string
    {
        return sprintf('0 PUSHDATA(32)[%s]', bin2hex($this->witnessHash));
    }

    /**
     * Get address
     */
    public function address(?NetworkInterface $network = null): string
    {
        return $this->network($network)->getAddressP2wsh($this->witnessHash);
    }

    /**
     * Validate script
     *
     * @throws Exception
     */
    static public function validateScript(string $script): void
    {
        if (static::SCRIPT_LEN != strlen($script)) {
            throw new Exception('Invalid P2WSH script length.');
        }

        if ("\x00" != $script[0] ||
            "\x20" != $script[1]) {
            throw new Exception('Invalid P2WSH script format.');
        }
    }

    /**
     * From script
     */
    static public function fromScript(string $script): OutputInterface
    {
        static::validateScript($script);

        $witnessHash = substr($script, 2, 32);

        return new static($witnessHash);
    }
}