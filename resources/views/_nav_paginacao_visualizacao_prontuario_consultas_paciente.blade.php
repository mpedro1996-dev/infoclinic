<nav aria-label="Page navigation">
    <ul class="pagination pagination-lg justify-content-end">
        <li class="page-item {{$collection->previousPageUrl()==null?"disabled":""}}">
            <a class="page-link" href="{{$collection->previousPageUrl()!=null?$collection->previousPageUrl():"#"}}&paginate={{$paginate}}&especialidade={{$especialidade}}" aria-label="Previous" {{$collection->previousPageUrl()==null?"tabindex='-1'":""}} >
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        @for($i=1;$i<=$collection->lastPage();$i++)
            <li class="page-item {{$i==$collection->currentPage()?'active':''}}"><a class="page-link" href="{{$collection->url($i)}}&paginate={{$paginate}}&especialidade={{$especialidade}}">{{$i}}</a></li>
        @endfor
        <li class="page-item {{$collection->nextPageUrl()==null?"disabled":""}}">
            <a class="page-link "  href="{{$collection->nextPageUrl()!=null?$collection->nextPageUrl():"#"}}&paginate={{$paginate}}&especialidade={{$especialidade}}" aria-label="Next" {{$collection->nextPageUrl()==null?"tabindex='-1'":""}}>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>