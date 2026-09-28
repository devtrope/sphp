<?php

namespace Sphp\Sphp\Token;

use Sphp\Sphp\Support\LexerType;

final class StringToken extends LexerToken
{
    /**
     * @param string|null $value
     * @param int $line
     */
    public function __construct(string|null $value, int $line)
    {
        parent::__construct(LexerType::STRING, $value, $line);
    }
}
