<?php

namespace App\Http\Controllers;

use App\Need;
use App\Advance;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\AdvanceRequest;
use App\NeedSource;

class AdvanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('advances.create', [
            'need_sources' => NeedSource::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvanceRequest $request)
    {
        $attr = $request->all();

        $attr['slug'] = Str::slug($request->destination . '-' . $request->objective);

        $advance = auth()->user()->advances()->create($attr);

        foreach ($request->needs as $i => $v) {
            Need::insert([
                'advance_id' => $advance->id,
                'need' => $request->needs[$i],
                'price' => $request->prices[$i],
                'day' => $request->days[$i],
                'total' => ($request->prices[$i] * $request->days[$i]),
                'note' => $request->notes[$i],
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ]);
        }

        session()->flash('success', 'Advances Perjalanan berhasil dibuat!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function show(Advance $advance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function edit(Advance $advance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advance $advance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advance $advance)
    {
        //
    }
}
