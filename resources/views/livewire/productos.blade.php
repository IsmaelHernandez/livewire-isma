<div>
     {{-- header --}}
     <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Productos')}}
        </h1>
    </x-slot>   
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidder shadow-xl sm:rounded-lg px-4 py-4">
            <div class=" m-2 my-3">
                @if(session()->has('message'))
                    {{-- preguntamos si tiene un valkor --}}
                    <div class="bg-indigo-400 rounded-b text-teal-900 px-4 py-4 shadow-md my-3" role="alert">
                        <div class="flex">
                            <div>
                                <h4>{{ session('message')}}</h4>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <br>
            <div class=" m-2 my-3">
                <button wire:click="crear()" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 mb-px">Nuevo</button>
                {{-- condicion para abrir el modal --}}
                @if($modal)
                    @include('livewire.crear')
                @endif
            </div>
            <br>
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-indigo-500 text-white">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">Descripcion</th>
                        <th class="px-4 py-2">Cantidad</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $produ)
                    <tr>
                        <td class="border px-4 py-2">{{$produ->id}}</td>
                        <td class="border px-4 py-2">{{$produ->descripcion}}</td>
                        <td class="border px-4 py-2">{{$produ->cantidad}}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="editar({{$produ->id}})" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4">Editar</button>
                            <button wire:click="borrar({{$produ->id}})" class="bg-red-600 hover:bg-blue-600 text-white font-bold py-2 px-4">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>
</div>
</div>