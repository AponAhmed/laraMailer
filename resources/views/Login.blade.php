@extends('layouts.app')

@section('content')


<div class="container">
<div class="login_head text-center">
<h2>Welcome To BulkMail</h2>
</div>
  <div class="row  mb-5">
  <div class="col-md-4 offset-md-4 card">
  <form  action=" "  class="m-5 loginForm">
        <div class="form-group">
        <label for="exampleInputEmail1">User Name</label>
         <input required="" name="userName" value="" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter User Name">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input  required="" name="userPassword"  value="" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
          <button name="submit" type="submit" class="btn btn-block btn-success">Login</button>
        </div>
        <div class="wrong_pass">

        </div>
    </form>
  </div>
</div>
</div>
@endsection




@section('script')
<script type="text/javascript">


    $('.loginForm').on('submit',function (event) {
        event.preventDefault();
        let formData=$(this).serializeArray();
        let userName=formData[0]['value'];
        let password=formData[1]['value'];
        let url="/onLogin";
        axios.post(url,{
            user:userName,
            pass:password
        }).then(function (response) {
           if(response.status==200 && response.data==1){
            $('.wrong_pass').append(` <p style="color: green;">Login Success</p>`);
               window.location.href="/";
           }
           else{
                $('.wrong_pass').append(` <p style="color: red;">Your Password Or User Name is Invalid</p>`);
           }

        }).catch(function (error) {

        })


    })

</script>
@endsection
