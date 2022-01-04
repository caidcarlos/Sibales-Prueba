<?php

namespace App\Http\Livewire;

use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Ubch;
use Livewire\Component;
use Livewire\WithPagination;

class Ubches extends Component
{
    use WithPagination;
    public $codigo, $nombre, $telefono, $direccion, $id_parroquia, $status, $id_ubch;
    public $busqueda = null;
    public $selectedMunicipio = null, $selectedParroquia = null;
    public $catParroquias = null;
    public $modal_create = false, $modal_update = false, $modal_confirm = false, $pivot = false;

    public function render()
    {
        $municipios = Municipio::where('status', 1)->get();
        $parroquias = Parroquia::where('status', 1)->get();
        if($this->pivot == false){
            if(!is_null($this->busqueda)){
                $ubches = Ubch::where('nombre', 'like', '%'.$this->busqueda.'%')
                ->orWhere('codigo', 'like', '%'.$this->busqueda.'%')
                ->orWhere('direccion', 'like', '%'.$this->busqueda.'%')
                ->where('status', 1)
                ->paginate(25);
            }else{
                $ubches = Ubch::where('status', 1)->paginate(25);
            }
        }else{
            if(!is_null($this->busqueda)){
                $ubches = Ubch::where('nombre', 'like', '%'.$this->busqueda.'%')
                ->orWhere('codigo', 'like', '%'.$this->busqueda.'%')
                ->orWhere('direccion', 'like', '%'.$this->busqueda.'%')
                ->where('status', 0)
                ->paginate(25);
            }else{
                $ubches = Ubch::where('status', 0)->paginate(25);
            }
        }
        return view('livewire.ubches.ubches', compact('municipios','parroquias','ubches'));
    }

    public function updatedselectedMunicipio($id_municipio){
        $this->catParroquias = Parroquia::where('id_municipio', $id_municipio)->get();
    }

    public function crear(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardar(){
        $this->validate([
            'codigo' => 'required|max:20',
            'nombre' => 'required|max:50|min:3',
            'telefono' => 'max:12',
            'direccion' => 'required|max:100',
            'selectedParroquia' => 'required'
        ]);
        Ubch::create([
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'id_parroquia' => $this->selectedParroquia,
            'status' => 1,
        ]);
        $this->cerrarModalCreate();
        $this->limpiarCampos();
    }

    public function editar($id_ubch){
        $ubch = Ubch::findOrFail($id_ubch);
        $this->id_ubch = $ubch->id;
        $this->codigo = $ubch->codigo;
        $this->nombre = $ubch->nombre;
        $this->telefono = $ubch->telefono;
        $this->direccion = $ubch->direccion;
        $this->selectedParroquia = $ubch->id_parroquia;
        $this->status = $ubch->status;
        $this->abrirModalUpdate();
    }

    public function actualizar($id_ubch){
        $this->validate([
            'codigo' => 'required|max:20',
            'nombre' => 'required|max:50|min:3',
            'telefono' => 'max:12',
            'direccion' => 'required|max:100',
            'selectedParroquia' => 'required'
        ]);
        Ubch::updateOrCreate(['id'=>$this->id_ubch], [
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'id_parroquia' => $this->selectedParroquia,
            'status' => 1,
        ]);
        $this->cerrarModalUpdate();
        $this->limpiarCampos();
    }

    public function confirmar($id_ubch){
        $ubch = Ubch::find($id_ubch);
        $this->nombre = $ubch->nombre;
        $this->status = $ubch->status;
        $this->id_ubch = $ubch->id;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($id_ubch){
        if($this->status == 1){
            $this->status = 0;
        }else{
            $this->status = 1;
        }
        Ubch::updateOrCreate(['id' => $this->id_ubch],[
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
        $this->id_ubch = '';
        $this->codigo = '';
        $this->nombre = '';
        $this->telefono = '';
        $this->direccion = '';
        $this->status = '';
        $this->id_parroquia = '';
    }
}
