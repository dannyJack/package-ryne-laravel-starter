<?php

namespace App\Services;

// use App\Models\[Model];
// use App\Interfaces\[ModelRepositoryInterface];

class ExampleService extends MainService
{
    /*======================================================================
     * CONSTRUCTOR
     *======================================================================*/

    /**
     * @param ExampleRepositoryInterface $repository
     */
    public function __construct(ExampleRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /*======================================================================
     * PUBLIC METHODS
     *======================================================================*/

    /**
     * fetch all records
     *
     * @param Int $type
     * @return Array $rtn
     */
    public function all()
    {
        $rtn = [
            'data' => $this->repository->acquireAll()
        ];

        return $rtn;
    }

    /**
     * fetch a record
     *
     * @param Int|Null $id
     * @return Array $rtn
     */
    public function get(int $id = null): array
    {
        $rtn = [
            'data' => $this->repository->acquire($id)
        ];

        return $rtn;
    }

    /**
     * store a record
     *
     * @return Bool|Admin $rtn
     */
    public function store()
    {
        $data = [
            'name' => request()->get('name')
        ];


        return $this->repository->add($data);
    }

    /**
     * update a record
     *
     * @param Int $id
     * @return Bool|Admin $rtn
     */
    public function update(int $id)
    {
        $data = [
            'name' => request()->get('name')
        ];

        return $this->repository->adjust($id, $data);
    }

    /**
     * delete a record
     *
     * @param Int $id
     * @return Bool
     */
    public function destroy(int $id)
    {
        return $this->repository->annul($id);
    }
}
