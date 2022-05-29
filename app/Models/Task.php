<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status_id',
        'author_id',
        'executor_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function status()
    {
        return $this->hasOne(TaskStatus::class, 'id', 'status_id');
    }

    public function executor()
    {
        return $this->hasOne(User::class, 'id', 'executor_id');
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class, 'task_label', 'task_id', 'label_id');
    }
}
