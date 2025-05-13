<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\ControlInspeccionesService;
use App\Http\Requests\Services\ControlInspeccionesService as RulesRequest;

class ControlInspeccionesController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\ControlInspeccionesService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new ControlInspeccionesService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\ControlInspeccionesService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexControlInspecciones = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexControlInspecciones);
        }
        return view('',compact('indexControlInspecciones'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\ControlInspeccionesService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeControlInspecciones = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeControlInspecciones, "Se guardó correctamente");
        }
        return view('',compact('storeControlInspecciones'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ControlInspeccionesService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showControlInspecciones = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showControlInspecciones);
        }
        return view('',compact('showControlInspecciones'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ControlInspeccionesService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateControlInspecciones = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateControlInspecciones, "Se actualizó correctamente");
        }
        return view('', compact('updateControlInspecciones'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ControlInspeccionesService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyControlInspecciones = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyControlInspecciones, "Se eliminó correctamente");
        }
        return view('', compact('destroyControlInspecciones'))->with("Se eliminó correctamente");
    }
}
