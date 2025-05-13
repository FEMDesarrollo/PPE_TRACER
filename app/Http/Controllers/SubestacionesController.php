<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\SubestacionesService;
use App\Http\Requests\Services\SubestacionesService as RulesRequest;

class SubestacionesController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\SubestacionesService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new SubestacionesService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\SubestacionesService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexSubestaciones = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexSubestaciones);
        }
        return view('Subestaciones.inicio',compact('indexSubestaciones'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\SubestacionesService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeSubestaciones = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeSubestaciones, "Se guardó correctamente");
        }
        return view('Subestaciones.inicio',compact('storeSubestaciones'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\SubestacionesService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showSubestaciones = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showSubestaciones);
        }
        return view('Subestaciones.inicio',compact('showSubestaciones'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\SubestacionesService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateSubestaciones = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateSubestaciones, "Se actualizó correctamente");
        }
        return view('Subestaciones.inicio', compact('updateSubestaciones'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\SubestacionesService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroySubestaciones = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroySubestaciones, "Se eliminó correctamente");
        }
        return view('Subestaciones.inicio', compact('destroySubestaciones'))->with("Se eliminó correctamente");
    }
}
