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
            <div class="box-head-single" style="background-color: #9777fa !important;">
                <div class="container">
                    <!-- <h3 style="color: white;"> -->
                    	<!-- Berita Terkini -->
                    <!-- </h3> -->
                    <ul class="breadcrumbs">
                        <li ><a href="/" style="font-size: 20px">Laman Utama</a></li>
                        <li style="color: white; font-size: 20px">{{ data_get($page, 'nama') }}</li>
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
                                        	<h4>{{ data_get($page, 'nama') }}</h4>
                                        </span>
                                    </div>
                                    <div class="sidebar-list-job">
                                        <span class="card-job-top--location text-sm">
                                            &nbsp;
                                        </span><br/>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <a href="/" class="btn btn-border">Kembali</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="single-image-feature">
                            <figure>
                                <img class="img-rd-15" src="{!! URL::to(data_get($page, 'path')) !!}" alt="{{ data_get($page, 'filename') }}" width="100%" height="100%">
                            </figure>
                        </div>
                        <div class="content-single">
                            
                            {!! data_get($page, 'content') !!}
                            
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