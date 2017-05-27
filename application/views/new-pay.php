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
                    <textarea id="customer-title">GESOP</textarea>
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
                    <th colspan="5">Customer details</th>


                </tr>

                <tr class="item-row">
                    <td class="item-name" colspan="2">
                        <div class="form-group">
                            <label >Fast name</label>
                            <input type="text" name="name" placeholder="First name" id="name" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label >Last name</label>
                            <input type="text" name="last_name" placeholder="Last name" id="last_name" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label >Mobile</label>
                            <input type="text" name="contact" placeholder="Mobile" id="contact" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label >E-mail</label>
                            <input type="text" name="email" placeholder="E-mail" id="email"  class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label >LC/Local Council</label>
                            <input type="text" name="lc" placeholder="LC" id="lc"  class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Village</label>
                            <input class="easyui-combobox form-control" name="village" id="village" style="width:100%;height:26px" data-options="
                                   url:'<?php echo base_url() ?>index.php/village/lists',
                                   method:'get',
                                   valueField:'name',
                                   textField:'name',
                                   multiple:false,
                                   panelHeight:'auto'
                                   ">     
                        </div>
                        <div class="form-group">
                            <label>Sub county</label>
                            <input class="easyui-combobox form-control" name="subcounty" id="subcounty" style="width:100%;height:26px" data-options="
                                   url:'<?php echo base_url() ?>index.php/subcounty/lists',
                                   method:'get',
                                   valueField:'name',
                                   textField:'name',
                                   multiple:false,
                                   panelHeight:'auto'
                                   ">     
                        </div>
                        <div class="form-group">
                            <label>District</label>
                            <input class="easyui-combobox form-control" name="district" id="district" style="width:100%;height:26px" data-options="
                                   url:'<?php echo base_url() ?>index.php/district/lists',
                                   method:'get',
                                   valueField:'anme',
                                   textField:'name',
                                   multiple:false,
                                   panelHeight:'auto'
                                   ">     
                        </div>



                    </td>

                    <td colspan="2"> 
                   

                        <div class="form-group">
                            <label >ID No.</label>
                            <input type="text" name="idno" placeholder="ID No." id="idno"  class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label >Next of kin</label>
                            <input type="text" name="kin_name" placeholder="Next of kin " id="kin_name"  class="form-control"/>                      
                        </div>
                        <div class="form-group">
                            <label >Next of kin phone</label>
                            <input type="text" name="kin_contact" placeholder="Next of kin" id="nok"  class="form-control"/>                      
                        </div>
                        <div class="form-group">
                            <label >Relationship</label>
                            <input type="text" name="relationship" placeholder="Relationship" id="nok"  class="form-control"/>                      
                        </div>
                        <div class="form-group">
                            <label>District</label>
                            <input class="easyui-combobox form-control" name="kin_district" id="kin_district" style="width:100%;height:26px" data-options="
                                   url:'<?php echo base_url() ?>index.php/district/lists',
                                   method:'get',
                                   valueField:'name',
                                   textField:'name',
                                   multiple:false,
                                   panelHeight:'auto'
                                   ">     
                        </div>
                             <div class="form-group">
                            <label class="control-label col-md-12 col-sm-12 col-xs-12">ID/ picture</label>  

                            <input type="file" name="userfile" id="userfile" class="btn-default btn-small"/>
                            <div id="imagePreview" ></div>      
                        </div>

                    </td>
                    <td></td>
                </tr>
                <tr>


                    <th colspan="5">Package details</th>

                </tr>
                <tr>


                    <td colspan="2"> 
                        <div class="form-group">
                            <label>Date</label>
                            <input class="easyui-datebox form-control" name="start" id="start" style="width:100%;height:26px;border:0;">
                        </div>

                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="qty" placeholder="Quantity" id="qty"  class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Period(Months)</label>
                            <input type="number" name="period" placeholder="Period(Months)" id="period"  class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label>Installation cost</label>
                            <input type="number" name="installation" placeholder="Installation cost" id="installation"  class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Installed by</label>
                            <input type="text" name="installed_by" placeholder="Installed by" id="installed_by"  class="form-control"/>
                        </div>
                    </td>
                    <td colspan="3">
                        <label >Select package</label>
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
                               ">
                        <span id="loading"  name ="loading"><img src="<?= base_url(); ?>images/loading.gif" alt="loading......" /></span>                                   

                    </td>

                </tr>

                <tr>
                    <th colspan="5">DETAILS </th>

                </tr>
                <tr>

                    <td colspan="2">  <label>BDO/Agent name</label></td>
                    <td colspan="3">
                        <input class="easyui-combobox form-control" name="agentID" id="agentID" style="width:100%;height:26px" data-options="
                               url:'<?php echo base_url() ?>index.php/agent/lists',
                               method:'get',
                               valueField:'id',
                               textField:'name',
                               multiple:false,
                               panelHeight:'auto'
                               ">     
                    </td>

                </tr>

                <tr>

                    <td colspan="2"><label>Bar code</label></td>
                    <td colspan="3"><input type="number" name="barcode" placeholder="Bar code" id="barcode"  class="form-control"/>
                    </td>

                </tr>
                <tr>

                    <td colspan="2">Region/VPC</td>
                    <td colspan="3"> <input type="text" name="region" placeholder="Region /VPC " id="region"  class="form-control"/>
                    </td>
                    
                </tr>               

                <tr>

                    <td colspan="2">Active</td>
                    <td colspan="3">
                        <select class="form-control" id="active" name="active"> 

                            <option value="true">true</option> 
                            <option value="false">false</option>                                  
                        </select>      
                    </td>
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
        document.body.style.zoom = "80%"
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
        var period = $("#period").val();
         var installation = $("#installation").val();

        var packageID = $("input[name=packageID]").val();
        var interest = $("input[name=interestID]").val();
        var start = $("input[name=start]").val();

        if (packageID !== null) {           // show loader 
            $('#loading').show();
            $.post("<?php echo base_url() ?>index.php/package/details", {
                packageID: packageID, start: start, interest: interest, paid: paid, period: period,installation:installation
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
