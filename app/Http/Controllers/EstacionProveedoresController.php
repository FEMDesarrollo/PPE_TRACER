<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\EstacionProveedoresService;
use App\Http\Requests\Services\EstacionProveedoresService as RulesRequest;

class EstacionProveedoresController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\EstacionProveedoresService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new EstacionProveedoresService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\EstacionProveedoresService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexEstacionProveedores = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexEstacionProveedores);
        }
        return view('',compact('indexEstacionProveedores'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\EstacionProveedoresService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeEstacionProveedores = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeEstacionProveedores, "Se guardó correctamente");
        }
        return view('',compact('storeEstacionProveedores'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\EstacionProveedoresService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showEstacionProveedores = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showEstacionProveedores);
        }
        return view('',compact('showEstacionProveedores'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\EstacionProveedoresService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateEstacionProveedores = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateEstacionProveedores, "Se actualizó correctamente");
        }
        return view('', compact('updateEstacionProveedores'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\EstacionProveedoresService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyEstacionProveedores = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyEstacionProveedores, "Se eliminó correctamente");
        }
        return view('', compact('destroyEstacionProveedores'))->with("Se eliminó correctamente");
    }
}
