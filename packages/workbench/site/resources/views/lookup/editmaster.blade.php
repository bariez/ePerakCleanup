@extends('laravolt::layout.app2')

@section('content')

<div id="actionbar" class="ui two column grid content__body p-x-3 p-y-1 m-b-0">
    <div class="column middle aligned">
                <h3 class="ui header m-t-xs">
           Kemaskini Kamus Data
        </h3>
    </div>
 <div class="column right aligned middle aligned">

           <a class="ui button" id="backbutton" href="/site/lookup/index"><i class="material-icons left"></i><span>Kembali</span></a>
    </div>
    
</div>


<div class="ui container-fluid content__body p-3">
        <div class="ui segments panel">
            <div class="ui segment panel__header ">
                <div class="ui menu secondary borderless m-0 p-0" style="min-height: 0">
                    <div class="item p-0 m-0">
                        <h4 class="panel__title ui header p-x-sm p-y-0">
                            <i class="pencil alternate icon"></i> Kemaskini Kamus Data
                        </h4>
                    </div>
                
                
            </div>
        </div>

        <div class="ui segment p-3">
        {!! form()->open()->post()->action(route('site::lkpmaster.editmaster',data_get($datamaster,'id')))->horizontal() !!}
         <div class="field">
            <label>Nama<font color="red">*</font></label>
            <input type="text" name="name" id="name" required="required"  value="{{data_get($datamaster,'name')}}">
          </div>
            <div class="field">
              <label>Kamus Data Utama</label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="mainlookup" value="{{data_get($datamaster,'parent_id')}}">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      @foreach($mainlookup as $key => $value)
                       <div class="item" data-value="{{$value->id}}">{{$value->name}}</div>
                        @endforeach
                    </div>
                  </div>
              </div>
              <div class="field">
              <label>Status<font color="red">*</font></label>
                <div class="ui fluid search selection dropdown">
                    <input type="hidden" name="status"  required="required" value="{{data_get($datamaster,'status')}}">
                    <i class="dropdown icon"></i>
                    <div class="default text">Sila Pilih</div>
                    <div class="menu">
                      <div class="item" data-value="">Sila Pilih</div>
                      <div class="item" data-value="1">Aktif</div>
                      <div class="item" data-value="0">Tidak Aktif</div>
                    </div>
                  </div>
              </div>
         

        <div class="ui divider section"></div>
        <div align="right">
                    <button type="submit" id="editbutton" class="ui button">
                        Kemaskini
                    </button>
                   <!--  <button class="ui button"><a href="{{URL::to('/site/lookup/index')}}">Kembali</a></button>     -->
                </div>

         </div>

        {!! form()->close() !!}
        </div>

        
    </div>
</div>

    
@endsection
@push('script')

<script type="text/javascript">

  $(document).ready(function() 
  {  
     $('#name').keyup(function()
    {
        $(this).val($(this).val().toUpperCase());
    });
     
  });

</script>

@endpush