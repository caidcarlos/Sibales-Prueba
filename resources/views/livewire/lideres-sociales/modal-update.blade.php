<div class="fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="border border-blue-500 shadow-lg mx-auto modal-container bg-white w-4/5 h-4/5 rounded-xl z-50 overflow-y-scroll">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold text-gray-500">Modificar Líder Social</p>
            </div>
            <!--Body-->
            <div class="my-5 mr-5 ml-5 flex justify-center">
                <form class="w-full">
                    <div class="flex justify-around">
                        <div class="w-1/3 -ml-4">
                            <div class="">
                                <label for="cedula" class="text-md text-gray-600">Cédula</label>
                            </div>
                            <div class="">
                                <input type="text" id="cedula" name="cedula" wire:model="cedula" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                            </div>
                        </div>
                       <div class="w-1/3">
                            <div class="">
                                <label for="p_nombre" class="text-md text-gray-600">Primer Nombre</label>
                            </div>
                            <div class="">
                                <input type="text" id="p_nombre" name="p_nombre" wire:model="p_nombre" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                            </div>
                        </div>
                        <div class="w-1/3">
                            <div class="">
                                <label for="s_nombre" class="text-md text-gray-600">Segundo Nombre (Opcional)</label>
                            </div>
                            <div class="">
                                <input type="text" id="s_nombre" name="s_nombre" wire:model="s_nombre" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around">
                        <div class="w-1/3 -ml-4">
                            <div class="">
                                <label for="p_apellido" class="text-md text-gray-600">Primer Apellido</label>
                            </div>
                            <div class="">
                                <input type="text" id="p_apellido" name="p_apellido" wire:model="p_apellido" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                            </div>
                        </div>
                       <div class="w-1/3">
                            <div class="">
                                <label for="s_apellido" class="text-md text-gray-600">Segundo Apellido (Opcional)</label>
                            </div>
                            <div class="">
                                <input type="text" id="s_apellido" name="s_apellido" wire:model="s_apellido" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                            </div>
                        </div>
                        <div class="w-1/3">
                            <div class="">
                                <label for="carnet_psuv" class="text-md text-gray-600">Carnet del PSUV (Opcional)</label>
                            </div>
                            <div class="">
                                <input type="text" id="carnet_psuv" name="carnet_psuv" wire:model="carnet_psuv" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around">
                        <div class="w-1/2 -ml-4">
                            <div class="">
                                <label for="telefono_1" class="text-md text-gray-600">Teléfono 1</label>
                            </div>
                            <div class="">
                                <input type="text" id="telefono_1" name="telefono_1" wire:model="telefono_1" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                            </div>
                        </div>
                       <div class="w-1/2">
                            <div class="">
                                <label for="telefono_2" class="text-md text-gray-600">Teléfono 2 (Opcional)</label>
                            </div>
                            <div class="">
                                <input type="text" id="telefono_2" name="telefono_2" wire:model="telefono_2" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <label for="direccion" class="text-md text-gray-600">Direccion</label>
                        </div>
                        <div class="">
                            <input type="text" id="direccion" name="direccion" wire:model="direccion" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                        </div>
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
                    </div>
                    @endif
                    <div class="">
                        <div class="">
                            <label for="nombre" class="text-md text-gray-600">¿Pertenece a algún Consejo Comunal?</label>
                        </div>
                        <div class="">
                            <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                id="id_consejocomunal" name="id_consejocomunal" wire:model="id_consejocomunal">
                                <option value=0>Ninguna</option>
                                @foreach ($ccomunales as $ccomunal)
                                    <option value={{$ccomunal->id}}>{{$ccomunal->nombre}}</option>                                                        
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <label for="nombre" class="text-md text-gray-600">¿Pertenece a alguna Comuna?</label>
                        </div>
                        <div class="">
                            <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                id="id_comuna" name="id_comuna" wire:model="id_comuna">
                                <option value=0>Ninguna</option>
                                @foreach ($comunas as $comuna)
                                    <option value={{$comuna->id}}>{{$comuna->nombre}}</option>                                                        
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <label for="nombre" class="text-md text-gray-600">¿Pertenece a alguna UBCh?</label>
                        </div>
                        <div class="">
                            <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                id="id_ubch" name="id_ubch" wire:model="id_ubch">
                                <option value=0>Ninguna</option>
                                @foreach ($ubches as $ubch)
                                    <option value={{$ubch->id}}>{{$ubch->nombre}}</option>                                                        
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-between pt-2 space-x-14">
                        <button class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none" 
                            wire:click.prevent="cerrarModalUpdate()">Cancelar</button>
                        <button class="bg-green-500 hover:bg-yellow-600 px-4 py-2 rounded text-white focus:outline-none" 
                            wire:click.prevent="actualizar({{$id_lider}})">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>