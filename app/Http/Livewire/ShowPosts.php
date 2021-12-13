<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination; //se importa para la paginacion

class ShowPosts extends Component
{
    use WithPagination;//se utiliza dentro de este componente

    public $search = ''; //variable para hacer reactivo al buscador
    public $sort = 'id';
    public $direction = 'desc';
    public $post;
    public $cant = '10';
    public $open_edit = false;
    public $readyToload = false;

    //query string //que inf de esta propieda baja por la url
    protected $queryString = [
        'cant' => ['except' => '10'],
        'sort' => ['except' => 'id'],
        'direction' => ['except' => 'desc'],
        'search' => ['except' => '']
    ];

    //dentro de este array se debe escuchar el evento   º
    protected $listeners = [
        'render' => 'delete'
    ]; 

     //reglas de validacion
    protected $rules = [
        'post.title' =>'required',
        'post.content' =>'required',
    ];

    public function render()
    {
        //ver que tenemos almacenado en readytoload
        if($this->readyToload){
            //consultar lista de datos select
            $posts = Post::where('title', 'like', '%' . $this->search . '%')
                ->orWhere('content', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort, $this->direction)
                ->paginate($this->cant);
        }
        else{
            $posts = [];
        }
                        
        return view('livewire.show-posts', compact('posts'));
    }

    public function loadPosts()
    {
        $this->readyToload = true;
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

    public function edit(Post $post)
    {
        $this->post = $post;
        $this->open_edit = true;
    }



    //definir un metodo que cuando search se modifique lo resete
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function update()
    {
        //metodo validate verifica reglas de validacion
        $this->validate();
        //mandar a llamar a la propiedad post y pasarle el metodo save
        $this->post->save();
         //mandamos a llamar a reset method
         $this->reset(['open_edit']); 
        //emitimos evento alert para una alert
        $this->emit('alert','El post se edito satisfactoriamente');
    }

    public function delete(Post $post)
    {
        $post->delete();
    }
}
