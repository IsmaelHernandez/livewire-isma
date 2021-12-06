<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Article;

class Articles extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.articles',[
            'articles' => Article::where('title', 'like', "%{$this->search}%"
            )->latest()->get()
            
        ]);
    }
}
// metodo latest para ordenar de forma