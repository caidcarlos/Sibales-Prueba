<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Categorías') }}
    </h2>
</x-slot>
<div class="mt-6 py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-2">
            @if(session()->has('message'))
                <div class="py-3 px-5 mb-4 bg-red-100 font-bold text-red-900 text-sm rounded-md border border-red-200" role="alert">
                    {{session('message')}}
                </div>
            @endif
            <div class="flex justify-between">
                <div class="w-1/4">
                    <button wire:click="crear()" class="py-3 px-4 uppercase font-bold text-white rounded-lg bg-red-600 hover:bg-red-500 shadow-lg block md:inline-block my-8">Agregar Categoría</button>
                </div>
                <div class="w-1/2">
                    <input type="text" wire:model="busqueda" placeholder="Buscar..." class="p-2 w-full border-2 border-gray-300 rounded-md py-3 my-8 -mx-4">
                </div>
                <div class="w-1/4">
                    <button wire:click="cambiaVista()" class="py-3 px-4 uppercase font-bold text-white rounded-lg bg-red-600 hover:bg-red-500 shadow-lg block md:inline-block my-8">
                        @if ($pivot == false)
                            Ver Inactivos
                        @else
                            Ver Activos
                        @endif
                    </button>
                </div>
            </div>
            @if($modalCreate)
                @include('livewire.categorias.modal-create')
            @endif
            @if($modalUpdate)
                @include('livewire.categorias.modal-update')
            @endif
            @if($modalConfirm)
                @include('livewire.categorias.modal-confirm')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-red-600 text-white uppercase text-xl py-4 my-10">
                        <th class="w-1/2">Categoría</th>
                        <th class="w-1/4">Status</th>
                        <th class="w-1/4">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                        <tr>
                            <td class="border px-4 py-2 text-center text-xl">{{$categoria->nombre}}</td>
                            <td class="border px-4 py-2 text-center text-xl">
                                @if ($categoria->status==1)
                                    Activo                                    
                                @else
                                    Inactivo
                                @endif
                            </td>
                            <td class="border px-4 py-2 flex justify-between">
                                <button wire:click="editar({{$categoria->id}})" 
                                    class="px-4 lg:py-3 lg:px-6 uppercase font-bold text-white rounded-lg bg-yellow-500 shadow-lg block md:inline-block">Editar</button>
                                <button wire:click="confirmar({{$categoria->id}})"
                                    class="py-3 px-6 uppercase font-bold text-white rounded-lg bg-red-600 shadow-lg block md:inline-block">Desactivar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
