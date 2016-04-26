<?php

namespace Milax\Mconsole\Gallery\Http\Controllers;

use App\Http\Controllers\Controller;
use Milax\Mconsole\Gallery\Http\Requests\GalleryRequest;
use Milax\Mconsole\Gallery\Models\Gallery;
use Milax\Mconsole\Models\MconsoleUploadPreset;
use Milax\Mconsole\Models\Language;
use Milax\Mconsole\Contracts\ListRenderer;
use Milax\Mconsole\Contracts\FormRenderer;

/**
 * Gallery module controller file
 */
class GalleryController extends Controller
{
    use \HasRedirects;
    
    protected $redirectTo = '/mconsole/gallery';
    protected $model = 'Milax\Mconsole\Gallery\Models\Gallery';
    
    /**
     * Create new class instance
     */
    public function __construct(ListRenderer $list, FormRenderer $form)
    {
        $this->list = $list;
        $this->form = $form;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->list->setQuery(Gallery::query())->setAddAction('gallery/create')->render(function ($item) {
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
        return $this->form->render('mconsole::gallery.form', [
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
        
        $this->handleUploads($gallery);
        app('API')->tags->sync($gallery);
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
        return $this->form->render('mconsole::gallery.form', [
            'item' => Gallery::findOrFail($id),
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
        $gallery = Gallery::findOrFail($id);
        
        $this->handleUploads($gallery);
        app('API')->tags->sync($gallery);
        
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
    protected function handleUploads($object)
    {
        // Images processing
        app('API')->uploads->handle(function ($uploads) use (&$object) {
            app('API')->uploads->attach([
                'group' => 'gallery',
                'uploads' => $uploads,
                'related' => $object,
            ]);
            app('API')->uploads->attach([
                'group' => 'cover',
                'uploads' => $uploads,
                'related' => $object,
                'unique' => true,
            ]);
            app('API')->uploads->attach([
                'group' => 'files',
                'uploads' => $uploads,
                'related' => $object,
            ]);
        });
    }
}
