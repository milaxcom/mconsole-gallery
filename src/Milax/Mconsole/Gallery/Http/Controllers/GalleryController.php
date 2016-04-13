<?php

namespace Milax\Mconsole\Gallery\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Milax\Mconsole\Gallery\Models\Gallery;
use HasPaginator;
use HasRedirects;
use HasQueryTraits;

/**
 * Gallery module controller file
 */
class GalleryController extends Controller
{
    use HasQueryTraits, HasRedirects, HasPaginator;

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
        return view('mconsole::gallery.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gallery::create($request->all());
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
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gallery::find($id)->update($request->all());
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
}