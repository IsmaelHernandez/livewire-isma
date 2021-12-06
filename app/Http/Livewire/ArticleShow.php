<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Article;

class ArticleShow extends Component
{
    //se asigna el modelo ala variable de asignacion
    public Article $article;

    public function render()
    {
        return view('livewire.article-show');
    }
}
