<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 row">
			@if (isset($movies) && count($movies)>0)
				@foreach ($movies as $movie)
				<div class="col-12 col-sm-6 col-md-4 col-lg-3 p-1.5">
					<div class="card text-right">
						<img class="cover" src="{{ asset('img/'.$movie->cover) }}">
						<div class="card-body">
							<h5 class="card-title text-center">{{ $movie->title }}</h5>
							<div class="d-flex justify-content-between">
								<p class="card-text">Class: {{ $movie->classification }}</p>
								<p class="card-text">Genre: {{ $movie->category->name }}</p>
							</div>
							<div class="d-flex justify-content-between">
								<p class="card-text">Duration: {{  date('H:i', mktime(0,$movie->minutes )) }}</p>
								<p class="card-text">Year: {{ $movie->year }}</p>
							</div>
							<p class="text-center"><a href="{{ $movie->trailer }}" target="_blank">Trailer</a></p>

							<button class="btn btn-info btn-block mb-2" type="button" data-toggle="collapse" data-target="#collapseDesc{{$movie->id}}">
								See Details
							</button>
							<div class="collapse" id="collapseDesc{{$movie->id}}">
								<p class="text-center">{{$movie->description}}</p>
							</div>

							<div>
								<a onclick="get({{Auth::user()->id}},{{$movie->id}})" class="btn btn-primary btn-block">Get</a>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			@else
				<h3 class="text-muted p-2">Ups. There Are No Movies.</h3>  
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
     	
     	function get(user_id, movie_id){
			axios({
				method: 'post',
				url: '{{ url('loans') }}',
				data: {
					movie_id: movie_id,
				    user_id: user_id,
					_token: '{{ csrf_token() }}'
				}
			}).then(function (response){
				var code = response.data.code
				swal({
					title: (code==200)?'Congrats':'Ups',
					text: response.data.message,
					icon: (code==200)?"success":"warning",
				})
			})
		}

     </script>
    </x-slot>
</x-app-layout> 