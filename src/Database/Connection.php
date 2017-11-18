<?php
namespace AlgoWeb\ModelViews\Database;

use Illuminate\Database\Connection as BaseConnection;
use Illuminate\Database\Eloquent\Model;

class Connection extends BaseConnection
{
    protected static $classes;

    public static function RegisterTableToProvide(Model $ModelOfTable)
    {
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
        $records = parent::select($query, $bindings);
        return $records;
    }
}
