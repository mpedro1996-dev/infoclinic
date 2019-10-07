<nav aria-label="Page navigation">
    <ul class="pagination pagination-lg justify-content-end">
        <li class="page-item {{$collectionConsultas->previousPageUrl()==null?"disabled":""}}">
            <a class="page-link" href="{{$collectionConsultas->previousPageUrl()!=null?$collectionConsultas->previousPageUrl():"#"}}&paginate={{$paginate}}&especialidade={{$especialidade}}&somente_meus={{$somente_meus}}" aria-label="Previous" {{$collectionConsultas->previousPageUrl()==null?"tabindex='-1'":""}} >
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        @for($i=1;$i<=$collectionConsultas->lastPage();$i++)
            <li class="page-item {{$i==$collectionConsultas->currentPage()?'active':''}}"><a class="page-link" href="{{$collectionConsultas->url($i)}}&paginate={{$paginate}}&especialidade={{$especialidade}}&somente_meus={{$somente_meus}}">{{$i}}</a></li>
        @endfor
        <li class="page-item {{$collectionConsultas->nextPageUrl()==null?"disabled":""}}">
            <a class="page-link "  href="{{$collectionConsultas->nextPageUrl()!=null?$collectionConsultas->nextPageUrl():"#"}}&paginate={{$paginate}}&especialidade={{$especialidade}}&somente_meus={{$somente_meus}}" aria-label="Next" {{$collectionConsultas->nextPageUrl()==null?"tabindex='-1'":""}}>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>