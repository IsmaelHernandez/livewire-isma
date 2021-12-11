<?php

namespace App\Http\Livewire;

use Livewire\Component;
//primero invocar al modelo para mostrar los datos de la tabla
use App\Models\Producto;

class Productos extends Component
{
    //definir la variable productos
    public $productos, $descripcion, $cantidad, $id_prodcuto;
    //variable para el modal
    public $modal = false;

    public function render()
    {
        //traer todos los registros de la base de datos
       $this->productos = Producto::all();
        return view('livewire.productos');
    }

    //al oprimir crear abrira una ventana modal
    public function crear()
    {
        $this->limpiarCampos();
        $this->abrirModal();
        
    }

    public function abrirModal()
    {
        $this->modal = true;
    }

    public function cerrarModal()
    {
        $this->modal = false;
    }

    public function limpiarCampos()
    {
        $this->descripcion = '';
        $this->cantidad = '';
        $this->id_prodcuto = '';
    }

    public function editar($id)
    {
        //singular a producto solo es 1
        $producto = Producto::findOrFail($id);
        $this->id_prodcuto = $id;
        $this->descripcion = $producto->descripcion;
        $this->cantidad = $producto->cantidad;
        //abrimos modal
        $this->abrirModal();
        

    }

    public function guardar()
    {
        Producto::updateOrCreate(['id'=>$this->id_prodcuto],
            [
                'descripcion' => $this->descripcion,
                'cantidad' => $this->cantidad
            ]);
        //mensajes flash //condicional si realiza un alta o modificacion utilizando operadores ternarios
        session()->flash('message', $this->id_prodcuto ? 'Actualizacion exitosa' : 'Alta exitosa');
        //cerramos modal
        $this->cerrarModal();
        // & limpiamos campos
        $this->limpiarCampos();
    }

    public function borrar($id)
    {
        //singular a producto solo es 1
        Producto::find($id)->delete(); 
        //mensajes flash
        session()->flash('message', 'Registro eliminado correctamente');
    }


}
