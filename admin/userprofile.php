<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách User trong hệ thống</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Username</th>
							<th>Email</th>
							<th>Số điện thoại</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd gradeX">
							<td>01</td>
							<td>Internet</td>
							<td>Internet</td>
							<td>Internet</td>
							<td>Internet</td>
							<td>Internet</td>
							<td><a href="">Sửa</a> || <a href="">Xóa</a></td>
						</tr>
						
						
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

