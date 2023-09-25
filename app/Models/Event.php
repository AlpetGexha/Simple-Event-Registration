<?php

namespace App\Models;

use App\Traits\WithUserId;
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
        HasTags,
        Sluggable,
        SoftDeletes,
        WithUserId;

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

    public function scopeCountAttendees(Builder $query): void
    {
        $query->withCount([
            'attendees' => fn ($query) => $query->whereStatus('going'),
        ]);
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
                ->whereColumn('event_id', 'events.id'),
        ]);
    }

    public function scopeEventIAmGoingTo(Builder $query): void
    {
        $query->withWhereHas('attendees', function ($query) {
            $query->where('user_id', auth()->id());
        });
    }

    public function scopeMyEvents(Builder $query): void
    {
        $query->where('user_id', auth()->id());
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
