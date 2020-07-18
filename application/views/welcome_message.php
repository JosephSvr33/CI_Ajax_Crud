<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="alternate" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<title>CI Ajax Crud</title>
  </head>
  <body>
    <div class="container">
		<div class="row">
			<div class="col-md-12 mt-5">
				<h2 class="text-center">
					CI Ajax Crud
				</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 mt-2">
				<!-- Button trigger modal -->
					<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#staticBackdrop">
					Add
					</button>

					<!-- Modal -->
					<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticBackdropLabel">Add Country</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="form_country">
								<div class="form-group">
									<label for="code">Country Code</label>
									<input type="text" id="code" name="code" class="form-control">
								</div>
								<div class="form-group">
									<label for="country">Country</label>
									<input type="text" id="country" name="country" class="form-control">
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-outline-primary" id="add">Add</button>
						</div>
						</div>
					</div>
					</div>
			</div>
		</div>
		<!-- edit modal -->
		<div class="modal fade" id="EditModel" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="staticBackdropLabel">Edit Country</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="form_edit_country">
								<input type="hidden" id="edit_modal_id" name="edit_modal_id" value="">
								<div class="form-group">
									<label for="code">Country Code</label>
									<input type="text" id="edit_code" name="edit_code" class="form-control">
								</div>
								<div class="form-group">
									<label for="country">Country</label>
									<input type="text" id="edit_country" name="edit_country" class="form-control">
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="button" class="btn btn-outline-primary" id="update" onclick=updateFuntion()>Update</button>
						</div>
						</div>
					</div>
					</div>
				<!-- edit modal  ends-->

		<div class="row">
			<div class="col-md-12 mt-3">
					<table class="table table-hover">
						<thead>
							<th>Country Code</th>
							<th>Country</th>
							<th>Action</th>
						</thead>
						<tbody id="tbody">

						</tbody>
					</table>
			</div>
		</div>
	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	
	<script src="assets/js/jquery.validate.min.js"></script>
	<script src="assets/js/additional-methods.min.js"></script>
	<script src="assets/js/UserCreationValid.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<script>

		$(document).ready( function () {
    		$('#myTable').DataTable();
		} );

		$(document).on("click", "#add", function(e) {
			
			if ($("#form_country").valid()) {
			
			var code = document.getElementById('code').value;
			var country = document.getElementById('country').value;
			
			 $.ajax({
			 	url : "<?php echo base_url();?>insert",
			 	type : "post",
			 	dataType : "json",
			 	data : {
			 		code : code,
					country : country
			 	},
			 	success: function(data) {
					 console.log(data);
					 $('#staticBackdrop').modal('hide');

					 if (data.responce == "success") {
						 toastr["success"](data.message, "Success")
						toastr.options = 
						{
							"closeButton": true,
							"debug": false,
							"newestOnTop": false,
							"progressBar": true,
							"positionClass": "toast-top-right",
							"preventDuplicates": false,
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}
					 }
					 else{
						toastr["error"](data.message, "Error")
						toastr.options = 
						{
							"closeButton": true,
							"debug": false,
							"newestOnTop": false,
							"progressBar": true,
							"positionClass": "toast-top-right",
							"preventDuplicates": false,
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}
					 }

					 	fetch();
			 	}
			 });
			}
			$("#form_country")[0].reset();
			
		});

		function fetch(){
			$.ajax({
				url : "<?php echo base_url();?>fetch",
				type : "post",
				dataType : "json",
				success: function(data){
					var tbody = "";

					for(var key in data){
						tbody += "<tr>";
						tbody += "<td>"+ data[key]['Country_Code'] +"</td>";
						tbody += "<td>"+ data[key]['Country_Name'] +"</td>";
						tbody += `<td>
									<button class="btn btn-outline-info dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-cogs" aria-hidden="true"></i></button>
									<div class="dropdown-menu">
									<button class="btn btn-primary dropdown-item" onclick="editFuntion(${data[key]['Country_Id']})">Edit</button>
									<div role="separator" class="dropdown-divider"></div>
									<button class="btn btn-warning dropdown-item" onclick="deleteFuntion(${data[key]['Country_Id']})">Delete</button>
									</div>
						</td>`;
					}
					$("#tbody").html(tbody);
				}
			});
		}

		function editFuntion(id){
			var edit_id = id;
			
			$.ajax({
				url : "<?php echo base_url()?>edit",
				type : "post",
				dataType : "json",
				data : {
					id : edit_id
				},
				success : function(data){
					
					if (data.responce == "success") {
						$('#EditModel').modal('show');
						$('#edit_modal_id').val(data.post.Country_Id);
						$('#edit_code').val(data.post.Country_Code);
						$('#edit_country ').val(data.post.Country_Name);
					}
					else{
						toastr["error"](data.message, "Error")
						toastr.options = 
						{
							"closeButton": true,
							"debug": false,
							"newestOnTop": false,
							"progressBar": true,
							"positionClass": "toast-top-right",
							"preventDuplicates": false,
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}
					}
				} 
			});
		}

		function deleteFuntion(id){
			var del_id = id;
			
			const swalWithBootstrapButtons = Swal.mixin(
				{
				customClass: {
					confirmButton: 'btn btn-success',
					cancelButton: 'btn btn-danger mr-2'
				},
				buttonsStyling: false
				})

				swalWithBootstrapButtons.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes, delete it!',
				cancelButtonText: 'No, cancel!',
				reverseButtons: true
				}).then((result) => {
				if (result.value) {
					$.ajax({
						url : "<?php echo base_url();?>delete",
						type : "post",
						dataType : "json",
						data : {
							id : del_id
						},
						success : function(data){
							fetch();
							if (data.responce == "success") {
								swalWithBootstrapButtons.fire
								(
									'Deleted!',
									'Your file has been deleted.',
									'success'
								)
							}
						}
					});

					
				} else if (
					/* Read more about handling dismissals below */
					result.dismiss === Swal.DismissReason.cancel
				) {
					swalWithBootstrapButtons.fire(
					'Cancelled',
					'Your imaginary file is safe :)',
					'error'
					)
				}
				})
		}

		function updateFuntion(){
			var edit_id = $("#edit_modal_id").val();
			var edit_code = $("#edit_code").val();
			var edit_country = $("#edit_country").val();

			$.ajax({
				url : "<?php echo base_url()?>update",
				type : "post",
				dataType : "json",
				data : {
					id : edit_id,
					code : edit_code,
					country : edit_country
				},
				success: function(data){
					fetch();
					console.log(data);
					
					 $('#EditModel').modal('hide');

					 if (data.responce == "success") {
						 toastr["success"](data.message, "Success")
						toastr.options = 
						{
							"closeButton": true,
							"debug": false,
							"newestOnTop": false,
							"progressBar": true,
							"positionClass": "toast-top-right",
							"preventDuplicates": false,
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}
					 }
					 else{
						toastr["error"](data.message, "Error")
						toastr.options = 
						{
							"closeButton": true,
							"debug": false,
							"newestOnTop": false,
							"progressBar": true,
							"positionClass": "toast-top-right",
							"preventDuplicates": false,
							"onclick": null,
							"showDuration": "300",
							"hideDuration": "1000",
							"timeOut": "5000",
							"extendedTimeOut": "1000",
							"showEasing": "swing",
							"hideEasing": "linear",
							"showMethod": "fadeIn",
							"hideMethod": "fadeOut"
						}
					 }

					 	fetch();
				}
			});
			$("#form_edit_country")[0].reset();
		}
		

		//fetch data
		fetch();

	</script>
</body>
</html>