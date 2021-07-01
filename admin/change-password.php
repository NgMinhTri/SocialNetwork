
<?php include 'inc/header.php';?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">           
            <hr class="mb-5">
                <div class="col-md-6 offset-md-3">
                    <span class="anchor" id="formChangePassword"></span>
                    <hr class="mb-5">

                    <!-- form card change password -->
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Thay đổi mật khẩu</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off">
                                <div class="form-group">
                                    <label for="inputPasswordOld">Mật khẩu hiện tại</label>
                                    <input type="password" class="form-control" id="inputPasswordOld" required="">
                                </div>
                                <div class="form-group">
                                    <label for="inputPasswordNew">Mật khẩu mới</label>
                                    <input type="password" class="form-control" id="inputPasswordNew" required="">
                                    <span class="form-text small text-muted">
                                            Mật khẩu phải từ 8-20 kí tự và <em>không</em> chứa khoảng trắng!
                                        </span>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg float-right">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                            
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>
          