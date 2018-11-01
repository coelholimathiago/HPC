<form class="form-control" action="/recebe" method="post">
  {!! csrf_field() !!}
  <input type="text" name="opa" value="">
  <button type="submit" name="button" value="{{serialize($teste)}}">Clique</button>
</form>
