<?php

namespace App\Http\Livewire;

use App\Models\Municipio;
use App\Models\Parroquia;
use Livewire\Component;
use Livewire\WithPagination;

class Parroquias extends Component
{
    use WithPagination;
    public /*$parroquias,*/ $nombre, $id_municipio, $status, $id_parroquia;
    public $busqueda = null;
    public $modal_create = false, $modal_update = false, $modal_confirm = false, $pivot = false;

    public function render()
    {
        $municipios = Municipio::all();
        if($this->pivot == false){
            if(!is_null($this->busqueda)){
                $parroquias = Parroquia::where('nombre', 'like', '%'.$this->busqueda.'%')
                ->where('status', 1)
                ->paginate(10);
            }else{
                $parroquias = Parroquia::where('status', 1)->paginate(10);
            }
        }else{
            if(!is_null($this->busqueda)){
                $parroquias = Parroquia::where('nombre', 'like', '%'.$this->busqueda.'%')
                ->where('status', 0)
                ->paginate(10);
            }else{
                $parroquias = Parroquia::where('status', 0)->paginate(10);
            }
        }
        return view('livewire.parroquias.parroquias', compact('parroquias','municipios'));
    }

    public function crear(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardar(){
        $this->validate([
            'nombre' => 'required|max:50|min:3',
            'id_municipio' => 'required'
        ]);
        Parroquia::create([
            'nombre' => $this->nombre,
            'status' => 1,
            'id_municipio' => $this->id_municipio
        ]);
        $this->cerrarModalCreate();
        $this->limpiarCampos();
    }

    public function editar($id_parroquia){
        $parroquia = Parroquia::findOrFail($id_parroquia);
        $this->id_parroquia = $parroquia->id;
        $this->nombre = $parroquia->nombre;
        $this->status = $parroquia->status;
        $this->id_categoria = $parroquia->id_categoria;
        $this->abrirModalUpdate();
    }

    public function actualizar($id_parroquia){
        $this->validate([
            'nombre' => 'required|max:50|min:3',
            'id_municipio' => 'required'
        ]);
        Parroquia::updateOrCreate(['id'=>$this->id_parroquia], [
            'nombre' => $this->nombre,
            'status' => 1,
            'id_municipio' => $this->id_municipio
        ]);
        $this->cerrarModalUpdate();
        $this->limpiarCampos();
    }

    public function confirmar($id_parroquia){
        $parroquia = Parroquia::find($id_parroquia);
        $this->nombre = $parroquia->nombre;
        $this->status = $parroquia->status;
        $this->id_parroquia = $parroquia->id;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($id_parroquia){
        if($this->status == 1){
            $this->status = 0;
        }else{
            $this->status = 1;
        }
        Parroquia::updateOrCreate(['id' => $this->id_parroquia],[
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
        $this->id_categoria = '';
        $this->id_subcat = '';
    }

}
