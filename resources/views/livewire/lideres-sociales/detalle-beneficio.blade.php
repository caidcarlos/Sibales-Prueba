<div class="fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-1/2 text-center text-white bg-green-500 text-xl fixed mx-0 mt-4 z-50">
        <div wire:loading>
            Cerrando
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
                    <div class="w-full p-4 border-2 rounded-md border-gray-500 mt-8">
                        <div class="font-bold text-center text-red-600 text-2xl bg-white -mt-4">Beneficio Otorgado</div>
                        <div class="text-center font-bold text-black text-xl pt-4">
                            @foreach($detallesEntrega as $e)
                                @foreach($beneficios as $benef)
                                    @if ($benef->id == $e->idsub)
                                        {{$benef->nombre}}
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                        <div class="w-full flex justify-around mt-4">
                            <div class="w-1/3">
                                <div class="">
                                    <label for="fecha" class="text-md text-red-600">Fecha</label>
                                </div>
                                <div class="text-center font-bold text-black text-xl pt-4">
                                    @foreach($detallesEntrega as $e)
                                        {{$e->fecha}}
                                    @endforeach
                                </div>
                            </div>
                            <div class="w-1/3">
                                <div class="">
                                    <label for="entregado" class="text-md text-red-600">Entregado en:</label>
                                </div>
                                <div class="text-center font-bold text-black text-xl pt-4">
                                    @foreach($detallesEntrega as $e)
                                        @foreach ($eventos as $even)
                                            @if ($e->evento == $even->id)
                                                {{$even->nombre}}
                                            @endif
                                        @endforeach
                                        @foreach ($secretarias as $sec)
                                            @if ($e->secretaria == $sec->id)
                                                {{$sec->nombre}}
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                            <div class="w-1/3">
                                <div class="">
                                    <label for="observacion" class="text-md text-red-600">Observación</label>
                                </div>
                                <div class="text-center font-bold text-black text-xl pt-4">
                                    @foreach($detallesEntrega as $e)
                                        {{$e->observacion}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center pt-2 space-x-14">
                        <button class="bg-red-600 hover:bg-red-500 px-4 py-2 rounded text-white focus:outline-none" 
                            wire:click.prevent="cerrarModalEntregado()">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>