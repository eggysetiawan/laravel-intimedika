<?php

namespace App\Http\Controllers;

use App\DailyJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\DailyJobDataTable;
use App\Http\Requests\DailyJobRequest;
use App\Services\DailyJobService;
use Illuminate\Support\Facades\DB;

class DailyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DailyJobDataTable $dataTable)
    {
        return $dataTable->render('daily_jobs.index');
    }

    public function timeline()
    {
        return view('daily_jobs.timeline', [
            'dailyJobs' => DailyJob::latest()->paginate(8),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('daily_jobs.create', [
            'dailyJob' => new DailyJob(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DailyJobRequest $request)
    {
        // dd($request->img);
        DB::transaction(function () use ($request) {
            $dailyJob = (new DailyJobService())->createDailyJob($request);

            $imgSlug = uniqid() . '.' . request()->file('img')->extension();
            $dailyJob
                ->addMediaFromRequest('img')
                ->usingFileName($imgSlug)
                ->toMediaCollection('sourcecode');
        });


        session()->flash('success', 'Laporan harian telah berhasil dibuat!');
        return redirect('daily_jobs');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DailyJob  $dailyJob
     * @return \Illuminate\Http\Response
     */
    public function show(DailyJob $dailyJob)
    {
        return view('daily_jobs.show', compact('dailyJob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DailyJob  $dailyJob
     * @return \Illuminate\Http\Response
     */
    public function edit(DailyJob $dailyJob)
    {
        return view('daily_jobs.edit', compact('dailyJob'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DailyJob  $dailyJob
     * @return \Illuminate\Http\Response
     */
    public function update(DailyJobRequest $request, DailyJob $dailyJob)
    {
        $dailyJob->update($request->all());
        session()->flash('success', 'Laporan harian berhasil di update');
        return redirect()->route('daily_jobs.timeline');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DailyJob  $dailyJob
     * @return \Illuminate\Http\Response
     */
    public function destroy(DailyJob $dailyJob)
    {
        $dailyJob->delete();
        session()->flash('success', 'Laporan harian berhasil di hapus');
        return redirect('daily_jobs');
    }
}
