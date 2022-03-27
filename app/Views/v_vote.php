<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote</title>
    <link rel="stylesheet" href="<?= base_url() . "/assets/theme/css/theme.min.css"?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.2/mdb.min.css" rel="stylesheet" />

    <style>
        * {
            font-family: 'Kanit', sans-serif !important;
        }
        #profile_image {
            width: 45px;
            height: 45px;
            border-radius: 50%;
        }
        .modal-content {
            border-radius: 0px !important;
        }
        nav.fluid-container {
            background-color: white !important;
            box-shadow: 1px 1px 5px 3px rgba(100,100,100,0.2);
        }
        input.form-control {
            height: 4rem;
            font-size: 1.5rem;
        }
        .bi-box-arrow-right{
            font-weight: bold;
            display: none;
        }
        @media (max-width: 767px) {
            .info{
                font-size: 12px;
            }
            .btn-logout {
                padding: 0px;
                width: 40% !important;
            }
            .btn-outline-danger{
                font-size: 5px;
            }
            #profile_image {
                display: none;
            }
            .info_usr{
                margin-top: 5px;
                margin-left: 10px;
                width: 60% !important;
            }
            .logo_sys a{
                display: none;
            }
            .sticky-top .d-flex{
                justify-content: center !important;
            }
            .bi-box-arrow-right{
                display: inline;
            }
            .btn span{
                display: none;
            }
        }
    </style>
