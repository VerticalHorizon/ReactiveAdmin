@if ($paginator->getLastPage() > 1)
{{--*/
	parse_str(Request::server('QUERY_STRING'), $query);
	unset($query['page']);
    $postfix = '&'.http_build_query($query);
/*--}}
<ul class="pagination pagination-lg pull-right">
  <li class="{{ ($paginator->getCurrentPage() == 1) ? 'disabled' : '' }}"><a href="{{ ($paginator->getCurrentPage() == 1) ? '' : $paginator->getUrl($paginator->getCurrentPage()-1).$postfix }}">&laquo;</a></li>
    @for ($i = 1; $i <= $paginator->getLastPage(); $i++)
    <li class="{{ ($paginator->getCurrentPage() == $i) ? 'active' : '' }}"><a href="{{ $paginator->getUrl($i).$postfix }}">{{ $i }}{{ ($paginator->getCurrentPage() == $i) ? ' <span class="sr-only">(current)</span>' : '' }}</a></li>
    @endfor
  <li class="{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? 'disabled' : '' }}"><a href="{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? '' : $paginator->getUrl($paginator->getCurrentPage()+1).$postfix }}">&raquo;</a></li>
</ul>
@endif