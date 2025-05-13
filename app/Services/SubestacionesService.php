<?php

namespace App\Services;

use App\Enums\HttpStatusEnum;
use App\Services\Service;
use App\Http\Requests\Services\SubestacionesService as RulesRequest;
use App\Models\Subestacion;

class SubestacionesService extends Service
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
     * @param  array<\App\Http\Requests\Services\SubestacionesService\Index>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function index(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Index::class, $data, $validateData);
        $request = new RulesRequest\Index($data);

        $subestacion = Subestacion::all();

        return $subestacion;
    }

    /**
     * Guarda un nuevo recurso
     *
     * @param  array<\App\Http\Requests\Services\SubestacionesService\Store>  $data
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
            $subestacion = Subestacion::create([
                'nombre'        =>$request->nombre,
                'direccion'     =>$request->direccion,
                'telefono'      =>$request->telefono,
                'id_estacion'   =>$request->id_estacion
              ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $subestacion;
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\SubestacionesService\Show>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function show(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Show::class, $data, $validateData);
        $request = new RulesRequest\Show($data);

        $subestacion = Subestacion::query()
        ->where('id','=', $request->id)
        ->first();

        return $subestacion;
    }

    /**
     * Actualiza un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\SubestacionesService\Update>  $data
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
            $subestacion = Subestacion::query()
                ->where('id','=', $request->id)
                ->first();

                if(!$subestacion){
                    abort(HttpStatusEnum::NOT_FOUND, "La subestación recibido no existe");
                }


                $subestacion->update([
                    'nombre'        =>$request->nombre,
                    'direccion'     =>$request->direccion,
                    'telefono'      =>$request->telefono,
                    'id_estacion'  =>$request->id_estacion
                ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $subestacion;
    }

    /**
     * Elimina un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\SubestacionesService\Destroy>  $data
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
            $subestacion = Subestacion::query()
                ->where('id','=', $request->id)
                ->first();

                if(!$subestacion){
                    abort(HttpStatusEnum::NOT_FOUND, "La subestación recibido no existe");
                }

                $subestacion->delete();

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $subestacion;
    }
}
