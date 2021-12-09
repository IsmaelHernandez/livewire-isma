<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use App\Models\Article;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

//componente que nos dej crear y editar un articulo
class ArticleForm extends Component
{
    use WithFileUploads; //para trabajar con images
    public Article $article;

    // public $image;

    //reglas de validacion
    protected function rules()
    {
        return [
            // 'image' => [
            //     //metodo obligatori si el valor que pasamos es verdadero
            //     Rule::requiredIf(! $this->article->image), //querenmos que la agregue si no esta setiada la imagen del articulo 
            //     Rule::when($this->image, ['image', 'max:2048']) //metodo when recibe un boolen verificamos si el usuario a seleccionbado una imagen 
            //     // 'max:2048'
            // ],
            'article.title' => [
                'required', 
                'min:4'
            ],
            'article.slug' => [
                'required',
                'alpha_dash', //solo permitira letras-numeros-guiones
                Rule::unique('articles', 'slug')->ignore($this->article)
            ],
            'article.content' => [
                'required'
            ],
        ];
    }

    //inicializar la propiedad
    public function mount(Article $article)
    {
        $this->article = $article;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    //otro hook verificar cada ves que se actualize
    public function updatedArticleTitle($title)
    {
        $this->article->slug = Str::slug($title);
    }
    // hace una funcion para insertar registro en bd
    public function save ()
    {
       //validar en tiempo real
       $this->validate();

    //    //verificar si imagen tiene un valor
    //    if($this->image){
    //        if($oldImage = $this->article->image){
    //             Storage::disk('public')->delete($oldImage);
    //        }

    //        $newImage = $this->image->store('/', 'public');
            
    //         $this->article->image = $newImage;
    //    }

       //hacer la relacion entre user y articulos
       Auth::user()->articles()->save($this->article);
       //mandar a llamar a la propiedad y al metodo save
    //    $this->article->save();
       //Mostrar msj de inserccion
       session()->flash('status',__('Articulo Guardado'));

       $this->redirectRoute('articles.index');
    }

    public function render()
    {
        return view('livewire.article-form');
    }
}
