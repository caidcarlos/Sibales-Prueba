<div class="fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-1/2 text-center text-white bg-green-500 text-xl fixed mx-0 mt-4 z-50">
        <div wire:loading>
            Cargando
        </div>
    </div>
    <div class="border border-blue-500 shadow-lg mx-auto modal-container bg-white w-10/12 lg:w-5/6 h-4/5 rounded-xl z-50 overflow-y-scroll">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold text-red-600">Entrega de Beneficio</p>
            </div>
            <!--Body-->
            <div class="my-5 mr-5 ml-5 flex justify-center">
                <form class="w-full">
                    <div class="flex justify-around ">
                        <div class="w-1/3 -ml-4">
                            <div class="">
                                <label for="cedula" class="text-md text-red-600">Cédula</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                {{$cedula}}
                            </div>
                        </div>
                        <div class="w-1/3">
                            <div class="">
                                <label for="p_nombre" class="text-md text-red-600">Primer Nombre</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                {{$p_nombre}}
                            </div>
                        </div>
                        <div class="w-1/3">
                            <div class="">
                                <label for="s_nombre" class="text-md text-red-600">Segundo Nombre</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                {{$s_nombre}}
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around">
                        <div class="w-1/3 -ml-4">
                            <div class="">
                                <label for="p_apellido" class="text-md text-red-600">Primer Apellido</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                {{$p_apellido}}
                            </div>
                        </div>
                       <div class="w-1/3">
                            <div class="">
                                <label for="s_apellido" class="text-md text-red-600">Segundo Apellido (Opcional)</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                {{$s_apellido}}
                            </div>
                        </div>
                        <div class="w-1/3">
                            <div class="">
                                <label for="carnet_psuv" class="text-md text-red-600">Carnet del PSUV</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                {{$carnet_psuv}}
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around">
                        <div class="w-1/3 -ml-4">
                            <div class="">
                                <label for="communa" class="text-md text-red-600">Comuna</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                @foreach ($comunas as $comuna)
                                    @if ($comuna->id == $id_comuna)
                                        {{$comuna->nombre}}
                                    @endif
                                @endforeach
                            </div>
                        </div>
                       <div class="w-1/3">
                            <div class="">
                                <label for="ccomunales" class="text-md text-red-600">Consejo Comunal</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                @foreach ($ccomunales as $ccomunal)
                                    @if ($ccomunal->id == $id_consejocomunal)
                                        {{$ccomunal->nombre}}
                                    @endif
                                @endforeach
                            </div>
                        </div>
                       <div class="w-1/3">
                            <div class="">
                                <label for="ubch" class="text-md text-red-600">UBCh</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                @foreach ($ubches as $ubch)
                                    @if ($ubch->id == $id_ubch)
                                        {{$ubch->nombre}}
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="w-full p-4 border-2 rounded-md border-gray-500 ml-2">
                        <div class="font-bold text-center text-red-600 text-2xl bg-white -mt-4">Beneficio a Otorgar</div>
                        <div class="text-center font-bold text-black text-xl pt-4">
                            {{$nombre_benef}}
                        </div>
                        <div class="w-full flex justify-around">
                            <div class="w-1/3">
                                <div class="">
                                    <label for="fecha" class="text-md text-red-600">Fecha</label>
                                </div>
                                <div class="">
                                    <input type="date" id="fecha_otor" name="fecha_otor" wire:model="fecha_otor" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                                </div>
                                @error('fecha_otor')
                                    <div class="text-red-500 font-italic"><small>* {{$message}}</small></div>
                                @enderror
                            </div>
                            <div class="w-1/3">
                                <div class="">
                                    <label for="entregado" class="text-md text-red-600">Entregado en:</label>
                                </div>
                                <div class="text-center">
                                    <input type="radio" name="even_sec" wire:model="even_sec" value = "even"> Evento
                                    <input type="radio" name="even_sec" wire:model="even_sec" value = "sec"> Secretaría
                                </div>
                                @error('fecha_otor')
                                    <div class="text-red-500 font-italic"><small>* {{$message}}</small></div>
                                @enderror
                            </div>
                            <div class="w-1/3">
                                @if ($even_sec == "even")
                                    <div class="">
                                        <label for="evento" class="text-md text-red-600">Evento</label>
                                    </div>
                                    <div class="">
                                        <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                            id="evento_otor" name="evento_otor" wire:model="evento_otor">
                                            <option value="">Seleccione un evento...</option>
                                            @foreach ($eventos as $evento)
                                                <option value={{$evento->id}}>{{$evento->nombre}}</option>                                                        
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                @if ($even_sec == "sec")
                                    <div class="">
                                        <label for="secretaria" class="text-md text-red-600">Secretaría</label>
                                    </div>
                                    <div class="">
                                        <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey"
                                            id="secretaria_otor" name="secretaria_otor" wire:model="secretaria_otor">
                                            <option value="">Seleccione una secretaría...</option>
                                            @foreach ($secretarias as $secretaria)
                                                <option value={{$secretaria->id}}>{{$secretaria->nombre}}</option>                                                        
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="">
                                <label for="observacion" class="text-md text-red-600">Observación (Opcional)</label>
                            </div>
                            <div>
                                <input type="text" name="observacion_otor" wire:model="observacion_otor" class="p-2 w-full border-2 border-gray-300 mb-5 rounded-md">
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center pt-2 space-x-14">
                        <button class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded text-white focus:outline-none" 
                            wire:click.prevent="cerrarModalOtorgar()">Cerrar</button>
                        <button class="bg-green-600 hover:bg-green-500 px-4 py-2 rounded text-white focus:outline-none" 
                            wire:click.prevent="guardarBeneficioOtorgado({{$id_benef}})">Otorgar Beneficio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>