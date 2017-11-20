<?php
namespace AlgoWeb\ModelViews\Database;

use Illuminate\Database\Connection as BaseConnection;
use Illuminate\Database\Eloquent\Model;

class Connection extends BaseConnection
{
    protected static $classes = [];

    protected static $information_schema = [];

    public static function RegisterTableToProvide($ModelOfTable)
    {
        self::$classes[] = $ModelOfTable;
        $currentISchemaTables = 0;
        if (array_key_exists('tables', self::$information_schema)) {
            $currentISchemaTables = count(self::$information_schema['tables']);
        } else {
            self::$information_schema['tables'] = [];
        }
        self::$information_schema['tables'][$currentISchemaTables]['Model'] = $ModelOfTable;
        self::$information_schema['tables'][$currentISchemaTables]['TABLE_NAME'] = $ModelOfTable::getTableName();
        self::$information_schema['tables'][$currentISchemaTables]['TABLE_SCHEMA'] = \Config::get('database.connections.'.\Config::get('database.default').'.database');
    }

    protected $normalizer;
    /**
     * Run a select statement and return a single result.
     *
     * @param  string $query
     * @param  array  $bindings
     * @return mixed
     */
    public function selectOne($query, $bindings = array())
    {
        $records = parent::select($query, $bindings);
        return $records;
    }
    /**
     * Run a select statement against the database.
     *
     * @param  string                                  $query
     * @param  array                                   $bindings
     * @return \Stidges\LaravelDbNormalizer\Collection
     */
    public function select($query, $bindings = array())
    {

//dd(self::$information_schema);
        dd(self::getSQL($query, $bindings));
        $records = parent::select($query, $bindings);
        dd($records);
        return $records;
    }

    private function ProcessSQL($query, $results)
    {
    }

    private static function getSQL($sql, $bindings)
    {
        $needle = '?';
        foreach ($bindings as $replace) {
            $pos = strpos($sql, $needle);
            if ($pos !== false) {
                if (gettype($replace) === 'string') {
                    $replace = ' "'.addslashes($replace).'" ';
                }
                $sql = substr_replace($sql, $replace, $pos, strlen($needle));
            }
        }
        return $sql;
    }
}
