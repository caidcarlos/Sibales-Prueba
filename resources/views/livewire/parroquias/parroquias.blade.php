<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Parroquias') }}
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
                    <button wire:click="crear()" class="py-3 px-4 uppercase font-bold text-white rounded-lg bg-red-600 shadow-lg block md:inline-block my-8">Agregar Parroquia</button>
                </div>
                <div class="w-1/2">
                    <input type="text" wire:model="busqueda" placeholder="Buscar..." class="-mx-4 p-2 w-full border-2 border-gray-300 rounded-md py-3 my-8">
                </div>
                <div class="w-1/4">
                    <button wire:click="cambiaVista()" class="py-3 px-4 uppercase font-bold text-white rounded-lg bg-red-600 shadow-lg block md:inline-block my-8">
                        @if($pivot == false) Ver Inactivos @else Ver Activos @endif 
                    </button>
                </div>
            </div>
            @if($modal_create)
                @include('livewire.parroquias.modal-create')
            @endif
            @if($modal_update)
                @include('livewire.parroquias.modal-update')
            @endif
            @if($modal_confirm)
                @include('livewire.parroquias.modal-confirm')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-red-600 text-white uppercase text-xl py-4 my-10">
                        <th class="w-1/4">Parroquia</th>
                        <th class="w-1/4">Municipio</th>
                        <th class="w-1/4">Status</th>
                        <th class="w-1/4">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parroquias as $parroquia)
                        <tr>
                            <td class="border px-4 py-2 text-center text-xl">{{$parroquia->nombre}}</td>
                            <td class="border px-4 py-2 text-center text-xl">
                                @foreach ($municipios as $municipio)
                                    @if($parroquia->id_municipio == $municipio->id)
                                        {{$municipio->nombre}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border px-4 py-2 text-center text-xl">
                                @if ($parroquia->status == 1)
                                    Activo                                    
                                @else
                                    Inactivo
                                @endif
                            </td>
                            <td class="border px-4 py-2 flex justify-between">
                                <button wire:click="editar({{$parroquia->id}})" 
                                    class="px-4 lg:py-3 lg:px-6 uppercase font-bold text-white rounded-lg bg-yellow-500 shadow-lg block md:inline-block">Editar</button>
                                <button wire:click="confirmar({{$parroquia->id}})"
                                    class="py-3 px-6 uppercase font-bold text-white rounded-lg bg-red-600 shadow-lg block md:inline-block">
                                    @if ($parroquia->status == 1)
                                        Desactivar
                                    @else
                                        Activar
                                    @endif
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-4"> {{ $parroquias->links() }} </div>
        </div>
    </div>
</div>