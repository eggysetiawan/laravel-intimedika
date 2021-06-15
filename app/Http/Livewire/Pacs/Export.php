<?php

namespace App\Http\Livewire\Pacs;

use App\PacsInstallation;
use Livewire\Component;
use Livewire\WithPagination;

class Export extends Component
{
    use WithPagination;

    public $query = '';

    public $perPage = 10;
    public $select = [];

    public $selectPageRows = false;
    public $selectedRows = [];



    public function updatedselectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->pacsInstallations->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    public function getPacsInstallationsProperty()
    {

        return PacsInstallation::query()
            ->whereHas('hospital', function ($q) {
                return $q->where('name', 'like', "%$this->query%")
                    ->orWhere('city', 'like', "%$this->query%");
            })
            ->orderBy('start_installation_date', 'desc')
            ->paginate($this->perPage);
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function render()
    {
        return view('livewire.pacs.export', [
            'pacsInstallations' => $this->pacsInstallations
        ]);
    }
}
