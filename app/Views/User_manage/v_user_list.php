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

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

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
            box-shadow: 1px 1px 5px 3px rgba(100, 100, 100, 0.2);
        }

        .bi-box-arrow-right {
            font-weight: bold;
            display: none;
        }

        @media (max-width: 767px) {
            .info {
                font-size: 12px;
            }

            .btn-logout {
                padding: 0px;
                width: 40% !important;
            }

            .btn {
                font-size: 5px;
            }

            #profile_image {
                display: none;
            }

            .info_usr {
                margin-top: 5px;
                margin-left: 10px;
                width: 60% !important;
            }

            .logo_sys a {
                display: none;
            }

            .sticky-top .d-flex {
                justify-content: center !important;
            }

            .bi-box-arrow-right {
                display: inline;
            }

            .btn span {
                display: none;
            }
        }
    </style>
</head>

<body>
    <main class="main" id="top">
        <nav class="fluid-container sticky-top p-2">
            <div class="d-flex justify-content-between">
                <div class="logo_sys">
                    <img class="me-3" src="<?= base_url() . "/assets/img/logo.png" ?>" style="width: 45px">
                    <a href="<?= base_url() . "/report" ?>">ระบบโหวต</a>
                </div>

                <div class="info">
                    <a class="me-2" href="<?php echo base_url() . '/User_manage'?>">จัดการผู้ใช้</a>
                    <a class="me-2" href="<?php echo base_url() . '/report'?>">ผลการโหวต</a>
                    <img src="https://dummyimage.com/40x40/000/fff" id="profile_image">
                    <span class="ms-2 info_usr"><?= $_SESSION["usr_full_name"]?></span>
                    <a class="btn-logout ms-2 btn btn-outline-danger waves-effect" style="font-weight: bold;" href="<?= base_url() . "/logout" ?>">Log out</a>
                </div>

            </div>
            </nav>

        <div class="container mt-5">
            <?php if (empty($arr_user)) :?>
            <h2>ไม่พบข้อมูลผู้ใช้</h2>
            <?php else : ?>
            <div class="row mb-3">
                <div class="col-auto">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_user">เพิ่ม</button>
                </div>
            </div>
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th><b>ลำดับ</b></th>
                        <th><b>ชื่อนามสกุล</b></th>
                        <th><b>มกุล/บทบาท<b /></th>
                        <th><b>คะแนนคงเหลือ</b></th>
                        <th><b>ดำเนินการ</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arr_user AS $index => $user) {?>
                    <tr>
                        <td>
                            <?php echo $index + 1?>
                        </td>
                        <td><?php echo $user['usr_full_name']?></td>
                        <td><?php echo ($user['rol_id'] == 1 ? $user['cst_number'] : $user['rol_name'])?></td>
                        <td><?php echo $user['usr_remain_score']?></td>
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit_user" onclick="get_user_ajax('<?php echo $user['usr_id']?>')">แก้ไข</button>
                            <a class="btn btn-danger" href="<?php echo base_url() . '/User_manage/delete/' . $user['usr_id']?>">ลบ</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
    </main>

    <div class="modal fade" id="add_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มผู้ใช้</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add_user_form" action="<?php echo base_url() . '/User_manage/insert'?>" method="POST">
                        <div class="mb-3">
                            <label for="usr_name" class="form-label">ชื่อผู้ใช้ (สำหรับ Login) :</label>
                            <input required type="text" class="form-control" name="usr_name" id="usr_name">
                        </div>
                        <div class="mb-3">
                            <label for="usr_password" class="form-label">รหัสผ่าน (สำหรับ Login) :</label>
                            <input required type="password" class="form-control" name="usr_password" id="usr_password">
                        </div>
                        <div class="mb-3">
                            <label for="usr_full_name" class="form-label">ชื่อ-นามสกุล :</label>
                            <input required type="text" class="form-control" name="usr_full_name" id="usr_full_name">
                        </div>
                        <div class="mb-3">
                            <label for="usr_role" class="form-label">บทบาท :</label>
                            <select required class="form-control" name="usr_role" id="usr_role" onchange="check_add_role(this, '.div_cluster', '#usr_cluster_id')">
                                <option value="" disabled selected hidden>โปรดเลือกบทบาท</option>
                                <?php foreach($opt_role AS $role) { ?>
                                <option value="<?php echo $role['rol_id']?>"><?php echo $role['rol_name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3 div_cluster">
                            <label for="usr_cluster_id" class="form-label">มกุล :</label>
                            <select class="form-control" name="usr_cluster_id" id="usr_cluster_id" required>
                                <option value="" disabled selected hidden>โปรดเลือกมกุล</option>
                                <?php foreach($opt_cluster AS $cluster) { ?>
                                <option value="<?php echo $cluster['cst_id']?>">มกุล <?php echo $cluster['cst_number']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="usr_remain_score" class="form-label">คะแนน :</label>
                            <input required type="text" class="form-control" name="usr_remain_score" id="usr_remain_score" value="500">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" form="add_user_form" class="btn btn-success">บันทึก</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขผู้ใช้</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit_user_form" action="<?php echo base_url() . '/User_manage/update'?>" method="POST">
                        <div class="mb-3" hidden>
                            <input required type="text" class="form-control" name="usr_id" id="usr_id_edit">
                        </div>
                        <div class="mb-3">
                            <label for="usr_name_edit" class="form-label">ชื่อผู้ใช้ (สำหรับ Login) :</label>
                            <input required type="text" class="form-control" name="usr_name" id="usr_name_edit">
                        </div>
                        <div class="mb-3">
                            <label for="usr_password_edit" class="form-label">รหัสผ่าน (สำหรับ Login) :</label>
                            <input type="password" class="form-control" name="usr_password" id="usr_password_edit">
                        </div>
                        <div class="mb-3">
                            <label for="usr_full_name_edit" class="form-label">ชื่อ-นามสกุล :</label>
                            <input required type="text" class="form-control" name="usr_full_name" id="usr_full_name_edit">
                        </div>
                        <div class="mb-3">
                            <label for="usr_role_edit" class="form-label">บทบาท :</label>
                            <select required class="form-control" name="usr_role" id="usr_role_edit" onchange="check_add_role(this, '.div_cluster_edit', '#usr_cluster_id_edit')">
                                <option value="" disabled selected hidden>โปรดเลือกบทบาท</option>
                                <?php foreach($opt_role AS $role) { ?>
                                <option value="<?php echo $role['rol_id']?>"><?php echo $role['rol_name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3 div_cluster_edit" hidden>
                            <label for="usr_cluster_id_edit" class="form-label">มกุล :</label>
                            <select class="form-control" name="usr_cluster_id" id="usr_cluster_id_edit" required>
                                <option value="" disabled selected hidden>โปรดเลือกมกุล</option>
                                <?php foreach($opt_cluster AS $cluster) { ?>
                                <option value="<?php echo $cluster['cst_id']?>">มกุล <?php echo $cluster['cst_number']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="usr_remain_score_edit" class="form-label">คะแนน :</label>
                            <input required type="text" class="form-control" name="usr_remain_score" id="usr_remain_score_edit" value="500">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">ยกเลิก</button>
                    <button type="submit" form="edit_user_form" class="btn btn-success">บันทึก</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('.table').DataTable();
    });

    async function get_user_ajax(usr_id) {
        await $.ajax({
            url: '<?php echo base_url() . '/User_ajax/get_user_ajax'?>',
            method: 'POST',
            dataType: 'JSON',
            data: {
                'usr_id': usr_id
            },
            success: function(obj_user) {
                show_user_in_edit_modal(obj_user);
            }
        });
    }

    function show_user_in_edit_modal(obj_user) {
        $('#usr_id_edit').val(obj_user['usr_id']);
        $('#usr_name_edit').val(obj_user['usr_name']);
        $('#usr_full_name_edit').val(obj_user['usr_full_name']);
        $('#usr_remain_score_edit').val(obj_user['usr_remain_score']);
        $('#usr_role_edit').val(obj_user['usr_role']);
        $('#usr_cluster_id_edit').val(obj_user['usr_cluster_id']);

        if (obj_user['usr_role'] == '1') {
            $('.div_cluster_edit').attr('hidden', false);
            $('#usr_cluster_id_edit').prop('required', true);
        } else {
            $('.div_cluster_edit').attr('hidden', true);
            $('#usr_cluster_id_edit').prop('required', false);
        }
    }

    function check_add_role(elem, div, select) {
        if (elem.value == '1') {
            $(div).attr('hidden', false);
            $(select).prop('required', true);
        } else {
            $(div).attr('hidden', true);
            $(select).prop('required', false);
        }
    }
    </script>

    <script src="<?= base_url() . "/assets/vendors/bootstrap/bootstrap.min.js"?>"></script>
    <script src="<?= base_url() . "/assets/vendors/is/is.min.js"?>"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="<?= base_url() . "/assets/theme/js/theme.js"?>"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap" rel="stylesheet">
</body>

</html>