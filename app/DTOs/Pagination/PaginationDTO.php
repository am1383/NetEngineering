<?php 
declare(strict_types=1);

namespace App\DTOs\Pagination;

final class PaginationDTO
{
    public function __construct(
        public readonly ?int $page = null,
        public readonly ?int $perPage = null
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            isset($data['page']) ? (int) $data['page'] : null,
            isset($data['per_page']) ? (int) $data['per_page'] : null
        );
    }
}
