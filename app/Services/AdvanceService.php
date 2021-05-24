<?php

namespace App\Services;

use App\Need;
use Illuminate\Support\Str;

class AdvanceService
{
    private $advance;

    public function createAdvance($request)
    {
        $attr = $request->validated();
        $attr['slug'] = Str::slug($request->destination . '-' . $request->objective);
        return $this->advance = auth()->user()->advances()->create($attr);
    }

    public function insertNeeds($request)
    {
        $needs = [];
        foreach ($request->needs as $i => $v) {
            $needs = Need::insert([
                'advance_id' => $this->advance->id,
                'need' => $request->needs[$i],
                'price' => $request->prices[$i],
                'day' => $request->days[$i],
                'total' => ($request->prices[$i] * $request->days[$i]),
                'note' => $request->notes[$i],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);
        }
        return $needs;
    }
}
