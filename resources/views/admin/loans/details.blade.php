<x-app-layout>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (isset($loan) && isset($movie) && isset($user))
          <div class="col-12">
            <a href="{{ url('loans') }}">Go Back to Loans</a>
          </div>
      <div class="row justify-content-md-center">
        <div class="col-12 col-md-4 p-2">
            <div class="card text-right">
                <img class="cover" src="{{ asset('img/'.$movie->cover) }}">
                <div class="card-body">
                    <h5 class="card-title text-center"><a href="{{ url("movies/{$movie->id}") }}">{{ $movie->title }}</a></h5>
                    <div class="d-flex justify-content-between">
                      <p class="card-text">Class: {{ $movie->classification }}</p>
                      <p class="card-text">Genre: {{ $movie->category->name }}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                      <p class="card-text">Duration: {{  date('H:i', mktime(0,$movie->minutes )) }}</p>
                      <p class="card-text">Year: {{ $movie->year }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4 p-2">
          <div class="card text-right">
              <img class="cover" src="{{ asset('img/users.png') }}">
              <div class="card-body">
                  <h5 class="card-title text-center"><a href="{{ url("users/{$user->id}") }}">{{ $user->name }}</a></h5>
                  <p class="card-text text-center">{{ $user->last_name }}</p>
              </div>
          </div>
      </div>

      </div>
          <div class="col-12 p-2">
                <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">
                    <table class="table table-striped table-bordered">
                      
                      <tbody>
                          <thead class="thead-dark ">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">User</th>
                              <th scope="col">Loan Date</th>
                              <th scope="col">Delivery Date</th>
                              <th scope="col">Status</th>
                            </tr>
                          </thead>
                            <tr>
                                <th scope="row">
                                    {{ $loan->id }}
                                </th>
                                <td> {{ $loan->user->name }} </td>
                                <td> {{ date('j F, Y, H:i', strtotime($loan->loan_date)) }} </td>
                                <td>
                                   @if ($loan->status=='PENDIENT')
                                    N/A
                                   @else
                                    {{ date('j F, Y, H:i', strtotime($loan->delivery_date)) }}    
                                   @endif
                                </td>
                                <td> {{ $loan->status}} </td>
                            </tr> 
                      </tbody>
                    </table>
                    <div class="text-center mb-2">
                      <a onclick="remove({{ $loan->id }},this)" class="btn btn-danger">Delete Register</a>
                    </div>
                </div>

            </div>

      @else
        <h3 class="text-muted p-2">Ups. This Loan Doesn't Exist.</h3>  
        <p><a href="{{ url('loans') }}">Go Back.</a></p>

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
         
         function remove(id,target){
  
           swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this loan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          }).then((willDelete) => {
          if (willDelete) {
  
            axios({
            method: 'delete',
            url: '{{ url('loans') }}',
            data: {
              id: id,
              _token: '{{ csrf_token() }}'
            }
            }).then(function (response) { 
              if(response.data.code==200){
                swal(response.data.message, {
                  icon: "success",
                });
                window.location.href = ('/loans/')
              }else{
                swal(response.data.message, {
                  icon: "error",
                });
              }
            });
          } else {
            swal("Your record is safe!");
            }
          });
         }
       </script>
      </x-slot>

</x-app-layout> 