<?php

namespace App\DTOs\Pagination;

final class PaginationDTO
{
    public function __construct(
        public int $page,
        public int $perPage
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            $data['page'] ?? 1,
            $data['per_page'] ?? 10
        );
    }
}
