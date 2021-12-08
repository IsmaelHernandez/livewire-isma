<?php

namespace Tests\Feature\Livewire;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticlesTest extends TestCase
{
    /** @test */
    //test para verificar si el componewnte article se renderiza correctamente
    function articles_component_renders_properly()
    {
        $this->get('/')->assertSeeLivewire('articles');
    }
}
