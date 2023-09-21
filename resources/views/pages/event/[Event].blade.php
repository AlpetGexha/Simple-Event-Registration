<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Event;

use function Laravel\Folio\name;
name('event.single')

use function Laravel\Folio\render;
render(function (View $view, Event $event) {

    if (!$event->isPublished())
        return response('Not Found', 404);
});


?>



<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($event->title) }}
        </h2>
    </x-slot>

    <div class="py-12">

        Title: {{ $event->title }}
        <br>
        Description: {{ $event->description }}
        <br>
        Location: {{ $event->place }}
        <br>
        Start Date: {{ $event->start_date }}
        to
        End Date: {{ $event->end_date }}
        <br>

        START TIME: {{ $event->start_date->diffForHumans() }}
        <br>

        HOST: {{$event->user->name}}


{{--        @dump($event)--}}

    </div>
</x-app-layout>
