<div class="form-group row">
    <label class="col-md-3 col-form-label text-md-right">Paginação</label>
    <div class="col-md-4">
        <select name="paginate" class="form-control">
            @for($i=5;$i<=50;$i+=5)
                <option>{{$i}}</option>
            @endfor
        </select>
    </div>
    <div class="col-md-offset-2 col-md-1">
        <button id="procurar" type="submit" class="btn btn-primary" data-toggle="tooltip" title="Procurar"><span class="fa fa-search"></span></button>
    </div>
</div>