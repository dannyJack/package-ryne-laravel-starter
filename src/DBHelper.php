<?php
namespace RyneLaraverStarter\DBHelper;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class DBHelper
{
    public static function keyDelete($table_name, $key, $type = 'foreign')
    {
        if (Schema::hasTable($table_name)) {
            Schema::table($table_name, function (Blueprint $table) use ($table_name, $key, $type) {
                $keyExists = DB::select(
                    DB::raw(
                        "SHOW KEYS
                        FROM $table_name
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