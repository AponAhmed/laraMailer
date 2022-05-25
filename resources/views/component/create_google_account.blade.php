<form class="ajx" action="{{route('googleAccount.store')}}">
         @if($data->id)
            <input type="hidden" name="update" value="{{$data->id}}">
        @endif
  <div class="mb-3">
    <label for="email" class="form-label">Add Email</label>
    <input required=""  type="email" name="email" value="{{$data->email}}" class="form-control" aria-describedby="emailHelp">
  </div>
  <div class="form-outline">
  <label class="form-label" for="daily_limit">Daily Limit</label>
  <input required="" type="number" name="daily_limit"   value="{{$data->daily_limit}}" class="form-control" />

</div>

<div class="form-outline">
<label class="form-label" for="hourly_limit">Hourly Limit</label>
  <input required="" type="number" value="{{$data->hourly_limit}}" name="hourly_limit" class="form-control" />

</div>



<br/>
  <button type="submit" class="btn btn-primary te">Submit</button>
</form>
