<div class="fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);">
    <div class="w-1/2 text-center text-white bg-green-500 text-xl fixed mx-0 mt-4 z-50">
        <div wire:loading>
            Procesando
        </div>
    </div>
    <div class="border border-blue-500 shadow-lg mx-auto modal-container bg-white w-10/12 lg:w-5/6 h-4/5 rounded-xl z-40 overflow-y-scroll">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold text-red-600">Detalles del Líder Social</p>
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
                                <label for="telefono_1" class="text-md text-red-600">Teléfono 1</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                {{$telefono_1}}
                            </div>
                        </div>
                       <div class="w-1/3">
                            <div class="">
                                <label for="telefono_2" class="text-md text-red-600">Teléfono 2 (Opcional)</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                {{$telefono_2}}
                            </div>
                        </div>
                       <div class="w-1/3">
                            <div class="">
                                <label for="direccion" class="text-md text-red-600">Dirección</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                {{$direccion}}
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-around">
                        <div class="w-1/2 -ml-4">
                            <div class="">
                                <label for="parroquia" class="text-md text-red-600">Parroquia</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                @foreach ($parroquias as $parroquia)
                                    @if ($parroquia->id == $selectedParroquia)
                                        {{$parroquia->nombre}}
                                    @endif
                                @endforeach
                            </div>
                        </div>
                       <div class="w-1/2">
                            <div class="">
                                <label for="municipio" class="text-md text-red-600">Municipio</label>
                            </div>
                            <div class="text-xl text-black font-bold">
                                @foreach ($parroquias as $parroquia)
                                @foreach ($municipios as $municipio)
                                    @if ($municipio->id == $parroquia->id_municipio && $parroquia->id == $selectedParroquia)
                                        {{$municipio->nombre}}
                                    @endif
                                @endforeach
                                @endforeach
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
                    <div class="w-full flex mt-10">
                        <div class="w-1/2 p-4 border-2 rounded-md border-gray-500 ml-2">
                            <div class="font-bold text-center text-red-600 text-2xl pt-6">Beneficios para Ofrecer</div>
                            <div class="">
                                @foreach ($categorias as $categoria)
                                    <div class="w-full">
                                        <div class="">
                                            <label for="categoria" class="sticky top-0 text-xl text-gray-800 font-bold">{{$categoria->nombre}}</label>
                                        </div>
                                        <div class="">
                                            <div class="text-md p-2">
                                                @foreach ($subcategorias as $subcategoria)
                                                    @if ($categoria->id == $subcategoria->id_categoria)
                                                        <button class="border-0 w-full bg-white hover:bg-red-600 text-gray-800 hover:text-gray-200 text-left px-6 py-2" 
                                                                wire:click.prevent="guardarBeneficio({{$subcategoria->id}})"
                                                                wire:loading.attr="disabled">
                                                            {{$subcategoria->nombre}}
                                                        </button>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="w-1/2 p-4 border-2 rounded-md border-gray-500 ml-2">
                            <div class="sticky font-bold text-center text-red-600 text-2xl pt-6">Beneficios Requeridos</div>
                            <div class="">
                                @foreach ($categorias as $categoria)
                                    <div class="w-full">
                                        <div class="">
                                            <label for="categoria" class="text-xl text-gray-800 font-bold">{{$categoria->nombre}}</label>
                                        </div>
                                        <div class="">
                                            <div class="text-md p-2">
                                                @if(!empty($benef_recibidos))
                                                    @foreach ($benef_recibidos as $benef)
                                                        @foreach ($todas_subcategorias as $subcategoria)
                                                            @if ($categoria->id == $subcategoria->id_categoria && $subcategoria->id == $benef->id_subcategoria)
                                                                <div class="flex justify-around border-0 w-full bg-white hover:bg-red-600 text-gray-800 hover:text-gray-100 text-left px-6 py-2">
                                                                    <div class="w-2/3">
                                                                        {{$subcategoria->nombre}}
                                                                    </div>
                                                                    <div class="w-1/3">
                                                                        <button class="border-0 bg-red-600 md:bg-transparent text-white px-2" 
                                                                            wire:click.prevent="otorgarBeneficio({{$benef->id}})">
                                                                            Otorgar
                                                                        </button>
                                                                        <button class="border-0 bg-red-600 md:bg-transparent text-white px-2" 
                                                                            wire:click.prevent="quitarBeneficio({{$benef->id}})"
                                                                            wire:loading.attr="disabled">
                                                                            Quitar
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="font-bold text-center text-red-600 text-2xl pt-6 border-t-2 border-black">Beneficios Otorgados</div>
                            <div class="">
                                @foreach ($categorias as $categoria)
                                    <div class="w-full">
                                        <div class="">
                                            <label for="categoria" class="text-xl text-gray-800 font-bold">{{$categoria->nombre}}</label>
                                        </div>
                                        <div class="">
                                            <div class="text-md p-2">
                                                @if(!empty($benef_entregados))
                                                    @foreach ($benef_entregados as $benefen)
                                                        @foreach ($todas_subcategorias as $subcategoria)
                                                            @if ($categoria->id == $subcategoria->id_categoria && $subcategoria->id == $benefen->idsub)
                                                            <div class="flex justify-around border-0 w-full bg-white hover:bg-red-600 text-gray-800 hover:text-gray-100 text-left px-6 py-2">
                                                                <div class="w-2/3">
                                                                    {{$subcategoria->nombre}}
                                                                </div>
                                                                <div class="w-1/3">
                                                                    <button class="border-0 bg-red-600 md:bg-transparent text-white px-2" 
                                                                        wire:click.prevent="verBeneficioOtorgado({{$benefen->idbe}})">
                                                                        Ver Detalles
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-center pt-2 space-x-14">
                        <button class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-white focus:outline-none" 
                            wire:click.prevent="cerrarModalDetalles()">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>