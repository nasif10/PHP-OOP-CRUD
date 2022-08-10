<?php
include 'config.php';
include 'header.php';

$obj = new Config();

if(isset($_GET['id'])){
	$eid = $_GET['id'];
	$obj->delete('id ='.$eid);
	header("Location: index.php");
}

?>

<section class="py-5">
	<div class="container">
		<h3 class="mb-4">Employee Records</h3>
		
		<table class="table table-bordered table-hover" cellpadding="2px">
			<thead class="table-light">
				<th scope="col">Id</th>
				<th scope="col">Name</th>
				<th scope="col">Phone</th>
				<th scope="col">Address</th>
				<th scope="col">Picture</th>
				<th scope="col">Class</th>     
				<th scope="col">Action</th>
			</thead>
			<tbody>
			<?php
				$obj = new Config();
				$obj->select('employee', 'employeeclass', 'employee.cid = employeeclass.cid', 'id', 5);

				foreach($obj->getResult() as $k => $v)
				{
			?>
					<tr>
						<td><?php echo $v['id']; ?></td>
						<td><?php echo $v['name']; ?></td>
						<td><?php echo $v['phone']; ?></td>
						<td><?php echo $v['address']; ?></td>
						<td style="text-align:center;"><img src="<?php echo $v['image']; ?>" alt="N" width="45" height="45"></td> 
						<td><?php echo $v['cname']; ?></td>               
						<td style="text-align: center;">
							<a role="button" href='update.php?id=<?php echo $v['id']; ?>'><i class="bi bi-pencil-square px-2" style="font-size: 1.2rem; color: Orange;"></i></a>
							<a role="button" href='index.php?id=<?php echo $v['id']; ?>'><i class="bi bi-trash px-2" style="font-size: 1.2rem; color: #df4759;"></i></a>
						</td>
					</tr>
			<?php
				} 
			?>
			</tbody>
		</table>

		<nav aria-label="Page navigation example">
			<ul class="pagination justify-content-center pt-4">
				

			<?php
				if(isset($_GET['page']) && $_GET['page']>1){
					echo '<li class="page-item"><a class="page-link" href="index.php?page='.($_GET['page']-1).'">Previous</a></li>';
				}
				$total_page = $obj->pagination('employeeclass', 'employee.cid = employeeclass.cid', 5);
				 
				for ($i = 1; $i <= $total_page; $i++)
				{
					$cls = "";
					if(isset($_GET['page'])){
						if($i == $_GET['page']){
							$cls = "active";
						}
					}
					echo '<li class="page-item '.$cls.'"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>'; 							
				}
				
				if(isset($_GET['page']) && ($total_page>$_GET['page'])){
					echo '<li class="page-item"><a class="page-link" href="index.php?page='.($_GET['page']+1).'">Next</a></li>';
				}		
		    ?>	
			</ul>
		</nav>
	</div>
</section>

<?php include 'footer.php'; ?>
