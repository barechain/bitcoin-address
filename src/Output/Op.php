<?php

declare(strict_types=1);

namespace Barechain\BitcoinAddress\Output;

interface Op
{
    public const DUP = "\x76";
    public const EQUAL = "\x87";
    public const EQUALVERIFY = "\x88";
    public const HASH160 = "\xa9";
    public const CHECKSIG = "\xac";
    public const CHECKMULTISIG = "\xae";
}