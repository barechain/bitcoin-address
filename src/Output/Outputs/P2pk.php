<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Output\Outputs;

use Barechain\BitcoinAddress\Exception;
use Barechain\BitcoinAddress\Network\NetworkInterface;
use Barechain\BitcoinAddress\Output\{AbstractOutput, Op, OutputInterface};
use Barechain\BitcoinAddress\Utils;
use Barechain\BitcoinAddress\Validate;

class P2pk extends AbstractOutput
{
    public const COMPRESSED_SCRIPT_LEN = 35;
    public const UNCOMPRESSED_SCRIPT_LEN = 67;

    protected string $pubKey;

    /**
     * P2pk constructor
     */
    public function __construct(string $pubKey)
    {
        $this->pubKey = Validate::pubKey($pubKey);
    }

    /**
     * Get script
     */
    public function script(): string
    {
        return chr(strlen($this->pubKey)) . $this->pubKey . Op::CHECKSIG;
    }

    /**
     * Get asm
     */
    public function asm(): string
    {
        return sprintf('PUSHDATA(%d)[%s] CHECKSIG', strlen($this->pubKey), bin2hex($this->pubKey));
    }

    /**
     * Get address
     */
    public function address(?NetworkInterface $network = null): string
    {
        return $this->network($network)->getAddressP2pkh(Utils::hash160($this->pubKey));
    }

    /**
     * Validate script
     *
     * @throws Exception
     */
    static public function validateScript(string $script): void
    {
        $scriptLen = strlen($script);

        if (static::COMPRESSED_SCRIPT_LEN != $scriptLen &&
            static::UNCOMPRESSED_SCRIPT_LEN != $scriptLen) {
            throw new Exception('Invalid P2PK script length.');
        }

        if (("\x21" != $script[0] && "\x41" != $script[0]) || Op::CHECKSIG != $script[-1]) {
            throw new Exception('Invalid P2PK script format.');
        }
    }

    /**
     * From script
     */
    static public function fromScript(string $script): OutputInterface
    {
        static::validateScript($script);

        $pubKey = substr($script, 1, -1);

        return new static($pubKey);
    }
}