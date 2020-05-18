<?php

namespace App\Http\Controllers;

use App\Repositories\NotasRepository;
use Illuminate\Http\Request;
use Validator;

class NotasController extends Controller
{
    protected $notas;
    public function __construct(NotasRepository $notasRepository)
    {
        $this->notas = $notasRepository;
    }

    public function index()
    {
        return response()->json($this->notas->obtenerNotas(),200);
    }

    public function store(Request $request)
    {
        $respuesta = new \stdClass;
        try {
            $validarDatos = Validator::make($request->all(),[
                'titulo' => 'required|max:50',
                'nota' => 'required|max:255'
            ]);
            if($validarDatos->fails()){
                $respuesta->titulo = 'warning';
                $respuesta->mesaje = $validarDatos->errors();
                return response()->json($respuesta,400);
            }
            $this->notas->crear($request->all());
            $respuesta->titulo = 'ok';
            $respuesta->mesaje = 'nota creada con exito';
            return response()->json($respuesta,200);
        }catch (\Exception $e){
            $respuesta->titulo = 'error';
            $respuesta->mesaje = $e->getMessage();
            return response()->json($respuesta,400);
        }
    }

    public function show($id)
    {
        return response()->json($this->notas->obtenerNota($id),200);
    }

    public function update(Request $request, $id)
    {
        $respuesta = new \stdClass;
        try {
            $this->notas->actualizarNota($request->all(),$id);
            $respuesta->titulo = 'ok';
            $respuesta->mesaje = 'nota actualizada con exito';
            return response()->json($respuesta,200);
        }catch (\Exception $e){
            $respuesta->titulo = 'error';
            $respuesta->mesaje = $e->getMessage();
            return response()->json($respuesta,400);
        }
    }

    public function destroy($id)
    {
        $respuesta = new \stdClass;
        try {
            $this->notas->eliminar($id);
            $respuesta->titulo = 'ok';
            $respuesta->mesaje = 'nota eliminada con exito';
            return response()->json($respuesta,200);
        }catch (\Exception $e){
            $respuesta->titulo = 'error';
            $respuesta->mesaje = $e->getMessage();
            return response()->json($respuesta,400);
        }
    }
}
