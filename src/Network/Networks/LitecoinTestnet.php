<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network\Networks;

class LitecoinTestnet extends Litecoin
{
    protected string $prefixP2pkh = "\x6f";
    protected string $prefixP2sh = "\x3a";
    protected ?string $prefixBech32 = 'tltc';
}