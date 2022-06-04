<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Document;

class TableDocument extends Component
{
    public function render()
    {
        $documents = Document::with('activity', 'signers')->get();
        return view('livewire.table-document')->with(compact('documents'));
    }
}
