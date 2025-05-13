<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\DetallesEstatusService;
use App\Http\Requests\Services\DetallesEstatusService as RulesRequest;

class DetallesEstatusController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\DetallesEstatusService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new DetallesEstatusService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\DetallesEstatusService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexDetallesEstatus = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexDetallesEstatus);
        }
        return view('DetallesEstatus.inicio',compact('indexDetallesEstatus'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\DetallesEstatusService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeDetallesEstatus = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeDetallesEstatus, "Se guardó correctamente");
        }
        return view('DetallesEstatus.inicio',compact('storeDetallesEstatus'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\DetallesEstatusService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showDetallesEstatus = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showDetallesEstatus);
        }
        return view('DetallesEstatus.inicio',compact('showDetallesEstatus'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\DetallesEstatusService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateDetallesEstatus = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateDetallesEstatus, "Se actualizó correctamente");
        }
        return view('DetallesEstatus.inicio', compact('updateDetallesEstatus'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\DetallesEstatusService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyDetallesEstatus = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyDetallesEstatus, "Se eliminó correctamente");
        }
        return view('DetallesEstatus.inicio', compact('destroyDetallesEstatus'))->with("Se eliminó correctamente");
    }
}
