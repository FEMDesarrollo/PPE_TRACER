<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\GestionInspeccionesService;
use App\Http\Requests\Services\GestionInspeccionesService as RulesRequest;

class GestionInspeccionesController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\GestionInspeccionesService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new GestionInspeccionesService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\GestionInspeccionesService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexGestionInspecciones = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexGestionInspecciones);
        }
        return view('GestionIns.inicio',compact('indexGestionInspecciones'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\GestionInspeccionesService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeGestionInspecciones = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeGestionInspecciones, "Se guardó correctamente");
        }
        return view('GestionIns.inicio',compact('storeGestionInspecciones'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\GestionInspeccionesService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showGestionInspecciones = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showGestionInspecciones);
        }
        return view('GestionIns.inicio',compact('showGestionInspecciones'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\GestionInspeccionesService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateGestionInspecciones = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateGestionInspecciones, "Se actualizó correctamente");
        }
        return view('GestionIns.inicio', compact('updateGestionInspecciones'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\GestionInspeccionesService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyGestionInspecciones = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyGestionInspecciones, "Se eliminó correctamente");
        }
        return view('GestionIns.inicio', compact('destroyGestionInspecciones'))->with("Se eliminó correctamente");
    }
}
