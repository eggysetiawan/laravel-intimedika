<?php

namespace App\Http\Controllers;

use App\Visit;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    public function visit()
    {
        $query = Str::slug(request('query'), '-');
        $visits = Visit::where("visits.slug", "like", "%$query%")
            ->with('customer', 'author')
            ->latest()
            ->paginate(5);
        return view('visits.index', compact('visits'));
    }
}
