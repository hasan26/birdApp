<li class="{{ Request::is('articles*') ? 'active' : '' }}">
    <a href="{!! route('articles.index') !!}"><i class="fa fa-edit"></i><span>Articles</span></a>
</li>


<li class="{{ Request::is('tags*') ? 'active' : '' }}">
    <a href="{!! route('tags.index') !!}"><i class="fa fa-edit"></i><span>Tags</span></a>
</li>

<li class="{{ Request::is('news*') ? 'active' : '' }}">
    <a href="{!! route('news.index') !!}"><i class="fa fa-edit"></i><span>News</span></a>
</li>

<li class="{{ Request::is('customers*') ? 'active' : '' }}">
    <a href="{!! route('customers.index') !!}"><i class="fa fa-edit"></i><span>Customers</span></a>
</li>

<li class="{{ Request::is('schedules*') ? 'active' : '' }}">
    <a href="{!! route('schedules.index') !!}"><i class="fa fa-edit"></i><span>Schedules</span></a>
</li>

