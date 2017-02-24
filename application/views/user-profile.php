
<?php require_once(APPPATH . 'views/inner-css.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/easyui.css?date=<?php echo date('Y-m-d') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/icon.css?date=<?php echo date('Y-m-d') ?>">
<link rel="stylesheet" href="<?= base_url(); ?>css/mine.css" />
<style type="text/css" media="screen">

    table{
        border-collapse:collapse;
        border:0px solid #FF0000;
    }

    table td{
        border:0px solid #FF0000;
    }

    table tr{
        border:0px solid #FF0000;
    }
    body{
        background-color: white;
    }
</style>

<div class="porlets-content padding-10">
    <div class="row container">
        <?php echo $this->session->flashdata('msg'); ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="col-md-12 col-sm-12 col-xs-12"> <span class="info-box status col-md-12 col-sm-12 col-xs-12" id="status"></span></div>

            </div>
            <div  class="col-md-12" >

                <table >
                    <h2>Profile</h2>
                    <tbody>
                        <?php
                        if (is_array($users) && count($users)) {
                            foreach ($users as $loop) {
                                ?>
                                <tr class="odd">
                                    <td> 
                                        <div class="profile_img">
                                            <?php
                                            if ($loop->image != "") {
                                                ?>
                                                <img height="20px" width="50px" class="img-responsive avatar-view" src="<?= base_url(); ?>uploads/<?php echo $loop->image; ?>" alt="Avatar" title="Change the avatar">

                                                <?php
                                            } else {
                                                ?>

                                                <img height="20px" width="50px" class="img-responsive avatar-view" src="<?= base_url(); ?>images/temp.png" alt="image" title="Change the avatar">
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    <td>
                                    </td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td ><span class=" red" >*you can edit the fields below inline</span>
                                    </td>

                                </tr>
                                <tr>
                                    <td>NAME:</td>
                                    <td id="name:<?php echo $loop->userID; ?>" contenteditable="true">
                                        <?php echo $loop->name; ?>
                                    </td>

                                </tr>
                                <tr>

                                    <td>EMAIL:</td>
                                    <td id="email:<?php echo $loop->userID; ?>" contenteditable="true"><?php echo $loop->email; ?></td>

                                </tr>
                                <tr>
                                    <td>DESIGNATION:</td>
                                    <td id="designation:<?php echo $loop->userID; ?>" contenteditable="true"><?php echo $loop->designation; ?></td>
                                </tr>
                                <tr>
                                    <td>STATUS:</td>
                                    <td id="active:<?php echo $loop->userID; ?>" contenteditable="true"><span class="red"><?php echo $loop->active; ?></span></td>


                                </tr>
                                <tr>
                                    <td>Department</td>
                                    <td id="department:<?php echo $loop->userID; ?>" contenteditable="true"><span class="blue"><?php echo $loop->department; ?></span> </td>

                                </tr>
                                <tr>
                                    <td>CONTACT:</td>
                                    <td id="contact:<?php echo $loop->userID; ?>" contenteditable="true"><?php echo $loop->contact; ?></td>

                                </tr>
                                <tr>
                                    <td> <h4>Change profile picture</h4></td>
                                    <td>
                                        <form  enctype="multipart/form-data" class="form-horizontal form-label-left"  action='<?= base_url(); ?>index.php/user/update_image'  method="post">                                       

                                            <input type="file" name="userfile" id="userfile" />
                                            <div id="imagePreview" ></div>
                                            <input type="hidden" name="userID" id="userID" value="<?php echo $loop->userID; ?>" />                                                   
                                            <input type="hidden" name="namer" id="namer" value="<?php echo $loop->name; ?>" />
                                            <button id="send" class="form-horizontal" type="submit" >Update picture</button>
                                        </form>

                                    </td>

                                </tr>
                                <tr>
                                    <td> <h4>Change password</h4></td>
                                    <td>
                                        <?php
                                        //echo $this->session->userdata('email');
                                        if ($loop->userID == $this->session->userdata('userID')) {
                                            ?>
                                            <form id="identicalForm"  enctype="multipart/form-data" class="form-horizontal form-label-left"  action='<?= base_url(); ?>index.php/user/update_password'  method="post">                                       



                                                <div class="form-group">
                                                    <label for="email">Password:</label>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" />                                                   

                                                </div>
                                                <div class="form-group">
                                                    <label for="pwd">Confirm password:</label>
                                                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm password" value="" />

                                                </div>  

                                                <input type="hidden" name="userID" id="userID" value="<?php echo $loop->userID; ?>" />     
                                                <button id="send" class="btn btn-default" type="submit" >Change password</button>


                                            </form>
                                        <?php } ?>
                                    </td>

                                </tr>
                                <?php
                            }
                        }
                        ?>

                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>js/jquery.js"></script>
<script src="<?= base_url(); ?>js/validator.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= base_url(); ?>js/jquery.easyui.min.js"></script>
<script type="text/javascript">
    $(function () {
        $("#userfile").on("change", function ()
        {
            var files = !!this.files ? this.files : [];
            if (!files.length || !window.FileReader)
                return; // no file selected, or no FileReader support
            if (/^image/.test(files[0].type)) { // only image file
                var reader = new FileReader(); // instance of the FileReader
                reader.readAsDataURL(files[0]); // read the local file

                reader.onloadend = function () { // set image data as background of div
                    $("#imagePreview").css("background-image", "url(" + this.result + ")");
                }
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $(function () {
            //acknowledgement message
            var message_status = $("#status");
            $("td[contenteditable=true]").blur(function () {
                var field_id = $(this).attr("id");
                var value = $(this).text();
                $.post('<?php echo base_url() . "index.php/user/update_profile/"; ?>', field_id + "=" + value, function (data) {
                    if (data != '')
                    {
                        message_status.show();
                        message_status.text(data);
                        //hide the message
                        setTimeout(function () {
                            message_status.hide()
                        }, 4000);
                    }
                });
            });

        });



    });
</script>
<script type="text/javascript">


    function myformatter(date) {
        var y = date.getFullYear();
        var m = date.getMonth() + 1;
        var d = date.getDate();
        return y + '-' + (m < 10 ? ('0' + m) : m) + '-' + (d < 10 ? ('0' + d) : d);
    }
    function myparser(s) {
        if (!s)
            return new Date();
        var ss = (s.split('-'));
        var y = parseInt(ss[0], 10);
        var m = parseInt(ss[1], 10);
        var d = parseInt(ss[2], 10);
        if (!isNaN(y) && !isNaN(m) && !isNaN(d)) {
            return new Date(y, m - 1, d);
        } else {
            return new Date();
        }
    }

</script>

<script>
    $(document).ready(function () {
        $('#identicalForm').formValidation({
            framework: 'bootstrap',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                confirmPassword: {
                    validators: {
                        identical: {
                            field: 'password',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                }
            }
        });
    });
</script>








