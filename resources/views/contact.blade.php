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
                                <th scope="col">Group </th>
                                <th scope="col">Email</th>
                                <th scope="col">Last Send</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="js-dt" data-route="{{ route('contact.data') }}"></tbody>
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

                    <td>${itremData.groupName}</td>
                    <td>${itremData.email}</td>
                    <td>${itremData.created_at}</td>


                    <td>
                    <a href="contact/edit/${itremData.id}" class="popup">Edit</a>
                    <a href="contact/delete/${itremData.id}" onclick="deleteData(event,this)">Delete</a>
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
                    $('.deleteAll').removeClass('d-none');


                } else {
                    $("#mytable input[type=checkbox]").each(function() {
                        $(this).prop("checked", false);
                    });
                    $('.deleteAll').addClass('d-none');
                }

            });

            $("[data-toggle=tooltip]").tooltip();






        });

        //delete All

        function deleteAll() {
            if ($(".checkthis:checked").length > 0) {
                let ids = [];
                $(".checkthis:checked").each(function() {
                    ids.push($(this).attr('data-id'));
                })
                axios.post('/contact/deleteAll', {
                        ids: ids

                    })
                    .then(function(response) {
                        Notiflix.Confirm.show(
                            'Delete Conformation',
                            'Are You Want To Delete?',
                            'Yes',
                            'No',
                            function() {

                                if (response.status == 200) {
                                    //uncheck all

                                    //uncheck all

                                    LoadData();



                                    ntf("Data Delation " + response.data + " " + "Success", 'success');
                                }
                            }
                        );

                    })
                    .catch(function(error) {

                        console.log(error);
                    });
            }

        }
    </script>
@endsection
