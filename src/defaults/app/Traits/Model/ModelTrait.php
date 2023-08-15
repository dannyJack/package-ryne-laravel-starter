<?php

namespace App\Traits\Models;

use Carbon\Carbon;

trait ModelTrait
{
    /*======================================================================
     * CUSTOM METHODS
     *======================================================================*/

    /**
     * get valid attribute if exist, if not then return default value
     *
     * @return [ModelProperty] $rtn
     */
    public function getAttr(string $attribute, $default = '')
    {
        $rtn = $default;

        if ($this->isNotEmpty) {
            if (isset($this[$attribute])) {
                $rtn = $this->{$attribute};
            }
        }

        return $rtn;
    }

    /**
     * get valid relationship attribute if exist, if not then return default value
     *
     * @return [ModelProperty] $rtn
     */
    public function getRelAttr(string $relationshipMethodString, string $attribute, $default = '')
    {
        $rtn = $default;

        if (!empty($this->{$relationshipMethodString})) {
            if (isset($this->{$relationshipMethodString}[$attribute])) {
                $rtn = $this->{$relationshipMethodString}->{$attribute};
            }
        }

        return $rtn;
    }

    /**
     * carbon format a property date
     *
     * @param String $property
     * @param String $format
     * @return String $rtn
     */
    public function formatDate(string $property, string $format = 'Y年m月d日'): string
    {
        $rtn = '';

        try {
            $dt = Carbon::parse($this->{$property});

            if ($property == 'bikou1') {
                $isValidDate = \DateTime::createFromFormat('Y-m-d H:i:s', $this->{$property}) !== false;

                if (!$isValidDate) {
                    $dt = '';
                }
            }

            if (!empty($dt) && checkdate($dt->month, $dt->day, $dt->year)) {
                $rtn = $dt->format($format);
            }
        } catch (\Exception $e) {
            \L0g::error('Exception: ' . $e->getMessage());
        } catch (\Error $e) {
            \L0g::error($e->getMessage());
        }

        return $rtn;
    }

    /*======================================================================
     * CUSTOM STATIC METHODS
     *======================================================================*/

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($data) {
            // // updateUser
            // if (empty($data->updateUser)) {
            //     $name = '';

            //     if (auth()->check()) {
            //         $name = auth()->user()->name;
            //     } else {
            //         $name = 'SYSTEM';
            //     }

            //     $data->updateUser = _trim($name, 8, '...');
            // }

            return $data;
        });

        static::updating(function ($data) {
            // $name = '';

            // if (auth()->check()) {
            //     $name = auth()->user()->name;
            // } else {
            //     $name = 'SYSTEM';
            // }

            // $data->updateUser = _trim($name, 8, '...');

            return $data;
        });
    }

    /**
     * inserting bulk records
     *
     * @param Array $attributesArray
     * @return Bool $rtn
     */
    public static function inserting(array $attributesArray)
    {
        $rtn = false;
        $insertAttributesArray = [];

        // $name = '';

        // if (auth()->check()) {
        //     $name = auth()->user()->name;
        // } else {
        //     $name = 'SYSTEM';
        // }

        // $updateUser = _trim($name, 8, '...');

        foreach ($attributesArray as $arr) {
            // if (empty($arr['updateUser'])) {
            //     $arr['updateUser'] = $updateUser;
            // }

            $insertAttributesArray[] = $arr;
        }

        if (!empty($insertAttributesArray)) {
            $rtn = self::insert($insertAttributesArray);
        }

        return $rtn;
    }

    /**
     * empty table column values
     */
    public static function empty()
    {
        return new static();
    }

    /*======================================================================
     * ACCESSORS
     *======================================================================*/

    /**
     * id
     *
     * @return Int
     */
    public function getIdAttribute($value): int
    {
        $rtn = 0;

        if ($this->primaryKey == 'id') {
            if (!is_null($value)) {
                $rtn = $value;
            }
        } else {
            if (isset($this[$this->primaryKey])) {
                $rtn = $this[$this->primaryKey];
            }
        }

        return $rtn;
    }

    /**
     * isEmpty
     *
     * @return Bool
     */
    public function getIsEmptyAttribute()
    {
        return empty($this->id);
    }

    /**
     * isNotEmpty
     *
     * @return Bool
     */
    public function getIsNotEmptyAttribute()
    {
        return !$this->isEmpty;
    }

    /*======================================================================
     * SCOPES
     *======================================================================*/

    /**
     * whereDeleted
     */
    public function scopeWhereDeleted($query)
    {
        $query->whereNotNull('deleted_at');
        return $query;
    }

    /**
     * whereNotDeleted
     */
    public function scopeWhereNotDeleted($query)
    {
        $query->whereNull('deleted_at');
        return $query;
    }

    /**
     * sortAsc
     */
    public function scopeSortAsc($query)
    {
        $query->orderBy('createdAt', 'asc');
        return $query;
    }

    /**
     * sortDesc
     */
    public function scopeSortDesc($query)
    {
        $query->orderBy('createdAt', 'desc');
        return $query;
    }
}
