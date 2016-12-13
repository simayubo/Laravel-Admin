<?php
namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\RepositoryInterface;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as Application;
abstract class Repository implements RepositoryInterface
{
    protected $app;
    protected $model;
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }
    abstract public function model();
    public function makeModel()
    {
        $model = $this->app->make($this->model());
        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }
        return $this->model = $model;
    }
    /**
     * Retrieve all data of repository
     *
     * @param array $columns
     *
     * @return mixed
     */
    public function all($columns = ['*']){
        return $this->model->all($columns);
    }
    /**
     * Find data by id
     *
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*']){
        return $this->model->select($columns)->find($id);
    }
    /**
     * Find data by field and value
     *
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findByField($field, $value, $columns = ['*']){
        return $this->model->select($columns)->where($field,$value)->get();
    }
    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhere(array $where, $columns = ['*']){
        return $this->model->select($columns)->where($where)->get();
    }
    /**
     * Find data by multiple values in one field
     *
     * @param       $field
     * @param array $values
     * @param array $columns
     *
     * @return mixed
     */
    public function findWhereIn($field, array $values, $columns = ['*']){
    }
    /**
     * Save a new entity in repository
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes){
        $model = new $this->model;
        $res = $model->fill($attributes)->save();
        if ($res){
            return $model->id;
        }else{
            return false;
        }
    }
    /**
     * Update a entity in repository by id
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id){
        $model = $this->model->findOrFail($id);
        $model->fill($attributes);
        return $model->save();
    }
    /**
     * Update or Create an entity in repository
     *
     * @throws ValidatorException
     *
     * @param array $attributes
     * @param array $values
     *
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values = []){
    }
    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function delete($id){
        return $this->model->destroy($id);
    }
    /**
     * Order collection by a given column
     *
     * @param string $column
     * @param string $direction
     *
     * @return $this
     */
    public function orderBy($column, $direction = 'asc'){
    }
    /**
     * Load relations
     *
     * @param $relations
     *
     * @return $this
     */
    public function with($relations){
    }
}