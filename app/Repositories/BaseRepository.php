<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    public function __construct(private Model $model, private array $relations)
    {}

    public function getAll()
    {
        return $this->model->query()->with($this->relations)->get();
    }

    public function create($data)
    {
        return $this->model->query()->with($this->relations)->create($data);
    }

    public function update($data, $id)
    {
        return tap($this->model->query()->with($this->relations)->where('id', $id))->update($data);
    }

    public function find($id)
    {
        return $this->model->query()->with($this->relations)->findOrFail($id);
    }

    public function delete($id)
    {
        return $this->model->query()->findOrFail($id)->delete();
    }
}
