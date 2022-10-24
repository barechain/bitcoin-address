<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network\Networks;

class Dash extends Bitcoin
{
    protected string $prefixP2pkh = "\x4c";
    protected string $prefixP2sh = "\x10";
    protected ?string $prefixBech32 = null;
}