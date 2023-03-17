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

    public function then(string $value): static
    {
        $this->pattern .= preg_quote($value, '/');

        return $this;
    }

    public function find(string $value): static
    {
        $this->pattern .= $value;

        return $this;
    }

    public function maybe(string $value): static
    {
        $this->pattern .= "(?:$value)?";

        return $this;
    }

    public function or(?string $value): static
    {
        $this->pattern .= '|';

        if (is_string($value)) {
            $this->pattern .= $value;
        }

        return $this;
    }

    public function anything(): static
    {
        $this->pattern .= '.*';

        return $this;
    }

    public function anythingBut(string $value): static
    {
        $this->pattern .= "(?:[^$value]*)";

        return $this;
    }

    public function something(): static
    {
        $this->pattern .= '.+';

        return $this;
    }

    public function somethingBut(string $value): static
    {
        $this->pattern .= "(?:[^$value]+)";

        return $this;
    }

    public function anyOf(string $characters): static
    {
        $this->pattern .= "[$characters]";

        return $this;
    }

    public function any(): static
    {
        $this->pattern .= '.';

        return $this;
    }

    public function not(string $value): static
    {
        $this->pattern .= "(?!$value)";

        return $this;
    }

    public function range(int|string $from, int|string $to): static
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

    public function addModifier(string $modifier): static
    {
        $this->pattern .= "(?$modifier)";

        return $this;
    }

    public function removeModifier(string $modifier): static
    {
        $this->pattern .= "(?$modifier-)";

        return $this;
    }

    public function withAnyCase(bool $enabled = true): static
    {
        $enabled ? $this->addModifier('i') : $this->removeModifier('i');

        return $this;
    }

    public function stopAtFirst(bool $enabled = true): static
    {
        $enabled ? $this->removeModifier('U') : $this->addModifier('U');

        return $this;
    }

    public function searchOneLine(bool $enabled = true): static
    {
        $enabled ? $this->removeModifier('m') : $this->addModifier('m');

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

    public function zeroOrMore(string $value): static
    {
        $this->pattern .= "{$value}*";

        return $this;
    }

    public function atLeast(int $min): static
    {
        $this->pattern .= sprintf('{%s,}', $min);

        return $this;
    }

    public function multiple(int $min, int $max): static
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
