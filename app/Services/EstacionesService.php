<?php

namespace App\Services;

use App\Enums\HttpStatusEnum;
use App\Services\Service;
use App\Http\Requests\Services\EstacionesService as RulesRequest;
use App\Models\Estacion;

class EstacionesService extends Service
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
     * @param  array<\App\Http\Requests\Services\EstacionesService\Index>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function index(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Index::class, $data, $validateData);
        $request = new RulesRequest\Index($data);

        $estaciones = Estacion::all();

        return $estaciones;
    }

    /**
     * Guarda un nuevo recurso
     *
     * @param  array<\App\Http\Requests\Services\EstacionesService\Store>  $data
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
            $estaciones = Estacion::create([
                'nombre'        =>$request->nombre,
                'direccion'     =>$request->direccion,
                'telefono'      =>$request->telefono,
                'total_trajes'  =>$request->total_trajes
            ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $estaciones;
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\EstacionesService\Show>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function show(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Show::class, $data, $validateData);
        $request = new RulesRequest\Show($data);

        $estaciones = Estacion::query()
        ->where('id','=',$request->id)
        ->first();

        return $estaciones;
    }

    /**
     * Actualiza un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\EstacionesService\Update>  $data
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
            $estaciones = Estacion::query()
                ->where('id','=',$request->id)
                ->first();

                if(!$estaciones){
                    abort(HttpStatusEnum::NOT_FOUND, "La estación recibido no existe");
                }

                $estaciones->update([
                    'nombre'        =>$request->nombre,
                    'direccion'     =>$request->direccion,
                    'telefono'      =>$request->telefono,
                    'total_trajes'  =>$request->total_trajes
                ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $estaciones;
    }

    /**
     * Elimina un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\EstacionesService\Destroy>  $data
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
            $estaciones = Estacion::query()
                ->where('id','=',$request->id)
                ->first();

                if(!$estaciones){
                    abort(HttpStatusEnum::NOT_FOUND, "La estación recibido no existe");
                }

                $estaciones->delete();

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $estaciones;
    }
}
