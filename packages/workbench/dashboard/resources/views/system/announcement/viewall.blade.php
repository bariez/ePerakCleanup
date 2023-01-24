@extends('laravolt::tnb.layouts.base')

@section('content')

<div class="col s12">
    <div class="container">
        @foreach($data as $key =>$data)
            <div class="col s12 m4">
                <div class="ct-chart card z-depth-2 border-radius-6">
                    <div class="card-content"  style="height: 270px !important;">
                        <h4 class="card-title">{{$data->title}}</h4>
                        {!! Str::words($data->content, 6, ' ...') !!}
                        <br><br>
                        <span style="color: grey!important;font-size: 12px;">Date : {{date('d-m-Y', strtotime($data->post_date))}}</span>
                        <a style="bottom: 0px;left: 35px;position: absolute;" class="btn waves-effect waves-light gradient-45deg-green-teal mb-3" href="/admin/announcement/view/{{$data->id}}"> Read Announcement</a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="content-overlay"></div>
    </div>
</div>
@endsection


@push('script')

<script type="text/javascript">

</script>

@endpush