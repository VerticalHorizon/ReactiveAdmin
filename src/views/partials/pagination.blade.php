@if ($paginator->getLastPage() > 1)
<ul class="pagination pagination-lg pull-right">
  <li class="{{ ($paginator->getCurrentPage() == 1) ? 'disabled' : '' }}"><a href="{{ $paginator->getUrl(1) }}">&laquo;</a></li>
    @for ($i = 1; $i <= $paginator->getLastPage(); $i++)
    <li class="{{ ($paginator->getCurrentPage() == $i) ? 'active' : '' }}"><a href="{{ $paginator->getUrl($i) }}">{{ $i }}{{ ($paginator->getCurrentPage() == $i) ? ' <span class="sr-only">(current)</span>' : '' }}</a></li>
    @endfor
  <li class="{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? 'disabled' : '' }}"><a href="{{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? '' : $paginator->getUrl($paginator->getCurrentPage()+1) }}">&raquo;</a></li>
</ul>
@endif