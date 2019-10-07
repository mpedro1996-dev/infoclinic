<nav aria-label="Page navigation">
    <ul class="pagination pagination-lg justify-content-end">
        <li class="page-item {{$collection->previousPageUrl()==null?"disabled":""}}">
            <a class="page-link" href="{{$collection->previousPageUrl()!=null?$collection->previousPageUrl():"#"}}&paginate={{$paginate}}&nome_medico={{$nome_medico}}&nome_paciente={{$nome_paciente}}&status_consulta={{$status_consulta}}&data_hoje={{$data_hoje}}" aria-label="Previous" {{$collection->previousPageUrl()==null?"tabindex='-1'":""}} >
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        @for($i=1;$i<=$collection->lastPage();$i++)
            <li class="page-item {{$i==$collection->currentPage()?'active':''}}"><a class="page-link" href="{{$collection->url($i)}}&paginate={{$paginate}}&nome_medico={{$nome_medico}}&nome_paciente={{$nome_paciente}}&status_consulta={{$status_consulta}}&data_hoje={{$data_hoje}}">{{$i}}</a></li>
        @endfor
        <li class="page-item {{$collection->nextPageUrl()==null?"disabled":""}}">
            <a class="page-link "  href="{{$collection->nextPageUrl()!=null?$collection->nextPageUrl():"#"}}&nome_medico={{$nome_medico}}&nome_paciente={{$nome_paciente}}&status_consulta={{$status_consulta}}&data_hoje={{$data_hoje}}" aria-label="Next" {{$collection->nextPageUrl()==null?"tabindex='-1'":""}}>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>