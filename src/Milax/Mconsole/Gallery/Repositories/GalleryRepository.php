<?php 

namespace Milax\Mconsole\Gallery\Repositories;

use Milax\Mconsole\Repositories\EloquentRepository;
use Milax\Mconsole\Gallery\Contracts\Repositories\GalleryRepository as Repository;

class GalleryRepository extends EloquentRepository implements Repository
{
    public $model = \Milax\Mconsole\Gallery\Models\Gallery::class;
}