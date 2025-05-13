<?php

namespace App\Services;

use App\Enums\HttpStatusEnum;
use App\Services\Service;
use App\Http\Requests\Services\UsuarioEquiposService as RulesRequest;
use App\Models\UsuarioEquipo;

class UsuarioEquiposService extends Service
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
     * @param  array<\App\Http\Requests\Services\UsuarioEquiposService\Index>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function index(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Index::class, $data, $validateData);
        $request = new RulesRequest\Index($data);

        $usuarioEquipo = UsuarioEquipo::all();

        return $usuarioEquipo;
    }

    /**
     * Guarda un nuevo recurso
     *
     * @param  array<\App\Http\Requests\Services\UsuarioEquiposService\Store>  $data
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
            $usuarioEquipo = UsuarioEquipo::create([
                'fecha_estatus'             => $request->fecha_estatus,
                'comentarios'               => $request->comentarios,
                'id_estatus_equipo'         => $request->id_estatus_equipo,
                'id_usuario'                => $request->id_usuario,
                'id_equipo'                 => $request->id_equipo,
            ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $usuarioEquipo;
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\UsuarioEquiposService\Show>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function show(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Show::class, $data, $validateData);
        $request = new RulesRequest\Show($data);

        $usuarioEquipo = UsuarioEquipo::query()
        ->where('id','=',$request->id)
        ->first();

        return $usuarioEquipo;
    }

    /**
     * Actualiza un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\UsuarioEquiposService\Update>  $data
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
            $usuarioEquipo = UsuarioEquipo::query()
            ->where('id','=',$request->id)
            ->first();

            if(!$usuarioEquipo){
                abort(HttpStatusEnum::NOT_FOUND, "El registro recibido no existe");
            }
            $usuarioEquipo->update([
                'fecha_estatus'             => $request->fecha_estatus,
                'comentarios'               => $request->comentarios,
                'id_estatus_equipo'         => $request->id_estatus_equipo,
                'id_usuario'                => $request->id_usuario,
                'id_equipo'                 => $request->id_equipo
            ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $usuarioEquipo;
    }

    /**
     * Elimina un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\UsuarioEquiposService\Destroy>  $data
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
            $usuarioEquipo = UsuarioEquipo::query()
            ->where('id','=',$request->id)
            ->first();

            if(!$usuarioEquipo){
                abort(HttpStatusEnum::NOT_FOUND, "El registro recibido no existe");
            }
            $usuarioEquipo->delete();

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $usuarioEquipo;
    }
}
