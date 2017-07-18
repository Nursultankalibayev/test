@if ($pagination->lastPage() > 1)
<ul class="pagination">
    <li class=" page-item {{ ($pagination->currentPage() == 1) ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $pagination->url(1) }}">Previous</a>
    </li>
    @for ($i = 1; $i <= $pagination->lastPage(); $i++)
        <li class=" page-item{{ ($pagination->currentPage() == $i) ? ' active' : '' }}">
            <a class="page-link"href="{{ $pagination->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class=" page-item{{ ($pagination->currentPage() == $pagination->lastPage()) ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $pagination->url($pagination->currentPage()+1) }}" >Next</a>
    </li>
</ul>
@endif