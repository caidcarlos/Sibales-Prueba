<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Líderes Sociales') }}
    </h2>
</x-slot>
<div class="mt-6 py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px8">
        <div class="w-1/2 text-center text-white bg-green-500 text-xl fixed mx-0 mt-4 z-50">
            <div wire:loading>
                Cargando
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-2">
            <div class="flex justify-between">
                <div class="w-1/4">
                    <button wire:click="crear()" class="py-3 px-4 uppercase font-bold text-white rounded-lg bg-red-600 shadow-lg block md:inline-block my-8">Agregar Lider Social</button>
                </div>
                <div class="w-1/2">
                    <input type="text" wire:model="busqueda" placeholder="Buscar..." class="-mx-4 p-2 w-full border-2 border-gray-300 rounded-md py-3 my-8">
                </div>
            </div>
            @if($modal_create)
                @include('livewire.lideres-sociales.modal-create')
            @endif
            @if($modal_update)
                @include('livewire.lideres-sociales.modal-update')
            @endif
            @if($modal_detalles)
                @include('livewire.lideres-sociales.modal-confirm')
            @endif
            @if($modal_otorgar)
                @include('livewire.lideres-sociales.otorgar-beneficio')
            @endif
            @if($modal_entregado)
                @include('livewire.lideres-sociales.detalle-beneficio')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-red-600 text-white uppercase text-xl py-4 my-10">
                        <th class="w-1/6">Cédula</th>
                        <th class="w-1/3">Nombre(s) y Apellido(s)</th>
                        <th class="w-1/6">Carnet del PSUV</th>
                        <th class="w-1/4">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lideres as $lider)
                        <tr>
                            <td class="border px-4 py-2 text-center text-xl">{{$lider->cedula}}</td>
                            <td class="border px-4 py-2 text-center text-xl">
                                {{$lider->p_nombre}} {{$lider->s_nombre}} {{$lider->p_apellido}} {{$lider->s_apellido}} 
                            </td>
                            <td class="border px-4 py-2 text-center text-xl">{{$lider->carnet_psuv}}</td>
                            <td class="border px-4 py-2 flex h-full justify-between">
                                <button wire:click="editar({{$lider->id}})" 
                                    class="text-md px-4 lg:py-3 lg:px-6 uppercase font-bold text-white rounded-lg bg-yellow-500 shadow-lg block md:inline-block">Editar</button>
                                <button wire:click="verDetalles({{$lider->id}})"
                                    class="text-md py-3 px-6 uppercase font-bold text-white rounded-lg bg-red-600 shadow-lg block md:inline-block">
                                    Ver Recursos
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="my-4"> {{ $lideres->links() }} </div>
        </div>
    </div>
</div>