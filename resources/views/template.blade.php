@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <!--include('layouts.navbar')-->
    @include('layouts.header')
    <div id="page-content-wrapper">
        <div class="container-fluid xyz">
            <div class="template_data">
                <table class="table table info_table" id="mytable">
                    <thead class="text-center t">
                        <tr class="text-left d">
                            <th><input type="checkbox" id="checkall" /></th>

                            <th scope="col">Name</th>
                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody class="js-dt" data-route="{{ route('template.data') }}"></tbody>
                </table>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <div class="pagination"></div>
@endsection

@section('script')
    <script>
        LoadData();
        new popup;

        function LoadData(p) {
            let dataWrap = document.querySelector(".js-dt");
            var route = dataWrap.getAttribute("data-route");

            if (p) {
                route = p;
            }
            axios
                .get(route)
                .then(function(response) {

                    let responseData = response.data;

                    let data = responseData.data;
                    Notiflix.Loading.remove();
                    //data row build
                    var listItem = "";
                    if (data.length > 0) {
                        for (i = 0; i < data.length; i++) {
                            let itremData = data[i];


                            listItem += `
                <tr class="text-left">
                <td><input type="checkbox" class="checkthis" ${itremData.id} /></td>
                    <td>${itremData.template_name}</td>
                    <td>
                    <a href="/template/edit/${itremData.id}">Edit</a>
                    <a href="/template/delete/${itremData.id}" onclick="deleteData(event,this)">Delete</a>
                    </td>
                </tr>`
                        }
                        $(dataWrap).html(listItem);
                        new popup;
                        //pagination
                        p = new pagination(responseData);
                        $(".pagination").html(p.linksHtm());
                    } else {
                        $(dataWrap).html(`<div class="mailNotFound">Data Not Found</div>`);
                    }

                })
                .catch(function(error) {
                    ntf(error, "error");
                });
        }

        //Check All Function
        $(document).ready(function() {
            $("#mytable #checkall").click(function() {
                if ($("#mytable #checkall").is(':checked')) {
                    $("#mytable input[type=checkbox]").each(function() {
                        $(this).prop("checked", true);
                    });

                } else {
                    $("#mytable input[type=checkbox]").each(function() {
                        $(this).prop("checked", false);
                    });
                }
            });

            $("[data-toggle=tooltip]").tooltip();
        });
    </script>
@endsection
