<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Output\Outputs;

use Barechain\BitcoinAddress\Exception;
use Barechain\BitcoinAddress\Network\NetworkInterface;
use Barechain\BitcoinAddress\Output\{AbstractOutput, Op, OutputInterface};
use Barechain\BitcoinAddress\Validate;

class P2sh extends AbstractOutput
{
    public const SCRIPT_LEN = 23;

    protected string $scriptHash;

    /**
     * P2sh constructor
     */
    public function __construct($scriptHash)
    {
        if ($scriptHash instanceof OutputInterface) {
            $scriptHash = $scriptHash->hash();
        }

        $this->scriptHash = Validate::scriptHash($scriptHash);
    }

    /**
     * Get script
     */
    public function script(): string
    {
        return Op::HASH160 . "\x14" . $this->scriptHash . Op::EQUAL;
    }

    /**
     * Get asm
     */
    public function asm(): string
    {
        return sprintf('HASH160 PUSHDATA(20)[%s] EQUAL', bin2hex($this->scriptHash));
    }

    /**
     * Get address value
     */
    public function address(NetworkInterface $network = null): string
    {
        return $this->network($network)->getAddressP2sh($this->scriptHash);
    }

    /**
     * Validate script
     *
     * @throws Exception
     */
    static public function validateScript(string $script): void
    {
        if (static::SCRIPT_LEN != strlen($script)) {
            throw new Exception('Invalid P2SH script length.');
        }

        if (Op::HASH160 != $script[0] ||
            "\x14" != $script[1] ||
            Op::EQUAL != $script[-1]) {
            throw new Exception('Invalid P2SH script format.');
        }
    }

    /**
     * From script
     */
    static public function fromScript(string $script): OutputInterface
    {
        static::validateScript($script);

        $scriptHash = substr($script, 2, -1);

        return new static($scriptHash);
    }
}