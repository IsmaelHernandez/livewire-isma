{{-- Componentes livewire solo deben tener un componente padre --}}
<div>
    {{-- header --}}
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('List Articles')}}
        </h1>
    </x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <a href="{{route('articles.create')}}" class="text-indigo-600 hover:text-indigo-900">Crear Articulo</a>
            <div class="px-6 py-4">
                {{-- <input type="text" wire:model="search"> --}}
                <x-jet-input class="w-full" type="text" wire:model="search" placeholder="Buscar"/>
            </div>
    <!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  ID
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Title
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Content
                </th>
                <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($articles as $article)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                      <div class="text-sm font-medium text-gray-900">
                        {{$article->id}}
                      </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{$article->title}}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{$article->content}}</div>
                  </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <a href="{{ route('articles.edit', $article)}}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                </td>
              </tr>
              @endforeach
              <!-- More people... -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <br>
  </div>
</div>
</div>
<div class="py-12">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <form class="w-full max-w-sm">
      <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
          <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
            Full Name
          </label>
        </div>
        <div class="md:w-2/3">
          <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-full-name" type="text" value="Jane Doe">
        </div>
      </div>
      <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
          <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
            Password
          </label>
        </div>
        <div class="md:w-2/3">
          <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="inline-password" type="password" placeholder="******************">
        </div>
      </div>
      <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3"></div>
        <label class="md:w-2/3 block text-gray-500 font-bold">
          <input class="mr-2 leading-tight" type="checkbox">
          <span class="text-sm">
            Send me your newsletter!
          </span>
        </label>
      </div>
      <div class="md:flex md:items-center">
        <div class="md:w-1/3"></div>
        <div class="md:w-2/3">
          <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
            Sign Up
          </button>
        </div>
      </div>
    </form>
</div>
  
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