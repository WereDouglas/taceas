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
            <h2 class="page-header">Accounts</h2>
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
                            <th>Customer</th>
                            <th>Agent</th>
                            <th>Start</th>
                            <th>End</th> 
                            <th>Expires</th> 
                            <th>Cost</th> 
                            <th>Package</th> 
                            <th>Product</th> 
                            <th>Interest(%)</th> 
                            <th>Discount(%)</th> 
                            <th>Daily</th> 
                            <th>Monthly</th> 
                            <th>Commission</th> 
                            <th>Meter No.</th> 
                            <th>Complete</th>
                            <th>Active</th> 
                            <th>Balance</th> 
                            <th>Created</th>
                             <th>Payments</th> 
                            <th class="hidden-phone">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        if (is_array($accs) && count($accs)) {
                            foreach ($accs as $loop) {
                                ?>  
                                <tr class="odd">
                                    <td >
                                        ACC <?php echo $loop->id; ?>
                                    </td>
                                    <td >
                                        <?php echo $loop->customer; ?>
                                    </td>
                                    <td >
                                        <?php echo $loop->agent; ?>
                                    </td>
                                    <td id="start:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->start; ?>
                                    </td>

                                    <td id="end:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->end; ?>
                                    </td>
                                    <td id="expiry:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->expiry; ?>
                                    </td>
                                    <td id="cost:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->cost; ?>
                                    </td>
                                    <td >
                                        <?php echo $loop->package; ?>
                                    </td>
                                     <td >
                                        <?php echo $loop->product; ?>
                                    </td>
                                    <td id="interest:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->interest; ?>
                                    </td>
                                    <td id="discount:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->discount; ?>
                                    </td>
                                    <td id="daily:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->daily; ?>
                                    </td>
                                    <td id="monthly:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->monthly; ?>
                                    </td>
                                    <td id="commission:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->commission; ?>
                                    </td>
                                    <td id="meterNo:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->meterNo; ?>
                                    </td>
                                    <td id="complete:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->complete; ?>
                                    </td>
                                    <td id="active:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->active; ?>
                                    </td>
                                    <td id="balance:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->balance; ?>
                                    </td>
                                    <td id="created:<?php echo $loop->id; ?>" contenteditable="true">
                                        <?php echo $loop->created; ?>
                                    </td>
                                    <td class="edit_td">
                                        <a class="btn btn-grey btn-xs" href="<?php echo base_url() . "index.php/payment/view/" . $loop->id; ?>"><li class="fa fa-archive-o">Payments</li></a>

                                    </td> 

                                    <td class="edit_td">
                                        <a class="btn btn-danger btn-xs" href="<?php echo base_url() . "index.php/product/delete/" . $loop->id; ?>"><li class="fa fa-trash-o">Delete</li></a>

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
                <h4 class="modal-title" id="myModalLabel">Add Product Item</h4>
            </div>

            <div class="modal-body">             
                <form id="station-form" parsley-validate novalidate role="form" class="form-horizontal" name="login-form" enctype="multipart/form-data"  action='<?= base_url(); ?>index.php/product/create'  method="post">
                    <div class="item form-group">                    
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">Profile picture</label>  
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="userfile" id="userfile" class="btn-default btn-small"/>
                            <div id="imagePreview" ></div>      
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="text" name="name" placeholder="Name" id="name" required class="form-control"/>
                        </div>
                    </div>                  

                    <div class="form-group">
                        <div class="col-sm-10">
                            <input type="text" name="cost" placeholder="Cost"  class="form-control"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-10">
                            <textarea name="description" placeholder="Description" id="description"  class="form-control"></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class=" col-sm-10">
                            <div class="checkbox checkbox_margin">
                                <button class="btn btn-default pull-right" type="submit">SUBMIT</button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

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
                $.post('<?php echo base_url() . "index.php/product/update/"; ?>', field_id + "=" + value, function (data) {
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

