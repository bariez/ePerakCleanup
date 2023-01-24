<?php 
use App\Models\MngAnnouncement;
$now = date('Y-m-d');


if(env('DB_CONNECTION') == 'mysql')
{

    $announcement  = MngAnnouncement::where('status','=',1)
              ->whereRaw('start_date <= "'.$now.'" AND end_date >= "'.$now.'"')
             ->orderBy('created_at','DESC')->limit('5')->get();
}else{

    $announcement  = MngAnnouncement::where('status','=',1)
                 ->whereRaw('start_date <= GETDATE() AND end_date >= GETDATE()')
                 ->orderBy('created_at','DESC')
                 ->limit(5)
                 ->get();

}

?>
<div class="dropdown" style="color:grey">
    <a type="button" data-toggle="dropdown" class="btn btn-icon has-ripple " style="height:40px;width:40px;margin-top:10px;float:right;margin-right:10px;font-size: 25px;">
        
        <i class="fas fa-question-circle"></i>
    </a>
   
    <div class="dropdown-menu dropdown-menu-right " style="width: 100%;height: 200vh;background-color: ;overflow-x: scroll;background-image: url({{asset('themes/ablepro/assets/images/banner3.jpg')}});background-size: cover;">
        <?php 

            $locale = App::getLocale();
            $activems = '';
            $activeen = '';
        ?>
        <div class="col-sm-12">
            <h5 class="mb-3 text-center"> <a type="button" data-toggle="dropdown" class="btn btn-icon has-ripple" style="height:30px;width:30px;float:left"><i class="fas fa-angle-left"></i></a>@lang('homepage.contacts')</h5>
            <hr>

            <div class="col-md-12 col-xl-12">
                <div class="card order-card">
                    <div class="card-body " style="color:black !important;height:100%;overflow-x: scroll;">
                                             
                            @if($locale == 'en')
                                <section id="ctl00_MainPlace_GroupA" class="group bs-content-mar">
                                        <div class="">
                                          <strong>Telephone Service</strong>
                                        </div>
                                        <br>
                                        <div class="information_box-content">
                                            Customer Service Center hotline is as follows:<br>
                                            <br>
                                            <table>
                                                <tbody><tr>
                                                    <td style="width: 150px; vertical-align: top;">Toll-Free Line</td>
                                                    <td>03-8911 1000 (LHDN)<br>
                                                        Press 1 (Malay)<br>
                                                        Press 2 (English)<br>
                                                        next<br>
                                                        Press 3 (e-Filing)
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td colspan="2">&nbsp;</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>Oversea line</td>
                                                                                                        <td>+603-8911 1100</td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <td>e-Filing direct line</td>
                                                                                                        <td>03-8911 1400</td>
                                                                                                    </tr>
                                                                                                </tbody></table>
                                                                                                <br>
                                                                                                Please state your full name, income tax number and telephone number when contacting us via telephone.<br>
                                                        <br>
                                                        Please be informed, in order to improve our services, every phone conversation will be recorded for quality control and training purposes.<br>
                                                        <br>
                                                        <b>Customer Service Center operating hours:</b><br>
                                                        <br>
                                                        Monday to Friday : 8.00 am - 5.00 pm<br>
                                                        <br>
                                                        <b>Peak Hours for Customer Service Center Telephone Service</b><br>
                                                        <br>
                                                        Please be informed that the peak hours for Customer Service Center telephony service begins from 10.30 am to 12.30 pm and 2 pm to 4.30 pm.<br><br>
                                                        If you are having trouble contacting the Customer Service Center during peak hours mentioned above, you may also contact any LHDNM branches for assistance.<br><br><br>
                                                        <div style="font-size: 15px"><b>Customer Feedback Form</b></div>
                                                        <br>Please click <a href="http://maklumbalas.hasil.gov.my/" target="_blank" style="text-decoration: underline; color: Blue;" data-original-title="" title="">here</a> for the Customer Feedback Form.
                                                                                                <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                        </div>
                                    </section>
                            @else
                                <section id="ctl00_MainPlace_GroupA" class="group bs-content-mar">
                                        <div class="">
                                            <strong>Perkhidmatan Telefon</strong>
                                        </div>
                                        <br>
                                        <div class="information_box-content">
                                            Talian telefon HASiL Care Line adalah seperti dibawah;<br>
                                            <br>
                                            <table>
                                                <tbody><tr>
                                                    <td style="width: 150px; vertical-align: top;">Talian Bebas Tol</td>
                                                    <td>03-8911 1000 (LHDN)<br>
                                                        Tekan 1 (B. Malaysia)<br>
                                                        Tekan 2 (B. Inggeris)<br>
                                                        seterusnya<br>
                                                        Tekan 3 (e-Filing)
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>Talian luar negara</td>
                                                    <td>+603-8911 1100</td>
                                                </tr>
                                                <tr>
                                                    <td>Talian terus e-Filing</td>
                                                    <td>03-8911 1400</td>
                                                </tr>
                                            </tbody></table>
                                            <br>
                                            Sila nyatakan nama penuh, nombor cukai pendapatan dan nombor telefon anda semasa menghubungi kami melalui telefon.<br>
                                            <br>
                                            Adalah dimaklumkan, dalam usaha untuk mempertingkatkan mutu perkhidmatan kami, setiap perbualan telefon akan dirakam untuk tujuan pengawalan kualiti 
                                            dan latihan.<br>
                                            <br>
                                            <b>Waktu perkhidmatan HASiL Care Line:</b><br>
                                            <br>
                                            Isnin hingga Jumaat : 9.00 pagi - 5.00 petang<br>
                                            <br>
                                            <b>Waktu Puncak Perkhidmatan Telefon di HASiL Care Line</b><br>
                                            <br>
                                            Untuk memudahkan urusan tuan/puan, adalah dimaklumkan bahawa waktu puncak bagi perkhidmatan talian telefon HASiL Care Line adalah mulai 
                                            jam 10.30 pagi hingga 12.30 tengah hari dan 2 petang hingga 4.30 petang.<br>
                                            <br>
                                            Sekiranya tuan/puan mengalami masalah menghubungi HASiL Care Line pada waktu puncak yang dinyatakan di atas, tuan/puan juga boleh menghubungi 
                                            mana-mana Cawangan LHDNM untuk mendapatkan bantuan.<br>
                                            <br>
                                            <br>

                                            <div style="font-size: 15px"><b>Borang Maklumbalas Pelanggan</b></div>
                                            <br>
                                            Sila klik di <a href="http://maklumbalas.hasil.gov.my/" target="_blank" style="text-decoration: underline; color: Blue;" data-original-title="" title="">sini</a> untuk ke Borang Maklumbalas Pelanggan.
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                        </div>
                                    </section>
                            @endif
            
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="dropdown user" style="color:grey">

    <a class="btn btn-icon has-ripple " data-toggle="dropdown"  style="height:40px;width:40px;margin-top:10px;float:right;margin-right:10px;font-size: 25px;">
        <i class="fas fa-bell"></i>
    </a>

    <div class="dropdown-menu dropdown-menu-right " style="width: 100%;height: 200vh;background-color: ;overflow-x: scroll;background-image: url({{asset('themes/ablepro/assets/images/banner3.jpg')}});background-size: cover;">
        <h5 class="mb-3 text-center"> <a type="button" data-toggle="dropdown" class="btn btn-icon has-ripple" style="height:30px;width:30px;float:left"><i class="fas fa-angle-left"></i></a> @lang('homepage.announcement')</h5>
            <hr>

            <div class="col-md-12 col-xl-12">
                @forelse($announcement as $key => $data)

                    <div class="widget-statstic-card pt-0 pb-1 pl-3 pr-3 bg-white rounded" style="cursor:pointer;box-shadow: 2px 2px 10px -5px rgb(0, 84, 151);"> 
                        <span style="padding:unset;font-size: 12px;color:#00867b"><strong>{{date("d/m/Y", strtotime($data->start_date))}}</strong></span>
                        <p style="font-size: 11px;color:#00867b">

                            @if($locale == 'en')
                                {{$data->announcement_en}}
                                <br>
                                <?php echo $data->body_en ?>
                            @else
                                {{$data->announcement_bm}}
                                <br>
                                <?php echo $data->body_bm ?>
                            @endif
                        </p>
                        <i style="font-size:12px;background-color:#0687b9;padding: 35px 35px 12px 12px;" class="fas fa-bell st-icon"></i>
                    </div>
                    <hr>
                
                @empty
                <form class="text-center widget-statstic-card pt-2 pb-1 pl-3 pr-3 bg-white rounded">
                    <i class="feather icon-check-circle display-4 text-success"></i>
                    <h6 class="mt-3">@lang('inbox.empty')</h6>
                    <p>@lang('inbox.nodata')</p>
                    <i style="font-size:12px;background-color:#0687b9;padding: 35px 35px 12px 12px;" class="fas fa-bell st-icon"></i>
                </form>
                @endforelse

            </div>
    </div>
</div>