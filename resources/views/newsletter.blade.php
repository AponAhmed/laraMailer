@extends('layouts.app')
@section('content')
    <!-- Navbar -->
    @include('layouts.header')
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid xyz">
            <div class="row">
                <div class="col-lg-12   ">
                    <table class="table table  info_table" id="mytable">
                        <thead class=" t">
                            <tr id="tt" class="text-left d">
                                <th><input type="checkbox" id="checkall"></th>
                                <th scope="col">Name </th>
                                <th scope="col">Subject</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="js-dt" data-route="{{ route('newsletter.data') }}"></tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
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
                            <tr class="text-left tableData">
                            <td><input type="checkbox" class="checkthis" data-id="${itremData.id}" /></td>
                                <td>${itremData.name}</td>
                                <td>${itremData.subject}</td>
                                <td>${itremData.created_at}</td>
                                <td>
                                <a href="newsletter/edit/${itremData.id}" class="popup">Edit</a>
                                 | <a href="newsletter/delete/${itremData.id}" onclick="deleteData(event,this)">Delete</a>
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
    </script>
@endsection
