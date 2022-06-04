<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activity;
use Illuminate\Pagination\LengthAwarePaginator;

class TableActivity extends Component
{
    public function render()
    {
        $activities = Activity::paginate(5);
        return view('livewire.table-activity')->with(compact('activities'));
    }
}
