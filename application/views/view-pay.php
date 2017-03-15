<?php require_once(APPPATH . 'views/inner-css.php'); ?> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/easyui.css?date=<?php echo date('Y-m-d') ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/icon.css?date=<?php echo date('Y-m-d') ?>">

<link rel="stylesheet" href="<?= base_url(); ?>css/mine.css?mine=<?php echo date('Y-m-d'); ?>" />

<link href="<?php echo base_url() ?>assets/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>css/style.css' />
<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>css/print.css' media="print" />
<style>
    body {
        font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 8px;
        background-color:#FFFFFF;
    } 
    #header {
        height: 49px;

    }
</style>

<div id="page-wrapper">
    <form id="station-form" parsley-validate novalidate role="form" class="vertical" name="login-form" enctype="multipart/form-data"  action='<?= base_url(); ?>index.php/payment/create'  method="post">


        <div id="page-wrap">

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
                        <td><textarea id="date"><?php echo date('d-M-Y')?></textarea></td>
                    </tr>
                 
                </table>

            </div>

            <table id="items">

                <tr>
                    <th>Customer details</th>
                    <th colspan="2">Account details</th>

                    <th> <label> Starting:</label> </th>
                    <th><label>Amount paid</label></th>
                </tr>

                <tr class="item-row">
                    <td class="item-name">

                        <input class="easyui-combobox form-control" name="customerID" id="customerID"  data-options="
                               url:'<?php echo base_url() ?>index.php/customer/lists',
                               method:'get',
                               valueField:'id',
                               textField:'name',
                               multiple:false,
                               panelHeight:'auto'
                               "/>

                    </td>
                    <td class="description" colspan="2">
                        <span id="loading"  name ="loading"><img src="<?= base_url(); ?>images/loading.gif" alt="loading......" /></span>                                   

                        <span id="loading2"  name ="loading2"><img src="<?= base_url(); ?>images/loading.gif" alt="loading......" /></span>                                   

                    </td>

                    <td> 
                        <div class="form-group">
                            <input class="easyui-datebox" name="start" id="start" value="<?php echo date('d-m-Y'); ?>"/>
                        </div>
                    </td>
                    <td><div class="form-group">

                            <input type="number" name="paid" placeholder="Amount paid/Deposited" id="paid"  class="form-control"/>

                        </div></td>
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
        </div>

    </form>

</div>

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
