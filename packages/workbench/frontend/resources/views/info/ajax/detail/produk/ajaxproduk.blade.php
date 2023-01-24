
	<section class="section-box">
		<div class="container">
			<div class="row align-items-end">
				<div class="col-lg-12 pt-30 text-end" id="tabbingpapar">
					<ul class="nav nav-right float-end" role="tablist">
						
						@foreach($lkpDetailProduk as $key => $value)
							<!-- if( count( $value->profil_produk ) != 0 ) -->
								<li class="" style="list-style-type: none;">
									<button data-bs-toggle="tab" 
											data-bs-target="#tab-id" 
											data-idprodukkat="{{ data_get($value, 'id') }}" 
											role="tab" 
											aria-controls="tab-id" aria-selected="true" 
											onclick="produkkatid(this)"
											>
												{{ data_get($value, 'description') }}&nbsp;&nbsp;
												<span class="badge rounded-pill bg-danger" style="vertical-align: text-top"> <!-- position-absolute top-0 start-100  -->
													{{ count( $value->profil_produk->where('fk_kampung', $request->segment(5) ) ) }}
												</span>
									</button>
								</li>
							<!-- else -->
							<!-- endif -->
						@endforeach

					</ul>
				</div>

				<div class="mt-5">
					<div class="tab-content" id="myTabContent-1">
						<div class="tab-pane fade" id="tab-id" role="tabpanel" aria-labelledby="tab-id">
							
							<div class="row" id="papar-produk">

							</div>

							<div class="row mt-30" id="ajaxloadingpapar-produk" style="display: none">
								<center>
									<img src="{{ asset('theme/assets/imgs/theme/loading.gif') }}" alt="e-Perak" style="height: 350px; width: 466px" />
								</center>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

<script type="text/javascript">

	// --------- function
	function produkkatid(data)
	{
		var idprodukkat = $(data).data('idprodukkat');
		var idkampung   = "{{ $request->segment(5) }}";

		// alert(idkampung);

		$.ajax({
			type: "GET", 
			url: "{{ URL::to('/info/ajax/detail/produk/modal/')}}"+"/"+idkampung+"/"+idprodukkat,
			datatype : 'json',

			beforeSend: function ()
			{
				$('#papar-produk').html('');
				$('#papar-produk').hide();
				$('#tabbingpapar').hide();
				$('#ajaxloadingpapar-produk').show();
			},
			success: function(data)
			{
				$('#papar-produk').html(data);
				$('#ajaxloadingpapar-produk').hide();
				$('#papar-produk').show();
				$('#tabbingpapar').show();
			}
		});
	}

</script>