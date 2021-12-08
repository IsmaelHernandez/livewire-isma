<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Article;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ArticleFormTest extends TestCase
{
    use RefreshDatabase; //para que inicien con una bd basia

    
    //test que nos diga que si no esta logeado no puede editar y crear
     /** @test */
     function guests_cannot_create_or_update_articles()
     {
         $this->get(route('articles.create'))
             ->assertRedirect('login');
         
         $article = Article::factory()->create();
         $this->get(route('articles.edit', $article))
             ->assertRedirect('login');
     }

     

    //crear un test que nos diga que el componente se muestra correctamente
     /** @test */
    function article_form_renders_properly()
    {
        //crear un usuario
        $user = User::factory()->create();
        /** @var mixed $user */
        $this->actingAs($user)->get(route('articles.create'))
            ->assertSeeLivewire('article-form');
        
        $article = Article::factory()->create();
        $this->actingAs($user)->get(route('articles.edit', $article))
            ->assertSeeLivewire('article-form');
    }

    //crear un test para verificar que el template de blade esta conectado correctamente
     /** @test */
    //otro test para validar si el titulo es obligatorio
    function blade_template_is_wired_properly()
    {
        Livewire::test('article-form')
            ->assertSeeHtml('wire:submit.prevent="save"')
            ->assertSeeHtml('wire:model="article.title"')
            ->assertSeeHtml('wire:model="article.slug"')
        ;
    }

    /**
     * A basic feature test example.
     *
     * @test
     */
    //test para validar si se creo un articulo
     function can_create_new_articles()
    {
        //creamos un disco en memoria para los test para las images //disco publico vacio
        Storage::fake('public');
        //crear imagenes en memorian //imagen lista para seleccionar
        $image = UploadedFile::fake()->image('post-image.png');
        //usuario para crear el articulo //al crear el articulo automaticamente se vincule al usuario
        $user = User::factory()->create();
        /** @var mixed $user */
        Livewire::actingAs($user)->test('article-form')
            ->set('image', $image) //seteamos la propiedad image
            ->set('article.title', 'New article') //setear una propiedad
            ->set('article.slug', 'new-article')
            ->set('article.content', 'Article content')
            ->call('save')
            ->assertSessionHas('status') //verificar si la seccion tiene status
            ->assertRedirect(route('articles.index'))

        ;
        //verificar si en la base de datos se creo el articulo
        $this->assertDatabaseHas('articles',[
            'image' => $imagePath = Storage::disk('public')->files()[0],
            'title' => 'New article',
            'slug' => 'new-article',
            'content' => 'Article content',
            'user_id' => $user->id
        ]);


        Storage::disk('public')->assertExists($imagePath);
    }

    /**
     * A basic feature test example.
     *
     * @test
     */
    //test para validar si se creo un articulo
    function can_update_articles()
    {
        //necesitamos un articulo en la BS
        $article = Article::factory()->create();

        //creamos el usuario
        $user = User::factory()->create();
        //inicializamos el componente
        Livewire::actingAs($user)->test('article-form', ['article' => $article])
            //metodo de livewire  para verificar que una propiedad ya esta setiada
            ->assertSet('article.title', $article->title) //para ver si una propiedad esta seteada
            ->assertSet('article.slug', $article->slug)
            ->assertSet('article.content', $article->content)  
            ->set('article.title', 'Updated title')
            ->set('article.slug', 'updated-slug')   
            ->call('save')
            ->assertSessionHas('status')
            ->assertRedirect(route('articles.index'))
        
        ;

        //comprobar si solo hay un registro
        $this->assertDatabaseCount('articles', 1);

        $this->assertDatabaseHas('articles',[
            'title' => 'Updated title',
            'slug' => 'updated-slug',
            'user_id' => $user->id,
        ]);
    }

     /**
     * A basic feature test example.
     *
     * @test
     */
    //test para validar si se creo un articulo
    function can_update_articles_image()
    {
        //creamos un disco en memoria para los test para las images //disco publico vacio
        Storage::fake('public');
        //crear imagenes en memorian //imagen lista para seleccionar
        $oldImage = UploadedFile::fake()->image('old-image.png');
        //direccion de la imagen que se almacena en el disco public
        $oldImagenPath = $oldImage->store('/', 'public');
        //nueva imagen
        $newImage = UploadedFile::fake()->image('new-image.png');
        //necesitamos un articulo en la BS
        $article = Article::factory()->create([
            'image' =>$oldImagenPath
        ]);
        //creamos el usuario
        $user = User::factory()->create();
        //inicializamos el componente
        Livewire::actingAs($user)->test('article-form', ['article' => $article])  
            ->set('image', $newImage)   
            ->call('save')
            ->assertSessionHas('status')
            ->assertRedirect(route('articles.index'))
        
        ;


        Storage::disk('public')
            ->assertExists($article->fresh()->image)
            ->assertMissing($oldImagenPath);
    }

    /** @test */
    //otro test para validar si el titulo es obligatorio
    function title_is_required()
    {
        Livewire::test('article-form')
            ->set('article.content', 'Article content')
            ->call('save')
            ->assertHasErrors(['article.title' => 'required'])
            ->assertSeeHtml(__('validation.required', ['attribute' => 'title']))
        ;
    }

    /** @test */
    //otro test para validar si el slug es obligatorio
    function slug_is_required()
    {
        Livewire::test('article-form')
            ->set('article.title', 'New Article')
            ->set('article.slug', null)
            ->set('article.content', 'Article content')
            ->call('save')
            ->assertHasErrors(['article.slug' => 'required'])
            ->assertSeeHtml(__('validation.required', ['attribute' => 'slug']));
    }

     /** @test */
    //otro test para validar si el slug es unico
    function slug_must_be_unique()
    {
        //crear un articulo
        $article = Article::factory()->create();
        Livewire::test('article-form')
            ->set('article.title', 'New Article')
            ->set('article.slug', $article->slug)
            ->set('article.content', 'Article content')
            ->call('save')
            ->assertHasErrors(['article.slug' => 'unique'])
            ->assertSeeHtml(__('validation.unique', ['attribute' => 'slug']))
        ;
    }

    /** @test */
    //otro test para validar si el slug es unico
    function slug_must_only_contain_letters_numbers_dashes_and_underscores()
    {
        Livewire::test('article-form')
            ->set('article.title', 'New Article')
            ->set('article.slug', 'new-article$')
            ->set('article.content', 'Article content')
            ->call('save')
            ->assertHasErrors(['article.slug' => 'alpha_dash'])
            ->assertSeeHtml(__('validation.alpha_dash', ['attribute' => 'slug']))
        ;
    }

     /** @test */
    //otro test para validar la regla de unique es ignorada cuando se actualiza un articulo
    function unique_rule_should_be_ignored_when_updating_the_same_slug()
    {
        //crear un articulo
        $article = Article::factory()->create();

        //creamos el usuario
        $user = User::factory()->create();

        Livewire::actingAs($user)->test('article-form', ['article' => $article])
            ->set('article.title', 'New Article')
            ->set('article.slug', $article->slug)
            ->set('article.content', 'Article content')
            ->call('save')
            ->assertHasNoErrors(['article.slug' => 'unique'])
            
        ;
    }

      /** @test */
    //otro test para validar la rules
    function title_must_be_4_characters_min()
    {
        Livewire::test('article-form')
            ->set('article.title', 'Art')
            ->set('article.content', 'Article content')
            ->call('save')
            ->assertHasErrors(['article.title' => 'min'])
            ->assertSeeHtml(__('validation.min.string', [
                'attribute' => 'title',
                'min' => 4

            ]))
        ;
    }

        /** @test */
    //test para ver si es valido el contenido
    function content_is_required()
    {
        Livewire::test('article-form')
            ->set('article.title', 'New Article')
            ->call('save')
            ->assertHasErrors(['article.content' => 'required'])
            ->assertSeeHtml(__('validation.required', ['attribute' => 'content']))
        ;
    }

    /** @test */
    //test para validar_en_tiempo_real_el_titulo
    function real_time_validation_work()
    {
        Livewire::test('article-form')
            ->set('article.title', '')
            ->assertHasErrors(['article.title' => 'required'])
            ->set('article.title', 'new')
            ->assertHasErrors(['article.title' => 'min'])
            ->set('article.title', 'New Article')
            ->assertHasNoErrors('article.title')
        ;
    }

     /** @test */
    //test para validar_en_tiempo_real_el_titulo
    function real_time_validation_work_for_tittle()
    {
        Livewire::test('article-form')
            ->set('article.title', '')
            ->assertHasErrors(['article.title' => 'required'])
            ->set('article.title', 'New')
            ->assertHasErrors(['article.title' => 'min'])
            ->set('article.title', 'New Article')
            ->assertHasNoErrors('article.title')
        ;
    }

    /** @test */
    //test para validar_en_tiempo_real_el_content
    function real_time_validation_work_for_content()
    {
        Livewire::test('article-form')
            ->set('article.content', '')
            ->assertHasErrors(['article.content' => 'required'])
            ->set('article.content', 'Article content')
            ->assertHasNoErrors('article.content')
        ;
    }

    /** @test */
    //test para validar_en_tiempo_real_el_content
    function slug_is_generated_automatically()
    {   //inicializamos el componente
        Livewire::test('article-form','Nuevo articulo')
            ->set('article.title', 'Nuevo articulo')//seteamos
            ->assertSet('article.slug', 'nuevo-articulo') //verificar si se a seteado automaticamente
            
        ;
    }
}
