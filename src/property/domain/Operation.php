<?php

declare(strict_types=1);

namespace Src\Property\Domain;

/** Clase que contiene información de la operación */
class Operation implements \JsonSerializable
{
    public function __construct(
        private string $type,
        private float $amount,
        private string $formatedAmount,
        private string $currency,
        private ?string $unit,
        private ?string $period,
        private ?Commission $commission
    ) {
        $this->type = $type;
        $this->amount = $amount;
        $this->formatedAmount = $formatedAmount;
        $this->currency = $currency;
        $this->unit = $unit;
        $this->period = $period;
        $this->commission = $commission;
    }

    public function jsonSerialize(): array
    {
        return [
            "type" => $this->type,
            "amount" => $this->amount,
            "formatedAmount" => $this->formatedAmount,
            "currency" => $this->currency,
            "unit" => $this->unit,
            "period" => $this->period,
            "commission" => $this->commission,

        ];
    }
}
