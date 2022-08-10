<?php 
include 'config.php';
include 'header.php';

$obj = new Config();

if(isset($_POST["submit"]))
{
    $name = $_FILES['image']['name'];
	$tmp_name = $_FILES['image']['tmp_name'];
	
	$target_dir = "savedImage/".$name;
	move_uploaded_file($tmp_name, $target_dir);
	
	$obj->name = $_POST['ename'];
    $obj->phone = $_POST['ephone'];
    $obj->address = $_POST['eaddress'];
    $obj->image = $target_dir; 
    $obj->cid = $_POST['eclass'];

    $obj->insert($obj);

    header("Location: index.php");
}
?>

<section class="py-5">
	<div class="container">	
		<div class="row">
		<div class="col-md-7 mx-auto">
		<div class="card">
		    <div class="card-header text-center">
				<h4>Create New Employee</h4>
			</div>
			<div class="card-body mt-4">
				<form class="post-form" action="" method="post" enctype="multipart/form-data">
					<div class="row mb-3">
						<label class="col-form-label col-md-3">Name</label>
						<div class="col-md-9">
							<input class="form-control" type="text" name="ename" required/>
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-form-label col-md-3">Phone</label>
						<div class="col-md-9">
							<input class="form-control" type="text" name="ephone" required/>
						</div>	
					</div>
					<div class="row mb-3">
						<label class="col-form-label col-md-3">Address</label>
						<div class="col-md-9">
							<input class="form-control" type="text" name="eaddress" required/>
					    </div>
					</div>
					<div class="row mb-3">
						<label class="col-form-label col-md-3">Image</label>
						<div class="col-md-9">
							<input class="form-control" type="file" name="image"/>
					    </div>
					</div>
					<div class="row mb-3">
						<label class="col-form-label col-md-3">Class</label>
						<div class="col-md-9">
							<select class="form-select" name="eclass">
							<option value="" selected disabled>Select Class</option>
							
							<?php			
								$sql = "SELECT * FROM employeeclass";
								$obj->sql($sql);
								foreach($obj->getResult() as $k => $v)
								{
									echo "<option value =".$v['cid'].">".$v['cname']."</option>";
							   	} 
							?>
							</select>
						</div>	
					</div>
					
					<div class="row mb-3">
					    <label class="col-form-label col-md-3"></label>
						<div class="d-grid col-md-9">
						    <input class="btn btn-outline-success" name="submit" type="submit" value="Save" />
				        </div>
					</div>
				</form>
			</div>
		</div>
		</div>	
		</div>	
	</div>
</section>

<?php include 'footer.php'; ?>
