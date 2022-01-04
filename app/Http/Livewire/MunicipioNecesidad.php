<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\lider_subcategoria;
use App\Models\Municipio;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MunicipioNecesidad extends Component
{
    public $municipioSelec = null, $categoriaSelec = null;
    public $resultado = null;
    public $municipio = null, $categoria = null;
    public function render()
    {
        $municipios = Municipio::all();
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        $total = count(lider_subcategoria::all());
        return view('livewire.reportes.municipio-necesidad', compact('municipios', 'categorias', 'subcategorias', 'total'));
    }

    public function updatedmunicipioSelec($id_municipio){
        if($id_municipio == ''){
            $this->municipio = null;
            $this->municipioSelec = null;
        }else{
            $this->municipio = $id_municipio;
        }
        if(is_null($this->categoria)){
            $this->resultado = Municipio::join('parroquias', 'municipios.id', '=', 'parroquias.id_municipio')
            ->join('lider_social', 'parroquias.id', '=', 'lider_social.id_parroquia')
            ->join('lider_subcategoria', 'lider_social.id', '=', 'lider_subcategoria.id_lider')
            ->join('subcategorias', 'lider_subcategoria.id_subcategoria', '=', 'subcategorias.id')
            ->join('categorias', 'subcategorias.id_categoria', '=', 'categorias.id')
            ->select('municipios.id AS id_mun', 'categorias.id AS id_cat', 'subcategorias.id AS id_subcat')
            ->where('municipios.id', $this->municipio)
            ->get();
        }else{
            $this->resultado = Municipio::join('parroquias', 'municipios.id', '=', 'parroquias.id_municipio')
            ->join('lider_social', 'parroquias.id', '=', 'lider_social.id_parroquia')
            ->join('lider_subcategoria', 'lider_social.id', '=', 'lider_subcategoria.id_lider')
            ->join('subcategorias', 'lider_subcategoria.id_subcategoria', '=', 'subcategorias.id')
            ->join('categorias', 'subcategorias.id_categoria', '=', 'categorias.id')
            ->select('municipios.id AS id_mun', 'categorias.id AS id_cat', 'subcategorias.id AS id_subcat')
            ->where('municipios.id', $this->municipio)
            ->where('categorias.id', $this->categoria)
            ->get();
        }
    }

    public function updatedcategoriaSelec($id_categoria){
        if($id_categoria == ''){
            $this->categoria = null;
            $this->categoriaSelec = null;
        }else{
            $this->categoria = $id_categoria;
        }
        if(!is_null($this->municipio)){
            $this->resultado = Municipio::join('parroquias', 'municipios.id', '=', 'parroquias.id_municipio')
            ->join('lider_social', 'parroquias.id', '=', 'lider_social.id_parroquia')
            ->join('lider_subcategoria', 'lider_social.id', '=', 'lider_subcategoria.id_lider')
            ->join('subcategorias', 'lider_subcategoria.id_subcategoria', '=', 'subcategorias.id')
            ->join('categorias', 'subcategorias.id_categoria', '=', 'categorias.id')
            ->select('municipios.id AS id_mun', 'categorias.id AS id_cat', 'subcategorias.id AS id_subcat')
            ->where('municipios.id', $this->municipio)
            ->where('categorias.id', $this->categoria)
            ->get();
        }
        if(is_null($this->categoria)){
            $this->resultado = Municipio::join('parroquias', 'municipios.id', '=', 'parroquias.id_municipio')
            ->join('lider_social', 'parroquias.id', '=', 'lider_social.id_parroquia')
            ->join('lider_subcategoria', 'lider_social.id', '=', 'lider_subcategoria.id_lider')
            ->join('subcategorias', 'lider_subcategoria.id_subcategoria', '=', 'subcategorias.id')
            ->join('categorias', 'subcategorias.id_categoria', '=', 'categorias.id')
            ->select('municipios.id AS id_mun', 'categorias.id AS id_cat', 'subcategorias.id AS id_subcat')
            ->where('municipios.id', $this->municipio)
            ->get();
        }
    }
}
