<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network\Networks;

class Dogecoin extends Bitcoin
{
    protected string $prefixP2pkh = "\x1e";
    protected string $prefixP2sh = "\x16";
    protected ?string $prefixBech32 = null;
}