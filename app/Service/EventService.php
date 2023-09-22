<?php

namespace App\Service;

use Carbon\Carbon;

class EventService
{
    public static function eventStatusDate(Carbon $start_date, Carbon $end_date): string
    {
        // check if event its ended
        if ($end_date->isPast()) {
            return "Ended";
        }

        // check if event its started
        if ($start_date->isPast()) {
            return "Started";
        }

        // check if event its today
        if ($start_date->isToday()) {
            return "Today";
        }

        // check if event its tomorrow
        if ($start_date->isTomorrow()) {
            return "Tomorrow";
        }

        // check if event its this week

        if ($start_date->isCurrentWeek()) {
            return "This week";
        }

        if ($start_date > now()) {
            return "Upcoming";
        }

        return "NULL";
    }
}
