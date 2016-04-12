@extends('mconsole::app')

@section('content')

<div class="row">
	<div class="col-md-8 col-sm-6">
        @if (isset($item))
            {!! Form::model($item, ['method' => 'PUT', 'route' => ['mconsole.gallery.update', $item->id]]) !!}
        @else
            {!! Form::open(['method' => 'POST', 'url' => '/mconsole/gallery']) !!}
        @endif
        <div class="portlet light">
            @include('mconsole::partials.portlet-title', [
                'title' => trans('mconsole::gallery.form.main'),
            ])
            <div class="portlet-body form">
    			<div class="form-body">
    				@include('mconsole::forms.text', [
    					'label' => trans('mconsole::gallery.form.slug'),
    					'name' => 'slug',
    				])
    				@include('mconsole::forms.text', [
    					'label' => trans('mconsole::gallery.form.title'),
    					'name' => 'title',
    				])
    				@include('mconsole::forms.textarea', [
    					'label' => trans('mconsole::gallery.form.description'),
    					'name' => 'description',
    				])
                    @include('mconsole::forms.select', [
    					'label' => trans('mconsole::gallery.form.preset.name'),
    					'name' => 'preset_id',
    					'options' => [
                            '1' => trans('mconsole::gallery.form.preset.true'),
                            '0' => trans('mconsole::gallery.form.preset.false'),
    					],
    				])
    				@include('mconsole::forms.select', [
    					'label' => trans('mconsole::news.form.enabled.name'),
    					'name' => 'enabled',
    					'options' => [
    						'1' => trans('mconsole::news.form.enabled.true'),
    						'0' => trans('mconsole::news.form.enabled.false'),
    					],
    				])
    			</div>
                <div class="form-actions">
                    @include('mconsole::forms.submit')
                </div>
            </div>
        </div>
		{!! Form::close() !!}
	</div>
</div>

@endsection