<?php

namespace App\Services;

use App\Enums\HttpStatusEnum;
use App\Services\Service;
use App\Http\Requests\Services\ProveedorServiciosService as RulesRequest;
use App\Models\ProveedorServicio;

class ProveedorServiciosService extends Service
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
     * @param  array<\App\Http\Requests\Services\ProveedorServiciosService\Index>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function index(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Index::class, $data, $validateData);
        $request = new RulesRequest\Index($data);

        $proveedorServ = ProveedorServicio::all();

        return $proveedorServ;
    }

    /**
     * Guarda un nuevo recurso
     *
     * @param  array<\App\Http\Requests\Services\ProveedorServiciosService\Store>  $data
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
            $proveedorServ = ProveedorServicio::create([
                'id_servicio'       =>$request->id_servicio,
                'id_proveedor'      =>$request->id_proveedor
            ]);

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $proveedorServ;
    }

    /**
     * Muestra un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\ProveedorServiciosService\Show>  $data
     * @param  bool  $validateData
     * @return <type> $example
     */
    public function show(array $data, bool $validateData = true)
    {
        $this->validate(RulesRequest\Show::class, $data, $validateData);
        $request = new RulesRequest\Show($data);

        $proveedorServ = ProveedorServicio::query()
        ->where('id','=',$request->id)
        ->first();

        if(!$proveedorServ){
            abort(HttpStatusEnum::NOT_FOUND, "El proveedor recibido no existe");
        }

        return $proveedorServ;
    }

    /**
     * Actualiza un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\ProveedorServiciosService\Update>  $data
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
            $proveedorServ = ProveedorServicio::query()
        ->where('id','=',$request->id)
        ->first();

        if(!$proveedorServ){
            abort(HttpStatusEnum::NOT_FOUND, "El proveedor recibido no existe");
        }
            $proveedorServ->update([
                'id_servicio'       =>$request->id_servicio,
                'id_proveedor'      =>$request->id_proveedor
            ]);


            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $proveedorServ;
    }

    /**
     * Elimina un recurso en especifico
     *
     * @param  array<\App\Http\Requests\Services\ProveedorServiciosService\Destroy>  $data
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
            $proveedorServ = ProveedorServicio::query()
        ->where('id','=',$request->id)
        ->first();

        if(!$proveedorServ){
            abort(HttpStatusEnum::NOT_FOUND, "El proveedor recibido no existe");
        }
            $proveedorServ->delete();

            $this->dbCommit($transactionExists);
        } catch (\Throwable $th) {
            $this->dbRollback($th->getMessage(), $transactionExists);
            throw $th;
        }

        return $proveedorServ;
    }
}
