<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\PermisosService;
use App\Http\Requests\Services\PermisosService as RulesRequest;

class PermisosController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\PermisosService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new PermisosService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\PermisosService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexPermisos = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexPermisos);
        }
        return view('welcome', compact('indexPermisos'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\PermisosService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storePermisos = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storePermisos, "Se guardó correctamente");
        }
        return view('Permisos.inicio',compact('storePermisos'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\PermisosService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showPermisos = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showPermisos);
        }
        return view('Permisos.inicio',compact('showPermisos'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\PermisosService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updatePermisos = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updatePermisos, "Se actualizó correctamente");
        }
        return view('Permisos.inicio', compact('updatePermisos'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\PermisosService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyPermisos = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyPermisos, "Se eliminó correctamente");
        }
        return view('Permisos.inicio', compact('destroyPermisos'))->with("Se eliminó correctamente");
    }

    /**
     * Muestra un recurso en especifico dependiendo del id del usuario
     *
     * @param  \App\Http\Requests\Services\PermisosService\ShowUsusario  $request
     * param  int  $idUsuario
     * @return \Illuminate\Http\JsonResponse
     */
    public function ShowUsusario(RulesRequest\ShowUsusario $request)
    {
        $showPerfil = $this->service->ShowUsusario($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showPerfil);
      }
      return view('Permisos.inicio', compact('showPerfil'));
    }
}
