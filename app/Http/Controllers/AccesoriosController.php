<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Services\AccesoriosService as RulesRequest;
use App\Services\AccesoriosService;

class AccesoriosController extends Controller
{
    /**
     * My Service
     *
     * @var \App\Services\AccesoriosService
     */
    protected $service;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->service = new AccesoriosService();
    }

    /**
     * Retorna una lista de los recursos
     *
     * @param  \App\Http\Requests\Services\AccesoriosService\Index  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(RulesRequest\Index $request)
    {
        $indexAccesorios = $this->service->index($request->validated(), false);
        if (request()->wantsJson()) {
            return ResponseHelper::json($indexAccesorios);
        }
        return view('Dashboard.Accesorios.inicio', compact('indexAccesorios'));
    }

    /**
     * Guarda un nuevo recurso
     *
     * @param  \App\Http\Requests\Services\AccesoriosService\Store  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RulesRequest\Store $request)
    {
        try {
            $storeAccesorios = $this->service->store($request->validated(), false, false);

            if (request()->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Se guardó correctamente', 'data' => $storeAccesorios]);
            }
            return redirect()->route('accesorios.index')->with('success', 'Se guardó correctamente');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al guardar el accesorio', 'error' => $e->getMessage()]);
        }
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\AccesoriosService\Show  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(RulesRequest\Show $request)
    {
        $showAccesorios = $this->service->show($request->validated(), false);
        if (request()->wantsJson()) {
            return ResponseHelper::json($showAccesorios);
        }
        return view('Dashboard.Accesorios.inicio', compact('showAccesorios'));
    }

    /**
     * Actualiza un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\AccesoriosService\Update  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RulesRequest\Update $request)
    {
        $updateAccesorios = $this->service->update($request->validated(), false, false);
        if (request()->wantsJson()) {
            return ResponseHelper::json($updateAccesorios, 'Se actualizó correctamente');
        }
        return view('Dashboard.Accesorios.inicio', compact('updateAccesorios'))->with('Se actualizó correctamente');
    }

    /**
     * Elimina un recurso en especifico
     *
     * @param  \App\Http\Requests\Services\AccesoriosService\Destroy  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RulesRequest\Destroy $request)
    {
        $destroyAccesorios = $this->service->destroy($request->validated(), false, false);
        if (request()->wantsJson()) {
            return ResponseHelper::json($destroyAccesorios, 'Se eliminó correctamente');
        }
        return view('Dashboard.Accesorios.inicio', compact('destroyAccesorios'))->with('Se eliminó correctamente');
    }
}
