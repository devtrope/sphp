<?php

namespace Sphp\Token;

use Override;
use Sphp\Support\Grammar;
use Sphp\Support\LexerType;
use UnexpectedValueException;

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

    #[Override]
    public function getValue(): string
    {
        if (false === \is_string($this->value)) {
            throw new UnexpectedValueException(\sprintf(
                'Expected identifier %s to be a string, got %s.',
                $this->value, /* @phpstan-ignore-line */
                get_debug_type($this->value)
            ));
        }

        /**
         * SPHP handle classes as PHP, with the ::class prefix not just as a simple string,
         * so at this point we have to check if the identifier is a simple string OR a specific class
         * from the developer's project
         */
        if (stripos($this->value, Grammar::BACKSLASH)) {
            $this->value .= Grammar::CLASSNAME;
        }
        return $this->value;
    }
}
