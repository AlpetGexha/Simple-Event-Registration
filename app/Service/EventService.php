<?php

namespace App\Service;

use Carbon\Carbon;

class EventService
{
    public static function eventStatusDate(Carbon $start_date, Carbon $end_date): string
    {
        if ($end_date->isPast()) {
            return 'Ended';
        }

        if ($start_date->isPast()) {
            return 'Started';
        }

        if ($start_date->isToday()) {
            return 'Today';
        }

        if ($start_date->isTomorrow()) {
            return 'Tomorrow';
        }

        if ($start_date->isCurrentWeek()) {
            return 'This week';
        }

        if ($start_date > now()) {
            return 'Upcoming';
        }

        return 'NULL';
    }

    public static function dateRange(Carbon $from, Carbon $to): string
    {
        $start = Carbon::parse($from)->isoFormat('MMM Do YYYY h:mm');
        $end = Carbon::parse($to)->isoFormat('MMM Do YYYY h:mm');

        return "{$start} - {$end}";
    }
}
