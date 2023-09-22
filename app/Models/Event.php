<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;

class Event extends Model
{
    use HasFactory,
        Sluggable,
        HasTags,
        SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'body',
        'place',
        'start_date',
        'end_date',
        'price',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attendees(): HasMany
    {
        return $this->hasMany(Attendee::class);
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'active');
    }

    public function scopeIsNotFinished(Builder $query): void
    {
        $query->where('end_date', '>=', now());
    }

    public function isPublished(): bool
    {
        return $this->status === 'active';
    }

    public function scopeCheckIfIsAttendeed(Builder $query): void
    {
        $query->addSelect([
            'is_attended' => Attendee::query()
                ->select('id')
                ->where('user_id', auth()->id())
                ->whereColumn('event_id', 'events.id')
        ]);
    }

    public function scopeEventIAmGoingTo(Builder $query): void
    {
        $query->withWhereHas('attendees', function ($query) {
            $query->where('user_id', auth()->id());
        });
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (auth()->check()) {
                $event->user_id = auth()->id();
                $event->status = 'active';
            }
        });
    }
}
