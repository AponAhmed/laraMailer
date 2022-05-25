@extends('layouts.app')

@section('content')
    <!-- Navbar -->
    @include('layouts.header')
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid xyz">
            <form id="settings">
                <div class="col-sm-6">
                    <div class="option-item">
                        <label>Send Limit</label>
                        <input type="text" value="{{ $data['send_limit_per_hit'] ?? '' }}"
                            name="settings[send_limit_per_hit]">
                        <span class='comment'>Sending limit of each cron hit</span>
                    </div>
                    <div class="option-item">
                        <label>Send Limit from Campaign</label>
                        <input type="text" value="{{ $data['send_limit_camp'] ?? '' }}" name="settings[send_limit_camp]">
                        <span class='comment'>Sending limit of each Campaign each time</span>
                    </div>
                    <div class="option-item">
                        <label>Delay</label>
                        <input type="text" value="{{ $data['delay_between'] ?? '' }}" name="settings[delay_between]">
                        <span class='comment'>Sending delay between sending(second)</span>
                    </div>
                    <div class="option-item">
                        <label>Duplicate Send</label>
                        <input type="text" value="{{ $data['duplicate_send'] ?? '' }}" name="settings[duplicate_send]">
                        <span class='comment'></span>
                    </div>
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div> <!-- Page Content End-->
    <!-- /#wrapper -->
@endsection

@section('script')
    <script>
        $("#settings").on('submit', function(event) {
            event.preventDefault();
            axios
                .post('settings/store', {
                    fData: $("#settings").serialize()
                })
                .then(function(response) {
                    console.log(response);
                    ntf("Settings Updated","success");
                })
                .catch(function(error) {
                    console.log(error);
                });
        });
    </script>
@endsection
