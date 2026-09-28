<?php

namespace Sphp\Token;

use Sphp\Support\Grammar;
use Sphp\Support\LexerType;

final class ColonToken extends LexerToken
{
    /**
     * @param int $line
     */
    public function __construct(int $line)
    {
        parent::__construct(LexerType::COLON, Grammar::COLON, $line);
    }
}
