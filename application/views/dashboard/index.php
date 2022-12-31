
			<!-- Container -->
            <div class="container-fluid mt-xl-50 mt-sm-30 mt-15 px-xxl-65 px-xl-20">
				
				<!-- Tab panes -->
				<div class="tab-content">
					<div class="tab-pane active" id="tabs-1" role="tabpanel">
						<!-- Row -->
						<div class="row">
							<div class="col-xl-12">
						
								<div class="row">
									<div class="col-xl-12">
										<div class="card card-refresh">
											<div class="refresh-container">
												<div class="loader-pendulums"></div>
											</div>
											<div class="card-header card-header-action">
												<h6>Grafik</h6>
												<div class="d-flex align-items-center card-action-wrap">
													<a href="#" class="inline-block refresh mr-15">
														<i class="ion ion-md-radio-button-off"></i>
													</a>
													<a href="#" class="inline-block full-screen">
														<i class="ion ion-md-expand"></i>
													</a>
												</div>
											</div>
											<div class="card-body">
											    	<div class="hk-legend-wrap mb-20">
													<div class="hk-legend">
														<span class="d-10 bg-success rounded-circle d-inline-block"></span><span><?= count($transaksi); ?> Transaksi</span>
													</div>
													
													<div class="hk-legend">
														<span class="d-10 bg-green-light-1 rounded-circle d-inline-block"></span><span><?= $currency['app_currency'] ?>
																		<?= rupiah($totrx['total']) ?>(Transaksi)</span>
													</div>
													<div class="hk-legend">
														<span class="d-10 bg-green-light-1 rounded-circle d-inline-block"></span><span><?= $currency['app_currency'] ?>
																		<?= rupiah($saldo['totalsaldo']) ?>(Saldo)</span>
													</div>
													<div class="hk-legend">
														<span class="d-10 bg-green-light-2 rounded-circle d-inline-block"></span><span><?= count($user); ?> User</span>
													</div>
													<div class="hk-legend">
														<span class="d-10 bg-green-light-3 rounded-circle d-inline-block"></span><span><?= count($hitungdriver); ?> Driver</span>
													</div>
														<div class="hk-legend">
														<span class="d-10 bg-green-light-3 rounded-circle d-inline-block"></span><span><?= count($mitra); ?> Mitra</span>
													</div>
												</div>
												<div class="hk-legend-wrap mb-20">
													<div class="hk-legend">
														<span class="d-10 bg-success rounded-circle d-inline-block"></span><span>Transportasi</span>
													</div>
													
													<div class="hk-legend">
														<span class="d-10 bg-green-light-1 rounded-circle d-inline-block"></span><span>Pengiriman</span>
													</div>
													<div class="hk-legend">
														<span class="d-10 bg-green-light-2 rounded-circle d-inline-block"></span><span>Rental</span>
													</div>
													<div class="hk-legend">
														<span class="d-10 bg-green-light-3 rounded-circle d-inline-block"></span><span>Jasa</span>
													</div>
												</div>
												<div id="mycart" class="echart" style="height: 240px;"></div>
											</div>
										</div>
									
										
									</div>
								</div>
								<div class="card">
											<div class="card-header card-header-action">
												<h6>Transaksi Aktif</h6>
												<div class="d-flex align-items-center card-action-wrap">
													<a href="#" class="inline-block refresh mr-15">
														<i class="ion ion-md-radio-button-off"></i>
													</a>
												
													<a href="#" class="inline-block full-screen">
														<i class="ion ion-md-expand"></i>
													</a>
												</div>
											</div>
											
											<div class="card-body">
												<div class="table-responsive">
												 
													<table id="mwtable" class="table table-striped table-hover dt-responsive display nowrap" data-info="false" cellspacing="0" width="100%">
														<thead>
															<tr>
																<th>Detail</th>
																<th>Customer</th>
																<th>Driver</th>
																<th>Fitur</th>
																<th>Biaya</th>
																<th>Pembayaran</th>
																<th>Status</th>
																<th>Actions</th>
																<th>Asal</th>
																<th>Tujuan</th>
															</tr>
														</thead>
														<tbody>
															<?php $i = 1;
															foreach ($transaksi as $tr) { ?>

																<tr>
																	<td style="text-align: center"></td>
																	<td><?= $tr['fullnama'] ?></td>
																	<td><?= $tr['nama_driver'] ?></td>
																	<td><?= $tr['fitur'] ?></td>
																	<td><?= $currency['app_currency'] ?>
																	<?= rupiah($tr['biaya_akhir']) ?></td>
																	<td>
																		<?php if ($tr['pakai_wallet'] == '0') {
																			echo 'CASH';
																		} else {
																			echo 'WALLET';
																		} ?>
																	</td>
																	<td>
																		<?php if ($tr['status'] == '2') { ?>
																			<label class="badge badge-primary"><?= $tr['status_transaksi']; ?></label>
																		<?php } ?>
																		<?php if ($tr['status'] == '3') { ?>
																			<label class="badge badge-success"><?= $tr['status_transaksi']; ?></label>
																		<?php } ?>
																		<?php if ($tr['status'] == '5') { ?>
																			<label class="badge badge-danger"><?= $tr['status_transaksi']; ?></label>
																		<?php } ?>
																		<?php if ($tr['status'] == '4') { ?>
																			<label class="badge badge-info"><?= $tr['status_transaksi']; ?></label>
																		<?php } ?>
																	</td>
																	
																	<td>
																		<a href="<?= base_url(); ?>dashboard/detail/<?= $tr['id_transaksi']; ?>" class="btn btn-outline-primary">View</a>
																		<a onclick="return confirm ('Are You Sure?')" href="<?= base_url(); ?>dashboard/delete/<?= $tr['id_transaksi']; ?>" class="btn btn-outline-danger">Delete</a>
																	</td>
																	<td style="max-width:300px;"><?= $tr['alamat_asal'] ?></td>
																	<td style="max-width:300px;"><?= $tr['alamat_tujuan'] ?></td>
																</tr>
															<?php $i++;
															} ?>
														</tbody>
													</table>
													</div>
											</div>
										</div>
							</div>
						</div>
						<!-- /Row -->
					</div>
				</div>
		
            <!-- /Container -->
			
           
        <!-- /Main Content -->
		<?php $this->load->view('includes/footer'); ?>
		<script>
    	"use strict"; 
        $.toast({
    		heading: 'Selamat Datang!',
    		text: '<p>Selamat Datang Di <?=$this->config->item('app_name');?>.</p>',
    		position: 'bottom-right',
    		loaderBg:'#22AF47',
    		class: 'jq-toast-success',
    		hideAfter: 3500, 
    		stack: 6,
    		showHideTransition: 'fade'
    	});
		</script>
	
		<script>
		    "use strict"; 
    		if( $('#mycart').length > 0 ){
    		var eChart_5 = echarts.init(document.getElementById('mycart'));
    		var option4 = {
    			color: ['#22AF47', '#bce7c7', '#69c982','#90d7a3'],		
    			tooltip: {
    				show: true,
    				trigger: 'axis',
    				backgroundColor: '#fff',
    				borderRadius:6,
    				padding:6,
    				axisPointer:{
    					lineStyle:{
    						width:0,
    					}
    				},
    				textStyle: {
    					color: '#324148',
    					fontFamily: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"',
    					fontSize: 12
    				}	
    			},
    			toolbox: {
    				show: false,
    			},
    			grid: {
    				left: '3%',
    				right: '3%',
    				bottom: '3%',
    				top:'3%',
    				containLabel: true
    			},
    			xAxis : [
    				{
    					type : 'category',
    					data : ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
    					axisLine: {
    						show:false
    					},
    					axisLabel: {
    						textStyle: {
    							color: '#878787'
    						}
    					},
    				}
    			],
    			yAxis : [
    				{
    					type : 'value',
    					axisLine: {
    						show:false
    					},
    					axisLabel: {
    						textStyle: {
    							color: '#878787'
    						}
    					},
    					splitLine: {
    						show: false,
    					}
    				}
    			],
    			series : [
    				{
    					name:'Transportasi',
    					type:'bar',
    					 data: [
                                    <?= $jan1[0]['jumlah'] ?>,
                                    <?= $feb1[0]['jumlah'] ?>,
                                    <?= $mar1[0]['jumlah'] ?>,
                                    <?= $apr1[0]['jumlah'] ?>,
                                    <?= $mei1[0]['jumlah'] ?>,
                                    <?= $jun1[0]['jumlah'] ?>,
                                    <?= $jul1[0]['jumlah'] ?>,
                                    <?= $aug1[0]['jumlah'] ?>,
                                    <?= $sep1[0]['jumlah'] ?>,
                                    <?= $okt1[0]['jumlah'] ?>,
                                    <?= $nov1[0]['jumlah'] ?>,
                                    <?= $des1[0]['jumlah'] ?>
                                ]
    				},
    				{
    					name:'Pengiriman',
    					type:'bar',
    					 data: [
                                    <?= $jan2[0]['jumlah'] ?>,
                                    <?= $feb2[0]['jumlah'] ?>,
                                    <?= $mar2[0]['jumlah'] ?>,
                                    <?= $apr2[0]['jumlah'] ?>,
                                    <?= $mei2[0]['jumlah'] ?>,
                                    <?= $jun2[0]['jumlah'] ?>,
                                    <?= $jul2[0]['jumlah'] ?>,
                                    <?= $aug2[0]['jumlah'] ?>,
                                    <?= $sep2[0]['jumlah'] ?>,
                                    <?= $okt2[0]['jumlah'] ?>,
                                    <?= $nov2[0]['jumlah'] ?>,
                                    <?= $des2[0]['jumlah'] ?>
                                ]
    				},
    				{
    					name:'Rental',
    					type:'bar',
    					 data: [
                                    <?= $jan3[0]['jumlah'] ?>,
                                    <?= $feb3[0]['jumlah'] ?>,
                                    <?= $mar3[0]['jumlah'] ?>,
                                    <?= $apr3[0]['jumlah'] ?>,
                                    <?= $mei3[0]['jumlah'] ?>,
                                    <?= $jun3[0]['jumlah'] ?>,
                                    <?= $jul3[0]['jumlah'] ?>,
                                    <?= $aug3[0]['jumlah'] ?>,
                                    <?= $sep3[0]['jumlah'] ?>,
                                    <?= $okt3[0]['jumlah'] ?>,
                                    <?= $nov3[0]['jumlah'] ?>,
                                    <?= $des3[0]['jumlah'] ?>
                                ]
    				},
    				{
    					name:'Jasa',
    					type:'bar',
    					 data: [
                                    <?= $jan4[0]['jumlah'] ?>,
                                    <?= $feb4[0]['jumlah'] ?>,
                                    <?= $mar4[0]['jumlah'] ?>,
                                    <?= $apr4[0]['jumlah'] ?>,
                                    <?= $mei4[0]['jumlah'] ?>,
                                    <?= $jun4[0]['jumlah'] ?>,
                                    <?= $jul4[0]['jumlah'] ?>,
                                    <?= $aug4[0]['jumlah'] ?>,
                                    <?= $sep4[0]['jumlah'] ?>,
                                    <?= $okt4[0]['jumlah'] ?>,
                                    <?= $nov4[0]['jumlah'] ?>,
                                    <?= $des4[0]['jumlah'] ?>
                                ]
    				}
    			]
    		};
    
    		eChart_5.setOption(option4);
    		eChart_5.resize();
    	}
		</script>
		
		<script>
	    "use strict"; 
    	if( $('#mychart2').length > 0 ){
    		var eChart_1 = echarts.init(document.getElementById('mychart2'));
    		var option = {
    			color: ['#69c982'],
    			tooltip: {
    				show: true,
    				trigger: 'axis',
    				backgroundColor: '#fff',
    				borderRadius:6,
    				padding:6,
    				axisPointer:{
    					lineStyle:{
    						width:0,
    					}
    				},
    				textStyle: {
    					color: '#324148',
    					fontFamily: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"',
    					fontSize: 12
    				}
    			},
    			
    			xAxis: [{
    				type: 'category',
    				data: ['Transaksi', 'Nominal', 'Customer', 'Driver', 'Mitra'],
    				axisLine: {
    					show:false
    				},
    				axisTick: {
    					show:false
    				},
    				axisLabel: {
    					textStyle: {
    						color: '#5e7d8a'
    					}
    				}
    			}],
    			yAxis: {
    				type: 'value',
    				axisLine: {
    					show:false
    				},
    				axisTick: {
    					show:false
    				},
    				axisLabel: {
    					textStyle: {
    						color: '#5e7d8a'
    					}
    				},
    				splitLine: {
    					lineStyle: {
    						color: '#eaecec',
    					}
    				}
    			},
    			grid: {
    				top: '3%',
    				left: '3%',
    				right: '3%',
    				bottom: '3%',
    				containLabel: true
    			},
    			series: [{
    				data: [<?= count($transaksi); ?>, 
    				<?= rupiah($totrx['total']) ?>, 
    				<?= count($user); ?>, 
    				<?= count($hitungdriver); ?>, 
    				<?= count($mitra); ?>],
    				type: 'bar',
    				barMaxWidth: 30,
    				itemStyle: {
    					normal: {
    						barBorderRadius: [6, 6, 0, 0] ,
    					}
    				},
    			}]
    		};
    		eChart_1.setOption(option);
    		eChart_1.resize();
    	}
	</script>
	<script>
	
</script>
