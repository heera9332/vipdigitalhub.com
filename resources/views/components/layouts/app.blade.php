@props(['title' => null, 'description' => null, 'image' => null])

@include('layouts.app', [
    'title' => $title,
    'description' => $description,
    'image' => $image,
    'slot' => $slot,
])
