<?php

namespace Sphp\Sphp\Token;

use Sphp\Sphp\Support\Grammar;
use Sphp\Sphp\Support\LexerType;

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
