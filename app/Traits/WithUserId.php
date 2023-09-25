<?php

namespace App\Traits;

trait WithUserId
{
    public static function bootWithUserId(): void
    {
        static::creating(function ($model) {
            if (auth()->check()) {
                $model->user_id = auth()->id();
            }
        });
    }
}
