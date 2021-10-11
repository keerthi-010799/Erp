<?php
include("database/db_conection.php");//make connection here
if(isset($_POST['submit']))
{
	$userid ="";
	$prefix = "DAPL00";
	
    $user_name=$_POST['user_name'];//here getting result from the post array after submitting the form.
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$gender = $_POST['gender'];
    $user_email=$_POST['email'];//same
    $user_password=$_POST['password'];//same
	$user_repassword = $_POST['repassword'];//same
	$user_mobile = $_POST['mobile'];
	$user_address = $_POST['address']; 
	$groupname = $_POST['groupname'];
	$groupname = $_POST['groupname'];
	$compcode = $_POST['compcode'];
	
	//$check_username="select * from userprofile WHERE username='$user_name'";
	$sql="SELECT id FROM userprofile WHERE username='$user_name' LIMIT 1";
	//echo $sql;
	$run_query = mysqli_query($dbcon, $sql); 
    $uname_check = mysqli_num_rows($run_query);
    if (strlen($user_name) < 3 || strlen($user_name) > 16) {
	    
		//echo '<strong style="color:#F00;">3 - 16 characters please</strong>';
	    //exit();
		
		echo "<script> alert (' Username must be between 3 and 16 characters')</script>";
	   exit();
		
		
    }
	
   $run_query1=mysqli_query($dbcon,$sql);
	if(mysqli_num_rows($run_query1)>0)
   {
    echo "<script>alert('User $user_name is already exist in our database, Please try another one!')</script>";
      //$fmsg= "Email already exists";
      exit();
   }
	
	
	if (is_numeric($user_name[0])) {
	   // echo '<strong style="color:#F00;">Usernames must begin with a letter</strong>';
		echo "<script>alert('Usernames must begin with a letter')</script>";
	    exit();
    }

     //here query check weather if user already registered so can't register again.
    $check_email_query="select id from userprofile WHERE useremail='$user_email' LIMIT 1";
    $run_query=mysqli_query($dbcon,$check_email_query);

    if(mysqli_num_rows($run_query)>0)
    {
        echo "<script>alert('Email $user_email address is already in use in the system')</script>";
        //$fmsg= "Email already exists";
        
		exit();
    }
	
	if($user_password != $user_repassword)
    {
        echo "<script>alert('Password does not match,please enter correct password')</script>";
        //$fmsg= "Email already exists";
        exit();
    }
	
	//insert the user into the database.
	
	//$image =$_FILES['image']['tmp_name'];
    //$image_name = $_FILES['image']['image_name'];
														
   //$image = file_get_contents($image);
   
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
		
	} else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
	
	//Generating Userid
	$sql="SELECT MAX(id) as latest_id FROM userprofile ORDER BY id DESC";
	if($result = mysqli_query($dbcon,$sql)){
		$row   = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$maxid = $row['latest_id'];
			$maxid+=1;
			
			$userid = $prefix.$maxid;
		}else{
			$maxid = 0;
			$maxid+=1;
			$userid = $prefix.$maxid;
		}
	}

	

   //$image =base64_encode($image);	
    $insert_userprofile="insert into userprofile (userid,username,firstname,lastname,gender,useremail,userpassword,repass,mobile,address,groupname,compcode,image_name) 
	VALUE ('$userid','$user_name','$firstname','$lastname','$gender','$user_email','$user_password','$user_repassword','$user_mobile','$user_address','$groupname','$compcode','$target_file')";
	//echo $insert_userprofile;
    if(mysqli_query($dbcon,$insert_userprofile))
    {
        //echo"<script>window.open('blank.html','_self')</script>";
		//<div class = "alert alert-success">Success! Well done its submitted.</div>
		
		//$smsg = "success";
		
		echo "<script>alert('User creation Successfully created')</script>";
		header("location:listUsers.php");
    } else {
		die('Error: ' . mysqli_error($dbcon));
		echo "<script>alert('User creation unsuccessful ')</script>";
		exit; 
	}
}
?>

