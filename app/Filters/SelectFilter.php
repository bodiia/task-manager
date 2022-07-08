<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SelectFilter implements FilterInterface
{
    private string $relation;

    private string $value;

    private string $field;

    public function __construct(string $relation, string $value, string $field)
    {
        $this->relation = $relation;
        $this->value = $value;
        $this->field = $field;
    }

    public function build(Builder $query): Builder
    {
        return $query->whereHas($this->relation, function (Builder $query) {
            return $query->where($this->field, $this->value);
        });
    }
}
