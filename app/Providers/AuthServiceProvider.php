<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\Label;
use App\Models\Status;
use App\Policies\TaskPolicy;
use App\Policies\LabelPolicy;
use App\Policies\StatusPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Task::class => TaskPolicy::class,
        Status::class => StatusPolicy::class,
        Label::class => LabelPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
