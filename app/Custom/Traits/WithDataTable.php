<?php

namespace App\Custom\Traits;

use Livewire\WithPagination;

trait WithDataTable
{
    use WithPagination;

    public $sortBy = 'id';
    public $sortDirection = 'desc';
    public $rpp = 10;

    public function sortBy($column)
    {
        if ($this->sortBy == $column) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->reset('sortDirection');
            $this->sortBy = $column;
        }
        $this->resetPage();
    }

    public function updatingWithDataTable()
    {
        $this->resetPage();
    }
}
