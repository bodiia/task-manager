<?php

namespace App\Services;

use App\Filters\SelectFilter;
use App\Filters\FiltersBuilder;
use Illuminate\Database\Eloquent\Builder;

class TaskService
{
    public function getFilteredTaskByQueryParams(Builder $query, array $queryParams)
    {
        $builder = new FiltersBuilder($query);
        foreach ($queryParams as $key => $value) {
            switch ($key) {
                case 'author':
                    $builder->push(new SelectFilter('author', $value, 'id'));
                    break;
                case 'executor':
                    $builder->push(new SelectFilter('executor', $value, 'id'));
                    break;
                case 'status':
                    $builder->push(new SelectFilter('status', $value, 'id'));
                    break;
                default:
                    break;
            }
        }

        return $builder->execute();
    }
}
