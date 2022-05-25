<form class="ajx" action="{{route('contact.store')}}">
         @if($data->id)
            <input type="hidden" name="update" value="{{$data->id}}">
        @endif



  <div class="mb-3">
    <label for="email" class="form-label">Email</label>

    <textarea required=""  class="form-control" name="email" value=""  id="email">{{$data->email}}</textarea>
  </div>

  <div class="mb-3 form-floating">
        <select required=""  class="form-select" name="group" id="" aria-label="Default select example">
        <option selected>Select Group</option>

        @foreach($contactGroup as $group)
        <option value="{{$group->id}}"
        @if($data->id)
        @if($group->id == $data->group)
         selected
        @endif
        @endif
        >{{$group->name}}</option>
        @endforeach
        </select>
  </div>


  <button type="submit" class="btn btn-primary te">Submit</button>
</form>
