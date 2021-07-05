<?php include 'inc/header.php'; ?>


<!------ Include the above in your HEAD tag ---------->
<div class="page-container">
    <div class="container">
        <!-- <div class="row">
            <div class="col-sm-12">
                <h1>Change Password</h1>
            </div>
        </div> -->
        <h1>Change Password</h1>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <p class="text-center">Use the form below to change your password.</p>
                <form id="passwordForm">
                    <input type="password" class="input-lg form-control" style="height: 37px;" name="password"
                        id="password" placeholder="New Password" autocomplete="off">
                    <div class="row">
                        <div class="col-sm-6">
                            <span id="8char" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> 8
                            Characters Long<br>
                            <span id="ucase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One
                            Uppercase Letter
                        </div>
                        <div class="col-sm-6">
                            <span id="lcase" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One
                            Lowercase Letter<br>
                            <span id="num" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> One Number
                        </div>
                    </div>
                    <input type="password" class="input-lg form-control" style="height: 37px;" name="password2"
                        id="password2" placeholder="Repeat Password" autocomplete="off">
                    <div class="row">
                        <div class="col-sm-12">
                            <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span>
                            Passwords Match
                        </div>
                    </div>
                    <input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg"
                        data-loading-text="Changing Password..." value="Change Password">
                </form>
            </div>
            <!--/col-sm-6-->
        </div>
        <!--/row-->
    </div></br></br>
    <div id="response"></div>
    </br></br>
</div>






<?php include 'inc/footer.php'; ?>


<script>
$("input[type=password]").keyup(function() {
    var ucase = new RegExp("[A-Z]+");
    var lcase = new RegExp("[a-z]+");
    var num = new RegExp("[0-9]+");

    if ($("#password").val().length >= 8) {
        $("#8char").removeClass("glyphicon-remove");
        $("#8char").addClass("glyphicon-ok");
        $("#8char").css("color", "#00A41E");
    } else {
        $("#8char").removeClass("glyphicon-ok");
        $("#8char").addClass("glyphicon-remove");
        $("#8char").css("color", "#FF0004");
    }

    if (ucase.test($("#password").val())) {
        $("#ucase").removeClass("glyphicon-remove");
        $("#ucase").addClass("glyphicon-ok");
        $("#ucase").css("color", "#00A41E");
    } else {
        $("#ucase").removeClass("glyphicon-ok");
        $("#ucase").addClass("glyphicon-remove");
        $("#ucase").css("color", "#FF0004");
    }

    if (lcase.test($("#password").val())) {
        $("#lcase").removeClass("glyphicon-remove");
        $("#lcase").addClass("glyphicon-ok");
        $("#lcase").css("color", "#00A41E");
    } else {
        $("#lcase").removeClass("glyphicon-ok");
        $("#lcase").addClass("glyphicon-remove");
        $("#lcase").css("color", "#FF0004");
    }

    if (num.test($("#password").val())) {
        $("#num").removeClass("glyphicon-remove");
        $("#num").addClass("glyphicon-ok");
        $("#num").css("color", "#00A41E");
    } else {
        $("#num").removeClass("glyphicon-ok");
        $("#num").addClass("glyphicon-remove");
        $("#num").css("color", "#FF0004");
    }

    if ($("#password").val() == $("#password2").val()) {
        $("#pwmatch").removeClass("glyphicon-remove");
        $("#pwmatch").addClass("glyphicon-ok");
        $("#pwmatch").css("color", "#00A41E");
    } else {
        $("#pwmatch").removeClass("glyphicon-ok");
        $("#pwmatch").addClass("glyphicon-remove");
        $("#pwmatch").css("color", "#FF0004");
    }
});

$(document).ready(function() {

    // trigger when registration form is submitted
    $(document).on('submit', '#passwordForm', function() {

        // get form data
        var passwordForm = $(this);
        var jwt = getCookie('jwt');
        // get form data
        var update_account_form_obj = passwordForm.serializeObject()

        // add jwt on the object
        update_account_form_obj.jwt = jwt;

        // convert object to json string
        var form_data = JSON.stringify(update_account_form_obj);
        $.ajax({
            url: "api/user/update_profile.php",
            type: "POST",
            contentType: 'application/json',
            data: form_data,
            success: function(result) {

                $('#response').html(
                    "<div class='alert alert-success'>Account was updated.</div>");

                // store new jwt to coookie
                setCookie("jwt", result.jwt, 1);
                // home page html will be here
            },
            error: function(xhr, resp, text) {
                if (xhr.responseJSON.message == "Unable to update user.") {
                    $('#response').html(
                        "<div class='alert alert-danger'>Unable to update account.</div>"
                        );
                } else if (xhr.responseJSON.message == "Access denied.") {
                    $('#response').html(
                        "<div class='alert alert-success'>Access denied. Please login</div>"
                        );
                    window.location.replace('log-in.php');
                }
            }
        });

        // http request will be here

        return false;
    });

    // function to set cookie
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

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
    // submit form data to api
    $.fn.serializeObject = function() {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
});
</script>