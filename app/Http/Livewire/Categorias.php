<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use Livewire\Component;

class Categorias extends Component
{
    public $categorias, $nombre, $id_cat, $status;
    public $busqueda = null;
    public $modalCreate = false, $modalUpdate = false, $modalConfirm = false, $pivot = false ;

    public function render()
    {
        if($this->pivot == false){
            if(!is_null($this->busqueda)){
                $this->categorias = Categoria::where('nombre', 'like', '%'.$this->busqueda.'%')->get();
            }else{
                $this->categorias = Categoria::where('status', 1)->get();
            }
        }else{
            if(!is_null($this->busqueda)){
                $this->categorias = Categoria::where('nombre', 'like', '%'.$this->busqueda.'%')->get();
            }else{
                $this->categorias = Categoria::where('status', 0)->get();
            }
        }
        return view('livewire.categorias.categorias');
    }

    public function crear(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardar(){
        $this->validate([
            'nombre' => 'required|max:50'
        ]);
        Categoria::create([
            'nombre' => $this->nombre,
            'status' => 1
        ]);
        $this->cerrarModalCreate();
        $this->limpiarCampos();
    }

    public function editar($id_cat){
        $categoria = Categoria::findOrFail($id_cat);
        $this->id_cat = $categoria->id;
        $this->nombre = $categoria->nombre;
        $this->status = $categoria->status;
        $this->abrirModalUpdate();
    }
    public function actualizar($id_cat){
        $this->validate([
            'nombre' => 'required|max:50',
        ]);
        Categoria::updateOrCreate(['id' => $id_cat], [
            'nombre' => $this->nombre,
            'status' => 1
        ]);
        $this->cerrarModalUpdate();
        $this->limpiarCampos();
    }

    public function confirmar($id_cat){
        $categoria = Categoria::find($id_cat);
        $this->nombre = $categoria->nombre;
        $this->status = $categoria->status;
        $this->id_cat = $categoria->id;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($id_cat){
        if($this->status == 1){
            $this->status = 0;
        }else{
            $this->status = 1;
        }
        Categoria::updateOrCreate(['id' => $this->id_cat],[
            'status' => $this->status
        ]);
        $this->cerrarModalConfirm();
    }

    public function abrirModalCreate(){
        $this->modalCreate = true;
    }

    public function cerrarModalCreate(){
        $this->modalCreate = false;
    }

    public function abrirModalUpdate(){
        $this->modalUpdate = true;
    }

    public function cerrarModalUpdate(){
        $this->modalUpdate = false;
    }

    public function abrirModalConfirm(){
        $this->modalConfirm = true;
    }

    public function cerrarModalConfirm(){
        $this->modalConfirm = false;
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
        $this->id_cat = '';

    }
}
