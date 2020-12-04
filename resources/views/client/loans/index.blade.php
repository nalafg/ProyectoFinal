<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 row">
			@if (isset($loans) && count($loans)>0)
				@foreach ($loans as $loan)
				<div class="col-12 col-sm-6 col-md-4 col-lg-3 p-1.5">
					<div class="card text-right">
						<img class="cover" src="{{ asset('img/'.$loan->movie->cover) }}">
						<div class="card-body">
							  <h5 class="card-title text-center">{{ $loan->movie->title }}</h5>
								<p class="card-text text-center">Rented on: {{ date('j F, Y', strtotime($loan->loan_date)) }}</p>
							@if ($loan->status == 'PENDIENT')
								<p class="card-text text-center">{{ $loan->status }}</p>
								<a onclick="returnLoan({{$loan->id}})" class="btn btn-primary btn-block">Return</a>
							@else
								<p class="card-text text-center">Returned on: {{ date('j F, Y', strtotime($loan->delivery_date)) }}</p>
							@endif
						</div>
					</div>
				</div>
				@endforeach
			@else
			<div>
				<h3 class="text-muted p-2">You Haven't Rented Any Movies Yet.</h3>
				<p><a href="{{ route('movies') }}">Go back to movies</a></p>
			</div>
			@endif 
        </div>
	</div>
	
	<style>
		.cover{
			height: 18rem;
			object-fit: cover;
		}
	</style>

<x-slot name="scripts">
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
     	
     	function returnLoan(loan_id){
			 console.log(loan_id)
			axios({
				method: 'put',
				url: '{{ url('loans') }}',
				data: {
					id: loan_id,
					_token: '{{ csrf_token() }}'
				}
			}).then(function (response){
				console.log(response);
				var code = response.data.code
				swal({
					title: (code==200)?'Congrats':'Ups',
					text: response.data.message,
					icon: (code==200)?"success":"warning",
				}).then(()=>{
					location.reload();
				})
			})
		}

     </script>
    </x-slot>

</x-app-layout> 