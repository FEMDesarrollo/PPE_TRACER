<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\RepuestosService;
use App\Http\Requests\Services\RepuestosService as RulesRequest;

class RepuestosController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\RepuestosService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new RepuestosService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\RepuestosService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexRepuestos = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexRepuestos);
        }
        return view('Repuestos.inicio',compact('indexRepuestos'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\RepuestosService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeRepuestos = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeRepuestos, "Se guardó correctamente");
        }
        return view('Repuestos.inicio',compact('storeRepuestos'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\RepuestosService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showRepuestos = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showRepuestos);
        }
        return view('Repuestos.inicio',compact('showRepuestos'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\RepuestosService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateRepuestos = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateRepuestos, "Se actualizó correctamente");
        }
        return view('Repuestos.inicio', compact('updateRepuestos'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\RepuestosService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyRepuestos = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyRepuestos, "Se eliminó correctamente");
        }
        return view('Repuestos.inicio', compact('destroyRepuestos'))->with("Se eliminó correctamente");
    }
}
