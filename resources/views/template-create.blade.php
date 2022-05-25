@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <!--include('layouts.navbar')-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css"
        rel="stylesheet">
    @include('layouts.header')
    <div id="page-content-wrapper">

        <div class="template-create">
            <form id="templateForm">
                @if ($data->id)
                    <input type="hidden" name="update" value="{{ $data->id }}">
                @endif
                <div class="style-control">
                    <input type="text" name="data[template_name]" value="{{ $data->template_name }}"
                        placeholder="Template Name">
                    <hr>
                    <ul class="nav nav-tabs" id="templateCreateTabItem" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                aria-controls="home" aria-selected="true">Layout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                aria-controls="profile" aria-selected="false">Header</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                aria-controls="contact" aria-selected="false">Footer</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="templateCreateTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="label-sm">Container Width</label>
                                    <input type="text" value="{{ $data->styles->container_width ?? '' }}"
                                        name="style[container_width]" class="input-text sm">
                                    <p class="comment comment-sm">Specify 'px' or '%' as Unit</p>
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-sm">Body Padding</label>
                                    <input type="text" value="{{ $data->styles->contentPadding ?? '' }}"
                                        name="style[contentPadding]" class="input-text sm">
                                    <p class="comment comment-sm">Like CSS Property value</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="label-sm">Background</label>
                                    <div class="colorinput">
                                        <input type="text" value="{{ $data->styles->container_bg ?? '' }}"
                                            name="style[container_bg]" class="input-text sm colorPicker">
                                        <span class="color"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-sm">Outer Background</label>
                                    <div class="colorinput">
                                        <input type="text" name="style[body_bg]"
                                            value="{{ $data->styles->body_bg ?? '' }}" class="input-text sm colorPicker">
                                        <span class="color"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="label-sm">Font</label>
                                    <input type="text" name="style[fontFamily]"
                                        value="{{ $data->styles->fontFamily ?? '' }}" class="input-text sm">
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-sm">Font Size</label>
                                    <input type="text" name="style[font_size]"
                                        value="{{ $data->styles->font_size ?? '' }}" class="input-text sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="label-sm">Font Color</label>
                                    <div class="colorinput">
                                        <input type="text" name="style[contColor]"
                                            value="{{ $data->styles->contColor ?? '' }}"
                                            class="input-text sm colorPicker">
                                        <span class="color"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-sm">Text Align</label>
                                    <input type="text" name="style[body_text_align]"
                                        value="{{ $data->styles->body_text_align ?? '' }}" class="input-text sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="label-sm">Line Height</label>
                                    <input type="text" name="style[body_line_height]"
                                        value="{{ $data->styles->body_line_height ?? '' }}" class="input-text sm">
                                </div>
                                <div class="col-sm-12">
                                    <label class="label-sm">Custom Css</label>
                                    <textarea class="form-control"
                                        name="data[custom_style]">{{ $data->custom_style ?? '' }}</textarea>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea class="form-control"
                                        name="data[header_text]">{{ $data->header_text ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="label-sm">Height</label>
                                    <input type="text" name="style[header_height]"
                                        value="{{ $data->styles->header_height ?? '' }}" class="input-text sm ">
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-sm">Padding</label>
                                    <input type="text" name="style[headerPadding]"
                                        value="{{ $data->styles->headerPadding ?? '' }}" class="input-text sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="label-sm">line Height</label>
                                    <input type="text" name="style[header_line_height]"
                                        value="{{ $data->styles->header_line_height ?? '' }}" class="input-text sm ">
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-sm">Font Size</label>
                                    <input type="text" name="style[header_font_size]"
                                        value="{{ $data->styles->header_font_size ?? '' }}" class="input-text sm">
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-sm">Background</label>
                                    <div class="colorinput">
                                        <input type="text" name="style[header_bg]"
                                            value="{{ $data->styles->header_bg ?? '' }}"
                                            class="input-text sm colorPicker">
                                        <span class="color"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-sm">Color</label>
                                    <div class="colorinput">
                                        <input type="text" name="style[header_color]"
                                            value="{{ $data->styles->header_color ?? '' }}"
                                            class="input-text sm colorPicker">
                                        <span class="color"></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea class="form-control"
                                        name="data[footer_text]">{{ $data->footer_text ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="label-sm">Height</label>
                                    <input type="text" name="style[footer_height]"
                                        value="{{ $data->styles->footer_height ?? '' }}" class="input-text sm ">
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-sm">Padding</label>
                                    <input type="text" name="style[footerPadding]"
                                        value="{{ $data->styles->footerPadding ?? '' }}" class="input-text sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="label-sm">Width</label>
                                    <input type="text" name="style[footer_width]"
                                        value="{{ $data->styles->footer_width ?? '' }}" class="input-text sm ">
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-sm">Line Height</label>
                                    <input type="text" name="style[footer_line_height]"
                                        value="{{ $data->styles->footer_line_height ?? '' }}" class="input-text sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="label-sm">Font</label>
                                    <input type="text" name="style[footerfontFamily]"
                                        value="{{ $data->styles->footerfontFamily ?? '' }}" class="input-text sm ">
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-sm">Font Size</label>
                                    <input type="text" name="style[footer_font_size]"
                                        value="{{ $data->styles->footer_font_size ?? '' }}" class="input-text sm">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="label-sm">Background</label>
                                    <div class="colorinput">
                                        <input type="text" name="style[footer_bg]"
                                            value="{{ $data->styles->footer_bg ?? '' }}"
                                            class="input-text sm colorPicker ">
                                        <span class="color"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-sm">Text Color</label>
                                    <div class="colorinput">
                                        <input type="text" name="style[footer_color]"
                                            value="{{ $data->styles->footer_color ?? '' }}"
                                            class="input-text sm colorPicker">
                                        <span class="color"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="label-sm">Text Align</label>
                                    <input type="text" name="style[footertext_align]"
                                        value="{{ $data->styles->footertext_align ?? '' }}" class="input-text sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <button class="btn btn-primary">Save</button>
                </div>
                <div class="preview"></div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js">
    </script>
    <script>
        $('.colorPicker').colorpicker({
            format: 'hex'
        }).on('changeColor', function() {
            console.log($(this).colorpicker('getValue', '#ffffff'));
            $(this).parent().find('.color').css("background-color", $(this).colorpicker('getValue', '#ffffff'));
        });
        $(".colorinput").each(function() {
            //let currentColor=$(this).find('.colorPicker').val();
            $(this).find('.color').css("background", $(this).find('.colorPicker').val());
        });
    </script>

    <script>
        $("#templateForm").on('submit', (event) => {
            event.preventDefault();
            let data = $("#templateForm").serialize();
            axios
                .post("/template/store", {
                    fData: data
                })
                .then((response) => {
                    ntf(response.data.msg, "success");
                    console.log(response.data.msg);
                    if (!response.data.error) {
                        //location.href = "/template/";
                        $(".preview").html(response.data.preview);
                    }
                })
                .catch((error) => {
                    ntf(error, "error");
                });
        })
    </script>
@endsection
