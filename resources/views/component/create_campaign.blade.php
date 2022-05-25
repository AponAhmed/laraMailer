<form style="min-width:500px" class="ajx" action="{{ route('campain.store') }}">
    @if ($data->id)
        <input type="hidden" name="update" value="{{ $data->id }}">
    @endif
    <h3>
        @if ($data->id)
            Update
        @else
            Create
        @endif
         Campaign
    </h3>
    <hr>
    <div class="mb-3">
        <div class="row">
            <div class="col-sm-4">
                <label for="Campain" class="form-label">Campain Name</label>
            </div>
            <div class="col-sm-8">
                <input required="" type="text" name="campaign_name" value="{{ $data->campaign_name }}"
                    class="form-control" id="Campain" aria-describedby="emailHelp">
            </div>
        </div>

    </div>
    <div class="mb-3">
        <div class="row">
            <div class="col-sm-4">
                <label>Newsletter</label>
            </div>
            <div class="col-sm-8">
                <select class="custom-select custom-select">
                    <option value="">Select Newsletter</option>
                </select>
            </div>
        </div>
    </div>
    <div class="mb-3 form-floating">
        <select required="" class="custom-select" name="group[]" aria-label="Default select example">
            <option value="">Select Group</option>
            @foreach ($contactGroup as $group)
                <option value="{{ $group->id }}" @if ($data->id)
                    @if (in_array($group->id, $data->group_ids()))
                        selected
                    @endif
            @endif>
            {{ $group->name }}</option>
            @endforeach
        </select>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary te">Submit</button>
</form>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error('There was a problem initializing the editor.', error);
        });
</script>
