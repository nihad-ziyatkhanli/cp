<?php

namespace App\Custom\Traits;

use Livewire\WithPagination;

trait WithDataTable
{
    use WithPagination;

    public $sortBy;
    public $sortDirection;
    public $rpp = 10;

    public function sortBy($column)
    {
        if ($this->sortBy == $column) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
            $this->sortBy = $column;
        }
        $this->resetPage();
    }

    public function updatingWithDataTable()
    {
        $this->resetPage();
    }
}
