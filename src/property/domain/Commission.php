<?php

declare(strict_types=1);

namespace Src\Property\Domain;

/** Clase que contiene la información sobre las comisiones */
class Commission implements \JsonSerializable
{
    public function __construct(
        private string $type,
        private ?int $value,
        private ?string $currency,
    ) {
        $this->type = $type;
        $this->value = $value;
        $this->currency = $currency;
    }

    public function jsonSerialize()
    {
        return [
            "type" => $this->type,
            "value" => $this->value,
            "currency" => $this->currency,
        ];
    }
}
