<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network\Networks;

class DashTestnet extends Dash
{
    protected string $prefixP2pkh = "\x8b";
    protected string $prefixP2sh = "\x13";
}