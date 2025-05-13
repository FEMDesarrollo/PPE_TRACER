<?php

namespace App\Services;

use App\Enums\HttpStatusEnum;
use App\Http\Requests\Services\SubestacionEquiposService as RulesRequest;
use App\Models\Subestacion;
use App\Models\SubestacionEquipo;
use App\Services\Service;

class SubestacionEquiposService extends Service
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
     * @param  array<\App\Http\Requests\Services\SubestacionEquiposService\Index>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function index(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Index::class, $data, $validateData);
        $request = new RulesRequest\Index($data);

        $SubestacionEquipo = SubestacionEquipo::all();

        return $SubestacionEquipo;
    }

    /**
     * Guarda un nuevo recurso
     *
     * @param  array<\App\Http\Requests\Services\SubestacionEquiposService\Store>  $data
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
            $SubestacionEquipo = SubestacionEquipo::create([
                'no_traje' => $request->no_traje,
                'id_equipo' => $request->id_equipo,
                'id_estacion' => $request->id_estacion,
                'id_subestacion' => $request->id_subestacion,
            ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $SubestacionEquipo;
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\SubestacionEquiposService\Show>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function show(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Show::class, $data, $validateData);
        $request = new RulesRequest\Show($data);

        $SubestacionEquipo = SubestacionEquipo::query()
            ->where('id', '=', $request->id)
            ->first();

        return $SubestacionEquipo;
    }

    /**
     * Actualiza un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\SubestacionEquiposService\Update>  $data
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
            $SubestacionEquipo = SubestacionEquipo::query()
                ->where('id', '=', $request->id)
                ->first();

            if (!$SubestacionEquipo) {
                abort(HttpStatusEnum::NOT_FOUND, 'El perfil recibido no existe');
            }

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $SubestacionEquipo;
    }

    /**
     * Elimina un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\SubestacionEquiposService\Destroy>  $data
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
            $SubestacionEquipo = SubestacionEquipo::query()
                ->where('id', '=', $request->id)
                ->first();

            if (!$SubestacionEquipo) {
                abort(HttpStatusEnum::NOT_FOUND, 'El perfil recibido no existe');
            }

            $SubestacionEquipo->delete();

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $SubestacionEquipo;
    }
}
