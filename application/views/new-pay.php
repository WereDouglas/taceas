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
    <form id="station-form" parsley-validate novalidate role="form" class="" name="login-form" enctype="multipart/form-data"  action='<?= base_url(); ?>index.php/account/create'  method="post">

        <div class="row"> 
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Customer details
                    </div>
                    <div class="panel-body">
                        <p>      
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
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Select Agent</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <input class="easyui-combobox form-control" name="agentID" id="agentID" style="width:100%;height:26px" data-options="
                                       url:'<?php echo base_url() ?>index.php/agent/lists',
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


                        </p>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Account Details
                    </div>
                    <div class="panel-body">
                        <p>
                        <div class=" item form-group">
                            <div class="form-group">
                                <div class="col-sm-10">

                                    <span class="col-sm-3"> Starting:</span> <span class="col-sm-9">   <input class="easyui-datebox" name="start" id="start" value="<?php echo date('d-m-Y'); ?>"/></span>  

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <span class="col-sm-3"> Expire date:</span> <span class="col-sm-9">   <input class="easyui-datebox" name="end" id="end" value="<?php echo date('d-m-Y'); ?>"/></span>  

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Interest</label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input class="easyui-combobox form-control" name="interestID" id="interestID" style="width:100%;height:26px" data-options="
                                           url:'<?php echo base_url() ?>index.php/interest/lists',
                                           method:'get',
                                           valueField:'percentage',
                                           textField:'percentage',
                                           multiple:false,
                                           panelHeight:'auto'
                                           ">
                                </div>
                            </div>
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">Package</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">

                                <input class="easyui-combobox form-control" name="packageID" id="packageID" style="width:100%;height:26px" data-options="
                                       url:'<?php echo base_url() ?>index.php/package/lists',
                                       method:'get',
                                       valueField:'id',
                                       textField:'name',
                                       multiple:false,
                                       panelHeight:'auto'
                                       ">
                            </div>

                            <div class="form-group">
                                <div class="col-sm-10">
                                    <span id="loading"  name ="loading"><img src="<?= base_url(); ?>images/loading.gif" alt="loading......" /></span>                                   
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Commission(%)</label>
                                <div class="col-md-12">
                                    <input type="number" name="commission" placeholder="Commission" id="commission"  class="form-control"/>
                                </div>
                            </div>  
                            <div class="form-group col-md-12">
                                <label>Amount paid</label>
                                <div class="col-md-12">
                                    <input type="number" name="paid" placeholder="Amount paid/Deposited" id="paid"  class="form-control"/>
                                </div>
                            </div> 
                            <div class="form-group col-md-12">
                                <label>Meter No.</label>
                                <div class="col-md-12">
                                    <input type="text" name="meterNo" placeholder="Meter No." id="paid"  class="form-control"/>
                                </div>
                            </div>  


                            <div class="form-group">
                                <label class="control-label col-md-12 col-sm-12 col-xs-12">Discount</label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <input class="easyui-combobox form-control" name="discountID" id="discountID" style="width:100%;height:26px" data-options="
                                           url:'<?php echo base_url() ?>index.php/discount/lists',
                                           method:'get',
                                           valueField:'percentage',
                                           textField:'percentage',
                                           multiple:false,
                                           panelHeight:'auto'
                                           ">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10">
                                    <label >Active</label>
                                    <select class="form-control" id="active" name="active"> 

                                        <option value="true">true</option> 
                                        <option value="false">false</option>                                  
                                    </select>
                                </div><!--/col-sm-9--> 
                            </div><!--/form-group-->

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
            $('#loading').hide();

            var payment = 0;

            $('#input[name=packageID]').blur(function () {

                alert("me");
            });

            $('#paid').blur(function () {

                //$("#tenantname").val($("input[name=tenant]").val());
                // $("#dater").val($("input[name=date]").val());
                var paid = $("#paid").val();

                var packageID = $("input[name=packageID]").val();
                var interest = $("input[name=interestID]").val();
                var start = $("input[name=start]").val();
                var end = $("input[name=end]").val();
                if (packageID !== null) {           // show loader 
                    $('#loading').show();
                    $.post("<?php echo base_url() ?>index.php/package/details", {
                        packageID: packageID, start: start, end: end, interest: interest, paid: paid
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
            });


        });

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
