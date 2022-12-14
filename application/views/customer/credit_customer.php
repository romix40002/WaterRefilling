<!-- Customer js php -->
<script src="<?php echo base_url()?>my-assets/js/admin_js/json/customer.js.php" ></script>
<!-- Manage credit customer -->
<div class="content-wrapper">
	<section class="content-header">
	    <div class="header-icon">
	        <i class="pe-7s-note2"></i>
	    </div>
	    <div class="header-title">
	        <h1><?php echo display('credit_customer') ?></h1>
	        <small><?php echo display('manage_your_credit_customer') ?></small>
	        <ol class="breadcrumb">
	            <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
	            <li><a href="#"><?php echo display('customer') ?></a></li>
	            <li class="active"><?php echo display('credit_customer') ?></li>
	        </ol>
	    </div>
	</section>
	<section class="content">
		<!-- Alert Message -->
	    <?php
	        $message = $this->session->userdata('message');
	        if (isset($message)) {
	    ?>
	    <div class="alert alert-info alert-dismissable">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	        <?php echo $message ?>
	    </div>
	    <?php
	        $this->session->unset_userdata('message');
	        }
	        $error_message = $this->session->userdata('error_message');
	        if (isset($error_message)) {
	    ?>
	    <div class="alert alert-danger alert-dismissable">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	        <?php echo $error_message ?>
	    </div>
	    <?php
	        $this->session->unset_userdata('error_message');
	        }
	    ?>

	    <div class="row">
            <div class="col-sm-12">
                <div class="column">
                    <?php
                    if($this->permission1->method('add_customer','create')->access()) { ?>
                        <a href="<?php echo base_url('Ccustomer')?>" class="btn btn-info m-b-5 m-r-2"><i class="ti-plus"> </i> <?php echo display('add_customer')?> </a>
                    <?php } ?>

                    <?php
                    if($this->permission1->method('manage_customer','read')->access() || $this->permission1->method('manage_customer','update')->access() || $this->permission1->method('manage_customer','delete')->access()) { ?>
                        <a href="<?php echo base_url('Ccustomer/manage_customer')?>" class="btn btn-primary m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('manage_customer')?> </a>
                    <?php } ?>

                    <?php
                    if($this->permission1->method('paid_customer','read')->access()) { ?>
                        <a href="<?php echo base_url('Ccustomer/paid_customer')?>" class="btn btn-warning m-b-5 m-r-2"><i class="ti-align-justify"> </i>  <?php echo display('paid_customer')?> </a>
                    <?php } ?>

                </div>
            </div>
        </div>


        <?php
        if($this->permission1->method('credit_customer','read')->access()) { ?>
	    <!-- Manage credit customer -->
	   	<div class="row">
			<div class="col-sm-12">
		        <div class="panel panel-default">
		            <div class="panel-body">

						<form action="<?php echo base_url('Ccustomer/credit_customer_search_item')?>" class="form-inline" method="post" accept-charset="utf-8">

		                    <label class="select"><?php echo display('customer_name')?>:</label>
							<select class="form-control" name="customer_id" style="width: 25%">
							    <option><?php echo display('select_customer')?></option>
	                           <?php foreach($all_credit_customer_list as $cust_list){
	                           	$customer = $this->db->select('customer_name')->from('customer_information')->where('customer_id',$cust_list['customer_id'])->get()->row();
	                           	?>
	                            <option value="<?php echo $cust_list['customer_id']?>"><?php echo $customer->customer_name;?></option>
	                           <?php }?>
                            </select>

							<button type="submit" class="btn btn-primary"><?php echo display('search')?>hh</button>

			            </form>
			        </div>
		        </div>
		    </div>
	    </div>
        <?php } ?>


        <?php
        if($this->permission1->method('credit_customer','read')->access() || $this->permission1->method('credit_customer','update')->access() || $this->permission1->method('credit_customer','delete')->access()) { ?>
		<!-- Manage Customer -->
		<div class="row">
		    <div class="col-sm-12">
		        <div class="panel panel-bd lobidrag">
		            <div class="panel-heading">
		                <div class="panel-title">
		                    <h4><?php echo display('credit_customer') ?></h4>
		                </div>
		            </div>
		            <div class="panel-body">
		                <div class="table-responsive">
		                    <table id="dataTableExample2" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th><?php echo display('sl') ?></th>
										<th><?php echo display('customer_name') ?></th>
										<th><?php echo display('address') ?></th>
										<th><?php echo display('mobile') ?></th>
										<th style="text-align:right !Important"><?php echo display('balance') ?></th>
                                        <?php
                                        if($this->permission1->method('credit_customer','update')->access() || $this->permission1->method('credit_customer','delete')->access()) { ?>
										<th style="text-align:center !Important"><?php echo display('action') ?></th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
								<?php
								if ($customers_list) {
								?><?php
								foreach($customers_list as $custlist){?>
									<tr>
										<td><?php echo $custlist['sl'];?></td>
                                        <?php
                                        if($this->permission1->method('credit_customer','read')->access()) { ?>
                                            <td><a href="<?php echo base_url().'Ccustomer/customerledger/'.$custlist['customer_id']; ?>"><?php echo $custlist['customer_name']; ?></a></td>
                                            <?php
                                        }else{
                                        ?>
                                         <td><?php echo $custlist['customer_name']; ?></td>
                                        <?php
                                        }
                                        ?>
										<td><?php echo $custlist['customer_address']; ?></td>
										<td><?php echo $custlist['customer_mobile']; ?></td>
										<td style="text-align:right !Important"> <?php echo (($position==0)?"$currency ".number_format($custlist['customer_balance'], 2, '.', ','):number_format($custlist['customer_balance'], 2, '.', ',')." $currency"); ?></td>

                                       <?php
                                        if($this->permission1->method('credit_customer','update')->access() || $this->permission1->method('credit_customer','delete')->access()) { ?>
										<td>
											<center>
                                                <?php
                                                if($this->permission1->method('credit_customer','update')->access()) { ?>
                                                <?php  if($custlist['customer_name'] !='Walking Customer') {?>
                                                    <a href="<?php echo base_url().'Ccustomer/customer_update_form/'.$custlist['customer_id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <?php }} ?>

                                                <?php
                                                if($this->permission1->method('credit_customer','delete')->access()) { ?>
                                                           <?php  if($custlist['customer_name'] !='Walking Customer') {?>
                                                   <a href="<?php echo base_url() . 'Ccustomer/customer_delete/' . $custlist['customer_id']; ?>" onclick="return confirm('Are Your sure to delete?')" class=" btn btn-danger btn-sm" name="{customer_id}" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                <?php }} ?>

											</center>
										</td>
                                       <?php }?>
									</tr>
								<?php }?>
								<?php
									}
								?>
								</tbody>
								<tfoot>
									<tr>
										<td style="text-align:right !Important" colspan="4"><b> <?php echo display('grand_total') ?></b></td>
										<td style="text-align:right !Important">
											<b><?php echo (($position==0)?"$currency {subtotal}":"{subtotal} $currency") ?></b>
										</td>
                                        <?php
                                        if($this->permission1->method('credit_customer','update')->access() || $this->permission1->method('credit_customer','delete')->access()) { ?>
										<td></td>
										<?php } ?>
									</tr>
								</tfoot>
		                    </table>
		                    <div class="text-right"><?php echo $links?></div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
        <?php
        }
        else{
         ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4><?php echo display('You do not have permission to access. Please contact with administrator.');?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>

	</section>
</div>
<!-- Manage Customer End -->

<!-- Delete Customer ajax code -->
<script type="text/javascript">
	//Delete Customer
	$(".deleteCustomer").click(function()
	{
		var customer_id=$(this).attr('name');
		var csrf_test_name=  $("[name=csrf_test_name]").val();
		var x = confirm("<?php echo display('are_you_sure_to_delete')?>?");
		if (x==true){
		$.ajax
		   ({
				type: "POST",
				url: '<?php echo base_url('Ccustomer/customer_delete')?>',
				data: {customer_id:customer_id,csrf_test_name:csrf_test_name},
				cache: false,
				success: function(datas)
				{
				}
			});
		}
	});
</script>