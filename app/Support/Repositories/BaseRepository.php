<?php
namespace App\Support\Repositories;

use Illuminate\Database\Eloquent\Builder as EloquentQueryBuilder;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Pagination\AbstractPaginator as Paginator;
use Illuminate\Database\DatabaseManager;

abstract class BaseRepository
{
    protected $db;
    protected $model;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    /**
    * @return EloquentModel
    */
    public function newModel()
    {
        return app($this->model);
    }

    /**
    * @return EloquentQueryBuilder|QueryBuilder
    */
    protected function newQuery()
    {
        return app($this->model)->newQuery();
    }

    public function create(array $data)
    {
        return app($this->model)->create($data);
    }

    /**
    * @param EloquentQueryBuilder|QueryBuilder $query
    * @param int                               $take
    * @param bool                              $paginate
    *
    * @return EloquentCollection|Paginator
    */
    protected function doQuery($query = null, $take = 15, $paginate = true)
    {
        if (is_null($query)) {
            $query = $this->newQuery();
        }
        
        if (true == $paginate) {
            return $query->orderBy('id', 'DESC')->paginate($take);
        }

        if ($take > 0 || false !== $take) {
            $query->take($take);
        }

        return $query->get();
    }

    /**
    * Returns all records.
    * If $take is false then brings all records
    * If $paginate is true returns Paginator instance.
    *
    * @param int  $take
    * @param bool $paginate
    *
    * @return EloquentCollection|Paginator
    */
    public function getAll($take = 15, $paginate = true)
    {
        return $this->doQuery(null, $take, $paginate);
    }

    /**
    * @param string      $column
    * @param string|null $key
    *
    * @return \Illuminate\Support\Collection
    */
    public function lists($column = 'name', $key = 'id')
    {
        return $this->newQuery()->pluck($column, $key);
    }

    /**
    * Retrieves a record by his id
    * If fail is true $ fires ModelNotFoundException.
    *
    * @param int  $id
    * @param bool $fail
    *
    * @return Model
    */
    public function findById($id, $fail = true)
    {
        if ($fail) {
            return $this->newQuery()->findOrFail($id);
        }
        
        return $this->newQuery()->find($id);
    }

    public function update(int $id, array $data)
    {
        $model = $this->newModel();

        return $model->where('id', '=', $id)
            ->update($data);
    }
}