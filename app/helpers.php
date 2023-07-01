<?php

use App\Models\User;
use Carbon\Carbon;

const USER_SHORT_DATE = 'd M, Y';
const USER_LONG_DATE = 'd M, Y H:i A';

function date_formatter($date, $format = USER_LONG_DATE): string
{
    $date = Carbon::parse($date);

    return $date->format($format);
}

function notify_success($text, $source = null): void
{
    session()->flash('success', __($text));

    if ($source) {
        $source->emit('notify_success', $text);
    }
}

function notify_error($text, $source = null): void
{
    session()->flash('error', __($text));

    if ($source) {
        $source->emit('notify_error', $text);
    }
}

function get_setting($name)
{
    if ($setting = \App\Models\Settings::query()->first()) {
        return $setting->value($name);
    } else {
        return null;
    }
}

if (! function_exists('user')) {
    function user(): ?User
    {
        return auth()->user() ?? auth()->guard('sanctum')->user();
    }
}

function web_route(...$path): string
{
    $publicDomain = config('app.web_url');

    $path = implode('/', $path);

    $path = str_starts_with($path, '/') ? $path : ('/'.$path);

    $publicDomain = str_ends_with($publicDomain, '/') ? substr($publicDomain, 0, -1) : $publicDomain;

    return $publicDomain.$path;
}

function resource_url($url, $temporary = false): ?string
{
    if (blank($url)) {
        return null;
    }

    if ($url instanceof \Livewire\TemporaryUploadedFile) {
        return $url->temporaryUrl();
    }

    if (filter_var($url, FILTER_VALIDATE_URL)) {
        return $url;
    }

    return \Illuminate\Support\Facades\Storage::url($url);
}

function validation_attributes(): array
{
    $validationAttributes = \Illuminate\Support\Facades\Lang::get('attributes');
    if (! is_array($validationAttributes)) {
        return [];
    }

    return array_merge($validationAttributes, ['form' => $validationAttributes]);
}

if (!function_exists('default_404_image')) {
    function default_404_image()
    {
        return asset('/images/default-img.png');
    }
}
