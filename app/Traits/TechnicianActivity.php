<?php

namespace App\Traits;

trait TechnicianActivity
{
    public function logs()
    {
        return $this->morphMany('App\Log', 'logable');
    }

    public function worktimes()
    {
        return $this->morphMany('App\Worktime', 'worktimeable');
    }

    public function activities()
    {
        return $this->morphMany('App\Activity', 'activityable');
    }

    public function warranties()
    {
        return $this->morphMany('App\Warranty', 'warrantyable');
    }

    public function date_changes()
    {
        return $this->morphMany('App\DateChange', 'changeable');
    }

    public function installed_modalities()
    {
        return $this->morphMany('App\InstalledModality', 'modalityable');
    }
}
