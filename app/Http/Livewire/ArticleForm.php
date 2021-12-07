<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Article;

//componente que nos dej crear y editar un articulo
class ArticleForm extends Component
{
    public Article $article;

    //reglas de validacion
    public $rules = [
        'article.title' => ['required', 'min:4'],
        'article.content' => ['required'],
    ];

    //inicializar la propiedad
    public function mount(Article $article)
    {
        $this->article = $article;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    // hace una funcion para insertar registro en bd
    public function save ()
    {
       //validar en tiempo real
       $this->validate();

       //mandar a llamar a la propiedad y al metodo save
       $this->article->save();
       //Mostrar msj de inserccion
       session()->flash('status',__('Articulo Guardado'));

       $this->redirectRoute('articles.index');
    }

    public function render()
    {
        return view('livewire.article-form');
    }
}
