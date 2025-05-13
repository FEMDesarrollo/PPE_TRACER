<?php

namespace App\Services;

use App\Enums\HttpStatusEnum;
use App\Services\Service;
use App\Http\Requests\Services\DetalleEquiposService as RulesRequest;
use App\Models\DetalleEquipo;

class DetalleEquiposService extends Service
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
     * @param  array<\App\Http\Requests\Services\DetalleEquiposService\Index>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function index(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Index::class, $data, $validateData);
        $request = new RulesRequest\Index($data);

        $detallesEquipos = DetalleEquipo::all();

        return $detallesEquipos;
    }

    /**
     * Guarda un nuevo recurso
     *
     * @param  array<\App\Http\Requests\Services\DetalleEquiposService\Store>  $data
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
            $detallesEquipos = DetalleEquipo::create([
                'modelo'                    =>$request->modelo,
                'no_serie'                  =>$request->no_serie,
                'talla'                     =>$request->talla,
                'piezas'                    =>$request->piezas,
                'fecha_fabricacion'         =>$request->fecha_fabricacion,
                'id_usuario_equipo'         =>$request->id_usuario_equipo
            ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $detallesEquipos;
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\DetalleEquiposService\Show>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function show(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Show::class, $data, $validateData);
        $request = new RulesRequest\Show($data);

        $detallesEquipos = DetalleEquipo::query()
        ->where('id','=',$request->id)
        ->first();

        return $detallesEquipos;
    }

    /**
     * Actualiza un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\DetalleEquiposService\Update>  $data
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
            $detallesEquipos = DetalleEquipo::query()
            ->where('id','=',$request->id)
            ->first();
            if(!$detallesEquipos){
                abort(HttpStatusEnum::NOT_FOUND, "El registro recibido no existe");
            }


            $detallesEquipos->update([
                'modelo'                    =>$request->modelo,
                'no_serie'                  =>$request->no_serie,
                'talla'                     =>$request->talla,
                'piezas'                    =>$request->piezas,
                'fecha_fabricacion'         =>$request->fecha_fabricacion,
                'id_usuario_equipo'         =>$request->id_usuario_equipo
            ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $detallesEquipos;
    }

    /**
     * Elimina un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\DetalleEquiposService\Destroy>  $data
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
            $detallesEquipos = DetalleEquipo::query()
            ->where('id','=',$request->id)
            ->first();
            if(!$detallesEquipos){
                abort(HttpStatusEnum::NOT_FOUND, "El registro recibido no existe");
            }


            $detallesEquipos->delete();

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $detallesEquipos;
    }
}
