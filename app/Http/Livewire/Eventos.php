<?php

namespace App\Http\Livewire;

use App\Models\Evento;
use App\Models\Municipio;
use App\Models\Parroquia;
use Livewire\Component;

class Eventos extends Component
{
    public $eventos, $nombre, $fecha, $id_evento, $id_parroquia;
    public $busqueda = null;
    public $selectedMunicipio = null, $selectedParroquia = null;
    public $catParroquias = null;
    public $modalCreate = false, $modalUpdate = false, $modalConfirm = false;

    public function render()
    {
        $parroquias = Parroquia::all();
        $municipios = Municipio::all();
        $this->eventos = Evento::where('nombre', 'like', '%'.$this->busqueda.'%')
                ->orWhere('fecha', 'like', '%'.$this->busqueda.'%')->get();
        return view('livewire.eventos.eventos', compact('municipios', 'parroquias'));
    }

    public function crear(){
        $this->limpiarCampos();
        $this->abrirModalCreate();
    }

    public function guardar(){
        $this->validate([
            'nombre' => 'required|max:50',
            'fecha' => 'required',
            'selectedMunicipio' => 'required',
            'selectedParroquia' => 'required'
        ]);
        Evento::create([
            'nombre' => $this->nombre,
            'fecha' => $this->fecha,
            'id_parroquia' => $this->selectedParroquia,
        ]);
        $this->cerrarModalCreate();
        $this->limpiarCampos();
    }

    public function updatedselectedMunicipio($id_municipio){
        $this->catParroquias = Parroquia::where('id_municipio', $id_municipio)->get();
    }

    public function editar($id_evento){
        $evento = Evento::findOrFail($id_evento);
        $this->id_evento = $evento->id;
        $this->nombre = $evento->nombre;
        $this->fecha = $evento->fecha;
        $this->id_parroquia = $evento->id_parroquia;
        $this->abrirModalUpdate();
    }
    public function actualizar($id_evento){
        $this->validate([
            'nombre' => 'required|max:50',
            'fecha' => 'required',
            'selectedMunicipio' => 'required',
            'selectedParroquia' => 'required'
        ]);
        Evento::updateOrCreate(['id' => $id_evento], [
            'nombre' => $this->nombre,
            'fecha' => $this->fecha,
            'id_parroquia' => $this->selectedParroquia,
        ]);
        $this->cerrarModalUpdate();
        $this->limpiarCampos();
    }

    public function confirmar($id_evento){
        $evento = Evento::find($id_evento);
        $this->nombre = $evento->nombre;
        $this->fecha = $evento->fecha;
        $this->id_parroquia = $evento->id_parroquia;
        $this->id_evento = $evento->id;
        $this->abrirModalConfirm();
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
        $this->id_parroquia = '';
        $this->id_evento = '';

    }
}
