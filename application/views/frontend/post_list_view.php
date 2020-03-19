<!DOCTYPE html>
<html>
	<head>
		<title>Blog Post</title>
	</head>
	<link rel="icon" href="assets/frontend/image/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets/frontend/image/favicon.png" type="image/x-icon">	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.css">
	<link rel="stylesheet" type="text/css" href="assets/frontend/css/post.css">
	<style>
		.square {
		    width: 100%;
		    padding-bottom: 100%;
		    background-size: cover;
		    background-position: center;
		}
		.alert {
		    position: relative;
		    padding: 0rem !important; 
		    margin-bottom: 1rem;
		    border: 1px solid transparent;
		    border-radius: .25rem;
		}
	</style>

	<body>

		<div class="container" style="margin-top: 3%">
			<div class="row">
			<?php
			for($i = 0; $i < count($list); $i ++)
			{
			?>
				<div class="col-md-3">
					<div class="card">
						<div class="card" >
						  	<!-- <img class="card-img-top" src="<?=$list[$i]['path']?>" alt="Card image cap"> -->
						  	<div class="card-body">
							    <!-- <h5 class="card-title">Card title</h5> -->
							    <p class="card-text"><?=$list[$i]['message']?></p>
							    <a href="#" class="btn btn-primary" onclick="show_modal(<?=$list[$i]['id']?>)">Publish</a>
						  	</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
				
			</div>
		</div>

	</body>

	<input type="hidden" id = "publish_modal" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModalLong">

	<div class="modal" tabindex="-1" role="dialog" id = "exampleModalLong" style="">
		<div class="modal-dialog" role="document" style="width: 100%;max-width: 70%">
			<div class="modal-content">
			  	<div class="modal-header">
				    <h5 class="modal-title">Post</h5>
				    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				      	<span aria-hidden="true">&times;</span>
				    </button>
			  	</div>
			  	<div class="modal-body">

			  		<div class="row">
			  			<div class="col-md-12">
			  				<div class="row">
					    		<div class="col-md-3">
					    			<img src="" id = "post_image" style="width: 100%">
					    		</div>
					    		<div class="col-md-9">
					    			<div class="row">
					    				
					    				<div class="col-md-3"><p>Message : </p></div>
					    				<div class="col-md-9">
					    					<p id = "post_message"></p>
					    				</div>
					    				<div class="col-md-3"><p>Link : </p></div>
					    				<div class="col-md-9">
					    					<p id = "post_link"></p>
					    				</div>
					    				<div class="col-md-3"><p>hashtag : </p></div>
					    				<div class="col-md-9">
					    					<p id = "post_hash"></p>
					    				</div>
					    				<div class="col-md-3"><p>Add-on message : </p></div>
					    				<div class="col-md-9">
					    					<p id = "post_addon"></p>
					    				</div>
					    			</div>
					    		</div>
					    	</div>

					    	<div class="row">
					    		<div class="col-md-12" style="text-align: right">
					    			<button type = "button" class = "btn btn-primary">Linkedin</button>
					    			<a href = "publish_twitter_controller" class = "btn btn-primary">Twitter</a>
					    			<button type = "button" class = "btn btn-primary">Facebook</button>
					    			<button type = "button" class = "btn btn-primary">Instagram</button>
					    		</div>
					    	</div>
			  			</div>
			  		</div>
			  	</div>
			  	
			</div>
		</div>
	</div>
		


	<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/frontend/js/post.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.js"></script>

	<script>

		function show_modal(id){
			$.ajax({
				url : "post_list_controller/save_selected_post",
				type : "POST",
				data : {
					id : id,
				},
				dataType : "JSON",
				success : function(res)
				{
					console.log(res);
					$("#post_image").attr("src",res[0]['path']);
					$("#post_message").text(res[0]['message']);
					$("#post_hash").text(res[0]['hash']);
					$("#post_link").text(res[0]['link']);
					$("#post_addon").text(res[0]['addon']);
					$("#publish_modal").click();
				}
			})
		}
		$(document).ready(function(){
			
			
		})
	</script>
</html>