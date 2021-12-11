<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class ShowPosts extends Component
{
    public $search; //variable para hacer reactivo al buscador
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners = ['render' => 'render' ]; //dentro de este array se debe escuchar el evento

    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
                        ->orWhere('content', 'like', '%' . $this->search . '%')
                        ->orderBy($this->sort, $this->direction)
                        ->get();
                        
        return view('livewire.show-posts', compact('posts'));
    }

    //lo recibiremos por una var sort
    public function order($sort){

        //lo que tengo almacenado en sort coincide con el parametro
        if ($this->sort == $sort) {
            //si lo que tiene direction es igual al valor de desc
            if ($this->direction == 'desc') {
                //si si remplazalo por orden asendente
                $this->direction = 'asc';
            }
             else {
                $this->direction = 'desc';
            }
        }   //en el caso de que de click en otro campo
        else {
            //remplaza sort por el valor que mandamos por asendente
            $this->sort = $sort;
            $this->direction = 'asc';
        }
        
        
    }
}
