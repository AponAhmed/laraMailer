@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid xyz">
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="google_account_data">
                        <table class="table table  info_table" id="mytable">
                            <thead class=" t">
                                <tr class="text-left d" id="header_t">
                                    <th><input type="checkbox" id="checkall"></th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Daily Limit/Send Count</th>
                                    <th scope="col">Hourly Limit/Send Count</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="js-dt" data-route="{{ route('googleAccount.data') }}">

                            </tbody>
                        </table>
                    </div>



                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->

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
                            let OauthStatus = "";
                            if (itremData.Oauth) {

                            } else {
                                OauthStatus =
                                    `<button type="button" data-id="${itremData.id}" onclick="getAuthLink(this)">Login With OAuth</button>`;
                            }

                            listItem += `
                            <tr class="text-left ">
                            <td><input type="checkbox" class="checkthis" ${itremData.id} /></td>
                                <td>
                                ${itremData.email}
                                ${OauthStatus}
                                </td>
                                <td>${itremData.daily_limit}/${itremData.daily_send_count}</td>
                                <td>${itremData.hourly_limit}/${itremData.hourly_send_count}</td>
                                <td>${itremData.created_at}</td>
                                <td>
                                <a href="google-account/edit/${itremData.id}" class="popup">Edit</a>
                                <a href="google-account/delete/${itremData.id}" onclick="deleteData(event,this)">Delete</a>
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

        function getAuthLink(_this) {
            let id = $(_this).attr('data-id');
            console.log(id);
            axios.get('google-account/get-oauth-link/' + id).then((response) => {
                let link = response.data;
                window.location = link;
            }).catch((error) => {

            })
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
