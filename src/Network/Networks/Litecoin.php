<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network\Networks;

class Litecoin extends Bitcoin
{
    protected string $prefixP2pkh = "\x30";
    protected string $prefixP2sh = "\x32";
    protected ?string $prefixBech32 = 'ltc';
}