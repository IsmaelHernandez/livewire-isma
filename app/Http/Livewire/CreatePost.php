<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public $open = false;

    public $title;
    public $content;


    public function save()
    {
        Post::create([
            'title' => $this->title,
            'content' => $this->content
        ]);

        //emitir un evento //llamar al metodo emit para renderizar el otro componente
        $this->emit('render');
         

    }

    public function render()
    {
        return view('livewire.create-post');
    }

    

}
