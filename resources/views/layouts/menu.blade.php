<li class="{{ Request::is('articles*') ? 'active' : '' }}">
    <a href="{!! route('articles.index') !!}"><i class="fa fa-edit"></i><span>Articles</span></a>
</li>


<li class="{{ Request::is('tags*') ? 'active' : '' }}">
    <a href="{!! route('tags.index') !!}"><i class="fa fa-edit"></i><span>Tags</span></a>
</li>