</head>
<body>
    <main class="main" id="top">
        <nav class="fluid-container sticky-top p-2">
            <div class="d-flex justify-content-between px-4">
                <div class="logo_sys">
                    <img class="me-3" src="<?= base_url() . "/assets/img/logo.png" ?>" style="width: 45px">
                    <a href="<?= base_url() . "/" ?>">ระบบโหวต</a>
                </div>
                
                <div class="d-flex justify-content-end info">
                    <img class="col-1 mt-1 text-center" src="https://dummyimage.com/40x40/000/fff" id="profile_image">
                    <span class="col-7 text-center info_usr">
                        <?= $_SESSION["usr_full_name"]?>
                        <div class="d-flex justify-content-between mx-4">
                            <div class="clus"><?php echo ($_SESSION["cst_number"] != '' ? 'มกุล '.$_SESSION["cst_number"]  : $_SESSION["rol_name"])?> &nbsp;</div>
                            <div class="coin">
                                <i class="bi bi-coin" style="color: #ab8211"></i>
                                <span id="remain_score"><?= $obj_user->usr_remain_score ?></span>
                            </div>
                        </div>
                    </span>
                    <div class="btn-logout col-5 text-center m-2">
                        <a type="button" href="<?= base_url() . "/logout" ?>" class="btn btn-outline-danger waves-effect" style="font-weight: bold;">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Log out</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        
        <form id="vote_form" action="<?= base_url() . "/Report/vote"?>" method="POST">
        <div class="container">
            <center><h1 class="mt-5">
                <?php
                    if ($obj_user->usr_remain_score > 0)
                    echo "โหวตมกุลที่ท่านชื่นชอบ";
                    else
                    echo "ท่านหมดสิทธิ์โหวตแล้ว";
                    ?>    
                </h1></center>
                
                <div class="row">
                    <?php for ($i = 0; $i < 9; $i++) { ?>
                        <div class="col-12 col-sm-6 col-md-4 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container p-0">
                                        <center><img src="<?= "https://se.buu.ac.th/gami_ossd/assets/dist/img/cluster/cluster".$i.".png" ?>" style="min-height: 100px; height: 10rem; object-fit: cover"></center>
                                    </div>

                                    <div class="d-flex justify-content-between mt-4">
                                        <div>
                                            <h4 class="card-title mt-3">มกุล <?= $arr_cluster[$i]->cst_number ?></h4>
                                            <h6 class="card-subtitle mb-3 text-muted"><?= $arr_cluster[$i]->cst_system_name ?></h6>
                                        </div>
                                        <div>
                                            <img src="<?= "https://se.buu.ac.th/gami_ossd/assets/dist/img/cluster/cluster".$i.".png" ?>" style="border-radius: 50%; width: 60px; height: 60px; object-fit: cover">
                                        </div>
                                    </div>

                                    <?php if ($obj_user->usr_remain_score > 0) :?>
                                        <div class="col-12">
                                            <input class="mt-4 form-control score-input score-input-<?= $i ?>" type="number" min="1" step="1" placeholder="กรอกคะแนน" name="score_input_cluster[]" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="กรอกตัวเลขจำนวนเต็มเท่านั้น"
                                            oninput="input_handling.convert_to_positive(this); user.cal_user_score(this);">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <?php if ($obj_user->usr_remain_score > 0) : ?>
                <div class="container">
                    <div class="d-flex justify-content-center my-5">
                        <input class="btn btn-secondary-outline me-3" type="reset" value="Clear" onclick="user.unlock_score_input(); user.reset_user_score()">
                        <button class="btn btn-warning ps-5 pe-5 pt-3 pb-3 ms-3" type="button" id="vote_open_modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Vote</button>
                    </div>
                </div>
            <?php endif; ?>

            <div class="container my-5">
                <h4 class="mb-2"><b>หมายเหตุ :</b></h4>
                <p>1. กรอกคะแนนที่ท่านต้องการให้แต่ละมกุล (ไม่จำเป็นต้องครบทุกมกุล)</p>
                <p>2. เมื่อต้องการโหวต กดปุ่ม "Vote"</p>
                <p>3. กดปุ่ม "Confirm Vote" เพื่อโหวต หรือกด "Cancel" เพื่อยกเลิก</p>
                <p>4. สามารถโหวตได้หลายครั้ง ถ้ายังมีแต้มเหลืออยู่</p>
                <p>5. หากกดปุ่ม "Confirm Vote" แล้ว ท่านไม่สามารถเปลี่ยนแปลงผลการโหวตได้</p>
            </div>
        </form>
    </main>

    <div id="exampleModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ยืนยันการโหวต</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>หากกดปุ่ม "Confirm Vote" แล้ว ท่านไม่สามารถเปลี่ยนแปลงผลการโหวตได้</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" form="vote_form">Confirm Vote</button>
                </div>
            </div>
        </div>
    </div>

    <?php if ($_SESSION["vote_status"] == "success") : ?>
        <div style="position: relative;" class="alert">
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="position: fixed; bottom: 20px; right: 20px; width: 600px">
                <i class="bi bi-check-circle"></i>
                <strong>Vote successful</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php elseif ($_SESSION["vote_status"] == "fail") : ?>
    <div style="position: relative;" class="alert" >
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="position: fixed; bottom: 20px; right: 20px; width: 600px">
            <i class="bi bi-x-circle"></i>
            <strong>Vote failed</strong>, please try again later
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>
    <?php
        unset($_SESSION["vote_status"]);
    ?>

    <script>
        setTimeout(function(){
            alert.hide_alert();
        }, 10000);

        let alert = {
            time_out : 10000,
            hide_alert: function() {
                $(".alert").hide(300);
            } 
        }
        let input_handling = {
            convert_to_positive: function(elem) {
                if (elem.value < 0) elem.value = elem.value * -1;
            }
        };
        let user = {
            user_id: 1,
            user_score: <?= $obj_user->usr_remain_score ?>,
            remain_score: <?= $obj_user->usr_remain_score?>,
            minus_user_score: function(score) {
                this.remain_score = this.user_score - score;
            },
            get_remain_score: function() {
                return this.remain_score;
            },
            reset_user_score: function() {
                this.remain_score = this.user_score;
                this.render_user_score();
            },
            cal_user_score: function(elem) {
                let total_score = 0;
                const SCORE_INPUT_ELEM = document.getElementsByClassName("score-input");
                for (let i = 0; i < SCORE_INPUT_ELEM.length; i++) {
                    let input_score = SCORE_INPUT_ELEM[i].value;
                    if (input_score == '') input_score = 0;
                    total_score += Number(input_score);
                }

                if (total_score > this.user_score) {
                    elem.value = elem.value - (total_score - this.user_score);
                    total_score = this.user_score;
                }
                
                this.minus_user_score(total_score);
                this.render_user_score();
                if (this.remain_score <= 0) {
                    this.lock_score_input();
                    if (this.remain_score < 0) {
                        this.lock_vote_button();
                    }
                }
                else {
                    this.unlock_score_input();
                    this.unlock_vote_button();
                }
            },
            render_user_score: function() {
                if (this.remain_score <= 0) 
                $("#remain_score").html("0");
                else
                $("#remain_score").html(this.remain_score);
            },
            lock_score_input: function() {
                const SCORE_INPUT_ELEM = document.getElementsByClassName("score-input");
                for (let i = 0; i < SCORE_INPUT_ELEM.length; i++) {
                    let input_score = SCORE_INPUT_ELEM[i].value;
                    if (input_score == 0 || input_score == "") {
                        SCORE_INPUT_ELEM[i].setAttribute("readonly", true);
                        SCORE_INPUT_ELEM[i].setAttribute("placeholder", "แต้มไม่พอ");
                    }
                }
            },
            unlock_score_input: function() {
                const SCORE_INPUT_ELEM = document.getElementsByClassName("score-input");
                for (let i = 0; i < SCORE_INPUT_ELEM.length; i++) {
                    let input_score = SCORE_INPUT_ELEM[i].value;
                    SCORE_INPUT_ELEM[i].removeAttribute("readonly");
                    SCORE_INPUT_ELEM[i].setAttribute("placeholder", "กรอกคะแนน");
                }
            },
            lock_vote_button: function() {
                $("#vote_open_modal").attr("disabled", true);
            },
            unlock_vote_button: function() {
                $("#vote_open_modal").attr("disabled", false);
            },
        };
    </script>

    <script src="<?= base_url() . "/assets/vendors/bootstrap/bootstrap.min.js"?>"></script>
    <script src="<?= base_url() . "/assets/vendors/is/is.min.js"?>"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="<?= base_url() . "/assets/theme/js/theme.js"?>"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
</body>
</html>