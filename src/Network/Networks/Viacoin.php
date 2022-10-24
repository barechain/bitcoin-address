<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Network\Networks;

class Viacoin extends Bitcoin
{
    protected string $prefixP2pkh = "\x47";
    protected string $prefixP2sh = "\x21";
    protected ?string $prefixBech32 = 'via';
}