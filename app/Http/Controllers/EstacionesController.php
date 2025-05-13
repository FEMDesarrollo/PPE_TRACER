<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\EstacionesService;
use App\Http\Requests\Services\EstacionesService as RulesRequest;

class EstacionesController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\EstacionesService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new EstacionesService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\EstacionesService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexEstaciones = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexEstaciones);
        }
        return view('Estaciones.inicio',compact('indexEstaciones'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\EstacionesService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeEstaciones = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeEstaciones, "Se guardó correctamente");
        }
        return view('Estaciones.inicio',compact('storeEstaciones'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\EstacionesService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showEstaciones = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showEstaciones);
        }
        return view('Estaciones.inicio',compact('showEstaciones'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\EstacionesService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateEstaciones = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateEstaciones, "Se actualizó correctamente");
        }
        return view('Estaciones.inicio', compact('updateEstaciones'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\EstacionesService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyEstaciones = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyEstaciones, "Se eliminó correctamente");
        }
        return view('Estaciones.inicio', compact('destroyEstaciones'))->with("Se eliminó correctamente");
    }
}
