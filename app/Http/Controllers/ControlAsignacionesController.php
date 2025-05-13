<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\ControlAsignacionesService;
use App\Http\Requests\Services\ControlAsignacionesService as RulesRequest;

class ControlAsignacionesController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\ControlAsignacionesService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new ControlAsignacionesService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\ControlAsignacionesService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexControlAsignaciones = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexControlAsignaciones);
        }
        return view('ControlAsignaciones.inicio',compact('indexControlAsignaciones'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\ControlAsignacionesService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeControlAsignaciones = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeControlAsignaciones, "Se guardó correctamente");
        }
        return view('ControlAsignaciones.inicio',compact('storeControlAsignaciones'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ControlAsignacionesService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showControlAsignaciones = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showControlAsignaciones);
        }
        return view('ControlAsignaciones.inicio',compact('showControlAsignaciones'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ControlAsignacionesService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateControlAsignaciones = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateControlAsignaciones, "Se actualizó correctamente");
        }
        return view('ControlAsignaciones.inicio', compact('updateControlAsignaciones'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ControlAsignacionesService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyControlAsignaciones = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyControlAsignaciones, "Se eliminó correctamente");
        }
        return view('ControlAsignaciones.inicio', compact('destroyControlAsignaciones'))->with("Se eliminó correctamente");
    }
}
