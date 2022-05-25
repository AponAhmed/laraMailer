@extends('layouts.app')

@section('content')


<div class="container-floid">
<h2 class="text-center count_h"> Total Count</h2>
	<div class="row">

		<div class="col-md-3 p-2 card_p">
			<div class="card">
				<div class="card-body">
                <h3 class="count-card-text text-center">Total Group</h3>
					<h3 class="count-card-title text-center">{{$TotalGroup}}</h3>

				</div>
			</div>
		</div>

		<div class="col-md-3 p-2 card_p">
			<div class="card">
				<div class="card-body">
                <h3 class="count-card-text text-center">Total Contact</h3>
					<h3 class="count-card-title text-center">{{$TotalContact}}</h3>

				</div>
			</div>
		</div>

		<div class="col-md-3 p-2 card_p">
			<div class="card">
				<div class="card-body">
                <h3 class="count-card-text text-center">Total Campaign</h3>
					<h3 class="count-card-title text-center">{{$TotalCampain}}</h3>

				</div>
			</div>
		</div>



	</div>
</div>

@endsection
