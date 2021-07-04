<?php include 'inc/header.php'; ?>


<!-- Breadcrumb -->
<!-- /Breadcrumb -->
<div class="page-container">
    <div class="container">
        <!-- <div class="row gutters-sm"> -->
        <!-- <div class="col-md-4 mb-3"> -->
        <!-- <div class="card">
                    <div class="card-body"> -->
        <div class="d-flex flex-column align-items-center text-center">
            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle"
                width="150">
            <div class="mt-3">
                <h4 id='fullname'></h4>
            </div>
            <!-- </div>
                    </div> -->
            <!-- </div> -->
        </div>
        <!-- <div class="col-md-8"> -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">First Name</h6>
                    </div>
                    <div id="fname" class='col-sm-9 text-secondary'>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Last Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="lname">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="email">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="username">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Phone Number</h6>
                    </div>
                    <div class="col-sm-9 text-secondary" id="phone">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <a class="btn btn-info " target="__blank" href="update.php">Edit Password</a>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

</div>

<script type="text/javascript">

</script>

<?php include 'inc/footer.php'; ?>


<script>
$(document).ready(function() {
    var jwt = getCookie('jwt');
    $.post("http://localhost/SOCIALNETWORK/api/user/validate_token.php", JSON.stringify({ jwt:jwt })).done(function(result) {
        $("#fname").html(`<div>` + result.data.firstname + `</div>`);
        $("#lname").html(`<div>` + result.data.lastname + `</div>`);
        $("#email").html(`<div>` + result.data.email + `</div>`);
        $("#username").html(`<div>` + result.data.username + `</div>`);
        $("#phone").html(`<div>` + result.data.phonenumber + `</div>`);
        $("#fullname").html(`<div>` + result.data.firstname + `</div>`);
 // html form for updating user account will be here
    })
    // const xhr = new XMLHttpRequest();
    // xhr.open('GET', 'http://localhost/SOCIALNETWORK/api/user/read.php')
    // xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8')
    // xhr.send(JSON.stringify(jwt))
    // $.getJSON("http://localhost/SOCIALNETWORK/api/user/read.php",function(data){
    //     $("#fname").html(`<div>` + data.firstname + `</div>`);
    //     $("#lname").html(`<div>` + data.lastname + `</div>`);
    //     $("#email").html(`<div>` + data.email + `</div>`);
    //     $("#username").html(`<div>` + data.username + `</div>`);
    //     $("#phone").html(`<div>` + data.phonenumber + `</div>`);
    //     $("#fullname").html(`<div>` + data.firstname + `</div>`);
    // });

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }

            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
});
</script>