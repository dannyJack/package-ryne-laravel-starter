<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Traits\ModelCollectionTrait;

class MainEloquentRepository
{
    use ModelCollectionTrait;

    /*======================================================================
     *======================================================================
     * SAMPLE CHILD CLASS
     *======================================================================

    public function acquireAll()
    {
        return parent::acquireAll();
    }

    public function acquire($id)
    {
        return parent::acquire($id);
    }

    public function add(array $attributes)
    {
        return parent::add($attributes);
    }

    public function adjust(int $id, array $attributes)
    {
        return parent::adjust($id, $attributes);
    }

    public function annul(array $id)
    {
        return parent::annul($id);
    }

    public function acquireByAttributes($attributes, $returnCollection)
    {
        return parent::acquireByAttributes($attributes, $returnCollection);
    }

    *======================================================================
    *======================================================================*/

    /*======================================================================
     * PROPERTIES
     *======================================================================*/

    /**
     * @var Model
     */
    public $Model;

    /*======================================================================
     * METHODS
     *======================================================================*/

    /**
     * acquire all model records
     * call NTC (No Try Catch) method
     *
     * @return Collection
     */
    public function acquireAll()
    {
        $rtn = $this->arrayToCollection([]);

        try {
            $rtn = $this->NTCacquireAll();
        } catch (\Exception $e) {
            \L0g::error('Exception: ' . $e->getMessage());
            \SlackLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \L0g::error($e->getMessage());
            \SlackLog::error($e->getMessage());
        }

        return $rtn;
    }

    /**
     * acquire all model records
     * NTC (No Try Catch) method
     *
     * @return Collection
     */
    public function NTCacquireAll()
    {
        $rtn = $this->arrayToCollection([]);

        if (!empty($this->Model)) {
            $rtn = $this->Model::all();
        }

        return $rtn;
    }

    /**
     * acquire a model record
     * call NTC (No Try Catch) method
     *
     * @param Int $id
     * @return Model
     */
    public function acquire($id)
    {
        $rtn = false;

        try {
            $rtn = $this->NTCacquire($id);
        } catch (\Exception $e) {
            \L0g::error('Exception: ' . $e->getMessage());
            \SlackLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \L0g::error($e->getMessage());
            \SlackLog::error($e->getMessage());
        }

        if (empty($rtn)) {
            $rtn = $this->Model::empty();
        }

        return $rtn;
    }

    /**
     * acquire a model record
     * NTC (No Try Catch) method
     *
     * @param Int $id
     * @return Model
     */
    public function NTCacquire($id)
    {
        $rtn = false;

        if (!empty($this->Model) && !empty($id)) {
            $rtn = $this->Model::find($id);
        }

        if (empty($rtn)) {
            $rtn = $this->Model::empty();
        }

        return $rtn;
    }

    /**
     * add a model record
     * call NTC (No Try Catch) method
     *
     * @param Array $attributes
     * @return Bool/Model
     */
    public function add(array $attributes)
    {
        $rtn = false;

        try {
            $rtn = $this->NTCadd($attributes);
        } catch (\Exception $e) {
            \L0g::error('Exception: ' . $e->getMessage());
            \SlackLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \L0g::error($e->getMessage());
            \SlackLog::error($e->getMessage());
        }

        return $rtn;
    }

    /**
     * add a model record
     * NTC (No Try Catch) method
     *
     * @param Array $attributes
     * @return Bool/Model
     */
    public function NTCadd(array $attributes)
    {
        $rtn = false;

        if (!empty($this->Model) && count($attributes) != 0) {
            $rtn = $this->Model::create($attributes);

            if ($rtn) {
                $rtn = $rtn->fresh();
            }
        }

        return $rtn;
    }

    /**
     * adjust a model record
     * call NTC (No Try Catch) method
     *
     * @param Int $id
     * @param Array $attributes
     * @return Bool/Model
     */
    public function adjust(int $id, array $attributes)
    {
        $rtn = false;
        try {
            $rtn = $this->NTCadjust($id, $attributes);
        } catch (\Exception $e) {
            \L0g::error('Exception: ' . $e->getMessage());
            \SlackLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \L0g::error($e->getMessage());
            \SlackLog::error($e->getMessage());
        }

        return $rtn;
    }

