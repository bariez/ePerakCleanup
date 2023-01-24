

    <?php

        use Workbench\Site\Model\Frontend\Logo;
        use Workbench\Site\Model\Frontend\Hubungi;
        use Workbench\Site\Model\Frontend\Counter;
        use Workbench\Site\Model\Lookup\AuditLog;

        // $logo  = Logo::where('status', 1)
        //              ->where('type', 1)
        //              ->first();

        // $jata  = Logo::where('status', 1)
        //              ->where('type', 2)
        //              ->first();

        $contactus  = Hubungi::where('status', 1)
                             ->first();

        $counter  = Counter::first();

        $editdate = AuditLog::orderBy('id', 'desc')
                            ->first();

    ?>



	<!-- <footer class="footer pt-50 " style="background: #FEED21;"> --> <!-- mt-10 -->
    <footer class="footer pt-20" style="background-image: url('{{ asset('theme/assets/imgs/theme/perak/bgfooterfive.jpeg') }}') !important; /*background-size: cover; background-repeat: no-repeat;*/ 
                                        padding-top: 5px; padding-bottom: 5px;
                                        font-size: 12px">
		<div class="container">
             <!-- atas line -->
             <center>
    			<div class="row">
                    <div class="col-md-4 col-sm-12">&nbsp;</div>
    				<div class="col-md-4 col-sm-12">
                        <ul class="">
                            <li>
                                <a href="javascript:;" style="color: white">Jumlah Pelawat : {{ data_get($counter, 'count') }}</a>
                            </li>
                            <li>
                                <a href="javascript:;" style="color: white">Tarikh Kemaskini : {{ date('d-M-Y h:i:s A', strtotime( data_get($editdate, 'created_at') )) }}</a>
                            </li>
                        </ul>
                        <a href="javascript:;" style="color: white">
                            {{ data_get($contactus, 'alamat') }}<br>
                            Tel: {{ data_get($contactus, 'no_tel') }}&nbsp;&nbsp;&nbsp;Fax: {{ data_get($contactus, 'no_faks') }}<br>
                            Emel : {{ data_get($contactus, 'email') }}<br>
                        </a>
    				</div>
                    <div class="col-md-4 col-sm-12">&nbsp;</div>
    			</div>
                <br>
                 <!-- bawah line -->
                <div class="row" style="border-top: 1px solid white;">
                    <div class="col-md-12 col-sm-12">
                        <br>
                        <a href="javascript:;" style="color: white">
                            Hakcipta Terpelihara @ PerakGIS <br>
                            Paparan terbaik skrin beresolusi 1920x1080 piksel menggunakan browser Mozilla Firefox atau Google Chrome versi terkini
                        </a>
                    </div>
                </div>
            </center>
		</div>
	</footer>


<!-- <script>
    setInterval(myTimer, 1000);

    function myTimer() 
    {
        const date = new Date();
        document.getElementById("demo").innerHTML = date.toLocaleTimeString();
    }
</script> -->