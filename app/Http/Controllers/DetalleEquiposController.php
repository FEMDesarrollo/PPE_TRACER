<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Helpers\ResponseHelper;
use App\Services\DetalleEquiposService;
use App\Http\Requests\Services\DetalleEquiposService as RulesRequest;

class DetalleEquiposController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\DetalleEquiposService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new DetalleEquiposService();
    }

     /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\DetalleEquiposService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexDetalleEquipos = $this->service->index($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($indexDetalleEquipos);
        }
        return view('DetallesEquipo.inicio',compact('indexDetalleEquipos'));
    }


 /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\DetalleEquiposService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        $storeDetalleEquipos = $this->service->store($request->validated(), false, false);
        if(request()->wantsJson()){
            return ResponseHelper::json($storeDetalleEquipos, "Se guardó correctamente");
        }
        return view('DetallesEquipo.inicio',compact('storeDetalleEquipos'))->with("Se guardo correctamente");
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\DetalleEquiposService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showDetalleEquipos = $this->service->show($request->validated(), false);
        if(request()->wantsJson()){
            return ResponseHelper::json($showDetalleEquipos);
        }
        return view('DetallesEquipo.inicio',compact('showDetalleEquipos'));
    }

     /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\DetalleEquiposService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateDetalleEquipos = $this->service->update($request->validated(), false, false);
         if(request()->wantsJson()){
             return ResponseHelper::json($updateDetalleEquipos, "Se actualizó correctamente");
        }
        return view('DetallesEquipo.inicio', compact('updateDetalleEquipos'))->with("Se actualizó correctamente");
    }

   /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\DetalleEquiposService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyDetalleEquipos = $this->service->destroy($request->validated(), false, false);
         if(request()->wantsJson()){
              return ResponseHelper::json($destroyDetalleEquipos, "Se eliminó correctamente");
        }
        return view('DetallesEquipo.inicio', compact('destroyDetalleEquipos'))->with("Se eliminó correctamente");
    }
}
