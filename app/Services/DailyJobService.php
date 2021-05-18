<?php

namespace App\Services;

use App\DailyJob;
use Illuminate\Support\Str;

class DailyJobService
{

    public function getSlug($request)
    {
        $slug = Str::slug($request->title);

        $findSlug = DailyJob::where('slug', Str::slug($request->title))->exists();
        if ($findSlug) {
            $slug = Str::slug($request->title . '-' . uniqid(auth()->user()->initial . '-'));
        }
        return $slug;
    }

    public function createDailyJob($request)
    {
        $attr = $request->all();
        $attr['slug'] = $this->getSlug($request);
        return $this->dailyJob = auth()->user()->daily_jobs()->create($attr);
    }

    // public function uploadFiles()
    // {
    //     $imgSlug = uniqid() . '.' . request()->file('img')->extension();
    //     return $this->dailyJob
    //         ->addMediaFromRequest('img')
    //         ->usingFileName($imgSlug)
    //         ->toMediaCollection('sourcecode');
    // }
}