<?php include('header.php');?>
	<!-- End Sidebar -->


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">


			<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">User Registration</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Create User</li>
                                    </ol>
                                    <div class="clearfix"></div>
                            </div>
					</div>
			</div>
            <!-- end row -->
			

			<!--div class="alert alert-success" role="alert">
				  <h4 class="alert-heading">Parsley JavaScript form validation library</h4>
				  <p>You can find examples and documentation about Parsley form validation library here: <a target="_blank" href="http://parsleyjs.org/">Parsley documentation</a></p>
			</div-->

			
			<div class="row">
			
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">						
						<div class="card mb-3">
							<div class="card-header">
								<h3><i class="fa fa-hand-pointer-o"></i>Create User</h3>
								</div>
								
							<div class="card-body">
																
										<form autocomplete="off" action="#" enctype="multipart/form-data" method="post">
                                                    <div class="form-group">
                                                        <label>User Name<span class="text-danger">*</span></label>
                                                        <input type="text" name="user_name"  required placeholder="Enter user name" class="form-control" >
                                                    </div>
													 <div class="form-group">
                                                        <label for="firstname">Firstname<span class="text-danger">*</span></label>
                                                        <input type="text" name="firstname"  required placeholder="Enter user name" class="form-control" >
                                                    </div>
													 <div class="form-group">
                                                        <label for="Lastname">Lastname<span class="text-danger">*</span></label>
                                                        <input type="text" name="lastname"  required placeholder="Enter user name" class="form-control" >
                                                    </div>
												
											
											<div class="form-group">
											<label>Gender</label>
											<select name="gender" class="form-control" required>
											<option value="">- Open Gender-</option>
											
																	<option  value="1">Male</option>
																    <option  value="2">Female</option>
											</select>
											</div>
										
											
                                                    <div class="form-group">
                                                        <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                                        <input type="email" name="email"  required placeholder="Enter email" class="form-control" id="emailAddress">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pass1">Password<span class="text-danger">*</span></label>
                                                        <input id="pass1" type="password" name="password" placeholder="Password" required class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="passWord2">Confirm Password <span class="text-danger">*</span></label>
                                                        <input data-parsley-equalto="#pass1" type="password" name="repassword" required placeholder="Password" class="form-control" id="passWord2">
                                                    </div>
                                                   <div class="form-group">
                                                        <label>Mobile<span class="text-danger">*</span></label>
                                                        <div>
                                                            <input data-parsley-type="number" step="any" name="mobile" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                                        </div>
                                                    </div>                                                    
                                                    <div class="form-group">
                                                        <label>Address<span class="text-danger">*</span></label>
                                                        <div>
                                                            <textarea name="address" class="form-control" data-parsley-trigger="change" required></textarea>
                                                        </div>
                                                    </div>
													
											<div class="form-group">
                                                <label for="inputState">Organization ID<span class="text-danger">*</span></label>
                                                <select id="compcode" onchange="oncompcode(this);" class="form-control" required name="compcode">
                                                    <option selected>Open Org ID</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here
                                                    $sql = mysqli_query($dbcon,"SELECT concat( prefix,id ) AS compcode
																				FROM comprofile
																				ORDER BY id ASC
																				");
                                                      while ($row = $sql->fetch_assoc()){	
                                                        echo $compcode=$row['compcode'];
														echo '<option onchange="'.$row[''].'" value="'.$compcode.'" >'.$compcode.'</option>';
                                                      
													  }
                                                    ?>
                                                </select>
                                            </div>
													
											
                                            <div class="form-group">
                                                <label for="inputState">Groups<span class="text-danger">*</span></label>
                                                <select id="groupname" onchange="ongroup(this)" class="form-control"  name="groupname">
                                                    <option selected>Open Groups</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT groupname FROM groups");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $groupname=$row['groupname'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$groupname.'" >'.$groupname.'</option>';
                                                    }
                                                    ?>
                                                </select>
												
											
								<!-- Button trigger modal -->
								<!--a role="button" href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
								  User Group
								</a-->
								
								<a href="#custom-modal" data-target="#customModal" data-toggle="modal"> 
								<i class="fa fa-user-plus" aria-hidden="true"></i>Add User Group/Role</a><br></br>
								
								<!-- Modal -->
								<div class="modal fade custom-modal" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel2">Add User Group/Role</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
									  	<form action="#" enctype="multipart/form-data" method="post">									
									  
											<div class="form-group">
												<input type="text" class="form-control" name="addgroupname"  id="addgroupname"  placeholder="groupname">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="adddescription" id="adddescription"  placeholder="description">
											</div>
										</div>
										
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" name="submitgroup" id="submitgroup" class="btn btn-primary">Save & Associate</button>
									  </div>
									</div>
								  </div>
								</div>
													<div class="form-group">
													<label>
													<div class="fa-hover col-md-12 col-sm-12">
													<i class="fa fa-folder-open bigfonts" aria-hidden="true"></i>Upload User Profile Image</div></label> 
													<input type="file" name="image" class="form-control">
													</div>
													
								
                                                    <div class="form-group text-right m-b-0">
                                                        <button class="btn btn-primary" name="submit" type="submit">
                                                            Submit
                                                        </button>
                                                        <button type="reset" name="cancel" class="btn btn-secondary m-l-5">
                                                            Cancel
                                                        </button>
                                                    </div>

                                        </form>
										
							</div>														
						</div><!-- end card-->					
                    </div>

					
					
			
									
									<script >$(function () {
									  var $sections = $('.form-section');

									  function navigateTo(index) {
										// Mark the current section with the class 'current'
										$sections
										  .removeClass('current')
										  .eq(index)
											.addClass('current');
										// Show only the navigation buttons that make sense for the current section:
										$('.form-navigation .previous').toggle(index > 0);
										var atTheEnd = index >= $sections.length - 1;
										$('.form-navigation .next').toggle(!atTheEnd);
										$('.form-navigation [type=submit]').toggle(atTheEnd);
									  }

									  function curIndex() {
										// Return the current index by looking at which section has the class 'current'
										return $sections.index($sections.filter('.current'));
									  }

									  // Previous button is easy, just go back
									  $('.form-navigation .previous').click(function() {
										navigateTo(curIndex() - 1);
									  });

									  // Next button goes forward iff current block validates
									  $('.form-navigation .next').click(function() {
										$('.demo-form').parsley().whenValidate({
										  group: 'block-' + curIndex()
										}).done(function() {
										  navigateTo(curIndex() + 1);
										});
									  });

									  // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
									  $sections.each(function(index, section) {
										$(section).find(':input').attr('data-parsley-group', 'block-' + index);
									  });
									  navigateTo(0); // Start at the beginning
									});
									//# sourceURL=pen.js
									</script>

								
							</div>														
						</div><!-- end card-->					
                    </div>
					
					
			</div>





            </div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

    </div>
	<!-- END content-page -->
    
	<footer class="footer">
		<span class="text-right">
		Copyright@<a target="_blank" href="#">Dhiraj Agro Products Pvt. Ltd.,</a>
		</span>
		<span class="float-right">
		Powered by <a target="_blank" href=""><span>e-Schoolz</span> </a>
		</span>
	</footer>
	
