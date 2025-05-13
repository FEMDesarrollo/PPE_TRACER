<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\ServiciosService;
use App\Http\Requests\Services\ServiciosService as RulesRequest;

class ServiciosController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\ServiciosService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new ServiciosService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\ServiciosService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexServicios = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexServicios);
        }
        return view('Servicios.inicio',compact('indexServicios'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\ServiciosService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeServicios = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeServicios, "Se guardó correctamente");
        }
        return view('Servicios.inicio',compact('storeServicios'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ServiciosService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showServicios = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showServicios);
        }
        return view('Servicios.inicio',compact('showServicios'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ServiciosService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateServicios = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateServicios, "Se actualizó correctamente");
        }
        return view('Servicios.inicio', compact('updateServicios'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ServiciosService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyServicios = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyServicios, "Se eliminó correctamente");
        }
        return view('Servicios.inicio', compact('destroyServicios'))->with("Se eliminó correctamente");
    }
}
