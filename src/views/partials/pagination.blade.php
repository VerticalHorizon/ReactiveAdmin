@if ($paginator->getLastPage() > 1)
{{--*/
    $orderBy_postfix = Input::has('orderBy') ? '&orderBy['.array_keys(Input::get('orderBy'))[0].']='.array_values(Input::get('orderBy'))[0] : '';
/*--}}
<ul class="pagination pagination-lg pull-right">
  <li class="{{ ($paginator->getCurrentPage() == 1) ? 'disabled' : '' }}"><a href="{{ ($paginator->getCurrentPage() == 1) ? '' : $paginator->getUrl($paginator->getCurrentPage()-1).$orderBy_postfix }}">&laquo;</a></li>
    @for ($i = 1; $i <= $paginator->getLastPage(); $i++)
    <li class="{{ ($paginator->getCurrentPage() == $i) ? 'active' : '' }}"><a href="{{ $paginator->getUrl($i).$orderBy_postfix }}">{{ $i }}{{ ($paginator->getCurrentPage() == $i) ? ' <span class="sr-only">(current)</span>' : '' }}</a></li>
    @endfor
  <li class="{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? 'disabled' : '' }}"><a href="{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? '' : $paginator->getUrl($paginator->getCurrentPage()+1).$orderBy_postfix }}">&raquo;</a></li>
</ul>
@endif