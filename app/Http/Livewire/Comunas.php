<?php

namespace App\Http\Livewire;

use App\Models\Comuna;
use App\Models\Municipio;
use App\Models\Parroquia;
use Livewire\Component;
use Livewire\WithPagination;


class Comunas extends Component
{
    use WithPagination;
    public $codigo, $nombre, $telefono, $direccion, $id_parroquia, $status, $id_comuna;
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
                $comunas = Comuna::where('nombre', 'like', '%'.$this->busqueda.'%')
                ->orWhere('codigo', 'like', '%'.$this->busqueda.'%')
                ->orWhere('direccion', 'like', '%'.$this->busqueda.'%')
                ->where('status', 1)
                ->paginate(25);
            }else{
                $comunas = Comuna::where('status', 1)->paginate(25);
            }
        }else{
            if(!is_null($this->busqueda)){
                $comunas = Comuna::where('nombre', 'like', '%'.$this->busqueda.'%')
                ->orWhere('codigo', 'like', '%'.$this->busqueda.'%')
                ->orWhere('direccion', 'like', '%'.$this->busqueda.'%')
                ->where('status', 0)
                ->paginate(25);
            }else{
                $comunas = Comuna::where('status', 0)->paginate(25);
            }
        }
        return view('livewire.comunas.comunas', compact('comunas','municipios','parroquias'));
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
        Comuna::create([
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

    public function editar($id_cc){
        $comuna = Comuna::findOrFail($id_cc);
        $this->id_comuna = $comuna->id;
        $this->codigo = $comuna->codigo;
        $this->nombre = $comuna->nombre;
        $this->telefono = $comuna->telefono;
        $this->direccion = $comuna->direccion;
        $this->selectedParroquia = $comuna->id_parroquia;
        $this->status = $comuna->status;
        $this->abrirModalUpdate();
    }

    public function actualizar($id_comuna){
        $this->validate([
            'codigo' => 'required|max:20',
            'nombre' => 'required|max:50|min:3',
            'telefono' => 'max:12',
            'direccion' => 'required|max:100',
            'selectedParroquia' => 'required'
        ]);
        Comuna::updateOrCreate(['id'=>$this->id_comuna], [
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

    public function confirmar($id_comuna){
        $comuna = Comuna::find($id_comuna);
        $this->nombre = $comuna->nombre;
        $this->status = $comuna->status;
        $this->id_comuna = $comuna->id;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($id_comuna){
        if($this->status == 1){
            $this->status = 0;
        }else{
            $this->status = 1;
        }
        Comuna::updateOrCreate(['id' => $this->id_comuna],[
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
        $this->id_comuna = '';
        $this->codigo = '';
        $this->nombre = '';
        $this->telefono = '';
        $this->direccion = '';
        $this->status = '';
        $this->id_parroquia = '';
    }
}
