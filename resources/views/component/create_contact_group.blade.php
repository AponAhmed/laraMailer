<form class="ajx" action="{{route('contactGroup.store')}}">
         @if($data->id)
            <input type="hidden" name="update" value="{{$data->id}}">
        @endif
  <div class="mb-3">
    <label for="Campain" class="form-label">ADD GROUP</label>
    <input required=""  type="text" name="name" value="{{$data->name}}" class="form-control" aria-describedby="emailHelp">
  </div>
<br/>
  <button type="submit" class="btn btn-primary te">Submit</button>
</form>
