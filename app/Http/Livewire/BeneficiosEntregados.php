<?php

namespace App\Http\Livewire;

use App\Models\Beneficio_entregado;
use App\Models\Categoria;
use App\Models\lider_subcategoria;
use App\Models\Subcategoria;
use Livewire\Component;

class BeneficiosEntregados extends Component
{
    public function render()
    {
        $categorias = Categoria::all();
        $beneficios = Subcategoria::all();
        $pedidos = lider_subcategoria::all();
        $entregados = Beneficio_entregado::all();
        return view('livewire.reportes.beneficios-entregados', compact('categorias','beneficios','pedidos','entregados'));
    }
}
