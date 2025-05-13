<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\SubestacionEquiposService;
use App\Http\Requests\Services\SubestacionEquiposService as RulesRequest;

class SubestacionEquiposController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\SubestacionEquiposService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new SubestacionEquiposService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\SubestacionEquiposService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexSubestacionEquipos = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexSubestacionEquipos);
        }
        return view('SubestacionEquipos.inicio',compact('indexSubestacionEquipos'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\SubestacionEquiposService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeSubestacionEquipos = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeSubestacionEquipos, "Se guardó correctamente");
        }
        return view('SubestacionEquipos.inicio',compact('storeSubestacionEquipos'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\SubestacionEquiposService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showSubestacionEquipos = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showSubestacionEquipos);
        }
        return view('SubestacionEquipos.inicio',compact('showSubestacionEquipos'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\SubestacionEquiposService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateSubestacionEquipos = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateSubestacionEquipos, "Se actualizó correctamente");
        }
        return view('SubestacionEquipos.inicio', compact('updateSubestacionEquipos'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\SubestacionEquiposService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroySubestacionEquipos = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroySubestacionEquipos, "Se eliminó correctamente");
        }
        return view('SubestacionEquipos.inicio', compact('destroySubestacionEquipos'))->with("Se eliminó correctamente");
    }
}
