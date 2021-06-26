<?php include 'inc/header.php';?>
<main>
                    <!-- <div class="container-fluid px-4">
                        <h1 class="mt-4">Danh sách danh mục câu hỏi</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Sidenav Light</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
                                This page is an example of using the light side navigation option. By appending the
                                <code>.sb-sidenav-light</code>
                                class to the
                                <code>.sb-sidenav</code>
                                class, the side navigation will take on a light color scheme. The
                                <code>.sb-sidenav-dark</code>
                                is also available for a darker option.
                            </div>
                        </div>
                    </div>  -->  
<div class="container-fluid px-4"> 
    <h1 class="mt-4">Danh sách User</h1>  
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase mb-0">Quản lý User</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table no-wrap user-table mb-0">
                              <thead>
                                <tr>
                                  <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                  <th scope="col" class="border-0 text-uppercase font-medium">Firstname</th>
                                  <th scope="col" class="border-0 text-uppercase font-medium">Lastname</th>
                                  <th scope="col" class="border-0 text-uppercase font-medium">Username</th>
                                  <th scope="col" class="border-0 text-uppercase font-medium">Email</th>
                                  <th scope="col" class="border-0 text-uppercase font-medium">PhoneNumber</th>
                                  <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>
                                </tr>
                              </thead>
                              <tbody>
                                
                                <tr>
                                  <td class="pl-4">6</td>
                                  <td>
                                      <h5 class="font-medium mb-0">Charlotte Brown</h5>
                                      <span class="text-muted">Texas, Unitedd states</span>
                                  </td>
                                  <td>
                                      <span class="text-muted">Visual Designer</span><br>
                                      <span class="text-muted">Past : teacher</span>
                                  </td>
                                  <td>
                                      <span class="text-muted">daniel@website.com</span><br>
                                      <span class="text-muted">999 - 444 - 555</span>
                                  </td>
                                  <td>
                                      <span class="text-muted">15 Mar 1988</span><br>
                                      <span class="text-muted">10: 55 AM</span>
                                  </td>
                                  <td>
                                    <select class="form-control category-select" id="exampleFormControlSelect1">
                                      <option>Modulator</option>
                                      <option>Admin</option>
                                      <option>User</option>
                                      <option>Subscriber</option>
                                    </select>
                                  </td>
                                  <td>
                                    <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle"><i class="fa fa-key"></i> </button>
                                    <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-trash"></i> </button>
                                    <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-edit"></i> </button>
                                    <button type="button" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-upload"></i> </button>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
</div>        
</main>
<?php include 'inc/footer.php';?>

<style type="text/css">
body{
    background: #edf1f5;
    margin-top:20px;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: 0;
}
.btn-circle.btn-lg, .btn-group-lg>.btn-circle.btn {
    width: 50px;
    height: 50px;
    padding: 14px 15px;
    font-size: 18px;
    line-height: 23px;
}
.text-muted {
    color: #8898aa!important;
}
[type=button]:not(:disabled), [type=reset]:not(:disabled), [type=submit]:not(:disabled), button:not(:disabled) {
    cursor: pointer;
}
.btn-circle {
    border-radius: 100%;
    width: 40px;
    height: 40px;
    padding: 10px;
}
.user-table tbody tr .category-select {
    max-width: 150px;
    border-radius: 20px;
}
</style>

                