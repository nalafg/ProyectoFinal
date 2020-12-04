<x-app-layout>
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="col m-2">
			<button class="btn btn-primary float-right" data-toggle="modal" data-target="#addCategory">
				Add Category
			</button>
		</div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">
                
            	<table class="table table-striped table-bordered">
				  <thead class="thead-dark ">
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">Name</th>
				      <th scope="col">Description</th>
				      <th scope="col">Movies</th>
				      <th scope="col">Actions</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@if (isset($categories) && count($categories)>0)
				  	@foreach ($categories as $category)
				  	<tr>
				      <th scope="row">
				      	{{ $category->id }}
				      </th>
				      <td> {{ $category->name }} </td>
				      <td> {{ $category->description }} </td>
				      <td> {{ count($category->movie) }} </td>
				      <td>
				      	<div class="btn-group" role="group" aria-label="Button group with nested dropdown"> 

						  <div class="btn-group" role="group">
						    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						      Actions
						    </button>
						    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
						      <a onclick="edit({{ $category->id }},'{{ $category->name }}','{{ $category->description }}')" data-toggle="modal" data-target="#editCategory" class="dropdown-item" href="#">
						      	Update
						      </a>
						      <a onclick="remove({{ $category->id }},this)" class="dropdown-item" >
						      	Delete
						      </a>
						    </div>
						  </div>
						</div>
				      </td>
				    </tr> 
				  	@endforeach
				  	@endif 
				  </tbody>
				</table>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editCategory" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <form method="post" action="{{ url('categories') }}" >
	      	@csrf
	      	@method('PUT')

	      	<div class="modal-body">
		        
	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Name
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="text" class="form-control" placeholder="Category example" aria-label="Category example" aria-describedby="basic-addon1" id="name" name="name" required="">
					</div>
				 </div>

				 <div class="form-group">
				    <label for="exampleInputEmail1">
				    	Description
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <textarea class="form-control" rows="5" placeholder="description of de category" name="description" id="description"></textarea>
					</div>
				 </div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">
		        	Cancel
		        </button>
		        <button type="submit" class="btn btn-primary">
		        	Update data
		        </button>
		        <input type="hidden" name="id" id="id" >
		      </div>

	      </form>

	    </div>
	  </div>
	</div>

	<div class="modal fade" id="addCategory" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <form method="post" action="{{ url('categories') }}" >
	      	@csrf 

	      	<div class="modal-body">
		        
	      		<div class="form-group">
				    <label for="exampleInputEmail1">
				    	Name
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <input type="text" class="form-control" placeholder="Category example" aria-label="Category example" aria-describedby="basic-addon1" name="name" required="">
					</div>
				 </div>

				 <div class="form-group">
				    <label for="exampleInputEmail1">
				    	Description
				    </label>
				    <div class="input-group mb-3">
					  <div class="input-group-prepend">
					    <span class="input-group-text" id="basic-addon1">@</span>
					  </div>
					  <textarea class="form-control" rows="5" placeholder="description of de category" name="description"></textarea>
					</div>
				 </div>

		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">
		        	Cancel
		        </button>
		        <button type="submit" class="btn btn-primary">
		        	Save data
		        </button>
		      </div>

	      </form>

	    </div>
	  </div>
	</div> 

	<x-slot name="scripts">
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <script type="text/javascript">
     	
     	function edit(id,name,description){
     		$("#name").val(name)
			$("#description").val(description)
			$("#id").val(id)
     	}

     	function remove(id,target){

     		swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover this record!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {

			  	axios({
				  method: 'delete',
				  url: '{{ url('categories') }}',
				  data: {
				    id: id,
				    _token: '{{ csrf_token() }}'
				  }
				}).then(function (response) { 
				    if(response.data.code==200){
				    	swal(response.data.message, {
					      icon: "success",
					    });
				    	$(target).parent().parent().parent().parent().parent().remove();
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
     		console.log(id)
     	}
     </script>
    </x-slot>
</x-app-layout>