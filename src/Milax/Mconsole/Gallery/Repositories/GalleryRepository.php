<?php 

namespace Milax\Mconsole\Gallery\Repositories;

use Milax\Mconsole\Repositories\EloquentRepository;
use Milax\Mconsole\Gallery\Contracts\Repositories\GalleryRepository as Repository;
use Milax\Mconsole\Traits\Repositories\TaggableRepository;

class GalleryRepository extends EloquentRepository implements Repository
{
    use TaggableRepository;
    
    public $model = \Milax\Mconsole\Gallery\Models\Gallery::class;
}