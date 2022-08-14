<?php

namespace Src\Property\domain;

/** Contiene información de la paginación */
class Pagination implements \JsonSerializable
{
    public function __construct(
        private int $limit,
        private int $page,
        private int $total,
        private ?string $nextPage
    ) {
        $this->limit = $limit;
        $this->page = $page;
        $this->total = $total;
        $this->nextPage = $nextPage;
    }

    public function jsonSerialize()
    {
        return [
            "limit" => $this->limit,
            "page" => $this->page,
            "total" => $this->total,
            "nextPage" => $this->nextPage
        ];
    }
}