    /**
     * adjust a model record
     * NTC (No Try Catch) method
     *
     * @param Int $id
     * @param Array $attributes
     * @return Bool/Model
     */
    public function NTCadjust(int $id, array $attributes)
    {
        $rtn = false;

        if (!empty($this->Model) && count($attributes) != 0) {
            $model = $this->NTCacquire($id);

            if (!$model->isEmpty) {
                $rtn = $model->update($attributes);

                if ($rtn === 0) {
                    $rtn = true;
                }

                if ($rtn) {
                    $rtn = $model->fresh();
                }
            }
        }

        return $rtn;
    }

    /**
     * annul a model record
     * call NTC (No Try Catch) method
     *
     * @param Int $id
     * @return Bool
     */
    public function annul(int $id)
    {
        $rtn = false;

        try {
            $rtn = $this->NTCannul($id);
        } catch (\Exception $e) {
            \L0g::error('Exception: ' . $e->getMessage());
            \SlackLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \L0g::error($e->getMessage());
            \SlackLog::error($e->getMessage());
        }

        return $rtn;
    }

    /**
     * annul a model record
     * NTC (No Try Catch) method
     *
     * @param Int $id
     * @return Bool
     */
    public function NTCannul(int $id)
    {
        $rtn = false;

        if (!empty($this->Model)) {
            $rtn = $this->NTCadjust($id, [
                'delFlg' => $this->Model::STATUS_DELETED
            ]);
        }

        return $rtn;
    }

    /**
     * acquire a list of records base on attributes given
     * call NTC (No Try Catch) method
     *
     * @param Array $attributes
     * @param Bool $returnCollection - either return by BuildQuery or Collection
     * @return BuildQuery|Collection
     */
    public function acquireByAttributes(array $attributes, bool $returnCollection = true)
    {
        if ($returnCollection) {
            $rtn = $this->arrayToCollection([]);
        } else {
            $rtn = $this->Model::query();
        }

        try {
            $rtn = $this->NTCacquireByAttributes($attributes, $returnCollection);
        } catch (\Exception $e) {
            \L0g::error('Exception: ' . $e->getMessage());
            \SlackLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \L0g::error($e->getMessage());
            \SlackLog::error($e->getMessage());
        }

        return $rtn;
    }

    /**
     * acquire a list of records base on attributes given
     * NTC (No Try Catch) method
     *
     * @param Array $attributes
     * @param Bool $returnCollection - either return by BuildQuery or Collection
     * @return BuildQuery|Collection
     */
    public function NTCacquireByAttributes(array $attributes, bool $returnCollection = true)
    {
        if ($returnCollection) {
            $rtn = $this->arrayToCollection([]);
        } else {
            $rtn = $this->Model::query();
        }

        if (!empty($this->Model) && count($attributes) != 0) {
            $rtn = $this->Model::where(function ($query) use ($attributes) {
                foreach ($attributes as $key => $value) {
                    if (is_array($value)) {
                        if (is_numeric($key)) {
                            if ($key == 0) {
                                $query->where(function ($query) use ($value) {
                                    foreach ($value as $key2 => $value2) {
                                        $query->where($key2, $value2);
                                    }

                                    return $query;
                                });
                            } else {
                                $query->orWhere(function ($query) use ($value) {
                                    foreach ($value as $key2 => $value2) {
                                        $query->where($key2, $value2);
                                    }

                                    return $query;
                                });
                            }
                        } else {
                            $query->whereIn($key, $value);
                        }
                    } else {
                        $query->where($key, $value);
                    }
                }

                return $query;
            });

            if ($returnCollection) {
                $rtn = $rtn->get();
            }
        }

        return $rtn;
    }

    /**
     * add bulk records
     * call NTC (No Try Catch) method
     *
     * @param Array $attributesArray
     * @return Bool/Model
     */
    public function addBulk(array $attributesArray)
    {
        $rtn = false;

        try {
            $rtn = $this->NTCaddBulk($attributesArray);
        } catch (\Exception $e) {
            \L0g::error('Exception: ' . $e->getMessage());
            \SlackLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \L0g::error($e->getMessage());
            \SlackLog::error($e->getMessage());
        }
        return $rtn;
    }

