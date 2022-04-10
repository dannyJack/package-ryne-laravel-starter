<?php
namespace Ryne\LaravelStarter;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class DBHelper
{
    public static function keyDelete($tableName, $key, $type = 'foreign')
    {
        if (Schema::hasTable($tableName)) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName, $key, $type) {
                $keyExists = DB::select(
                    DB::raw(
                        "SHOW KEYS
                        FROM $tableName
                        WHERE Key_name='$key'"
                    )
                );
                if ($keyExists) {
                    if ($type == 'index') {
                        $table->dropIndex($key);
                    } else {
                        $table->dropForeign($key);
                    }
                }
            });
        }
    }
}