<?php

namespace App\Providers;

use Livewire\Component;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Component::macro('notify', function ($message, $title = '', $type = 'success') {
            $this->dispatch('notify', ['message' => $message, 'title' => $title, 'type' => $type]);
        });

        Builder::macro('search', function($field, $string){
            return $string ? $this->where($field, 'like', '%'.$string.'%') : $this;
        });

        Builder::macro('orSearch', function($field, $string){
            return $string ? $this->orWhere($field, 'like', '%'.$string.'%') : $this;
        });
    }
}
