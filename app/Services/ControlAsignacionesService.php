<?php

namespace App\Services;

use App\Enums\HttpStatusEnum;
use App\Services\Service;
use App\Http\Requests\Services\ControlAsignacionesService as RulesRequest;
use App\Models\ControlAsignacion;

class ControlAsignacionesService extends Service
{
    /**
     * Construct
     *
     * @return void
     */
    public function _construct()
    {
        //
    }

    /**
     * Retorna una lista de los recursos
     *
     * @param  array<\App\Http\Requests\Services\ControlAsignacionesService\Index>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function index(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Index::class, $data, $validateData);
        $request = new RulesRequest\Index($data);

        $controlAsignacion = ControlAsignacion::all();

        return $controlAsignacion;
    }

    /**
     * Guarda un nuevo recurso
     *
     * @param  array<\App\Http\Requests\Services\ControlAsignacionesService\Store>  $data
     * @param  bool  $transactionExists
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function store(array $data, bool $transactionExists = false, bool $validateData = true)
    {
        $this->validate(RulesRequest\Store::class, $data, $validateData);
        $request = new RulesRequest\Store($data);

        $this->dbBeginTransaction($transactionExists);
        try {
            $controlAsignacion = ControlAsignacion::create([
                'observaciones'             =>$request->observaciones,
                'fecha_asignacion'          =>$request->fecha_asignacion,
                'fecha_devolucion'          =>$request->fecha_deolucionv,
                'id_usuario_equipo'         =>$request->id_usuario_equipo,
                'id_estatus_critico'        =>$request->id_estatus_critico,
            ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $controlAsignacion;
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\ControlAsignacionesService\Show>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function show(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Show::class, $data, $validateData);
        $request = new RulesRequest\Show($data);

        $controlAsignacion = ControlAsignacion::query()
        ->where('id','=',$request->id)
        ->first();



        return $controlAsignacion;
    }

    /**
     * Actualiza un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\ControlAsignacionesService\Update>  $data
     * @param  bool  $transactionExists
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function update(array $data, bool $transactionExists = false, bool $validateData = true)
    {
        $this->validate(RulesRequest\Update::class, $data, $validateData);
        $request = new RulesRequest\Update($data);

        $this->dbBeginTransaction($transactionExists);
        try {
            $controlAsignacion = ControlAsignacion::query()
            ->where('id','=',$request->id)
            ->first();

            if(!$controlAsignacion){
                abort(HttpStatusEnum::NOT_FOUND, "El registro recibido no existe");
            }

            $controlAsignacion->update([
               'observaciones'             =>$request->observaciones,
                'fecha_asignacion'          =>$request->fecha_asignacion,
                'fecha_devolucion'          =>$request->fecha_deolucionv,
                'id_usuario_equipo'         =>$request->id_usuario_equipo,
                'id_estatus_critico'        =>$request->id_estatus_critico,
            ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $controlAsignacion;
    }

    /**
     * Elimina un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\ControlAsignacionesService\Destroy>  $data
     * @param  bool  $transactionExists
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function destroy(array $data, bool $transactionExists = false, bool $validateData = true)
    {
        $this->validate(RulesRequest\Destroy::class, $data, $validateData);
        $request = new RulesRequest\Destroy($data);

        $this->dbBeginTransaction($transactionExists);
        try {

            $controlAsignacion = ControlAsignacion::query()
            ->where('id','=',$request->id)
            ->first();

            if(!$controlAsignacion){
                abort(HttpStatusEnum::NOT_FOUND, "El registro recibido no existe");
            }
            $controlAsignacion->delete();

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $controlAsignacion;
    }
}
