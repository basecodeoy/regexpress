<?php

declare(strict_types=1);

namespace PreemStudio\RegExpress\Concerns;

trait HasPattern
{
    private string $pattern = '';

    public function startOfLine(): static
    {
        $this->pattern .= '^';

        return $this;
    }

    public function endOfLine(): static
    {
        $this->pattern .= '$';

        return $this;
    }

    public function then($string): static
    {
        $this->pattern .= preg_quote($string, '/');

        return $this;
    }

    public function find($pattern): static
    {
        $this->pattern .= $pattern;

        return $this;
    }

    public function maybe($pattern): static
    {
        $this->pattern .= "(?:$pattern)?";

        return $this;
    }

    public function or($pattern): static
    {
        $this->pattern .= "|$pattern";

        return $this;
    }

    public function anything(): static
    {
        $this->pattern .= '.*';

        return $this;
    }

    public function anythingBut($pattern): static
    {
        $this->pattern .= "(?:[^$pattern]*)";

        return $this;
    }

    public function something(): static
    {
        $this->pattern .= '.+';

        return $this;
    }

    public function somethingBut($pattern): static
    {
        $this->pattern .= "(?:[^$pattern]+)";

        return $this;
    }

    public function anyOf($chars): static
    {
        $this->pattern .= "[$chars]";

        return $this;
    }

    public function any(): static
    {
        $this->pattern .= '.';

        return $this;
    }

    public function not($pattern): static
    {
        $this->pattern .= "(?!$pattern)";

        return $this;
    }

    public function range($from, $to): static
    {
        $this->pattern .= "[$from-$to]";

        return $this;
    }

    public function lineBreak(): static
    {
        $this->pattern .= "(?:\r\n|\r|\n)";

        return $this;
    }

    public function br(): static
    {
        $this->lineBreak();

        return $this;
    }

    public function tab(): static
    {
        $this->pattern .= "\t";

        return $this;
    }

    public function word(): static
    {
        $this->pattern .= "\w";

        return $this;
    }

    public function digit(): static
    {
        $this->pattern .= "\d";

        return $this;
    }

    public function whitespace(): static
    {
        $this->pattern .= "\s";

        return $this;
    }

    public function addModifier($modifier): static
    {
        $this->pattern .= "(?$modifier)";

        return $this;
    }

    public function removeModifier($modifier): static
    {
        $this->pattern .= "(?$modifier-)";

        return $this;
    }

    public function withAnyCase(): static
    {
        $this->addModifier('i');

        return $this;
    }

    public function stopAtFirst(): static
    {
        $this->addModifier('U');

        return $this;
    }

    public function searchOneLine(): static
    {
        $this->removeModifier('m');

        return $this;
    }

    public function repeatPrevious(int $count = 0): static
    {
        if ($count > 0) {
            $this->pattern .= '{'.$count.'}';
        } else {
            $this->pattern .= '+';
        }

        return $this;
    }

    public function oneOrMore(): static
    {
        $this->pattern .= '+';

        return $this;
    }

    public function multiple($min, $max): static
    {
        $this->pattern .= sprintf('{%s,%s}', $min, $max);

        return $this;
    }

    public function beginCapture(): static
    {
        $this->pattern .= '(';

        return $this;
    }

    public function endCapture(): static
    {
        $this->pattern .= ')';

        return $this;
    }

    public function toRegExp(): string
    {
        return '/'.$this->pattern.'/';
    }
}
