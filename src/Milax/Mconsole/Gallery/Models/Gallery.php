<?php

namespace Milax\Mconsole\Gallery\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class Gallery extends Model
{
    use \HasTags, \HasState;
    
    protected $fillable = ['preset_id', 'slug', 'title', 'description', 'enabled'];
    
    /**
     * Automatically generate slug from heading if empty, format for url
     * 
     * @param void
     */
    public function setSlugAttribute($value)
    {
        if (strlen($value) == 0) {
            $title = Request::input('title');
            $this->attributes['slug'] = str_slug($title);
        } else {
            $this->attributes['slug'] = str_slug($value);
        }
    }
    
    /**
     * Automatically delete related data
     * 
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        self::deleting(function ($object) {
            app('API')->tags->detach($object);
            $object->uploads->each(function ($upload) {
                $upload->delete();
            });
        });
    }
}
