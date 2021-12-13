<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class EditPost extends Component
{
    public $open = false;
    //definimos post
    public $post;

    //reglas de validacion
    protected $rules = [
        'post.title' =>'required',
        'post.content' =>'required',
    ];

    //metodo mount para recivir el parametro
    public function mount(Post $post){
        $this->post = $post;
    }

    public function save(){
        //metodo validate verifica reglas de validacion
        $this->validate();
        //mandar a llamar a la propiedad post y pasarle el metodo save
        $this->post->save();
         //mandamos a llamar a reset method
         $this->reset(['open']); 
        //emitir un evento //llamar al metodo emit para renderizar el otro componente
        $this->emit('render-edit');
        //emitimos evento alert para una alert
        $this->emit('alert','El post se edito satisfactoriamente');

        
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
