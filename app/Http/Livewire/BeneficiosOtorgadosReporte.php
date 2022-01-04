<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\lider_subcategoria;
use App\Models\Subcategoria;
use Livewire\Component;

class BeneficiosOtorgadosReporte extends Component
{
    public function render()
    {
        $categorias = Categoria::all();
        $beneficios = Subcategoria::all();
        $pedidos = lider_subcategoria::select('id_subcategoria')
                        ->get();
        $total = count($pedidos);
        return view('livewire.reportes.beneficios-otorgados-reporte', compact('categorias', 'beneficios', 'total', 'pedidos'));
    }
}
