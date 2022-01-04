<?php

namespace App\Http\Livewire;

use App\Models\Beneficio_entregado;
use App\Models\Categoria;
use App\Models\Comuna;
use App\Models\Consejo_comunal;
use App\Models\Evento;
use App\Models\Lider_Social;
use App\Models\lider_subcategoria;
use App\Models\Municipio;
use App\Models\Parroquia;
use App\Models\Secretaria;
use App\Models\Subcategoria;
use App\Models\Ubch;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class LideresSociales extends Component
{
    use WithPagination;
    public $subcategorias, $id_beneficio, $benef_entregados, $benef_recibidos, $cedula, $p_nombre, $s_nombre, $p_apellido, $s_apellido, $telefono_1, $telefono_2, $carnet_psuv, $direccion, $id_lider;
    public $id_ubch = null, $id_comuna = null, $id_consejocomunal = null;
    public $beneficios = [];
    public $eventos, $secretarias;
    public $fecha_otor, $observacion_otor, $secretaria_otor = null, $evento_otor = null;
    public $busqueda = null;
    public $selectedMunicipio = null, $selectedParroquia = null;
    public $catParroquias = null;
    public $modal_create = false, $modal_update = false, $modal_detalles = false, $modal_otorgar = false, $modal_entregado = null;
    public $even_sec = null;
    public $id_benef, $nombre_benef, $detallesEntrega;

    public function render()
    {
        $categorias = Categoria::where('status', 1)->get();
        $todas_subcategorias = Subcategoria::where('status', 1)->get();
        $ccomunales = Consejo_comunal::where('status', 1)->get();
        $comunas = Comuna::where('status',1)->get();
        $ubches = Ubch::where('status',1)->get();
        $municipios = Municipio::where('status', 1)->get();
        $parroquias = Parroquia::where('status', 1)->get();
        if(!is_null($this->busqueda)){
            $lideres = Lider_Social::where('cedula', 'like', '%'.$this->busqueda.'%')
            ->orWhere('p_nombre', 'like', '%'.$this->busqueda.'%')
            ->orWhere('s_nombre', 'like', '%'.$this->busqueda.'%')
            ->orWhere('p_apellido', 'like', '%'.$this->busqueda.'%')
            ->orWhere('s_apellido', 'like', '%'.$this->busqueda.'%')
            ->orWhere('carnet_psuv', 'like', '%'.$this->busqueda.'%')
            ->orderBy('id', 'desc')
            ->paginate(25);
        }else{
            $lideres = Lider_Social::orderBy('id', 'desc')->paginate(25);
        }
        return view('livewire.lideres-sociales.lideres-sociales', compact('todas_subcategorias', 'categorias','lideres','ccomunales','comunas','ubches','municipios','parroquias'));
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
            'cedula' => 'required|max:12',
            'p_nombre' => 'required|max:20|min:3',
            's_nombre' => 'max:20|min:3',
            'p_apellido' => 'required|max:20|min:3',
            's_apellido' => 'max:20|min:3',
            'telefono_1' => 'required|max:12|min:11',
            'telefono_2' => 'max:12|min:11',
            'carnet_psuv' => 'max:20',
            'direccion' => 'required|max:100',
            'selectedParroquia' => 'required',
            'id_comuna' => 'required',
            'id_ubch' => 'required',
            'id_consejocomunal' => 'required'
        ]);
        Lider_Social::create([
            'cedula' => $this->cedula,
            'p_nombre' => $this->p_nombre,
            's_nombre' => $this->s_nombre,
            'p_apellido' => $this->p_apellido,
            's_apellido' => $this->s_apellido,
            'telefono_1' => $this->telefono_1,
            'telefono_2' => $this->telefono_2,
            'carnet_psuv' => $this->carnet_psuv,
            'direccion' => $this->direccion,
            'id_parroquia' => $this->selectedParroquia,
            'id_ubch' => $this->id_ubch,
            'id_consejocomunal' => $this->id_consejocomunal,
            'id_comuna' => $this->id_comuna,
        ]);
        $this->cerrarModalCreate();
        $this->limpiarCampos();
    }

    public function editar($id_lider){
        $lider = Lider_Social::findOrFail($id_lider);
        $this->id_lider = $lider->id;
        $this->cedula = $lider->cedula;
        $this->p_nombre = $lider->p_nombre;
        $this->s_nombre = $lider->s_nombre;
        $this->p_apellido = $lider->p_apellido;
        $this->s_apellido = $lider->s_apellido;
        $this->telefono_1 = $lider->telefono_1;
        $this->telefono_2 = $lider->telefono_2;
        $this->carnet_psuv = $lider->carnet_psuv;
        $this->direccion = $lider->direccion;
        $this->selectedParroquia = $lider->id_parroquia;
        $this->id_ubch = $lider->id_ubch;
        $this->id_consejocomunal = $lider->id_consejocomunal;
        $this->id_comuna = $lider->id_comuna;
        $this->abrirModalUpdate();
    }

    public function actualizar($id_lider){
        $this->validate([
            'cedula' => 'required|max:12',
            'p_nombre' => 'required|max:20|min:3',
            's_nombre' => 'max:20|min:3',
            'p_apellido' => 'required|max:20|min:3',
            's_apellido' => 'max:20|min:3',
            'telefono_1' => 'required|max:12|min:11',
            'telefono_2' => 'max:12|min:11',
            'carnet_psuv' => 'max:20',
            'direccion' => 'required|max:100',
            'selectedParroquia' => 'required'
        ]);
        Lider_Social::updateOrCreate(['id' => $this->id_lider], [
            'cedula' => $this->cedula,
            'p_nombre' => $this->p_nombre,
            's_nombre' => $this->s_nombre,
            'p_apellido' => $this->p_apellido,
            's_apellido' => $this->s_apellido,
            'telefono_1' => $this->telefono_1,
            'telefono_2' => $this->telefono_2,
            'carnet_psuv' => $this->carnet_psuv,
            'direccion' => $this->direccion,
            'id_parroquia' => $this->selectedParroquia,
            'id_ubch' => $this->id_ubch,
            'id_consejocomunal' => $this->id_consejocomunal,
            'id_comuna' => $this->id_comuna,
        ]);
        $this->cerrarModalUpdate();
        $this->limpiarCampos();
    }

    public function verDetalles($id_lider){
        $lider = Lider_Social::find($id_lider);
        $this->benef_recibidos = lider_subcategoria::whereNotIn('id', function($query){
            $query->select('id_lider_beneficio')
                ->from('beneficio_entregado');
            })
            ->where('id_lider', $id_lider)
            ->get();
        $this->cedula = $lider->cedula;
        $this->p_nombre = $lider->p_nombre;
        $this->s_nombre = $lider->s_nombre;
        $this->p_apellido = $lider->p_apellido;
        $this->s_apellido = $lider->s_apellido;
        $this->telefono_1 = $lider->telefono_1;
        $this->telefono_2 = $lider->telefono_2;
        $this->carnet_psuv = $lider->carnet_psuv;
        $this->direccion = $lider->direccion;
        $this->selectedParroquia = $lider->id_parroquia;
        $this->id_ubch = $lider->id_ubch;
        $this->id_consejocomunal = $lider->id_consejocomunal;
        $this->id_comuna = $lider->id_comuna;
        $this->id_lider = $lider->id;
        $this->subcategorias = DB::table('subcategorias')
        ->whereNotIn('id', function($query){
            $query->select('id_subcategoria')->from('lider_subcategoria')->where('id_lider', $this->id_lider);
        })
        ->select('id', 'nombre', 'id_categoria')
        ->where('status', 1)
        ->distinct('id')
        ->get();
        $this->benef_entregados = Beneficio_entregado::
        join('lider_subcategoria', 'beneficio_entregado.id_lider_beneficio', '=', 'lider_subcategoria.id')
        ->join('subcategorias', 'subcategorias.id', '=', 'lider_subcategoria.id_subcategoria')
        ->select('subcategorias.nombre', 'subcategorias.id AS idsub','lider_subcategoria.id AS idls', 'beneficio_entregado.id AS idbe')
        ->where('lider_subcategoria.id_lider', $this->id_lider)
        ->get();
        $this->abrirModalDetalles();
    }

    public function guardarBeneficio($id_subcategoria){
        lider_subcategoria::create([
            'id_lider' => $this->id_lider,
            'id_subcategoria' => $id_subcategoria
        ]);
        $this->benef_recibidos = lider_subcategoria::where('id_lider', $this->id_lider)->get();
        $this->subcategorias = DB::table('subcategorias')
        ->whereNotIn('id', function($query){
            $query->select('id_subcategoria')->from('lider_subcategoria')->where('id_lider', $this->id_lider);
        })
        ->select('id', 'nombre', 'id_categoria')
        ->where('status', 1)
        ->distinct('id')
        ->get();
    }

    public function quitarBeneficio($id_benef){
        lider_subcategoria::find($id_benef)->delete();
        $this->benef_recibidos = lider_subcategoria::where('id_lider', $this->id_lider)->get();
        $this->subcategorias = DB::table('subcategorias')
        ->whereNotIn('id', function($query){
            $query->select('id_subcategoria')->from('lider_subcategoria')->where('id_lider', $this->id_lider);
        })
        ->select('id', 'nombre', 'id_categoria')
        ->where('status', 1)
        ->distinct('id')
        ->get();
    }

    public function otorgarBeneficio($benef_id){
        $this->id_benef = $benef_id;
        $datos = lider_subcategoria::find($this->id_benef);
        $id_subcat = $datos->id_subcategoria;
        $dataSubcat = Subcategoria::find($id_subcat);
        $this->nombre_benef = $dataSubcat->nombre;
        /*        $this->nombre_benef = lider_subcategoria::
                join('subcategorias', 'subcategorias.id', '=', 'lider_subcategoria.id_subcategoria')
                ->select('subcategorias.id AS idsub')
                ->where('lider_subcategoria.id', $this->id_benef)
                ->get();*/
        $this->eventos = Evento::all();
        $this->secretarias = Secretaria::all();
        $this->subcategorias = Subcategoria::all();
        $this->cerrarModalDetalles();
        $this->abrirModalOtorgar();
    }

    public function guardarBeneficioOtorgado($id_otorgado){
        $this->validate([
            'fecha_otor' => 'required',
            'even_sec' => 'required',

        ]);
        Beneficio_entregado::create([
            'fecha' => $this->fecha_otor,
            'id_evento' => $this->evento_otor,
            'id_secretaria' => $this->secretaria_otor,
            'observacion' => $this->observacion_otor,
            'id_lider_beneficio' => $id_otorgado,
        ]);
        $this->cerrarModalOtorgar();
        $this->verDetalles($this->id_lider);
    }

    public function verBeneficioOtorgado($id_ben_rec){
        $this->detallesEntrega = Beneficio_entregado::
                join('lider_subcategoria', 'lider_subcategoria.id', '=', 'beneficio_entregado.id_lider_beneficio')
            ->join('subcategorias', 'subcategorias.id', '=', 'lider_subcategoria.id_subcategoria')
            ->select('beneficio_entregado.fecha AS fecha', 
                    'beneficio_entregado.id_evento AS evento',
                    'beneficio_entregado.id_secretaria AS secretaria',
                    'beneficio_entregado.observacion AS observacion',
                    'subcategorias.id AS idsub')
            ->where('beneficio_entregado.id', $id_ben_rec)
            ->get();
        $this->eventos = Evento::all(); //ojo aquí por si hay conflictos luego...
        $this->secretarias = Secretaria::all();//Idem...
        $this->beneficios = Subcategoria::all();//Idem...
        $this->cerrarModalDetalles();
        $this->abrirModalEntregado();
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

    public function abrirModalDetalles(){
        $this->modal_detalles = true;
    }

    public function cerrarModalDetalles(){
        $this->modal_detalles = false;
    }

    public function abrirModalOtorgar(){
        $this->modal_otorgar = true;
    }

    public function cerrarModalOtorgar(){
        $this->modal_otorgar = false;
    }

    public function abrirModalEntregado(){
        $this->modal_entregado = true;
    }

    public function cerrarModalEntregado(){
        $this->modal_entregado = false;
    }

    public function limpiarCampos(){
        $this->cedula = '';
        $this->p_nombre = '';
        $this->s_nombre = '';
        $this->p_apellido = '';
        $this->s_apellido = '';
        $this->telefono_1 = '';
        $this->telefono_2 = '';
        $this->carnet_psuv = '';
        $this->direccion = '';
        $this->id_parroquia = '';
        $this->id_ubch = '';
        $this->id_comuna = '';
        $this->id_consejocomunal = '';
        $this->id_lider = '';
    }

}
