<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::text('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Text Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('text', 'Text:') !!}
    {!! Form::textarea('text', null, ['class' => 'form-control']) !!}
</div>

<!-- Tag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tag', 'Tag:') !!}
    {!! Form::select('tag',$article['tag_data'], $article['tag'],['class' => 'form-control']) !!}
</div>

<!-- Bundle Article Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bundle_articles', 'Bundle Article:') !!}
    <div class="ui-autocomplete-multiselect ui-state-default ui-widget ui-state-active" style="width: 100%;">
        @foreach($article['artilce_bundle_data'] as $value)
            <div class="ui-autocomplete-multiselect-item" style="padding: 6px 12px;">{!! $value[1] !!}<span onclick="$(this).parent().remove();" class="ui-icon ui-icon-close"></span>
                <input type="hidden" name="bundle_articles[]" value="{!! $value[0]!!}">
            </div>
        @endforeach
        <input id="q" placeholder="Enter Title Articles" class="form-control ui-autocomplete-input" name="q" type="text" value="" autocomplete="off">
    </div>
</div>


<!-- Banner Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_banner', 'Banner:') !!}
    {!! Form::checkbox('is_banner',1, null, []) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('articles.index') !!}" class="btn btn-default">Cancel</a>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.12.0/themes/ui-lightness/jquery-ui.css"/>

<script type="text/javascript">
    $(function()
    {
        $( "#q" ).autocomplete({
            source: "{{ URL::action('ArticleController@autocomplete') }}",
            minLength: 3,
            multiselect: true

        });
    });
</script>