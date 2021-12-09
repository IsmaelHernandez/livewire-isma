<div>
    {{-- header --}}
    <x-slot name="header">
        {{-- //estilizar el titulo --}}
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- titulo traducible --}}
            {{__('View Article')}}
        </h1>
    </x-slot>
    <div>{{$article->id}}</div>
    <h1>{{$article->title}}</h1>
    <p>{{$article->content}}</p>
    <a href="{{route('articles.index')}}">Regresar</a>
</div>
