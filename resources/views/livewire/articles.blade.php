{{-- Componentes livewire solo deben tener un componente padre --}}
<div>
    <h1>Listado de Articulos</h1>
    <a href="{{route('articles.create')}}">Crear Articulo</a>
    <label>
        <input wire:model="search" type="search" placeholder="Buscar..">
    </label>
    <ul>
        @foreach ($articles as $article)
            <li>
                <a href="{{ route('articles.show', $article)}}">
                    {{$article->title}}
                </a>
                <a href="{{ route('articles.edit', $article)}}">
                    Editar
                </a> 
            </li>
        @endforeach
    </ul>
    <br>
       
</div>


























{{-- <div {{$attributes->merge(['class' =>'bg-white shadow-md rounded px-8 pt-4 pb-2'])}}>
    <div class="font-bold mt-2 text-gray-800 text-lg">
        {{$title}}

    </div>
    <p class="text-gray-600 text-base mt-2">
        {{$slot}}
    </p>
    <div class="py-4">
        <a href="/tags/tag-1">
            <span class="inline-block bg-gray-200 rounded-full px-3">
                #tag
            </span>
        </a>
        <a href="/tags/tag-2">
            <span class="inline-block bg-gray-200 rounded-full px-3">
                #tag2
            </span>
        
        </a>
    </div>
</div> --}}