<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\UsuarioEquiposService;
use App\Http\Requests\Services\UsuarioEquiposService as RulesRequest;

class UsuarioEquiposController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\UsuarioEquiposService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new UsuarioEquiposService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\UsuarioEquiposService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexUsuarioEquipos = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexUsuarioEquipos);
        }
        return view('UsuariosEquipos.inicio',compact('indexUsuarioEquipos'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\UsuarioEquiposService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeUsuarioEquipos = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeUsuarioEquipos, "Se guardó correctamente");
        }
        return view('UsuariosEquipos.inicio',compact('storeUsuarioEquipos'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\UsuarioEquiposService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showUsuarioEquipos = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showUsuarioEquipos);
        }
        return view('UsuariosEquipos.inicio',compact('showUsuarioEquipos'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\UsuarioEquiposService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateUsuarioEquipos = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateUsuarioEquipos, "Se actualizó correctamente");
        }
        return view('UsuariosEquipos.inicio', compact('updateUsuarioEquipos'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\UsuarioEquiposService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyUsuarioEquipos = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyUsuarioEquipos, "Se eliminó correctamente");
        }
        return view('UsuariosEquipos.inicio', compact('destroyUsuarioEquipos'))->with("Se eliminó correctamente");
    }
}
