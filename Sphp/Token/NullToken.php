<?php

namespace Sphp\Token;

use Sphp\Support\LexerType;

final class NullToken extends LexerToken
{
    /**
     * @param int $line
     */
    public function __construct(int $line)
    {
        parent::__construct(LexerType::NULL, null, $line);
    }
}
