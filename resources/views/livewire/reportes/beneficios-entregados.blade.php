<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Reporte General de Beneficios Requeridos') }}
    </h2>
</x-slot>
<div class="mt-6 py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-2">
            <div class="flex justify-between">
                <div class="w-1/4">
                    <button onClick="javascript:window.print()" class="py-3 px-4 uppercase font-bold text-white rounded-lg bg-red-600 shadow-lg block md:inline-block my-8">Imprimir</button>
                </div>
            </div>
            @foreach ($categorias as $categoria)
                <div class="text-xl font-bold text-black py-6 text-center">Categoría: {{$categoria->nombre}}</div>
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-red-600 text-white uppercase text-xl py-4 my-10">
                            <th class="w-1/2">Beneficio</th>
                            <th class="w-1/4">Veces Requerido</th>
                            <th class="w-1/4">Veces Entregados</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($beneficios as $beneficio)
                            @if ($beneficio->id_categoria == $categoria->id)
                                <tr>
                                    <td class="border px-4 py-2 text-center text-xl">{{$beneficio->nombre}}</td>
                                    <td class="border px-4 py-2 text-center text-xl">
                                        @php
                                        $i = 0;
                                        @endphp
                                        @foreach ($pedidos as $pedido)
                                            @if($pedido->id_subcategoria == $beneficio->id)
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
                                        @foreach ($pedidos as $pedido)
                                            @foreach ($entregados as $entregado)
                                                @if ($pedido->id_subcategoria == $beneficio->id && $entregado->id_lider_beneficio == $pedido->id)
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
            <div class="flex justify-center">
                <div class="w-full text-center">
                    <button onClick="javascript:window.print()" class="w-1/2 py-3 px-4 uppercase font-bold text-white rounded-lg bg-red-600 shadow-lg block md:inline-block my-8">Imprimir</button>
                </div>
            </div>
        </div>
    </div>
</div>