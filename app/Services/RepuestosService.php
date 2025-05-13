<?php

namespace App\Services;

use App\Enums\HttpStatusEnum;
use App\Services\Service;
use App\Http\Requests\Services\RepuestosService as RulesRequest;
use App\Models\Repuesto;

class RepuestosService extends Service
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
     * @param  array<\App\Http\Requests\Services\RepuestosService\Index>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function index(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Index::class, $data, $validateData);
        $request = new RulesRequest\Index($data);

        $repuestos =Repuesto::all();

        return $repuestos;
    }

    /**
     * Guarda un nuevo recurso
     *
     * @param  array<\App\Http\Requests\Services\RepuestosService\Store>  $data
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
            $repuestos = Repuesto::create([
                'costo'                         =>$request->costo,
                'fecha_disponibilidad'          =>$request->fecha_disponibilidad,
                'id_prov_servicio'              =>$request->id_prov_servicio,
                'id_accesorio'                  =>$request->id_accesorio
            ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $repuestos;
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\RepuestosService\Show>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function show(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Show::class, $data, $validateData);
        $request = new RulesRequest\Show($data);

        $repuestos = Repuesto::query()
        ->where('id','=',$request->id)
        ->first();

        if (!$repuestos) {
            abort(HttpStatusEnum::NOT_FOUND, 'El repuesto recibido no existe');
        }

        return $repuestos;
    }

    /**
     * Actualiza un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\RepuestosService\Update>  $data
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
            $repuestos = Repuesto::query()
        ->where('id','=',$request->id)
        ->first();

        if (!$repuestos) {
            abort(HttpStatusEnum::NOT_FOUND, 'El repuesto recibido no existe');
        }
            $repuestos->update([
                'costo'                         =>$request->costo,
                'fecha_disponibilidad'          =>$request->fecha_disponibilidad,
                'id_prov_servicio'              =>$request->id_prov_servicio,
                'id_accesorio'                  =>$request->id_accesorio
            ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $repuestos;
    }

    /**
     * Elimina un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\RepuestosService\Destroy>  $data
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
            $repuestos = Repuesto::query()
        ->where('id','=',$request->id)
        ->first();

        if (!$repuestos) {
            abort(HttpStatusEnum::NOT_FOUND, 'El repuesto recibido no existe');
        }
            $repuestos->delete();

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $repuestos;
    }
}
