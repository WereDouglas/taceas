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
            <h2 class="page-header">Packages</h2>
            <!--End Page Header -->        
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="block-web">
                        <div class="header">
                            <a href="javascript:void(0);" class="add_user btn-default" data-toggle="modal" data-target="#myModal"> <i class="fa fa-plus-square"></i> <span> New</span> </a>
                            <a class="btn btn-default btn-xs" href="<?php echo base_url() . "index.php/package/view/"; ?>"><li class="fa fa-trash-o">Packages</li></a>

                            <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                        <div class="alert alert-info" id="status"></div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">   <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th><font color="blue">Products</font></th>
                                            <th>Interest(%)</th>
                                            <th>Fixed Initial(%)</th> 
                                            <th>Cost</th>  
                                            <th class="hidden-phone">Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        if (is_array($dis) && count($dis)) {
                                            foreach ($dis as $loop) {
                                                ?>  
                                                <tr class="odd">
                                                    <td >
                                                        <?php echo $loop->id; ?>
                                                    </td> 
                                                    <td id="name:<?php echo $loop->id; ?>" contenteditable="true">
                                                        <?php echo $loop->name; ?>
                                                    </td> 
                                                    <td id="description:<?php echo $loop->id; ?>" contenteditable="true">
                                                        <?php echo $loop->description; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $ct = 0;
                                                        $cost = 0;
                                                        foreach ($prods as $loops) {
                                                            $ct = $ct + 1;

                                                            if (strpos($loop->products, $loops->id) !== false) {
                                                                $cost = $cost + $loops->cost;
                                                                echo '<font color="blue">' . $ct . '. ' . $loops->name . ' ' . number_format($loops->cost) . '</font>' . '<br>';
                                                            }
                                                        }
                                                        echo '<strong>TOTAL:</strong><font color="red" style="margin-left:50px;">' . number_format($cost) . '</font>' . '<br>';
                                                        //echo $loop->products;
                                                        ?>
                                                    </td>
                                                    <td id="interest:<?php echo $loop->id; ?>" contenteditable="true">
                                                        <?php echo $loop->interest; ?>
                                                    </td>
                                                    <td id="initial:<?php echo $loop->id; ?>" contenteditable="true">
                                                        <?php echo $loop->initial; ?>
                                                    </td>
                                                    <td id="cost:<?php echo $loop->id; ?>" contenteditable="true">
                                                        <?php echo $loop->cost; ?>
                                                    </td>

                                                    <td class="edit_td">
                                                        <a class="btn btn-danger btn-xs" href="<?php echo base_url() . "index.php/package/delete/" . $loop->id; ?>"><li class="fa fa-trash-o">Delete</li></a>

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
                        <h4 class="modal-title" id="myModalLabel">Add Package</h4>
                    </div>
                    <div class="modal-body">             
                        <form id="station-form" parsley-validate novalidate role="form" class="form-horizontal" name="login-form" enctype="multipart/form-data"  action='<?= base_url(); ?>index.php/package/create'  method="post">
                            <div class=" item form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Products</label>


                                <input class="easyui-combobox form-control" name="productID[]" id="productID" style="width:100%;height:26px" data-options="
                                       url:'<?php echo base_url() ?>index.php/product/lists',
                                       method:'get',
                                       valueField:'id',
                                       textField:'name',
                                       multiple:true,
                                       panelHeight:'auto'
                                       ">

                            </div>
                            <div class="form-group">

                                <input type="text" name="name" placeholder="Name" id="name" required class="form-control"/>

                            </div>
                            <div class="form-group">

                                <input type="text" name="description" placeholder="Description" id="description" required class="form-control"/>

                            </div>
                            <div class="form-group">
                                <label>Interest(%)</label>
                                <input class="easyui-combobox form-control" name="interest" id="interest" style="width:100%;height:26px" data-options="
                                       url:'<?php echo base_url() ?>index.php/interest/lists',
                                       method:'get',
                                       valueField:'percentage',
                                       textField:'percentage',
                                       multiple:false,
                                       panelHeight:'auto'
                                       ">  
                            </div>
                            <div class="form-group">
                                <label>Fixed initial %</label>
                                <input type="text" name="initial" value="20" placeholder="Fixed initial %" id="initial"  class="form-control"/>

                            </div>

                            <div class="form-group">

                                <input type="text" name="cost" placeholder="Package Cost" id="cost"  class="form-control"/>

                            </div>
                            <span id="loading"  name ="loading"><img src="<?= base_url(); ?>images/loading.gif" alt="loading......" /></span>                                   


                            <div class="form-group">

                                <div class="checkbox checkbox_margin">
                                    <button class="btn btn-default pull-right" type="submit">SUBMIT</button>
                                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>

                                </div>

                            </div>

                        </form>

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
        $('#loading').hide();
        $("#status").hide();
        $(function () {
            //acknowledgement message
            var message_status = $("#status");
            $("td[contenteditable=true]").blur(function () {
                var field_id = $(this).attr("id");
                var value = $(this).text();
                $.post('<?php echo base_url() . "index.php/package/update/"; ?>', field_id + "=" + value, function (data) {
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
        $('#cost').blur(function () {
            PaymentDetails('ele');
        });
    });

    function PaymentDetails(ele) {

        //$("#tenantname").val($("input[name=tenant]").val());
        // $("#dater").val($("input[name=date]").val());
        var cost = $("#cost").val();
        var initial = $("#initial").val();
        var interest = $("input[name=interest]").val();

        if (cost !== null) {           // show loader 
            $('#loading').show();
            $.post("<?php echo base_url() ?>index.php/package/payments", {
                cost: cost, interest: interest, initial: initial
            }, function (response) {
                //#emailInfo is a span which will show you message
                $('#loading').hide();
                setTimeout(finishAjax('loading', escape(response)), 400);
            });
        }

        function finishAjax(id, response) {
            $('#' + id).html(unescape(response));
            $('#' + id).fadeIn();
        }

    }


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

