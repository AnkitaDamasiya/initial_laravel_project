@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-11">
                <h2>Restaurant</h2>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-success" href="#" data-toggle="modal" data-target="#addModal">Add</a>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered" id="restaurantTable">
 <thead>
 <tr>
 <th>Name</th>
 <th>Email</th>
 <th>Phone_No</th>
 <th>Restaurant_Code</th>
 <th width="280px">Action</th>
 </tr>
 </thead> 
 <tbody>
    @foreach ($restaurants as $restaurant)
      <tr id="{{ $restaurant->id }}">
          <td>{{ $restaurant->restaurant_name }}</td>
          <td>{{ $restaurant->email }}</td>
          <td>{{ $restaurant->restaurant_number }}</td>
          <td>{{ $restaurant->restaurant_code }}</td>
          <td>
            <a data-id="{{ $restaurant->id }}" class="btn btn-primary btnEdit">Edit</a>
            <a data-id="{{ $restaurant->id }}" class="btn btn-danger btnDelete">Delete</button>
          </td>
      </tr>
    @endforeach
 </tbody>
    </table>
 
 
<!-- Add Restaurant Modal -->
<div id="addModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
 
    <!-- Restaurant Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Restaurant</h4>
      </div>
   <div class="modal-body">
 <form id="addRestaurant" name="addRestaurant" action="{{ route('admin.restaurant.store') }}" method="post" enctype="multipart/form-data">
 @csrf
 <div class="form-group">
 <label for="txtFirstName">Restaurant Name:</label>
 <input type="text" class="form-control" id="restaurant_name" placeholder="Enter Restaurant Name" name="restaurant_name">
 </div>
 <div class="form-group">
 <label for="txtLastName">Restaurant Email:</label>
 <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email">
 </div>
 <div class="form-group">
 <label for="txtLastName">Restaurant Code:</label>
 <input type="text" class="form-control" id="restaurant_code" placeholder="Enter Restaurant Code" name="restaurant_code">
 </div>
 <div class="form-group">
 <label for="txtLastName">Restaurant Phone_no:</label>
 <input type="text" class="form-control" id="restaurant_number" placeholder="Enter Restaurant Phone_no" name="restaurant_number">
 </div>
 
 <div class="form-group">
 <label for="txtAddress">Restaurant Description:</label>
 <textarea class="form-control" id="restaurant_desc" name="restaurant_desc" rows="10" placeholder="Enter Description"></textarea>
 </div>
 <div class="form-group">
 <label for="txtLastName">Restaurant Image:</label>
 <input type="file" class="form-control" id="image" name="image">
 </div>
 <button type="submit" class="btn btn-primary">Submit</button>
 </form>
   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
<!-- Update Restaurant Modal -->
<div id="updateModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
 
    <!-- Restaurant Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Restaurant</h4>
      </div>
   <div class="modal-body">
 <form id="updateRestaurant" name="updateRestaurant" action="{{ route('admin.restaurant.update') }}" method="post">
 <input type="hidden" name="hdnRestauranttId" id="hdnRestauranttId"/>
 @csrf
 <div class="form-group">
 <label for="txtFirstName">Restaurant Name:</label>
 <input type="text" class="form-control" id="restaurant_name" placeholder="Enter Restaurant Name" name="restaurant_name">
 </div>
 <div class="form-group">
 <label for="txtFirstName">Email:</label>
 <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email" disabled>
 </div>
 <div class="form-group">
 <label for="txtLastName">Restaurant Code:</label>
 <input type="text" class="form-control" id="restaurant_code" placeholder="Enter Restaurant Code" name="restaurant_code">
 </div>
 <div class="form-group">
 <label for="txtLastName">Restaurant Phone_no:</label>
 <input type="text" class="form-control" id="restaurant_number" placeholder="Enter Phone_no" name="restaurant_number">
 </div>
 <div class="form-group">
 <label for="txtAddress">Restaurant Description:</label>
 <textarea class="form-control" id="restaurant_desc" name="restaurant_desc" rows="10" placeholder="Enter Description"></textarea>
 </div>
 <button type="submit" class="btn btn-primary">Submit</button>
 </form>
   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script>
  $(document).ready(function () {
    $("#addRestaurant").validate({
      rules: {
      restaurant_name: "required",
      restaurant_code : "required",
      restaurant_number : "required",
      email  : "required",
      image : "required",
      restaurant_desc: "required"
      },
      messages: {
      },
      submitHandler: function(form) {
          var form_action = $("#addRestaurant").attr("action");
        $.ajax({
          data: $('#addRestaurant').serialize(),
          url: form_action,
          type: "POST",
          dataType: 'json',
          success: function (data) {
          var restaurant = '<tr id="'+data.id+'">';
            restaurant += '<td>' + data.restaurant_name + '</td>';
            restaurant += '<td>' + data.email + '</td>';
            restaurant += '<td>' + data.restaurant_number + '</td>';
            restaurant += '<td>' + data.restaurant_code + '</td>';
            restaurant += '<td><a data-id="' + data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
            restaurant += '</tr>';            
            $('#restaurantTable tbody').prepend(restaurant);
            $('#addRestaurant')[0].reset();
            $('#addModal').modal('hide');
          },
          error: function (data) {
          }
        });
      }
    });
 
    //When click edit restaurant
    $('body').on('click', '.btnEdit', function () {
      var restaurant_id = $(this).attr('data-id');
      $.get('restaurant/' + restaurant_id +'/edit', function (data) {
          $('#updateModal').modal('show');
          $('#updateRestaurant #hdnRestauranttId').val(data.id); 
          $('#updateRestaurant #restaurant_name').val(data.restaurant_name);
          $('#updateRestaurant #restaurant_code').val(data.restaurant_code);
          $('#updateRestaurant #restaurant_desc').val(data.restaurant_desc);
          $('#updateRestaurant #restaurant_number').val(data.restaurant_number);
          $('#updateRestaurant #email').val(data.email);
      })
   });

  // Update the restaurant
   var form_action = $("#updateRestaurant").attr("action");
  $.ajax({
    data: $('#updateRestaurant').serialize(),
    url: form_action,
    type: "POST",
    dataType: 'json',
      success: function (data) {
        alert(data);
      var restaurant = '<td>' + data.id + '</td>';
      restaurant += '<td>' + data.restaurant_name + '</td>';
      restaurant += '<td>' + data.email  + '</td>';
      restaurant += '<td>' + data.restaurant_number + '</td>';
      restaurant += '<td>' + data.restaurant_code + '</td>';
      restaurant += '<td><a data-id="' + data.id + '" class="btn btn-primary btnEdit">Edit</a>&nbsp;&nbsp;<a data-id="' + data.id + '" class="btn btn-danger btnDelete">Delete</a></td>';
      $('#restaurantTable tbody #'+ data.id).html(restaurant);
      $('#updateRestaurant')[0].reset();
      $('#updateModal').modal('hide');
      },
      error: function (data) {
      }
  });


   //delete student
  $('body').on('click', '.btnDelete', function () {
      var restaurant_id = $(this).attr('data-id');
      $.get('restaurant/' + restaurant_id +'/delete', function (data) {
          $('#restaurantTable tbody #'+ restaurant_id).remove();
      })
   }); 
 
});   
</script>
@endsection