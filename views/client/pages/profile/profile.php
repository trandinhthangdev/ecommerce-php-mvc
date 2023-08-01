<?php  
if(count($customer) != 0)
{
	$name = $customer[0]['name'];
	$address = $customer[0]['address'];
	$phone = $customer[0]['phone'];	
}
else 
{
	$name = '';
	$address = '';
	$phone = '';	
}

?>
<div class="container mt-4">
    <h2 class="font-weight-bolder text-center text-dark">Profile</h2>
	<div class="row border-bottom pb-5 mb-5">
		<div class="col-12 text-right">
			<button class="btn btn-success" data-toggle="modal" data-target="#update_profile_modal" id="update_profile_btn"><span><i class="fa fa-edit"></i></span> Update</button>
		</div>
	</div>
	<div class="row text-dark" style="height: 360px;">
		<div class="col-12">
			<h5 class="font-weight-bolder">Name : </h5>
			<span class="font-italic"><?= $name; ?></span>
			<h5 class="font-weight-bolder">Address : </h5>
			<span class="font-italic"><?= $address; ?></span>
			<h5 class="font-weight-bolder">Phone : </h5>
			<span class="font-italic"><?= $phone; ?></span>
		</div>
	</div>
</div>


<!-- The Modal -->
<div class="modal" id="update_profile_modal">
    <div class="modal-dialog">
        <div class="modal-content text-dark font-weight-bolder">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Update Profile</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="POST" id="update_profile_form">
				    <div class="form-group">
				        <label for="name">Name :</label>
				        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
				    </div>
				    <div class="form-group">
				        <label for="address">Address :</label>
				        <input type="text" class="form-control" id="address" placeholder="Enter address" name="address" required>
				    </div>
				    <div class="form-group">
				        <label for="phone">Phone :</label>
				        <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone" required>
				    </div>
				    <button type="submit" class="btn btn-primary">Update</button>
				    <button type="reset" class="btn btn-info">Reset</button>
				</form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#update_profile_btn').click(function(){
			$.ajax({
				url : 'view_customer.html',
				type : 'GET',
				dataType : 'JSON',
				success : function(result){
					$('#name').val(result.name);
					$('#address').val(result.address);
					$('#phone').val(result.phone);
				}
			});
		});
		$('#update_profile_form').on('submit', function(event){
			event.preventDefault();
			var data_update_profile = $(this).serializeArray();
			var data = {};
			$.each(data_update_profile, function(key, value){
				data[value.name] = value.value;		
			});
			$.ajax({
				url : 'update_profile.html',
				type : 'POST',
				data : data,
				dataType : 'text',
				success : function(result){
					toastr.success(result, 'Response',{timeOut: 400});
					setTimeout('location.reload();', 400);
				}
			});
		});

	});
</script>