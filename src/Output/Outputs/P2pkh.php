<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Output\Outputs;

use Barechain\BitcoinAddress\Exception;
use Barechain\BitcoinAddress\Network\NetworkInterface;
use Barechain\BitcoinAddress\Output\{AbstractOutput, Op, OutputInterface};
use Barechain\BitcoinAddress\Validate;

class P2pkh extends AbstractOutput
{
    public const SCRIPT_LEN = 25;

    protected string $pubKeyHash;

    /**
     * P2pkh constructor
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
        return Op::DUP . Op::HASH160 . "\x14" . $this->pubKeyHash . Op::EQUALVERIFY . Op::CHECKSIG;
    }

    /**
     * Get asm
     */
    public function asm(): string
    {
        return sprintf('DUP HASH160 PUSHDATA(20)[%s] EQUALVERIFY CHECKSIG', bin2hex($this->pubKeyHash));
    }

    /**
     * Get address value
     */
    public function address(?NetworkInterface $network = null): string
    {
        return $this->network($network)->getAddressP2pkh($this->pubKeyHash);
    }

    /**
     * Validate script
     *
     * @throws Exception
     */
    static public function validateScript(string $script): void
    {
        if (static::SCRIPT_LEN != strlen($script)) {
            throw new Exception('Invalid P2PKH script length.');
        }

        if (Op::DUP != $script[0] ||
            Op::HASH160 != $script[1] ||
            "\x14" != $script[2] ||
            Op::EQUALVERIFY != $script[-2] ||
            Op::CHECKSIG != $script[-1]
        ) {
            throw new Exception('Invalid P2PKH script format.');
        }
    }

    /**
     * Get from script
     */
    static public function fromScript(string $script): OutputInterface
    {
        static::validateScript($script);

        $pubKeyHash = substr($script, 3, 20);

        return new static($pubKeyHash);
    }
}