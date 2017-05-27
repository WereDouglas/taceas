<?php require_once(APPPATH . 'views/inner-css.php'); ?> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/easyui.css?date=<?php echo date('Y-m-d') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/icon.css?date=<?php echo date('Y-m-d') ?>">

<link rel="stylesheet" href="<?= base_url(); ?>css/mine.css?mine=<?php echo date('Y-m-d'); ?>" />
<style>
    body {
        font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 13px;
        background-color:#FFFFFF;
    } 
</style>
<link href="<?php echo base_url() ?>assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">System users</h1>
        </div>
        <!--End Page Header -->
    </div>
    <div class="row">
        <div class="header">
            <a href="javascript:void(0);" class="add_user" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus-square"></i> <span> New</span> </a>

            <?php echo $this->session->flashdata('msg'); ?>
        </div>
        <div class="alert alert-info" id="status"></div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example"> 
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>email</th>
                            <th>Contact</th>
                            <th class="hidden-phone">Status</th>
                            <th class="hidden-phone">Created</th>
                            <th class="hidden-phone">Action</th>
                            <th class="hidden-phone">Reset password</th>
                            <th class="hidden-phone">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (is_array($users) && count($users)) {
                            foreach ($users as $loop) {
                                ?>  
                                <tr class="odd">
                                    <td >
                                        <?php echo $loop->id; ?>
                                    </td>
                                    <td> 
                                        <?php
                                        if ($loop->image != "") {
                                            ?>
                                            <img  height="50px" width="50px"  src="<?= base_url(); ?>uploads/<?php echo $loop->image; ?>"  />
                                            <?php
                                        } else {
                                            ?>
                                            <img  height="50px" width="50px"  src="<?= base_url(); ?>images/user_place.png"  />
                                            <?php
                                        }
                                        ?>
                                    </td>

                                    <td id="name:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->name; ?>
                                    </td>

                                    <td ><?php echo $loop->role; ?></td>

                                    <td id="email:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->email; ?>
                                    </td>
                                    <td id="contact:<?php echo $loop->id; ?>" contenteditable="true"><?php echo $loop->contact; ?></td>
                                    <td id="status:<?php echo $loop->id; ?>" contenteditable="true"><?php echo $loop->status; ?></td>
                                    <td id="created:<?php echo $loop->id; ?>" contenteditable="true"><?php echo $loop->created; ?></td>
                                    <td class="edit_td">
                                        <a class="btn btn-primary btn-xs" href="<?php echo base_url() . "index.php/user/profile/" . $loop->id;
                                        ?>"><li class="fa fa-folder">View</li></a>

                                    </td> 
                                    <td>
                                        <a href="#"  value="<?php echo $loop->id; ?>"  id="myLink" onclick="NavigateToSite(this)" class="tooltip-error text-danger" data-rel="tooltip" title="reset">
                                            <span class="red">
                                                <i class="icon-lock bigger-120 text-danger"></i>
                                                Reset
                                            </span>
                                        </a>
                                    </td>
                                    <td class="edit_td">
                                        <a class="btn btn-danger btn-xs" href="<?php echo base_url() . "index.php/user/delete/" . $loop->id; ?>"><li class="fa fa-trash-o">Delete</li></a>

                                    </td> 


                                </tr>
                                <?php
                            }
                        }
                        ?>

                    </tbody>

                </table>
            </div><!--/table-responsive-->
        </div><!--/porlets-content-->


    </div><!--/block-web--> 
</div><!--/col-md-12--> 
</div><!--/row-->           
</div><!--/page-content end--> 
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add user</h4>
            </div>

            <div class="modal-body">             
                <form id="station-form" parsley-validate novalidate role="form" class="form-horizontal" name="login-form" enctype="multipart/form-data"  action='<?= base_url(); ?>index.php/user/create'  method="post">
                    <div class="item form-group">                    
                        <label>Profile picture</label>  
                       
                            <input type="file" name="userfile" id="userfile" class="btn-default btn-small"/>
                            <div id="imagePreview" ></div>      
                      
                    </div>
                    <div class=" item form-group">
                        <label>Select Role</label>
                        <input class="easyui-combobox form-control" name="roleID" id="roleID" style="width:100%;height:26px" data-options="
                               url:'<?php echo base_url() ?>index.php/role/lists',
                               method:'get',
                               valueField:'id',
                               textField:'name',
                               multiple:false,
                               panelHeight:'auto'
                               ">

                    </div>
                    <div class="form-group">
                        <label >Select Store</label>
                        <input class="easyui-combobox form-control" name="storeID" id="storeID" style="width:100%;height:26px" data-options="
                               url:'<?php echo base_url() ?>index.php/store/lists',
                               method:'get',
                               valueField:'id',
                               textField:'name',
                               multiple:false,
                               panelHeight:'auto'
                               ">
                    </div>
          
            <div class="form-group">

                <label >Active</label>
                <select class="form-control" id="status" name="status"> 
                    <option value="active">active</option> 
                    <option value="dull">dull</option>                                  
                </select>
            </div><!--/form-group-->
            <div class="form-group">                
                    <input type="text" name="name" placeholder="Full Name" id="name" required class="form-control"/>               
            </div>                  

            <div>
                <div class="form-group">                    
                        <input type="text" name="contact" placeholder="Contact No."  class="form-control"/>                 
                </div>

                <div class="form-group">                   
                        <input type="text" name="email" placeholder="Email" id="email"  class="form-control"/>                    
                </div>
                <div class="form-group">
                    <label for="email">Password:</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" />                                                   

                </div>
                <div class="form-group">
                    <label for="pwd">Confirm password:</label>
                    <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirm password" value="" />

                </div>  

               

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>    <button class="btn btn-success pull-right" type="submit">SUBMIT</button>

            </div>
        </div>
    </div>
</div>
<!-- sidebar chats -->

<script src="<?php echo base_url() ?>assets/plugins/jquery-1.10.2.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/bootstrap.min.js"></script>
<script>
                                    $(document).ready(function () {
                                        $("#status").hide();
                                        $(function () {
                                            //acknowledgement message
                                            var message_status = $("#status");
                                            $("td[contenteditable=true]").blur(function () {
                                                var field_id = $(this).attr("id");
                                                var value = $(this).text();
                                                $.post('<?php echo base_url() . "index.php/user/update/"; ?>', field_id + "=" + value, function (data) {
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
<script src="<?php echo base_url() ?>assets/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/dataTables/dataTables.bootstrap.js"></script>
<script>
                                    $(document).ready(function () {
                                        $('#dataTables-example').dataTable();
                                    });
</script>
<script src="<?php echo base_url() ?>plugins/validation/parsley.min.js"></script>
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

    function NavigateToSite(ele) {
        var selectedVal = $(ele).attr("value");
        //var selectedVal = document.getElementById("myLink").getAttribute('value');
        //href= "index.php/patient/add_user/'
        $.post("<?php echo base_url() ?>index.php/user/reset", {
            userID: selectedVal
        }, function (response) {
            alert(response);
        });

    }

</script>
