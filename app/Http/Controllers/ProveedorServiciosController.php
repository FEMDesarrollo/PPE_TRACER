<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\ProveedorServiciosService;
use App\Http\Requests\Services\ProveedorServiciosService as RulesRequest;

class ProveedorServiciosController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\ProveedorServiciosService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new ProveedorServiciosService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\ProveedorServiciosService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexProveedorServicios = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexProveedorServicios);
        }
        return view('ProveedoresServicios.inicio',compact('indexProveedorServicios'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\ProveedorServiciosService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeProveedorServicios = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeProveedorServicios, "Se guardó correctamente");
        }
        return view('ProveedoresServicios.inicio',compact('storeProveedorServicios'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ProveedorServiciosService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showProveedorServicios = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showProveedorServicios);
        }
        return view('ProveedoresServicios.inicio',compact('showProveedorServicios'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ProveedorServiciosService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateProveedorServicios = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateProveedorServicios, "Se actualizó correctamente");
        }
        return view('ProveedoresServicios.inicio', compact('updateProveedorServicios'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ProveedorServiciosService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyProveedorServicios = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyProveedorServicios, "Se eliminó correctamente");
        }
        return view('ProveedoresServicios.inicio', compact('destroyProveedorServicios'))->with("Se eliminó correctamente");
    }
}
