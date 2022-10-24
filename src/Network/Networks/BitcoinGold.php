<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network\Networks;

class BitcoinGold extends Bitcoin
{
    protected string $prefixP2pkh = "\x26";
    protected string $prefixP2sh = "\x17";
    protected ?string $prefixBech32 = 'btg';
}