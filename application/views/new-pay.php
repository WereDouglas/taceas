<?php require_once(APPPATH . 'views/inner-css.php'); ?> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/easyui.css?date=<?php echo date('Y-m-d') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/icon.css?date=<?php echo date('Y-m-d') ?>">

<link rel="stylesheet" href="<?= base_url(); ?>css/mine.css?mine=<?php echo date('Y-m-d'); ?>" />
<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>css/style.css' />
<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>css/print.css' media="print" />
<style>
    body {
        font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;

        background-color:#FFFFFF;
    } 
    form {

        font-size: 11px;
    }
    #header {
        height: 49px;

    }
    .form-control {
   
    border-radius: 0px;
    
}
</style>

<link href="<?php echo base_url() ?>assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />


<div id="page-wrapper">
    <form id="station-form" parsley-validate novalidate role="form" class="" name="login-form" enctype="multipart/form-data"  action='<?= base_url(); ?>index.php/account/create'  method="post">


        <div id="page-wrap" class="page-wrap">

            <textarea id="header">INVOICE</textarea>


            <div style="clear:both"></div>

            <div id="customer">

                <img id="image" height="80px" width="140px" src="<?= base_url(); ?>images/barcode.png" alt="logo" />

                <div id="identity">

                    <textarea id="customer-title">TACEAS</textarea>

                </div>

                <table id="meta">
                    <tr>
                        <td class="meta-head">Invoice #</td>
                        <td><textarea>000123</textarea></td>
                    </tr>
                    <tr>

                        <td class="meta-head">Date</td>
                        <td><textarea id="date"><?php echo date('d-M-Y') ?></textarea></td>
                    </tr>

                </table>

            </div>

            <table id="items">

                <tr>
                    <th>Customer details</th>
                    <th colspan="3"></th>


                </tr>

                <tr class="item-row">
                    <td class="item-name">

                        <input type="text" name="name" placeholder="Name" id="name" required class="form-control"/>

                        <input type="text" name="contact" placeholder="Contact" id="contact" required class="form-control"/>
                        <input type="text" name="email" placeholder="E-mail" id="email"  class="form-control"/>

                        <input type="text" name="nok" placeholder="Next of kin" id="nok"  class="form-control"/>                      

                        </div>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12">Profile picture</label>  
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="userfile" id="userfile" class="btn-default btn-small"/>
                            <div id="imagePreview" ></div>      
                        </div>
                    </td>
                    <td class="description">

                    </td>

                    <td> 
                        <div class="form-group">
                            <input class="easyui-combobox form-control" name="agentID" id="agentID" style="width:100%;height:26px" data-options="
                                   url:'<?php echo base_url() ?>index.php/agent/lists',
                                   method:'get',
                                   valueField:'id',
                                   textField:'name',
                                   multiple:false,
                                   panelHeight:'auto'
                                   ">     
                        </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <th></th>
                    <th colspan="3">Package details</th>

                </tr>
                <tr>
                    <td> <input type="text" name="meterNo" placeholder="Meter No." id="paid"  class="form-control"/>
                    </td>
                    <td colspan="3">
                        <input class="easyui-combobox form-control" name="packageID" id="packageID" style="width:100%;height:26px;border:0;" data-options="
                               url:'<?php echo base_url() ?>index.php/package/lists',
                               method:'get',
                               valueField:'id',
                               textField:'name',
                               multiple:false,
                               panelHeight:'auto',
                               onChange: function(rec){
                               SelectedRole('info');
                               }
                               "></td>

                </tr>
                <tr>
                    <th colspan="4">
                        <div class="container">  
                            <span id="loading"  name ="loading"><img src="<?= base_url(); ?>images/loading.gif" alt="loading......" /></span>                                   
                        </div> 
                    </th>

                </tr>
                <tr>
                    <th colspan="4">DETAILS </th>

                </tr>
                <tr>
                    <td>  </td>
                    <td>  <label>Commission</label></td>
                    <td colspan="2"><input type="number" name="commission" placeholder="Commission" id="commission"  class="form-control"/>
                    </td>


                </tr>
                <tr>
                    <td> </td>
                    <td> Interest  </td>
                    <td colspan="2"> <input class="easyui-combobox form-control" name="interestID" id="interestID" style="width:100%;height:26px" data-options="
                                            url:'<?php echo base_url() ?>index.php/interest/lists',
                                            method:'get',
                                            valueField:'percentage',
                                            textField:'percentage',
                                            multiple:false,
                                            panelHeight:'auto'
                                            ">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td> Amount payable</td>
                    <td colspan="2">
                        <input type="number" name="paid" placeholder="Amount paid/Deposited" id="paid"  class="form-control"/>
                    </td>

                </tr>
                <tr>
                    <td></td>
                    <td> Discount</td>
                    <td colspan="2" > <input class="easyui-combobox form-control" name="discountID" id="discountID" style="width:100%;height:26px" data-options="
                                             url:'<?php echo base_url() ?>index.php/discount/lists',
                                             method:'get',
                                             valueField:'percentage',
                                             textField:'percentage',
                                             multiple:false,
                                             panelHeight:'auto'
                                             "></td>



                </tr>
                <tr>
                    <td></td>
                    <td> Active</td>
                    <td colspan="2">
                        <select class="form-control" id="active" name="active"> 

                            <option value="true">true</option> 
                            <option value="false">false</option>                                  
                        </select>      
                    </td>

                </tr>
                <tr>
                    <td></td>
                    <td > Amount payable</td>
                    <td colspan="2"> 
                        <input type="number" name="paid" placeholder="Amount paid/Deposited" id="paid"  class="form-control"/>
                    </td>

                </tr>
                <tr>
                    <td></td>
                    <td>Starting:</td>
                    <td colspan="2"> 
                        <input class="easyui-datebox" name="start" id="start" value="<?php echo date('d-m-Y'); ?>"/>   </th>


                </tr>
                <tr>
                    <td></td>
                    <td>End:</td>
                    <td colspan="2"> <input class="easyui-datebox" name="end" id="end" value="<?php echo date('d-m-Y'); ?>"/></th>

                </tr>

            </table>

            <div id="terms">
                <h5>Terms</h5>
                <textarea>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</textarea>
            </div>

        </div>
        <div class="form-group">                            
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
            <button class="btn btn-default pull-right" type="submit">SUBMIT</button>     
            <input type="button" class="btn btn-default  printdiv-btn btn-primary icon-ok center" value="print" />
        </div>

    </form>


</div>

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
        document.body.style.zoom="80%"
        $('#loading').hide();

        var payment = 0;

        $('#input[name=packageID]').blur(function () {

            alert("me");
        });

        $('#paid').blur(function () {
            SelectedRole('ele');
        });


    });

    $(document).on('click', '.printdiv-btn', function (e) {
        e.preventDefault();

        var $this = $(this);
        //  var originalContent = $('body').html();
        var printArea = $this.parents('.page-wrap').html();

        $('body').html(printArea);
        window.print();
        $('body').html(printArea);
    });
    function SelectedRole(ele) {

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





    }


</script>