    /**
     * add bulk records
     * NTC (No Try Catch) method
     *
     * @param Array $attributesArray
     * @return Bool/Model
     */
    public function NTCaddBulk(array $attributesArray)
    {
        $rtn = false;

        if (!empty($this->Model) && count($attributesArray) != 0) {
            $rtn = $this->Model::inserting($attributesArray);
        }

        return $rtn;
    }

    /**
     * adjust a list of records base on attributes given
     * call NTC (No Try Catch) method
     *
     * @param Array $whereAttributes
     * @param Array $adjustAttributes
     * @return Bool
     */
    public function adjustByAttributes(array $whereAttributes, array $adjustAttributes)
    {
        $rtn = false;

        try {
            $rtn = $this->NTCadjustByAttributes($whereAttributes, $adjustAttributes);
        } catch (\Exception $e) {
            \L0g::error('Exception: ' . $e->getMessage());
            \SlackLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \L0g::error($e->getMessage());
            \SlackLog::error($e->getMessage());
        }

        return $rtn;
    }

    /**
     * adjust a list of records base on attributes given
     * NTC (No Try Catch) method
     *
     * @param Array $whereAttributes
     * @param Array $adjustAttributes
     * @return Bool
     */
    public function NTCadjustByAttributes(array $whereAttributes, array $adjustAttributes)
    {
        $rtn = false;

        if (!empty($this->Model) && count($whereAttributes) != 0 && count($adjustAttributes) != 0) {
            $rtn = $this->Model::where(function ($query) use ($whereAttributes, $adjustAttributes) {
                foreach ($whereAttributes as $key => $value) {
                    if (is_array($value)) {
                        $query->whereIn($key, $value);
                    } else {
                        $query->where($key, $value);
                    }
                }

                return $query;
            })->update($adjustAttributes);

            if ($rtn === 0) {
                $rtn = true;
            }
        }

        return $rtn;
    }

    /**
     * annul a list of records base on attributes given
     * call NTC (No Try Catch) method
     *
     * @param Array $attributes
     * @return Bool
     */
    public function annulByAttributes(array $attributes)
    {
        $rtn = false;

        try {
            $rtn = $this->NTCannulByAttributes($attributes);
        } catch (\Exception $e) {
            \L0g::error('Exception: ' . $e->getMessage());
            \SlackLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \L0g::error($e->getMessage());
            \SlackLog::error($e->getMessage());
        }

        return $rtn;
    }

    /**
     * annul a list of records base on attributes given
     * NTC (No Try Catch) method
     *
     * @param Array $attributes
     * @return Bool
     */
    public function NTCannulByAttributes(array $attributes)
    {
        $rtn = false;

        if (!empty($this->Model) && count($attributes) != 0) {
            $rtn = $this->NTCadjustByAttributes($attributes, [
                'delFlg' => $this->Model::STATUS_DELETED
            ]);
        }

        return $rtn;
    }

    /**
     * acquire a model record
     * call NTC (No Try Catch) method
     *
     * @param Int $id
     * @param string $relation
     * @return Model
     */
    public function acquireWith($id, $relation)
    {
        $rtn = false;

        try {
            $rtn = $this->NTCacquireWith($id, $relation);
        } catch (\Exception $e) {
            \L0g::error('Exception: ' . $e->getMessage());
            \SlackLog::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \L0g::error($e->getMessage());
            \SlackLog::error($e->getMessage());
        }

        if (empty($rtn)) {
            $rtn = $this->Model::empty();
        }

        return $rtn;
    }

    /**
     * acquire a model record
     * NTC (No Try Catch) method
     *
     * @param Int $id
     * @param string $relation
     * @return Model
     */
    public function NTCacquireWith($id, $relation)
    {
        $rtn = false;

        if (!empty($this->Model) && !empty($id)) {
            $rtn = $this->Model::with($relation)->find($id);
        }

        if (empty($rtn)) {
            $rtn = $this->Model::empty();
        }

        return $rtn;
    }
}
