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
            <h1 class="page-header">Sales agents</h1>
        </div>
        <!--End Page Header -->
    </div>
    <div class="row">
        <!--quick info section -->
        <div class="col-sm-2">
            <a href="javascript:void(0);" class="add_user" data-toggle="modal" data-target="#myModal"> 
                <div class="alert alert-success text-center">
                    <i class="fa fa-user-md fa-2x"></i>&nbsp;<b><?php echo count($agents);?> </b>Add new Agent

                </div></a>
        </div>
        <div class="col-sm-2">
            <div class="alert alert-danger text-center">
                <i class="fa  fa-beer fa-2x"></i>&nbsp;<b>27 % </b>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="alert alert-info text-center">
                <i class="fa fa-rss fa-2x"></i>&nbsp;<b>1,900</b> Subscribers 

            </div>
        </div>
        <div class="col-sm-2">
            <div class="alert alert-warning text-center">
                <i class="fa  fa-pencil fa-2x"></i>&nbsp;<b>2,000 $ </b>Items
            </div>
        </div>
        
        <!--end quick info section -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-md-12">
                <div class="block-web">
                    <div class="header">
                        <a href="javascript:void(0);" class="add_user" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus-square"></i> <span> New</span> </a>
                        <h3 class="content-header">Sales agents</h3>
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
                                        <th>Contact</th> 
                                        <th>E-mail</th> 
                                        <th class="hidden-phone">Next of kin</th>
                                        <th class="hidden-phone">Village</th>
                                        <th class="hidden-phone">Registered on</th>
                                        <th class="hidden-phone">Actions</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (is_array($agents) && count($agents)) {
                                        foreach ($agents as $loop) {
                                            ?>  
                                            <tr class="odd">
                                                <td>
                                                    AC<?php echo $loop->id; ?>
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

                                                <td id="contact:<?php echo $loop->id; ?>" contenteditable="true"><?php echo $loop->contact; ?></td>
                                                <td id="email:<?php echo $loop->id; ?>" contenteditable="true"><?php echo $loop->email; ?></td>

                                                <td id="nok:<?php echo $loop->id; ?>" contenteditable="true"><?php echo $loop->nok; ?></td>
                                                <td ><?php echo $loop->village; ?></td>

                                                <td id="created:<?php echo $loop->id; ?>" contenteditable="true"><?php echo $loop->created; ?></td>

                                                <td class="edit_td">
                                                    <a class="btn btn-danger btn-xs" href="<?php echo base_url() . "index.php/agent/delete/" . $loop->id; ?>"><li class="fa fa-trash-o">Delete</li></a>

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
                    <h4 class="modal-title" id="myModalLabel">Add Agent</h4>
                </div>
                <div class="modal-body">             
                    <form id="station-form" parsley-validate novalidate role="form" class="form-horizontal" name="login-form" enctype="multipart/form-data"  action='<?= base_url(); ?>index.php/agent/create'  method="post">

                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" name="name" placeholder="Name" id="name" required class="form-control"/>
                            </div>
                        </div>  
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" name="contact" placeholder="Contact" id="contact" required class="form-control"/>
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" name="email" placeholder="E-mail" id="email"  class="form-control"/>
                            </div>
                        </div>  
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" name="nok" placeholder="Next of kin" id="nok"  class="form-control"/>
                            </div>
                        </div>  
                        <div class=" item form-group">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Village</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <input class="easyui-combobox form-control" name="villageID" id="villageID" style="width:100%;height:26px" data-options="
                                       url:'<?php echo base_url() ?>index.php/village/lists',
                                       method:'get',
                                       valueField:'id',
                                       textField:'name',
                                       multiple:false,
                                       panelHeight:'auto'
                                       ">
                            </div>
                        </div>
                        <div class="item form-group">                    
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Profile picture</label>  
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="userfile" id="userfile" class="btn-default btn-small"/>
                                <div id="imagePreview" ></div>      
                            </div>
                        </div>                       

                        <div class="form-group">
                            <div class=" col-sm-10">
                                <div class="checkbox checkbox_margin">
                                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                                    <button class="btn btn-default pull-right" type="submit">SUBMIT</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

</div>
</div>

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
                $.post('<?php echo base_url() . "index.php/agent/update/"; ?>', field_id + "=" + value, function (data) {
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



