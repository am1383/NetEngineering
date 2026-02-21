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
            $data['page'] ?? config('pagination.default_page'),
            $data['per_page'] ?? config('pagination.default_per_page'),
        );
    }
}
