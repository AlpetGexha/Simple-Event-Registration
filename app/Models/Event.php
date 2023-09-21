<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory,
        Sluggable,
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

    public function isPublished(): bool
    {
        return $this->status === 'active';
    }

    public function scopeWithPeopopleWhoIsGoing(Builder $query): void
    {
        // list all the perople from this event who are attendees this event
        $query->with(['attendees' => function ($query) {
            $query->with('user')->where('status', 'going');
        }]);
    }

    public function scopeCheckIfIsAttendeed(Builder $query)
    {
        $query->addSelect([
            'is_attended' => Attendee::query()
                ->select('id')
                ->where('user_id', auth()->id())
                ->whereColumn('event_id', 'events.id'),

        ]);
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
