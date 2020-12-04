<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 row">
      @if (isset($user))
      <div class="col-12">
        <a href="{{ url('users') }}">Go Back to Users</a>
      </div>
          
            <div class="col-12 col-md-4 p-2">
                <div class="card text-right">
                    <img class="cover" src="{{ asset('img/users.png') }}">
                    <div class="card-body">
                          <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text">{{ $user->last_name }}</p>
                        <p class="card-text">This user has rented {{ $loans->count() }} movies</p>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8 p-2">
                <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">
                    <table class="table table-striped table-bordered">
                      
                      <tbody>
                        @if (isset($loans) && count($loans)>0)
                          <thead class="thead-dark ">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Movie</th>
                              <th scope="col">Loan Date</th>
                              <th scope="col">Delivery Date</th>
                            </tr>
                          </thead>
                          @foreach ($loans as $loan)
                            <tr>
                                <th scope="row">
                                    {{ $loan->id }}
                                </th>
                                <td> {{ $loan->movie->title }} </td>
                                <td> {{ date('j F, Y, H:i', strtotime($loan->loan_date)) }} </td>
                                <td>
                                    @if($loan->status=='PENDIENT')
                                      {{ $loan->status}}
                                    @else
                                      {{ date('j F, Y, H:i', strtotime($loan->delivery_date)) }}
                                    @endif
                                </td>
                            </tr> 
                          @endforeach
                        @else
                          <p class="text-center text-muted p-2">This User Doesn't Have A Rental History Yet.</p>
                        @endif 
                      </tbody>
                    </table>
                </div>
            </div>

      @else
      <h3 class="text-muted p-2">Ups. This User Doesn't Exist.</h3>  
      <p><a href="{{ url('users') }}">Go Back.</a></p>
      
			@endif 
        </div>
	</div>
	
	<style>
		.cover{
			height: 18rem;
			object-fit: cover;
		}
	</style>

</x-app-layout> 