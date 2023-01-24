<div class="ui two stackable link cards">
    <div class="card">
        <div class="content" style="text-align: center; background-color: #000000;">
            <div class="ui statistic">
                <div class="label" style="font-size: 20px; color: #fbfd7a">
                    JUMLAH PETEMPATAN
                </div>

                <br>

                <div class="value" style="color: #fbfd7a">
                    <!-- <i class="home icon"></i>&nbsp; -->{{ data_get($result,'jum_petempatan') }}
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="content" style="text-align: center; background-color: #000000;">
            <div class="ui statistic"> 
                <div class="label" style="font-size: 20px;color: #fbfd7a">
                    @if($resultall==null)
                        {{ data_get($category,'description') }}
                    @else
                        {{ data_get($resultall,'category') }}
                    @endif
                </div>
                
                <br>

                <div class="value" style="color: #fbfd7a">
                    @if($resultall==null)
                        <!-- <i class="map pin icon"></i>&nbsp; -->0
                    @else
                        <!-- <i class="map pin icon"></i>&nbsp; -->{{ data_get($resultall,'countpetempatan') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
