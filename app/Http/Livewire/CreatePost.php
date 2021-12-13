<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public $open = false;

    public $title;
    public $content;

    //reglas de validacion
    protected $rules = [
        'title' =>'required',
        'content' =>'required',
    ];

    //validacion en tiempo real
    //definir un metodo update se activa cada ves que se modifique las propiedades definidas
    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName); //valida si cumple con las reglas de validacion
    // }


    public function save()
    {
        //metodo validate verifica reglas de validacion
        $this->validate();

        Post::create([
            'title' => $this->title,
            'content' => $this->content
        ]);

        //mandamos a llamar a reset method
        $this->reset(['open','title','content']);
        //emitir un evento //llamar al metodo emit para renderizar el otro componente
        $this->emit('render');
        //emitimos evento alert para una alert
        $this->emit('alert','El post se creo satisfactoriamente');

    }

    public function render()
    {
        return view('livewire.create-post');
    }

    

}