</div>
<!-- END main -->

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>

<!-- App js -->
<script src="assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->
<script src="assets/plugins/parsleyjs/parsley.min.js"></script>
<script>
  $('#form').parsley();
</script>
<!-- END Java Script for this page -->

<!-- BEGIN Java Script for this page -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(document).ready(function(){
    
	$('#example1').click(function(){
       swal("Hello world!");
    });
	
	$('#example2').click(function(){
       swal("Here's the title!", "...and here's the text!");
    });
	
	$('#submit').click(function(){
       swal("User Created Successfully!", "Click OK button", "success");
    });
	
	$('#example4').click(function(){
       swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover this imaginary file!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
				swal("Poof! Your imaginary file has been deleted!", {
				  icon: "success",
				});
			  } else {
				swal("Your imaginary file is safe!");
			  }
			});
    });
	
	$('#example5').click(function(){
       swal("Write something here:", {
			  content: "input",
			})
			.then((value) => {
			  swal(`You typed: ${value}`);
			});
    });
	
	$('#example6').click(function(){
       swal({
				text: 'Search for a movie. e.g. "Titanic".',
				  content: "input",
				  button: {
					text: "Search!",
					closeModal: false,
				  },
				})
				.then(name => {
				  if (!name) throw null;
				 
				  return fetch(`https://itunes.apple.com/search?term=${name}&entity=movie`);
				})
				.then(results => {
				  return results.json();
				})
				.then(json => {
				  const movie = json.results[0];
				 
				  if (!movie) {
					return swal("No movie was found!");
				  }
				 
				  const name = movie.trackName;
				  const imageURL = movie.artworkUrl100;
				 
				  swal({
					title: "Top result:",
					text: name,
					icon: imageURL,
				  });
				})
				.catch(err => {
				  if (err) {
					swal("Oh noes!", "The AJAX request failed!", "error");
				  } else {
					swal.stopLoading();
					swal.close();
				  }
				});
    });
	
});
</script>
<script>
                function oncompcode(){

                    console.log(this);
                }
            </script>

<!-- END Java Script for this page -->
<script>
                function ongroup(){

                    console.log(this);
                }
            </script>
			
<script>
$('document').ready(function(){
	//addGroupnames_ajax.php
	$('#submitgroup').click(function(){
		var description = $('#adddescription').val();
		var groupname = $('#addgroupname').val();
		//alert(groupname+description);
		$.ajax ({
           url: 'addGroupnames_ajax.php',
		   type: 'post',
		   data: {
				  groupname:groupname,
				  description:description
				},
		   //dataType: 'json',
           success:function(response){
				if(response!=0){
					var new_option ="<option>"+response+"</option>";
					$('#groupname').append(new_option);
					 $('#customModal').modal('toggle');
				}else{
					alert('Error in inserting new Group,try another group');
				}
			}
        
         });
		 
		 });
});
			
</script>			

</body>
</html>