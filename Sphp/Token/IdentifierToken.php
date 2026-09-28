<?php

namespace Sphp\Sphp\Token;

use Sphp\Sphp\Support\LexerType;

final class IdentifierToken extends LexerToken
{
    /**
     * @param string $value
     * @param int $line
     */
    public function __construct(string $value, int $line)
    {
        parent::__construct(LexerType::IDENTIFIER, $value, $line);
    }
}
