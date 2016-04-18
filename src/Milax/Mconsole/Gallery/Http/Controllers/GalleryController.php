<?php

namespace Milax\Mconsole\Gallery\Http\Controllers;

use Milax;
use App\Http\Controllers\Controller;
use Milax\Mconsole\Gallery\Http\Requests\GalleryRequest;
use Milax\Mconsole\Gallery\Models\Gallery;
use Milax\Mconsole\Models\MconsoleUploadPreset;
use Milax\Mconsole\Models\Language;

/**
 * Gallery module controller file
 */
class GalleryController extends Controller
{
    use \HasQueryTraits, \HasRedirects, \HasPaginator;
    
    protected $redirectTo = '/mconsole/gallery';
    protected $model = 'Milax\Mconsole\Gallery\Models\Gallery';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->setPerPage(20)->run('mconsole::gallery.list', function ($item) {
            return [
                '#' => $item->id,
                trans('mconsole::gallery.table.updated') => $item->updated_at->format('m.d.Y'),
                trans('mconsole::gallery.table.slug') => $item->slug,
                trans('mconsole::gallery.table.title') => $item->title,
            ];
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mconsole::gallery.form', [
            'presets' => MconsoleUploadPreset::all(),
            'languages' => Language::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $gallery = Gallery::create($request->all());
        
        if (!is_null($tags = $request->input('tags'))) {
            $gallery->tags()->sync($tags);
        }
        
        $this->handleFiles($gallery);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('mconsole::gallery.form', [
            'item' => Gallery::find($id),
            'presets' => MconsoleUploadPreset::all(),
            'languages' => Language::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        $gallery = Gallery::find($id);
        
        if (!is_null($tags = $request->input('tags'))) {
            $gallery->tags()->sync($tags);
        } else {
            $gallery->tags()->detach();
        }
        
        $this->handleFiles($gallery);
        
        $gallery->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gallery::destroy($id);
    }
    
    /**
     * Handle images upload
     *
     * @param Milax\Mconsole\Pages\Models\Page $page [Page object]
     * @return void
     */
    protected function handleFiles($object)
    {
        // Images processing
        app('API')->uploads->handle(function ($files) use (&$object) {
            app('API')->uploads->attach([
                'group' => 'gallery',
                'images' => $files,
                'related' => $object,
            ]);
            app('API')->uploads->attach([
                'group' => 'cover',
                'images' => $files,
                'related' => $object,
                'unique' => true,
            ]);
            app('API')->uploads->attach([
                'group' => 'files',
                'images' => $files,
                'related' => $object,
            ]);
        });
    }
}
