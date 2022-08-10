<?php 
include 'config.php';
include 'header.php'; 

$obj = new Config();

?>

<section class="py-5">
	<div class="container">
		<div class="row">
			<div class="col-md-7 mx-auto">
				<div class="card">
					<div class="card-header text-center">
						<h4>Query</h4>
					</div>
					<div class="card-body">
						<p class="card-title text-center">Enter SQL query in the textbox</p>
					
						<form class="post-form p-2" action="" method="POST"> 
							<div class="row mb-3">
								<textarea id="query_text" class="form-control" name="query" cols="64" rows="6" required></textarea></br></br>
								
							</div>
							<div class="row mb-2">
								<input class="btn btn-outline-secondary" type="submit" name="qbtn" value="Run Query"/>
							</div>
						</form>
					</div>	
				</div>
			
				<?php
					if(isset($_POST['qbtn'])){
						$query_text = $_REQUEST['query'];
						$sql = "SELECT * FROM employee";
						$result = $obj->sql($sql);
						$noOfRows = $result->num_rows;
						echo "<br>"."No. of rows in table 'employee' : ".$noOfRows;
			 
						$result = $obj->sql($query_text);
						$noOfRows = $result->num_rows;
						echo "<br>"."No. of rows matched : ".$noOfRows;
			 
						echo "<pre>";
							print_r($obj->getResult());
						echo "</pre>";
					}
				?>
		</div>
		</div>			
	</div>
</section>
	
<?php include 'footer.php'; ?>