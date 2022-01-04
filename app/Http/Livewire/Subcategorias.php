<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Livewire\Component;

class Subcategorias extends Component
{
    public $subcategorias, $nombre, $id_subcat, $id_categoria;
    public $busqueda = null;
    public $modal_create = false, $modal_update = false, $modal_confirm = false, $pivot = false;
    public $estat = 1;

    public function render()
    {
        $categorias = Categoria::all();
        if($this->pivot == false){
            if(!is_null($this->busqueda)){
                $this->subcategorias = Subcategoria::where('nombre', 'like', '%'.$this->busqueda.'%')
                ->where('status', 1)
                ->get();
            }else{
                $this->subcategorias = Subcategoria::where('status', 1)->get();
            }
        }else{
            if(!is_null($this->busqueda)){
                $this->subcategorias = Subcategoria::where('nombre', 'like', '%'.$this->busqueda.'%')
                ->where('status', 0)
                ->get();
            }else{
                $this->subcategorias = Subcategoria::where('status', 0)->get();
            }
        }
        return view('livewire.subcategorias.subcategorias', compact('categorias'));
    }

    public function crear(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardar(){
        $this->validate([
            'nombre' => 'required|max:100|min:4',
            'id_categoria' => 'required'
        ]);
        Subcategoria::create([
            'nombre' => $this->nombre,
            'status' => $this->estat,
            'id_categoria' => $this->id_categoria
        ]);
        $this->cerrarModalCreate();
        $this->limpiarCampos();
    }

    public function editar($id_subcat){
        $subcategoria = Subcategoria::findOrFail($id_subcat);
        $this->id_subcat = $subcategoria->id;
        $this->nombre = $subcategoria->nombre;
        $this->status = $subcategoria->status;
        $this->id_categoria = $subcategoria->id_categoria;
        $this->abrirModalUpdate();
    }

    public function actualizar($id_subcat){
        $this->validate([
            'nombre' => 'required|max:100|min:4',
            'id_categoria' => 'required'
        ]);
        Subcategoria::updateOrCreate(['id'=>$this->id_subcat], [
            'nombre' => $this->nombre,
            'status' => $this->estat,
            'id_categoria' => $this->id_categoria
        ]);
        $this->cerrarModalUpdate();
        $this->limpiarCampos();
    }

    public function confirmar($id_subcat){
        $subcategoria = Subcategoria::find($id_subcat);
        $this->nombre = $subcategoria->nombre;
        $this->estat = $subcategoria->status;
        $this->id_subcat = $subcategoria->id;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($id_subcat){
        if($this->estat == 1){
            $this->estat = 0;
        }else{
            $this->estat = 1;
        }
        Subcategoria::updateOrCreate(['id' => $this->id_subcat],[
            'status' => $this->estat
        ]);
        $this->cerrarModalConfirm();
    }

    public function abrirModalCreate(){
        $this->modal_create = true;
    }

    public function cerrarModalCreate(){
        $this->modal_create = false;
    }

    public function abrirModalUpdate(){
        $this->modal_update = true;
    }

    public function cerrarModalUpdate(){
        $this->modal_update = false;
    }

    public function abrirModalConfirm(){
        $this->modal_confirm = true;
    }

    public function cerrarModalConfirm(){
        $this->modal_confirm = false;
    }

    public function cambiaVista(){
        if($this->pivot == true){
            $this->pivot = false;
        }else{
            $this->pivot = true;
        }
    }

    public function limpiarCampos(){
        $this->nombre = '';
        $this->status = '';
        $this->id_categoria = '';
        $this->id_subcat = '';
    }

}
