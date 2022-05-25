<form class="ajx" action="{{ route('newsletter.store') }}">
    @if ($data->id)
        <input type="hidden" name="update" value="{{ $data->id }}">
    @endif
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input required="" type="text" name="name" value="{{ $data->name }}" class="form-control" id="name"
            aria-describedby="emailHelp">

    </div>
    <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input required="" type="text" name="subject" value="{{ $data->subject }}" class="form-control" id="subject"
            aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea class="form-control" name="body" value="" id="editor">{{ $data->body }}</textarea>
    </div>


    <div class="mb-3 form-floating">
        <select class="form-select" name="template_id" aria-label="Default select example">
            <option value="">Template</option>
            @foreach ($templates as $template)
                <option value="{{ $template->id }}" @if ($template->id)
                    @if ($template->id == $data->template_id)
                        selected
                    @endif
            @endif >
            {{ $template->template_name }}</option>
            @endforeach
        </select>
    </div>

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
