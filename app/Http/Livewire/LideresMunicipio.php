<?php

namespace App\Http\Livewire;

use App\Models\Lider_Social;
use App\Models\Municipio;
use App\Models\Parroquia;
use Livewire\Component;

class LideresMunicipio extends Component
{
    public function render()
    {
        $lideres = Lider_Social::all();
        $parroquias = Parroquia::all();
        $municipios = Municipio::all();
        $total = count($lideres);
        return view('livewire.reportes.lideres-municipio', compact('lideres', 'parroquias', 'municipios','total'));
    }
}
