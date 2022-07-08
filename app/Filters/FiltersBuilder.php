<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FiltersBuilder
{
    /** @var FilterInterface[] */
    private array $filters;

    private Builder $query;

    public function __construct(Builder $query, ...$filters)
    {
        $this->filters = $filters;
        $this->query = $query;
    }

    public function push(FilterInterface $filter): void
    {
        $this->filters[] = $filter;
    }

    public function execute(): Builder
    {
        foreach ($this->filters as $filter) {
            $filter->build($this->query);
        }

        return $this->query;
    }
}
