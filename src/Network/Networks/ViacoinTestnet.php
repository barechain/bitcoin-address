<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network\Networks;

class ViacoinTestnet extends Viacoin
{
    protected string $prefixP2pkh = "\x7f";
    protected string $prefixP2sh = "\xc4";
    protected ?string $prefixBech32 = 'tvia';
}