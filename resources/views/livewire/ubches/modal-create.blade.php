<div class="fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="border border-blue-500 shadow-lg mx-auto modal-container bg-white w-2/3 rounded-xl z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold text-gray-500">Agregar UBCh</p>
            </div>
            <!--Body-->
            <div class="my-5 mr-5 ml-5 flex justify-center">
                <form class="w-full">
                    <div class="">
                        <div class="">
                            <label for="codigo" class="text-md text-gray-600">Código</label>
                        </div>
                        <div class="">
                            <input type="text" id="codigo" name="codigo" wire:model="codigo" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                        </div>
                        @error('codigo')
                            <div class="font-italic text-red-500"><small>* {{$message}}</small></div>                            
                        @enderror
                    </div>
                    <div class="">
                        <div class="">
                            <label for="nombre" class="text-md text-gray-600">Nombre</label>
                        </div>
                        <div class="">
                            <input type="text" id="nombre" name="nombre" wire:model="nombre" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                        </div>
                        @error('nombre')
                            <div class="font-italic text-red-500"><small>* {{$message}}</small></div>                            
                        @enderror
                    </div>
                    <div class="">
                        <div class="">
                            <label for="telefono" class="text-md text-gray-600">Telefono (Opcional)</label>
                        </div>
                        <div class="">
                            <input type="text" id="telefono" name="telefono" wire:model="telefono" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                        </div>
                        @error('telefono')
                            <div class="font-italic text-red-500"><small>* {{$message}}</small></div>                            
                        @enderror
                    </div>
                    <div class="">
                        <div class="">
                            <label for="direccion" class="text-md text-gray-600">Dirección</label>
                        </div>
                        <div class="">
                            <input type="text" id="direccion" name="direccion" wire:model="direccion" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                        </div>
                        @error('direccion')
                            <div class="font-italic text-red-500"><small>* {{$message}}</small></div>                            
                        @enderror
                    </div>
                    <div class="">
                        <div class="">
                            <label for="nombre" class="text-md text-gray-600">Municipio</label>
                        </div>
                        <div class="">
                            <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                id="selectedMunicipio" name="selectedMunicipio" wire:model="selectedMunicipio">
                                <option value="">Seleccione un municipio...</option>
                                @foreach ($municipios as $municipio)
                                    <option value={{$municipio->id}}>{{$municipio->nombre}}</option>                                                        
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if(!is_null($catParroquias))
                    <div class="">
                        <div class="">
                            <label for="nombre" class="text-md text-gray-600">Parroquia</label>
                        </div>
                        <div class="">
                            <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                id="selectedParroquia" name="selectedParroquia" wire:model="selectedParroquia">
                                <option value="">Seleccione un parroquia...</option>
                                @foreach ($catParroquias as $parroquia)
                                    <option value={{$parroquia->id}}>{{$parroquia->nombre}}</option>                                                        
                                @endforeach
                            </select>
                        </div>
                        @error('selectedParroquia')
                            <div class="font-italic text-red-500"><small>* {{$message}}</small></div>                            
                        @enderror
                    </div>
                    @endif
                    <div class="flex justify-between pt-2 space-x-14">
                        <button class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none" 
                            wire:click.prevent="cerrarModalCreate()">Cancelar</button>
                        <button class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded text-white focus:outline-none" 
                            wire:click.prevent="guardar()">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>