<?php

namespace App\Http\Livewire;

use App\Models\Consejo_comunal;
use App\Models\Municipio;
use App\Models\Parroquia;
use Livewire\Component;
use Livewire\WithPagination;


class ConsejosComunales extends Component
{
    use WithPagination;
    public $codigo, $nombre, $telefono, $direccion, $id_parroquia, $status, $id_cc;
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
                $consejoscomunales = Consejo_comunal::where('nombre', 'like', '%'.$this->busqueda.'%')
                ->orWhere('codigo', 'like', '%'.$this->busqueda.'%')
                ->orWhere('direccion', 'like', '%'.$this->busqueda.'%')
                ->where('status', 1)
                ->paginate(25);
            }else{
                $consejoscomunales = Consejo_comunal::where('status', 1)->paginate(25);
            }
        }else{
            if(!is_null($this->busqueda)){
                $consejoscomunales = Consejo_comunal::where('nombre', 'like', '%'.$this->busqueda.'%')
                ->orWhere('codigo', 'like', '%'.$this->busqueda.'%')
                ->orWhere('direccion', 'like', '%'.$this->busqueda.'%')
                ->where('status', 0)
                ->paginate(25);
            }else{
                $consejoscomunales = Consejo_comunal::where('status', 0)->paginate(25);
            }
        }
        return view('livewire.consejos-comunales.consejos-comunales', compact('consejoscomunales','municipios','parroquias'));
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
        Consejo_comunal::create([
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
        $cc = Consejo_comunal::findOrFail($id_cc);
        $this->id_cc = $cc->id;
        $this->codigo = $cc->codigo;
        $this->nombre = $cc->nombre;
        $this->telefono = $cc->telefono;
        $this->direccion = $cc->direccion;
        $this->selectedParroquia = $cc->id_parroquia;
        $this->status = $cc->status;
        $this->abrirModalUpdate();
    }

    public function actualizar($id_cc){
        $this->validate([
            'codigo' => 'required|max:20',
            'nombre' => 'required|max:50|min:3',
            'telefono' => 'max:12',
            'direccion' => 'required|max:100',
            'selectedParroquia' => 'required'
        ]);
        Consejo_comunal::updateOrCreate(['id'=>$this->id_cc], [
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

    public function confirmar($id_cc){
        $cc = Consejo_comunal::find($id_cc);
        $this->nombre = $cc->nombre;
        $this->status = $cc->status;
        $this->id_cc = $cc->id;
        $this->abrirModalConfirm();
    }

    public function cambiarStatus($id_cc){
        if($this->status == 1){
            $this->status = 0;
        }else{
            $this->status = 1;
        }
        Consejo_comunal::updateOrCreate(['id' => $this->id_cc],[
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
        $this->id_cc = '';
        $this->codigo = '';
        $this->nombre = '';
        $this->telefono = '';
        $this->direccion = '';
        $this->status = '';
        $this->id_parroquia = '';
    }
}
