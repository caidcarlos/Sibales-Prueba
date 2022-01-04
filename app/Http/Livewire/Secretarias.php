<?php

namespace App\Http\Livewire;

use App\Models\Secretaria;
use Livewire\Component;

class Secretarias extends Component
{
    public $secretarias, $nombre, $id_secretaria, $status;
    public $busqueda = null;
    public $modalCreate = false, $modalUpdate = false, $modalConfirm = false, $pivot = false ;

    public function render()
    {
        if($this->pivot == false){
            if(!is_null($this->busqueda)){
                $this->secretarias = Secretaria::where('nombre', 'like', '%'.$this->busqueda.'%')->get();
            }else{
                $this->secretarias = Secretaria::where('status', 1)->get();
            }
        }else{
            if(!is_null($this->busqueda)){
                $this->secretarias = Secretaria::where('nombre', 'like', '%'.$this->busqueda.'%')->get();
            }else{
                $this->secretarias = Secretaria::where('status', 0)->get();
            }
        }
        return view('livewire.secretarias.secretarias');
    }
    public function crear(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardar(){
        $this->validate([
            'nombre' => 'required|max:50'
        ]);
        Secretaria::create([
            'nombre' => $this->nombre,
            'status' => 1
        ]);
        $this->cerrarModalCreate();
        $this->limpiarCampos();
    }

    public function editar($id_secretaria){
        $secretaria = Secretaria::findOrFail($id_secretaria);
        $this->id_secretaria = $secretaria->id;
        $this->nombre = $secretaria->nombre;
        $this->status = $secretaria->status;
        $this->abrirModalUpdate();
    }
    public function actualizar($id_secretaria){
        $this->validate([
            'nombre' => 'required|max:50',
        ]);
        Secretaria::updateOrCreate(['id' => $id_secretaria], [
            'nombre' => $this->nombre,
            'status' => 1
        ]);
        $this->cerrarModalUpdate();
        $this->limpiarCampos();
    }

    public function confirmar($id_secretaria){
        $secretaria = Secretaria::find($id_secretaria);
        $this->nombre = $secretaria->nombre;
        $this->status = $secretaria->status;
        $this->id_secretaria = $secretaria->id;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($id_cat){
        if($this->status == 1){
            $this->status = 0;
        }else{
            $this->status = 1;
        }
        Secretaria::updateOrCreate(['id' => $this->id_secretaria],[
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
        $this->id_secretaria = '';

    }
}
