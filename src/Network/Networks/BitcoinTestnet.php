<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network\Networks;

class BitcoinTestnet extends Bitcoin
{
    protected string $prefixP2pkh = "\x6f";
    protected string $prefixP2sh = "\xc4";
    protected ?string $prefixBech32 = 'tb';
}