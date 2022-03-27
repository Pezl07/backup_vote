<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>ระบบโหวต</title>
</head>
<style>
    * {
        font-family: 'Kanit', sans-serif !important;
    }
    body {
        margin: 0;
        padding: 0;
    }

    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }

    .container .h-custom{
        height: 100%;
        width: 100%;
    }

    .sub_container{
        min-width: 300px;
        min-height: 400px;
        max-height: 800px;
        max-width: 500px;
        padding: 30px;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 50px;
        border: 1px solid rgb(0, 0, 0, 0.9);
        /* box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px; */
        box-shadow: rgba(0, 0, 0, 0.25) 0px 54px 55px, rgba(0, 0, 0, 0.12) 0px -12px 30px, rgba(0, 0, 0, 0.12) 0px 4px 6px, rgba(0, 0, 0, 0.17) 0px 12px 13px, rgba(0, 0, 0, 0.09) 0px -3px 5px;
    }

    .fa_eye{
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .main {
        overflow: hidden;
        position: relative;
        height: 100%;
    }

    .image {
        opacity: 0.4;
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .container {
        position: relative;
    }

    #hide {
        display: none;
    }

    .password-input {
        display: flex;
    }
</style>

<body>
    <div class="main">
        <img class="image" src="<?= base_url() . "/assets/img/picture_camp.png" ?>" alt="">
        <section class="vh-100 container">
            <div class="container h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class='sub_container'>
                        <div class="logo text-center">
                            <img src="<?= base_url() . "/assets/img/logo.png" ?>" width="200" height="200">
                        </div>
                        <h2 class="text-center">ระบบโหวต OSSD CAMP #10</h2>
                        <h4 class="text-center">Login</h4>
                        <form id="login_form" action="<?php echo base_url() . '/Login/login' ?>" method="POST">

                            <!-- Username input -->
                            <div class="form-outline mb-4">
                                <input class="form-control form-control-lg" required
                                placeholder="Enter username" type="text" name="usr_name" id="usr_name"
                                value="<?php if (isset($_SESSION["usr_name"])) echo $_SESSION["usr_name"]?>" />
                                <label class="form-label" for="usr_name">Username</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-3 password-input">
                                <input class="form-control form-control-lg" required
                                placeholder="Enter password" type="password" name="usr_password" id="usr_password" />
                                <label class="form-label" for="usr_password">Password</label>
                                <div class="fa_eye">
                                    <i class="bi bi-eye-slash" id="show" onclick="show_eye()"></i>
                                    <i class="bi bi-eye" id="hide" onclick="show_eye()"></i>
                                </div>
                            </div>
                            
                            <?php if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == false) : ?>
                                <div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <i class="bi bi-x-circle me-2" style="font-size: 1.5rem "></i>
                                    <div>Username หรือ Password ไม่ถูกต้อง</div>
                                </div>
                            <?php endif; ?>

                            <div class="text-center pt-2 align-items-center">
                                <button type="submit" class="btn btn-primary btn-lg"
                                    style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>
<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.js"></script>
<!-- jQuery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function show_eye() {
        var input_password = $('#usr_password').attr('type');
        if(input_password === "password") {
            $("#usr_password").prop("type", "text")
            $('#hide').css("display", "inline-block");
            $('#show').css("display", "none");
        }else{
            $("#usr_password").prop("type", "password")
            $('#hide').css("display", "none");
            $('#show').css("display", "inline-block");
        }

    }
</script>

</html>