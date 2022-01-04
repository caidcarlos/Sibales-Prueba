<div class="fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);" id="modal-id">
    <div class="absolute bg-black opacity-80 inset-0 z-0"></div>
    <div class="w-1/2  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
        <div class="">
            <div class="text-center p-5 flex-auto justify-center">
                <h2 class="text-xl font-bold py-4 ">¿Está seguro?</h2>
                <p class="text-gray-700 px-8 text-lg">
                    ¿De verdad quiere
                    @if ($status == 1)
                        <b>desactivar</b>
                    @else
                        <b>activar</b>
                    @endif
                    la UBCh {{$nombre}}?</p>    
            </div>
            <div class="p-3 mt-2 text-center space-x-4 md:block py-8">
                <button wire:click="cerrarModalConfirm()" 
                    class="py-3 px-4 uppercase font-bold text-white rounded-lg bg-blue-800 hover:bg-blue-600 shadow-lg block md:inline-block">
                    Cancelar
                </button>
                <button wire:click="cambiarStatus({{$id_ubch}})"
                    class="py-3 px-4 uppercase font-bold text-white rounded-lg bg-red-700 hover:bg-red-600 shadow-lg block md:inline-block">
                    @if ($status == 1)
                        <b>Inhabilitar</b>
                    @else
                        <b>Habilitar</b>
                    @endif
                </button>
            </div>
        </div>
    </div>
</div>