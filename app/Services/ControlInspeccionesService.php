<?php

namespace App\Services;

use App\Enums\HttpStatusEnum;
use App\Services\Service;
use App\Http\Requests\Services\ControlInspeccionesService as RulesRequest;
use App\Models\ControlInspeccion;

class ControlInspeccionesService extends Service
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
     * @param  array<\App\Http\Requests\Services\ControlInspeccionesService\Index>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function index(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Index::class, $data, $validateData);
        $request = new RulesRequest\Index($data);

        $Control = ControlInspeccion::all();

        return $Control;
    }

    /**
     * Guarda un nuevo recurso
     *
     * @param  array<\App\Http\Requests\Services\ControlInspeccionesService\Store>  $data
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


                $Control = ControlInspeccion::create([
                    'respuestas'                =>$request->respuestas,
                    'imagen'                    =>$request->imagen,
                    'descripcion'               =>$request->descripcion,
                    'fecha'                     =>$request->fecha,
                    'id_gestion_inspeccion'     =>$request->id_gestion_inspeccion,
                    'id_usuario'                =>$request->id_usuario,
                ]);



            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $Control;
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\ControlInspeccionesService\Show>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function show(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Show::class, $data, $validateData);
        $request = new RulesRequest\Show($data);

        $Control = ControlInspeccion::query()
        ->where('id','=',$request->id)
        ->first();

        return $Control;
    }

    /**
     * Actualiza un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\ControlInspeccionesService\Update>  $data
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

            $Control = ControlInspeccion::query()
            ->where('id','=',$request->id)
            ->first();

            if(!$Control){
                abort(HttpStatusEnum::NOT_FOUND, "El registro recibido no existe");
            }

            $Control->update([
                    'respuestas'                =>$request->respuestas,
                    'imagen'                    =>$request->imagen,
                    'descripcion'               =>$request->descripcion,
                    'fecha'                     =>$request->fecha,
            ]) ;


            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $Control;
    }

    /**
     * Elimina un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\ControlInspeccionesService\Destroy>  $data
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
            $Control = ControlInspeccion::query()
            ->where('id','=',$request->id)
            ->first();

            if(!$Control){
                abort(HttpStatusEnum::NOT_FOUND, "El registro recibido no existe");
            }

            $Control->delete();

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $Control;
    }
}
