<nav aria-label="Page navigation">
    <ul class="pagination pagination-lg justify-content-end">
        <li class="page-item {{$collectionExames->previousPageUrl()==null?"disabled":""}}">
            <a class="page-link" href="{{$collectionExames->previousPageUrl()!=null?$collectionExames->previousPageUrl():"#"}}&paginate={{$paginate}}&especialidade={{$especialidade}}&somente_meus={{$somente_meus}}" aria-label="Previous" {{$collectionExames->previousPageUrl()==null?"tabindex='-1'":""}} >
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        @for($i=1;$i<=$collectionExames->lastPage();$i++)
            <li class="page-item {{$i==$collectionExames->currentPage()?'active':''}}"><a class="page-link" href="{{$collectionExames->url($i)}}&paginate={{$paginate}}&especialidade={{$especialidade}}&somente_meus={{$somente_meus}}">{{$i}}</a></li>
        @endfor
        <li class="page-item {{$collectionExames->nextPageUrl()==null?"disabled":""}}">
            <a class="page-link "  href="{{$collectionExames->nextPageUrl()!=null?$collectionExames->nextPageUrl():"#"}}&paginate={{$paginate}}&especialidade={{$especialidade}}&somente_meus={{$somente_meus}}" aria-label="Next" {{$collectionExames->nextPageUrl()==null?"tabindex='-1'":""}}>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>