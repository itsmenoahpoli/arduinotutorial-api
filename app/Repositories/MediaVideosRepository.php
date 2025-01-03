<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\BaseRepository;

class MediaVideosRepository extends BaseRepository
{
    public function __construct(Model $model)
    {
        parent::__construct($model, []);
    }
}
