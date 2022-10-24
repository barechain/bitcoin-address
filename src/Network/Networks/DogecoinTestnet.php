<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network\Networks;

class DogecoinTestnet extends Dogecoin
{
    protected string $prefixP2pkh = "\x71";
    protected string $prefixP2sh = "\xc4";
    protected ?string $prefixBech32 = null;
}