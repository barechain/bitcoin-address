<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network\Networks;

class Zcash extends Bitcoin
{
    protected string $prefixP2pkh = "\x1c\xb8";
    protected string $prefixP2sh = "\x1c\xbd";
    protected ?string $prefixBech32 = null;
}