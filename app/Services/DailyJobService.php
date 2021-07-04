<?php

namespace App\Services;

use App\DailyJob;
use Illuminate\Support\Str;

class DailyJobService
{

    public function getSlug($request)
    {
        $slug = Str::slug(Str::limit($request->description, 191));

        $findSlug = DailyJob::where('slug', Str::slug($request->description))->exists();
        if ($findSlug) {
            $slug = Str::slug(Str::limit($request->description, 100) . '-' . uniqid(auth()->user()->initial . '-'));
        }
        return $slug;
    }

    public function createDailyJob($request)
    {
        $attr = $request->validated();
        $attr['slug'] = $this->getSlug($request);
        return $this->dailyJob = auth()->user()->daily_jobs()->create($attr);
    }
}
