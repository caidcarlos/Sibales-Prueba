<?php

namespace App\Http\Livewire;

use App\Models\Municipio;
use Livewire\Component;

class Municipios extends Component
{
    public $municipios, $nombre, $id_municipio, $status;
    public $busqueda = null;
    public $modal_create = false, $modal_update = false, $modal_confirm = false, $pivot = false;

    public function render()
    {
        if($this->pivot == false){
            if(!is_null($this->busqueda)){
                $this->municipios = Municipio::where('nombre', 'like', '%'.$this->busqueda.'%')
                ->where('status', 1)
                ->get();
            }else{
                $this->municipios = Municipio::where('status', 1)->get();
            }
        }else{
            if(!is_null($this->busqueda)){
                $this->municipios = Municipio::where('nombre', 'like', '%'.$this->busqueda.'%')
                ->where('status', 0)
                ->get();
            }else{
                $this->municipios = Municipio::where('status', 0)->get();
            }
        }
        return view('livewire.municipios.municipios');
    }

    public function crear(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardar(){
        $this->validate([
            'nombre' => 'required|max:50|min:3',
        ]);
        Municipio::create([
            'nombre' => $this->nombre,
            'status' => 1,
        ]);
        $this->cerrarModalCreate();
        $this->limpiarCampos();
    }

    public function editar($id_municipio){
        $municipio = Municipio::findOrFail($id_municipio);
        $this->id_municipio = $municipio->id;
        $this->nombre = $municipio->nombre;
        $this->status = $municipio->status;
        $this->abrirModalUpdate();
    }

    public function actualizar($id_municipio){
        $this->validate([
            'nombre' => 'required|max:50|min:3',
        ]);
        Municipio::updateOrCreate(['id'=>$this->id_municipio], [
            'nombre' => $this->nombre,
            'status' => $this->status,
        ]);
        $this->cerrarModalUpdate();
        $this->limpiarCampos();
    }

    public function confirmar($id_municipio){
        $municipio = Municipio::find($id_municipio);
        $this->nombre = $municipio->nombre;
        $this->status = $municipio->status;
        $this->id_municipio = $municipio->id;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($id_municipio){
        if($this->status == 1){
            $this->status = 0;
        }else{
            $this->status = 1;
        }
        Municipio::updateOrCreate(['id' => $this->id_municipio],[
            'status' => $this->status
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
        $this->id_municipio = '';
    }

}
