<?php

namespace Sphp\Token;

use Sphp\Support\LexerType;
use Override;

final class BooleanToken extends LexerToken
{
    /**
     * @param string $value
     * @param int $line
     */
    public function __construct(string $value, int $line)
    {
        parent::__construct(LexerType::BOOLEAN, $value, $line);
    }

    #[Override]
    public function getValue(): bool|null
    {
        return filter_var($this->value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
    }
}
