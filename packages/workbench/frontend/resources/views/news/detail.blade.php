@extends('laravolt::eperak.layouts.base')

@section('content')

<!-- start-------------------------------------------------------------------------------------------------------- -->

@push('style')
<style type="text/css">

</style>
@endpush

<!-- start -------------------------------------------------------------------------------------------------------- -->

	<!-- banner start -->
        <section class="section-box">
            <div class="box-head-single" style="background-color: #f2f2f2 !important"> <!-- #9777fa -->
                <div class="container">
                    <!-- <h3 style="color: white;"> -->
                    	<!-- Berita Terkini -->
                    <!-- </h3> -->
                    <ul class="breadcrumbs">
                        <li ><a href="/news?page=1" style="font-size: 20px; font-weight: bold;">BERITA</a></li>
                        <li style="font-size: 20px; font-weight: bold;">{{ data_get($notis, 'tajuk') }}</li>
                    </ul>
                </div>
            </div>
        </section>
    <!-- banner end   -->

    <!-- berita start -->

        <section class="section-box mt-30">
            <div class="container">
                <div class="row flex-row-reverse">
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15">
                        <div class="sidebar-shadow">
                            <div class="sidebar-heading">
                                <div class="avatar-sidebar">
                                    <div class="sidebar-info">
                                        <span class="sidebar-company">
                                        	<h4>{{ data_get($notis, 'tajuk') }}</h4>
                                        </span>
                                    </div>
                                    <div class="sidebar-list-job">
                                        <span class="card-job-top--location text-sm">
                                            {{ data_get($notis, 'ringkasan') }}
                                        </span><br/>
                                        <span class="card-job-top--post-time text-sm">
                                            <i class="fi fi-rr-calendar"></i> {{ data_get($notis, 'tarikh_notis') }}
                                        </span><br/>
                                        <span class="card-job-top--location text-sm">
                                            &nbsp;
                                        </span><br/>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="text-description mt-15">
                                We're looking to add more product designers to our growing teams.
                            </div> -->
                            <div class="text-end">
                                <a href="/news?page=1" class="btn btn-border">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="single-image-feature">

                            @if( data_get($notis, 'path') )
                                @if( file_exists( public_path( data_get($notis, 'path') ) ) )
                                    <a target="_blank" href="{!! URL::to(data_get($notis, 'path')) !!}">
                                        <img src="{!! URL::to(data_get($notis, 'path')) !!}" 
                                             alt="{{ data_get($notis, 'tajuk') }}" 
                                             title="{{ data_get($notis, 'tajuk') }}" 
                                             class="img-rd-15"
                                             style="vertical-align: middle !important; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px;
                                                    height: 500px; object-fit: cover;">
                                    </a>
                                @else
                                    <center style="background-color: white; border-radius: 10px 10px 0px 0px ">
                                        <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" 
                                             alt="{{ data_get($notis, 'tajuk') }}" 
                                             title="{{ data_get($notis, 'tajuk') }}" 
                                             style="width: 30% !important">
                                    </center>
                                @endif
                            @else
                                <center style="background-color: white; border-radius: 10px 10px 0px 0px ">
                                    <img src="{{ asset('theme/assets/imgs/theme/perak/noimage.jpg') }}" 
                                         alt="{{ data_get($notis, 'tajuk') }}" 
                                         title="{{ data_get($notis, 'tajuk') }}" 
                                         style="width: 30% !important">
                                </center>
                            @endif


                            <div class="sidebar-shadow" style="border-radius: 0px 0px 10px 10px">
                                <div class="sidebar-heading">
                                    <div class="avatar-sidebar" style="text-align: justify;">
                                        <!-- <div class="sidebar-list-job"> -->
                                            {!! data_get($notis, 'keterangan') !!}
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- berita end -->

<!-- end ---------------------------------------------------------------------------------------------------------- -->
@endsection

@push('script')
<script type="text/javascript">


</script>
@endpush

