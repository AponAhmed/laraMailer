@extends('layouts.app')

@section('content')
@include('layouts.header')
<div id="page-content-wrapper">
    <div class="container-fluid xyz">
        
        <div class="row">
            <div class="col-lg-12  ">
                <table class="table table  info_table" id="mytable">
                    <thead class=" t">
                        <tr class="text-left d">
                        <th><input type="checkbox" id="checkall" /></th>

                            <th scope="col">Group Name</th>

                            <th scope="col">Action</th>

                        </tr>
                    </thead>
                    <tbody class="js-dt" data-route="{{route('contactGroup.data')}}" >


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>

<div class="pagination"></div>
@endsection


@section('script')

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

                    <td>${itremData.name}</td>



                    <td>
                    <a href="contactGroup/edit/${itremData.id}" class="popup">Edit</a>
                    <a href="contactGroup/delete/${itremData.id}" onclick="deleteData(event,this)">Delete</a>
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
            $(document).ready(function(){
        $("#mytable #checkall").click(function () {
                if ($("#mytable #checkall").is(':checked')) {
                    $("#mytable input[type=checkbox]").each(function () {
                        $(this).prop("checked", true);
                    });

                } else {
                    $("#mytable input[type=checkbox]").each(function () {
                        $(this).prop("checked", false);
                    });
                }
            });

    $("[data-toggle=tooltip]").tooltip();
});
</script>
@endsection

@endsection
