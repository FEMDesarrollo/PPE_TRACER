<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\ProveedoresService;
use App\Http\Requests\Services\ProveedoresService as RulesRequest;

class ProveedoresController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\ProveedoresService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new ProveedoresService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\ProveedoresService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexProveedores = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexProveedores);
        }
        return view('Proveedores.inicio',compact('indexProveedores'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\ProveedoresService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeProveedores = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeProveedores, "Se guardó correctamente");
        }
        return view('Proveedores.inicio',compact('storeProveedores'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ProveedoresService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showProveedores = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showProveedores);
        }
        return view('Proveedores.inicio',compact('showProveedores'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ProveedoresService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateProveedores = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateProveedores, "Se actualizó correctamente");
        }
        return view('Proveedores.inicio', compact('updateProveedores'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\ProveedoresService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyProveedores = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyProveedores, "Se eliminó correctamente");
        }
        return view('Proveedores.inicio', compact('destroyProveedores'))->with("Se eliminó correctamente");
    }
}
