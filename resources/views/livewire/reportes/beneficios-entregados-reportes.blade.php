<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Beneficios Entregados por Municipio') }}
    </h2>
</x-slot>
<div class="mt-6 py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-2">
            <div class="flex justify-between">
                <div class="w-1/5">
                    <button onClick="javascript:window.print()" class="py-3 w-5/6 px-4 uppercase font-bold text-white rounded-lg bg-red-600 shadow-lg block md:inline-block my-8">Imprimir</button>
                </div>
                <div class="w-2/5">
                    <select class="block appearance-none w-full bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none my-8 focus:bg-white focus:border-grey"
                    id="municipioSelec" name="municipioSelec" wire:model="municipioSelec">
                        <option value="">Seleccione un Municipio</option>
                        @foreach ($municipios as $municipio)
                            <option value="{{$municipio->id}}">{{$municipio->nombre}}</option>                                                        
                        @endforeach
                    </select>
                </div>
                <div class="w-2/5">
                    <select class="block appearance-none w-full mx-2 bg-grey-200 border border-grey-200 text-grey-darker py-3 px-4 pr-8 rounded leading-tight focus:outline-none my-8 focus:bg-white focus:border-grey"
                    id="categoriaSelec" name="categoriaSelec" wire:model="categoriaSelec">
                        <option value="">Todas las categorias</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>                                                        
                        @endforeach
                    </select>
                </div>
            </div>
            @if(!is_null($municipioSelec) && !is_null($categoriaSelec))
                <div class="w-full mx-2 text-xl font-bold bg-red-600 text-white text-center">
                    @foreach ($municipios as $municipio)
                        @if($municipio->id == $municipioSelec)
                            {{$municipio->nombre}}
                        @endif
                    @endforeach
                </div>
                <div class="text-xl font-bold text-black py-6 text-center">
                    @foreach ($categorias as $categoria)
                        @if ($categoria->id == $categoriaSelec)
                            {{$categoria->nombre}}
                        @endif
                    @endforeach
                </div>
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-red-600 text-white uppercase text-xl py-4 my-10">
                            <th class="w-1/2">Beneficio</th>
                            <th class="w-1/4">Veces Requerido</th>
                            <th class="w-1/4">Veces Entregado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategorias as $subcategoria)
                            @if ($subcategoria->id_categoria == $categoriaSelec)
                                <tr>
                                    <td class="border px-4 py-2 text-center text-xl">{{$subcategoria->nombre}}</td>
                                    <td class="border px-4 py-2 text-center text-xl">
                                        @php
                                            $i = 0;
                                        @endphp
                                        @foreach ($resultado as $res)
                                            @if($res->id_subcat == $subcategoria->id)
                                                @php
                                                    $i++;    
                                                @endphp                                        
                                            @endif
                                        @endforeach
                                        {{$i}}
                                    </td>
                                    <td class="border px-4 py-2 text-center text-xl">
                                        @php
                                            $j = 0;
                                        @endphp
                                        @foreach ($resultado as $res)
                                            @foreach ($otorgados as $otor)
                                                @if ($res->id_subcat == $subcategoria->id && $res->idls == $otor->id_lider_beneficio)
                                                    @php
                                                        $j++;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @endforeach
                                        {{$j}}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @endif
            @if(!is_null($municipioSelec) && is_null($categoriaSelec))
                <div class="w-full mx-2 text-xl font-bold bg-red-600 text-white text-center">
                    @foreach ($municipios as $municipio)
                        @if($municipio->id == $municipioSelec)
                            {{$municipio->nombre}}
                        @endif
                    @endforeach
                </div>
                @foreach ($categorias as $categoria)
                    <div class="text-xl font-bold text-black py-6 text-center">Categoría: {{$categoria->nombre}}</div>
                    <table class="table-fixed w-full">
                        <thead>
                            <tr class="bg-red-600 text-white uppercase text-xl py-4 my-10">
                                <th class="w-1/2">Beneficio</th>
                                <th class="w-1/4">Veces Requerido</th>
                                <th class="w-1/4">Veces Entregado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subcategorias as $subcategoria)
                                @if ($subcategoria->id_categoria == $categoria->id)
                                    <tr>
                                        <td class="border px-4 py-2 text-center text-xl">{{$subcategoria->nombre}}</td>
                                        <td class="border px-4 py-2 text-center text-xl">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($resultado as $res)
                                                @if($res->id_subcat == $subcategoria->id)
                                                    @php
                                                        $i++;    
                                                    @endphp                                        
                                                @endif
                                            @endforeach
                                            {{$i}}
                                        </td>
                                        <td class="border px-4 py-2 text-center text-xl">
                                            @php
                                                $j = 0;
                                            @endphp
                                            @foreach ($resultado as $res)
                                                @foreach ($otorgados as $otor)
                                                    @if ($res->id_subcat == $subcategoria->id && $res->idls == $otor->id_lider_beneficio)
                                                        @php
                                                            $j++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            {{$j}}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            @endif
            @if (is_null($municipioSelec))
                <div class="w-full mx-10 shadow-md text-center text-xl text-black bg-white p-6 font-bold">Seleccione un Municipio</div>                    
            @endif
            <div class="flex justify-center">
                <div class="w-full text-center">
                    <button onClick="javascript:window.print()" class="w-1/2 py-3 px-4 uppercase font-bold text-white rounded-lg bg-red-600 shadow-lg block md:inline-block my-8">Imprimir</button>
                </div>
            </div>
        </div>
    </div>
</div>