<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
// use App\Interfaces\[ExampleRepositoryInterface];
// use App\Models\[Model];

class ExampleEloquentRepository extends MainEloquentRepository // implements [ExampleRepositoryInterface]
{
    /*======================================================================
     * PROPERTIES
     *======================================================================*/

    // /**
    //  * @var [Model] $Model
    //  */
    // public $Model = [Model]::class;

    /*======================================================================
     * METHODS
     *======================================================================*/

    /**
     * acquire all [Model] records
     *
     * @param Int $paginatePerPage
     * @return Collection/LengthAwarePaginator
     */
    public function acquireAll($paginatePerPage = 10): Collection|LengthAwarePaginator
    {
        return parent::acquireAll();
    }

    /**
     * acquire a [Model] record
     *
     * @param Int $id
     * @return [Model]
     */
    public function acquire($id)
    {
        return parent::acquire($id);
    }

    /**
     * add a [Model] record
     *
     * @param Array $attributes
     * @return Bool/[Model]
     */
    public function add(array $attributes)
    {
        return parent::add($attributes);
    }

    /**
     * adjust a [Model] record
     *
     * @param Int $id
     * @param Array $attributes
     * @return Bool/[Model]
     */
    public function adjust(int $id, array $attributes)
    {
        return parent::adjust($id, $attributes);
    }

    /**
     * annul a [Model] record
     *
     * @param Int $id
     * @return Bool
     */
    public function annul(int $id)
    {
        return parent::annul($id);
    }
}
