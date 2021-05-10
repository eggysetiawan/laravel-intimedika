<?php

namespace App\Services;

use App\DailyJob;
use Illuminate\Support\Str;

class DailyJobService
{
    public function createDailyJob($request)
    {
        $attr = $request->all();

        $slug = Str::slug($request->title);
        $findSlug = DailyJob::where('slug', Str::slug($request->title))->exists();

        if ($findSlug) {
            $slug = Str::slug($request->title . '-' . uniqid());
        }

        $attr['slug'] = $slug;
        return auth()->user()->daily_jobs()->create($attr);
    }
}
