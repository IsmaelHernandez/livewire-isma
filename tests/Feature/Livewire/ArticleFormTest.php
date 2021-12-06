<?php

namespace Tests\Feature\Livewire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ArticleFormTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        //componente
        Livewire::test('article-form')
            ->set('article.title','New article')
            ->set('article.content','Article article')
            ->call('save');
            ->assertSessionHas('status')
            ->assertRedirect(route('article.index'))
        ;

        $this->assertDatabaseHas('articles', [
            'title' => 'New article',
            'content' => 'Article content'
        ]);
        /* $response = $this->get('/');

        $response->assertStatus(200); */
    }
}
