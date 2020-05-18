<?php


namespace App\Repositories;


use App\Nota;

class NotasRepository
{
    public function obtenerNotas(){
        return Nota::all();
    }

    public function crear($input){
        $nuevaNota = new Nota();
        $nuevaNota->titulo = $input['titulo'];
        $nuevaNota->nota = $input['nota'];
        return $nuevaNota->save();
    }

    public  function crearActualizar($input){
        return Nota::updateOrCreate([
            'id' => $input['id']
        ],$input);
    }

    public function obtenerNota($id){
        return Nota::find($id);
    }

    public function actualizarNota($input,$id){
        $notaActualizar = Nota::find($id);
        $notaActualizar->titulo = $input['titulo'];
        $notaActualizar->nota = $input['nota'];
        return $notaActualizar->save();
    }

    public function eliminar($id){
        return Nota::destroy($id);
    }
}
