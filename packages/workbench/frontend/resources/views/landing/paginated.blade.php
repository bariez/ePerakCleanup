<?php 
    if(isset($_GET['tahun'])) 
    {
        $tahun = $_GET['tahun'];
        // dd($tahun);exit;
    }

    if(isset($_GET['data'])) 
    {
        $data = $_GET['data'];
        // dd($data);exit;
    }  

    if(isset($_GET['daerah'])) 
    {
        $daerah = $_GET['daerah'];
        // dd($daerah);exit;
    }  

    if(isset($_GET['mukim'])) 
    {
        $mukim = $_GET['mukim'];
        // dd($mukim);exit;
    }  

    if(isset($_GET['kampung'])) 
    {
        $kampung = $_GET['kampung'];
        // dd($kampung);exit;
    }  


    
?>

<ul class="pager">
	<li <?php if($request->page <= 1){ echo 'disabled'; } ?> >
        @if(isset($tahun))
            <a href="<?php if($request->page <= 1){ echo 'javascript:;'; } else { echo "?tahun=$tahun&data=$data&page=" . ((int)$request->page-(int)1); } ?>" class="pager-prev"></a>
        @elseif(isset($daerah))
            <a href="<?php if($request->page <= 1){ echo 'javascript:;'; } else { echo "?daerah=$daerah&mukim=$mukim&kampung=$kampung&page=" . ((int)$request->page-(int)1); } ?>" class="pager-prev"></a>
        @else
            <a href="<?php if($request->page <= 1){ echo 'javascript:;'; } else { echo "?page=" . ((int)$request->page-(int)1); } ?>" class="pager-prev"></a>
        @endif
	</li>

	<?php
		// no of page before ...
    	$stop = 5;

    	// current page
    	$curpage = $request->page;

    	// ...
    	$skip = $stop + $curpage;

    	// last loop. 168 - 5 = 163
    	$last_loop = $totalpage - $stop;
	?>

        <!-- kalo <totalpage> < <stop> -->
            @if($totalpage <= $stop)  <!-- maksud nya, totalpage 2, stop 5 -->
                @for( $i = 1; $i <= $totalpage; $i++)
                    <li>
                        @if(isset($tahun))
                            <a href="?tahun={{ $tahun }}&data={{ $data }}&page=<?= $i; ?>" class="pager-number <?php if($request->page == $i) {echo 'active'; } ?>" style="color: white; text-shadow: 2px 2px #000000;">
                                <center>{{ $i }}</center>
                            </a>
                        @elseif(isset($daerah))
                            <a href="?daerah={{ $daerah }}&mukim={{ $mukim }}&kampung={{ $kampung }}&page=<?= $i; ?>" class="pager-number <?php if($request->page == $i) {echo 'active'; } ?>" style="color: white; text-shadow: 2px 2px #000000;">
                                <center>{{ $i }}</center>
                            </a>
                        @else
                            <a href="?page=<?= $i; ?>" class="pager-number <?php if($request->page == $i) {echo 'active'; } ?>" style="color: white; text-shadow: 2px 2px #000000;">
                                <center>{{ $i }}</center>
                            </a>
                        @endif
                    </li>
                @endfor
    		  <!-- paparan sebelum <stop> terakhir -->
    		@elseif($request->page < $last_loop)
    			@for( $i = 0, $j=$request->page; $i < $totalpage; $i++, $j++ )
            		@if( $j < $skip )
            			<li>
                            @if(isset($tahun))
                                <a href="?tahun={{ $tahun }}&data={{ $data }}&page=<?= $j; ?>" class="pager-number <?php if($request->page == $j) {echo 'active'; } ?>" style="color: white; text-shadow: 2px 2px #000000;">
                                    <center>{{ $j }}</center>
                                </a>
                            @elseif(isset($daerah))
                                <a href="?daerah={{ $daerah }}&mukim={{ $mukim }}&kampung={{ $kampung }}&page=<?= $j; ?>" class="pager-number <?php if($request->page == $j) {echo 'active'; } ?>" style="color: white; text-shadow: 2px 2px #000000;">
                                    <center>{{ $j }}</center>
                                </a>
                            @else
                                <a href="?page=<?= $j; ?>" class="pager-number <?php if($request->page == $j) {echo 'active'; } ?>" style="color: white; text-shadow: 2px 2px #000000;">
                                    <center>{{ $j }}</center>
                                </a>
                            @endif
    	            	</li>
                	@endif

            		@if( $j == $skip )
            			@if($j < $totalpage)
                			<li><center><span style="color: white; text-shadow: 2px 2px #000000;">...</span></center></li>
            			@endif
                	@endif

            		@if( $j == $totalpage )
                		<li>
                            @if(isset($tahun))
                                <a href="?tahun={{ $tahun }}&data={{ $data }}&page=<?= $totalpage; ?>" class="pager-number" style="color: white; text-shadow: 2px 2px #000000;">
                                    <center>{{ $totalpage }}</center>
                                </a>
                            @elseif(isset($daerah))
                                <a href="?daerah={{ $daerah }}&mukim={{ $mukim }}&kampung={{ $kampung }}&page=<?= $totalpage; ?>" class="pager-number" style="color: white; text-shadow: 2px 2px #000000;">
                                    <center>{{ $totalpage }}</center>
                                </a>
                            @else
                        		<a href="?page=<?= $totalpage; ?>" class="pager-number" style="color: white; text-shadow: 2px 2px #000000;">
                        			<center>{{ $totalpage }}</center>
                        		</a>
                            @endif
                    	</li>
                	@endif
    	    	@endfor
    		@else

		<!-- paparan <stop> terakhir -->
			@for( $i = 0; $i <= $totalpage; $i++)

        		@if( $i == 0 )
            		<li>
                        @if(isset($tahun))
                            <a href="?tahun={{ $tahun }}&data={{ $data }}&page=1" class="pager-number" style="color: white; text-shadow: 2px 2px #000000;">
                                <center>1</center>
                            </a>
                        @elseif(isset($daerah))
                            <a href="?daerah={{ $daerah }}&mukim={{ $mukim }}&kampung={{ $kampung }}&page=1" class="pager-number" style="color: white; text-shadow: 2px 2px #000000;">
                                <center>1</center>
                            </a>
                        @else
                    		<a href="?page=1" class="pager-number" style="color: white; text-shadow: 2px 2px #000000;">
                    			<center>1</center>
                    		</a>
                        @endif
                	</li>
        			<li><center><span style="color: white; text-shadow: 2px 2px #000000;">...</span></center></li>
            	@endif
        		@if($i >= $last_loop && $i <= $totalpage)
        			<li>
                        @if(isset($tahun))
                            <a href="?tahun={{ $tahun }}&data={{ $data }}&page=<?= $i; ?>" class="pager-number <?php if($request->page == $i) {echo 'active'; } ?>" style="color: white; text-shadow: 2px 2px #000000;">
                                <center>{{ $i }}</center>
                            </a>
                        @elseif(isset($daerah))
                            <a href="?daerah={{ $daerah }}&mukim={{ $mukim }}&kampung={{ $kampung }}&page=<?= $i; ?>" class="pager-number <?php if($request->page == $i) {echo 'active'; } ?>" style="color: white; text-shadow: 2px 2px #000000;">
                                <center>{{ $i }}</center>
                            </a>
                        @else
    	            		<a href="?page=<?= $i; ?>" class="pager-number <?php if($request->page == $i) {echo 'active'; } ?>" style="color: white; text-shadow: 2px 2px #000000;">
    	            			<center>{{ $i }}</center>
    	            		</a>
                        @endif
	            	</li>
            	@endif
	    	@endfor
		@endif

    <li <?php if($request->page == $totalpage){ echo 'disabled'; } ?> >
        @if(isset($tahun))
            <a href="<?php if($request->page == $totalpage) { echo 'javascript:;'; } else { echo "?tahun=$tahun&data=$data&page=" . ((int)$request->page+(int)1); } ?>" class="pager-next"></a>
        @elseif(isset($daerah))
            <a href="<?php if($request->page == $totalpage) { echo 'javascript:;'; } else { echo "?daerah=$daerah&mukim=$mukim&kampung=$kampung&page=" . ((int)$request->page+(int)1); } ?>" class="pager-next"></a>
        @else
    	   <a href="<?php if($request->page == $totalpage) { echo 'javascript:;'; } else { echo "?page=" . ((int)$request->page+(int)1); } ?>" class="pager-next"></a>
        @endif
    </li>
</ul>
