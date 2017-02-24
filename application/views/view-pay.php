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
        <div class="col-md-12">
            <h2 class="page-header">New payment</h2>
        </div>
    </div>
    <form id="station-form" parsley-validate novalidate role="form" class="" name="login-form" enctype="multipart/form-data"  action='<?= base_url(); ?>index.php/payment/create'  method="post">

        <div class="row"> 
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Payment
                    </div>
                    <div class="panel-body">


                        <div class="form-group">
                            <label class="control-label col-md-8 col-sm-8 col-xs-8">Select Customer</label>
                            <div class="col-md-8 col-sm-8 col-xs-8">

                                <input class="easyui-combobox form-control" name="customerID" id="customerID" style="width:100%;height:26px" data-options="
                                       url:'<?php echo base_url() ?>index.php/customer/lists',
                                       method:'get',
                                       valueField:'id',
                                       textField:'name',
                                       multiple:false,
                                       panelHeight:'auto'
                                       ">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10">
                                <span id="loading"  name ="loading"><img src="<?= base_url(); ?>images/loading.gif" alt="loading......" /></span>                                   
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <span id="loading2"  name ="loading2"><img src="<?= base_url(); ?>images/loading.gif" alt="loading......" /></span>                                   
                            </div>
                        </div>




                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Payment Details
                    </div>
                    <div class="panel-body">
                        <p>
                        <div class=" item form-group">
                            <div class="form-group">
                                <div class="col-sm-10">

                                    <span class="col-sm-3"> Starting:</span> <span class="col-sm-9">   <input class="easyui-datebox" name="start" id="start" value="<?php echo date('d-m-Y'); ?>"/></span>  

                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Amount paid</label>
                                <div class="col-md-12">
                                    <input type="number" name="paid" placeholder="Amount paid/Deposited" id="paid"  class="form-control"/>
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

                            </p> 
                        </div>

                    </div>
                </div>
            </div>
            <br>

        </div>
    </form>

    <script src="<?php echo base_url() ?>assets/plugins/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/bootstrap/bootstrap.min.js"></script>

    <script src="<?php echo base_url() ?>plugins/validation/parsley.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>js/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>js/payment-form.js"></script>


    <script>
 $('#loading').hide();
  $('#loading2').hide();
        var TACEAS = {
            baseURL: '<?php echo base_url() ?>'
        };

        $(document).on('click', '.printdiv-btn', function (e) {
            e.preventDefault();

            var $this = $(this);
            //  var originalContent = $('body').html();
            var printArea = $this.parents('.printableArea').html();

            $('body').html(printArea);
            window.print();
            $('body').html(printArea);
        });


    </script>
