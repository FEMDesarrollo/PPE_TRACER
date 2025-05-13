<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\PerfilesService;
use App\Http\Requests\Services\PerfilesService as RulesRequest;

class PerfilesController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\PerfilesService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new PerfilesService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\PerfilesService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexPerfiles = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexPerfiles);
        }
        return view('Perfiles.inicio',compact('indexPerfiles'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\PerfilesService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storePerfiles = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storePerfiles, "Se guardó correctamente");
        }
        return view('Perfiles.inicio',compact('storePerfiles'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\PerfilesService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showPerfiles = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showPerfiles);
        }
        return view('Perfiles.inicio',compact('showPerfiles'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\PerfilesService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updatePerfiles = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updatePerfiles, "Se actualizó correctamente");
        }
        return view('Perfiles.inicio', compact('updatePerfiles'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\PerfilesService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyPerfiles = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyPerfiles, "Se eliminó correctamente");
        }
        return view('Perfiles.inicio', compact('destroyPerfiles'))->with("Se eliminó correctamente");
    }
}
