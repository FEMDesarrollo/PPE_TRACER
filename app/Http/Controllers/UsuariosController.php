<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\UsuariosService;
use App\Http\Requests\Services\UsuariosService as RulesRequest;

class UsuariosController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\UsuariosService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new UsuariosService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\UsuariosService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexUsuarios = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexUsuarios);
        }
        return view('Dashboard.Usuarios.inicio',compact('indexUsuarios'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\UsuariosService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeUsuarios = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeUsuarios, "Se guardó correctamente");
        }
        return view('Dashboard.Usuarios.inicio',compact('storeUsuarios'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\UsuariosService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showUsuarios = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showUsuarios);
        }
        return view('Dashboard.Usuarios.inicio',compact('showUsuarios'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\UsuariosService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateUsuarios = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateUsuarios, "Se actualizó correctamente");
        }
        return view('Dashboard.Usuarios.inicio', compact('updateUsuarios'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\UsuariosService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyUsuarios = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyUsuarios, "Se eliminó correctamente");
        }
        return view('Dashboard.Usuarios.inicio', compact('destroyUsuarios'))->with("Se eliminó correctamente");
    }
}
