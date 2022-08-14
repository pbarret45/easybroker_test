<?php

declare(strict_types=1);

namespace Src\Property\Domain;

/** Clase que contiene la información de las propiedades */
class Property implements \JsonSerializable
{
    public function __construct(
        private ?string $agent,
        private string $publicId,
        private string $title,
        private string $titleImageFull,
        private string $titleImageThumb,
        private ?int $bedrooms,
        private ?int $bathrooms,
        private ?int $parkingSpaces,
        private string $location,
        private string $propertyType,
        private string $updatedAt,
        private bool $showPrices,
        private bool $shareCommission,
        private string $constructionSize,
        private array $operationList
    ) {
        $this->agent = $agent;
        $this->publicId = $publicId;
        $this->title = $title;
        $this->titleImageFull = $titleImageFull;
        $this->titleImageThumb = $titleImageThumb;
        $this->bedrooms = $bedrooms;
        $this->bathrooms = $bathrooms;
        $this->parkingSpaces = $parkingSpaces;
        $this->location = $location;
        $this->propertyType = $propertyType;
        $this->updatedAt = $updatedAt;
        $this->showPrice = $showPrices;
        $this->shareCommission = $shareCommission;
        $this->constructionSize = $constructionSize;
        $this->operationList = $operationList;
    }

    public function jsonSerialize(): array
    {
        return [
            "title" => $this->title,
            "agent" => $this->agent,
            "titleImageFull" => $this->titleImageFull,
            "titleImageThumb" => $this->titleImageThumb,
            "titleImageFull" => $this->titleImageFull,
            "constructionSize" => $this->constructionSize,
            "bedrooms" => $this->bedrooms,
            "bathrooms" => $this->bathrooms,
            "parkingSpaces" => $this->parkingSpaces,
            "location" => $this->location,
            "propertyType" => $this->propertyType,
            "showPrice" => $this->showPrice,
            "operationList" => $this->operationList,
        ];
    }
}
