<?php
namespace Workbench\Frontend\Data\Repo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

use Workbench\Site\Model\Lookup\Parlimen;
use Workbench\Site\Model\Lookup\Dun;
use Workbench\Site\Model\Lookup\Daerah;
use Workbench\Site\Model\Lookup\Mukim;
use Workbench\Site\Model\Lookup\Kampung;

use Workbench\Site\Model\Lookup\ProfilAktiviti;
use Workbench\Site\Model\Lookup\ProfilPencapaian;
use Workbench\Site\Model\Lookup\ProfilKemudahan;
use Workbench\Site\Model\Lookup\ProfilProduk;
use Workbench\Site\Model\Lookup\ProfilProjek;
use Workbench\Site\Model\Lookup\ProfilPentadbiran;
use Workbench\Site\Model\Lookup\GaleriMast;
use Workbench\Site\Model\Lookup\GaleriDetail;
use Workbench\Site\Model\Lookup\Pemilikanrumah;
use Workbench\Site\Model\Lookup\Isirumah;

use Workbench\Site\Model\Lookup\LkpMaster;
use Workbench\Site\Model\Lookup\LkpDetail;
use Workbench\Site\Model\Lookup\VwKampungRumah;
use Workbench\Site\Model\Lookup\AclRoleUser;
use Workbench\Site\Model\Lookup\AuditLog;

use Workbench\Site\Model\Frontend\Logo;
use Workbench\Site\Model\Frontend\Banner;
use Workbench\Site\Model\Frontend\Notis;
use Workbench\Site\Model\Frontend\Hubungi;
use Workbench\Site\Model\Frontend\SoalanLazim;
use Workbench\Site\Model\Frontend\ProductIcon;
use Workbench\Site\Model\Frontend\Menum;
use Workbench\Site\Model\Frontend\ContentPage;
use Workbench\Site\Model\Frontend\Counter;
use Workbench\Site\Model\Lookup\VwKemudahanAwam;
use Workbench\Site\Model\Lookup\VwKetuaIsiRumah;

/**
 *
 *
 * @laravolt site
 * @author apip
 **/
class FrontendRepo
{
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author
	 **/

	public function ajaxMukim($request)
	{
		$user = auth()->user();
		$roleuser = AclRoleUser::where('user_id', data_get($user,'id'))
							   ->first();

		// if (data_get($roleuser, 'role_id') == 2) // Pentadbir Daerah
		// {
		// 	$mukim  = Mukim::where('fk_daerah', $request->iddaerah)
		// 					->whereHas('user', function ($query) use ($user)
		// 					{
		// 						$query->where('Mukim', '=', $user->Mukim);
		// 					})
		// 					->with('user')
		// 					->get();
		// }
		if (data_get($roleuser, 'role_id') == 3) // Penghulu Mukim
		{
			$mukim  = Mukim::whereHas('user', function ($query) use ($user)
						   {
							   $query->where('Mukim', '=', $user->Mukim);
						   })
						   ->with('user')
						   ->first();
		}
		else
		{
			$mukim  = Mukim::where('fk_daerah', $request->iddaerah)
						   ->with('user')
						   ->get();
		}

		// dd($mukim, $roleuser->role_id, $user);exit;

		return $mukim;
	}

	public function ajaxParlimenDaerah($request)
	{
		$parlimen  = Parlimen::with('kampung.daerah')
							 ->where('Status', 1)
							 ->whereHas('kampung.daerah', function ($query) use ($request)
							   {
							   		$query->where('id', '=', $request->iddaerah);
							   })
							 ->get();

		return $parlimen;
	}

	public function ajaxParlimenMukim($request)
	{
		$parlimen  = Parlimen::with('kampung.mukim')
							 ->where('Status', 1)
							 ->whereHas('kampung.mukim', function ($query) use ($request)
							   {
							   		$query->where('id', '=', $request->idmukim);
							   })
							 ->get();

		return $parlimen;
	}

	public function ajaxDun($request)
	{
		$dun  = Dun::where('fk_parlimen', $request->idparlimen)
				   ->get();

		return $dun;
	}

	public function ajaxKampung($request)
	{
		$parlimen = data_get($request, 'idparlimen');
		$dun 	  = data_get($request, 'iddun');
		$daerah   = data_get($request, 'iddaerah');
		$mukim 	  = data_get($request, 'idmukim');
		$cat 	  = data_get($request, 'idcat');
		$kampung  = data_get($request, 'idkampung');

		// dd($parlimen, $dun, $daerah, $mukim, $cat, $kampung);exit;

		$kampung = Kampung::where(function ($query) use ($parlimen)
							{
								if($parlimen != '0')
									$query->where('fk_parlimen', '=', $parlimen);
								else
									$query;
							})
							->where(function ($query) use ($dun)
							{
								if($dun != '0')
									$query->where('fk_dun', '=', $dun);
								else
									$query;
							})
							->where(function ($query) use ($daerah)
							{
								if($daerah != '0')
									$query->where('fk_daerah', '=', $daerah);
								else
									$query;
							})
							->where(function ($query) use ($mukim)
							{
								if($mukim != '0')
									$query->where('fk_mukim', '=', $mukim);
								else
									$query;
							})
							->where(function ($query) use ($cat)
							{
								if($cat != '0')
									$query->where('KategoriPetempatan', '=', $cat);
								else
									$query;
							})
							// ->where(function ($query) use ($kampung)
							// {
							// 	if($kampung != '0')
							// 		$query->where('fk_kampung', '=', $kampung);
							// 	else
							// 		$query;
							// })
							->get();


		return $kampung;
	}

	public function ajaxResult($request)
	{
		$parlimen = data_get($request, 'idparlimen');
		$dun 	  = data_get($request, 'iddun');
		$daerah   = data_get($request, 'iddaerah');
		$mukim 	  = data_get($request, 'idmukim');
		$cat 	  = data_get($request, 'idcat');
		$kampung  = data_get($request, 'idkampung');

		// dd($parlimen, $dun, $daerah, $mukim, $cat, $kampung);exit;

		$data = Kampung::with('parlimen', 'dun', 'daerah', 'mukim', 'catpetempatan', 'kampung_rangkaian')
							->where(function ($query) use ($parlimen)
							{
								if($parlimen != '0')
									$query->where('fk_parlimen', '=', $parlimen);
								else
									$query;
							})
							->where(function ($query) use ($dun)
							{
								if($dun != '0')
									$query->where('fk_dun', '=', $dun);
								else
									$query;
							})
							->where(function ($query) use ($daerah)
							{
								if($daerah != '0')
									$query->where('fk_daerah', '=', $daerah);
								else
									$query;
							})
							->where(function ($query) use ($mukim)
							{
								if($mukim != '0')
									$query->where('fk_mukim', '=', $mukim);
								else
									$query;
							})
							->where(function ($query) use ($cat)
							{
								if($cat != '0')
								{
									if($cat==4)
									{
										$query->where('KategoriPetempatan', '=', $cat)
											  ->whereNull('IdKampungInduk');
									}
									else
									{
										$query->where('KategoriPetempatan', '=', $cat);
									}
								}
								else
									$query->whereNull('IdKampungInduk');
							})
							->where(function ($query) use ($kampung)
							{
								if($kampung != '0')
									$query->where('id', '=', $kampung);
								else
									$query;
							})
							->get();


		return $data;
	}

	public function dataKampung($request)
	{
		return Kampung::where('id', $request->idkampung)
					  ->with('profil_aktiviti', 'profil_pencapaian', 'profil_infra', 'profil_produk', 'profil_projek', 'profil_pentadbiran')
					  ->first();
	}

	public function dataJantina($request)
	{
		$lelaki = Isirumah::with('rumah')
							->whereHas('rumah', function ($query) use ($request)
							{
								$query->where('fk_kampung', '=', $request->idkampung);
						   	})
						   	->where('Jantina', 113)
						   	->count();

		$wanita = Isirumah::with('rumah')
							->whereHas('rumah', function ($query) use ($request)
							{
								$query->where('fk_kampung', '=', $request->idkampung);
						   	})
						   	->where('Jantina', 114)
						   	->count();

		$jantina = $lelaki.", ".$wanita;

		return $jantina;

						   // dd($jantina);exit;
	}

	public function dataBangsa($request)
	{
		$lkpbangsa = LkpDetail::where('status',1)->where('fk_lkp_master', 20)
							  ->get();
							  // dd($lkpbangsa);exit;

		$bangsa = "";
		$bangsalabel = "";
		$i = 1;

		foreach ($lkpbangsa as $key => $value)
		{
			$pecahans = Isirumah::with('rumah')
								->whereHas('rumah', function ($query) use ($request)
								{
									$query->where('fk_kampung', '=', $request->idkampung);
								})
								->where('Bangsa', $value->id)
								->count();

			if($i == 1)
			{
				$bangsa = $pecahans;
				$bangsalabel = "'".$value->description."'";
			}
			else
			{
				$bangsa = $bangsa.", ".$pecahans;
				$bangsalabel = $bangsalabel.", '".$value->description."'";
			}

			$i++;

		}

		return compact('bangsa', 'bangsalabel');
	}

	public function dataTarafPerkahwinan($request)
	{
		$lkptaraf = LkpDetail::where('status',1)->where('fk_lkp_master', 23)
							  ->get();
							  // dd($lkptaraf);exit;

		$taraf = "";
		$taraflabel = "";
		$i = 1;

		foreach ($lkptaraf as $key => $value)
		{
			$pecahans = Isirumah::with('rumah')
								->whereHas('rumah', function ($query) use ($request)
								{
									$query->where('fk_kampung', '=', $request->idkampung);
								})
								->where('TarafKahwin', $value->id)
								->count();

			if($i == 1)
			{
				$taraf = $pecahans;
				$taraflabel = "'".$value->description."'";
			}
			else
			{
				$taraf = $taraf.", ".$pecahans;
				$taraflabel = $taraflabel.", '".$value->description."'";
			}

			$i++;

		}

		return compact('taraf', 'taraflabel');
	}

	public function dataJpkk($request)
	{
		$jpkk = ProfilPentadbiran::with('kampung')
								 ->where('Jawatan', '141')
								 ->where('Status', '1')
								 ->where('fk_kampung', $request->idkampung)
								 ->orderBy('created_at', 'desc')
								 ->first();

								 // dd($jpkk);exit;

		return $jpkk;
	}

	public function dataAktiviti($request)
	{
		return ProfilAktiviti::where('fk_kampung', $request->idkampung)
							 ->get();
	}

	public function dataAktivitiModal($request)
	{
		return ProfilAktiviti::where('id', $request->idaktiviti)
							 ->first();
	}

	public function dataAktivitiList($request)
	{
		return ProfilAktiviti::where('fk_kampung', $request->idkampung)
							 ->get();
	}

	public function dataPencapaianList($request)
	{
		return ProfilPencapaian::where('fk_kampung', $request->idkampung)
							 ->get();
	}

	public function dataLkpDetailInfra($request)
	{
		$ldi = LkpDetail::where('status',1)
						->where('fk_lkp_master',4)
						->whereHas('profil_kemudahan', function ($query) use ($request)
						{
							$query->where('fk_kampung', '=', $request->idkampung);
						})
						->with('profil_kemudahan')
						->get();

						// dump($ldi, 'aaa');exit;

		return $ldi;
	}

	public function dataInfra($request)
	{
		return ProfilKemudahan::where('fk_kampung', $request->idkampung)
							  // ->with('lkpdetail')
							  ->with('KatKemudahan')
							  ->get();
	}

	public function dataInfraList($request)
	{
		return ProfilKemudahan::where('KatKemudahan', $request->idinfra)
							  ->where('fk_kampung', $request->idkampung)
							  ->get();
	}

	public function dataProdukList($request)
	{
		return ProfilProduk::where('KategoriProduk', $request->idprodukkat)
							->where('fk_kampung', $request->idkampung)
							->get();
	}

	public function dataLkpDetailProjek($request)
	{
		$ldp = LkpDetail::where('status',1)
						->where('fk_lkp_master',25)
						->whereHas('profil_projek', function ($query) use ($request)
						{
							$query->where('fk_kampung', '=', $request->idkampung);
						})
						->with('profil_projek')
						->get();

						// dump($ldp, 'sadas');exit;

		return $ldp;
	}

	public function dataProjek($request)
	{
		return ProfilProjek::where('fk_kampung', $request->idkampung)
						   ->with('jenisprojek')
						   ->get();
	}

	public function dataProjekList($request)
	{
		return ProfilProjek::where('jenisprojek', $request->idprojek)
						   ->where('fk_kampung', $request->idkampung)
						   ->get();
	}

	public function dataProjekModal($request)
	{
		return ProfilProjek::where('id', $request->idprojek)
						   ->first();
	}

	public function dataGaleri($request)
	{
		return GaleriMast::where('fk_kampung', $request->idkampung)
							 ->get();
	}

	public function dataGaleriModal($request)
	{
		return GaleriDetail::where('fk_galeri_mast', $request->idgaleri)
						   ->with('galerimast', 'type')
						   ->get();
	}


// start lookup table ------------------------------------------------

	// plucking
	public function parlimen($request)
	{
		return Parlimen::where('status',1)->get();
	}
	public function dun($request)
	{
		return Dun::where('status',1)->get();
	}
	public function daerah($request)
	{
		$user = auth()->user();
		$roleuser = AclRoleUser::where('user_id', data_get($user,'id'))
							   ->first();

							   // dd($user->Daerah);exit;

		if (data_get($roleuser, 'role_id') == 2 || data_get($roleuser, 'role_id') == 3) // Pentadbir Daerah 2    // Penghulu Mukim 3
		{
			$daerah = Daerah::where('status', 1)
							->whereHas('user', function ($query) use ($user)
							{
								$query->where('Daerah', '=', $user->Daerah);
							})
							->with('user')
							->first();
		}
		// else if (data_get($roleuser, 'role_id') == 3) // Penghulu Mukim
		// {
		// 	$daerah = Daerah::where('status', 1)
		// 					->whereHas('user', function ($query) use ($user)
		// 					{
		// 						$query->where('Daerah', '=', $user->Daerah);
		// 					})
		// 					->with('user')
		// 					->get();
		// }
		else
		{
			$daerah = Daerah::where('status', 1)
							->with('user')
							->get();
		}

		// dd($daerah, $roleuser->role_id, $user);exit;

		return $daerah;
	}
	public function mukim($request)
	{
		$user = auth()->user();
		$roleuser = AclRoleUser::where('user_id', data_get($user,'id'))
							   ->first();

		$mukim = Mukim::where('status',1)->get();

		return $mukim;
	}
	public function kampung($request)
	{
		return Kampung::where('status',1)
					  ->whereNull('IdKampungInduk')
					  ->get();
	}
	public function lkpDetail($request)
	{
		return LkpDetail::where('status',1)->where('fk_lkp_master',3)->get();
	}
	public function lkpDetailInfra($request)
	{
		return LkpDetail::where('status',1)->where('fk_lkp_master',4)->get();
	}
	public function lkpDetailProduk($request)
	{
		return LkpDetail::where('status',1)->where('fk_lkp_master',7)
						->with('profil_produk')
						->get();
	}
	public function lkpDetailProjek($request)
	{
		return LkpDetail::where('status',1)->where('fk_lkp_master',25)->get();
	}
	public function tahunAktiviti($request)
	{
		$data = ProfilAktiviti::selectRaw('Tahun')
							  ->where('Tahun', '>=', '1990')
							  ->groupBy('Tahun')
							  ->orderBy('Tahun', 'desc')
							  ->get();
		// dd($data);exit;

		return $data;
	}
	public function tahunNews($request)
	{
		$data = Notis::selectRaw('YEAR(tarikh_notis_date) as tarikh_notis_date')
					 ->groupByRaw('YEAR(tarikh_notis_date)')
					 ->orderBy('tarikh_notis_date', 'desc')
					 ->get();

		// dd($data);exit;

		return $data;
	}

	// for frontend use only -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function feBanner()
	{
		// $now = date('d-m-Y', strtotime(Carbon::now()));
		$now = date('Y-m-d', strtotime(Carbon::now()));

		$banners  = Banner::where('status', 1)
						 ->get();

		$objbs = [];

		foreach ($banners as $key => $banner)
		{
			$objb = (object)[];

			// $tm = date('d-m-Y', strtotime( $banner->tarikh_mula ));
			// $ta = date('d-m-Y', strtotime( $banner->tarikh_akhir ));
			$tm = date('Y-m-d', strtotime( $banner->tarikh_mula ));
			$ta = date('Y-m-d', strtotime( $banner->tarikh_akhir ));

			if($tm <= $now)
			{
				if($ta >= $now)
				{
					$objb->path = $banner->path;
					$objb->filename = $banner->filename;
					$objb->tajuk = $banner->tajuk;

					$objbs[] = $objb;
				}
			}
		}

		return $objbs;
	}

	public function feFaq()
	{
		$faq  = SoalanLazim::where('status', 1)
						   ->orderBy('Susunan')
						   ->get();

		return $faq;
	}

	public function feContactUs()
	{
		$contactus  = Hubungi::where('status', 1)
							 ->first();

		return $contactus;
	}

	public function feNotis($type)
	{
		$now = date('Y-m-d', strtotime(Carbon::now()));

		if($type == 'landing')
		{
			$notiss  = Notis::where('status', 1)
							->orderBy('tarikh_notis_date', 'desc')
							// ->skip(1)
							// ->take(4)
							->get();

							// dd($notiss);exit;
		}
		if($type == 'list')
		{
			$notiss  = Notis::where('status', 1)
							->orderBy('tarikh_notis_date', 'desc')
							->get();
		}

		$obj_notis = [];

		foreach ($notiss as $key => $notis)
		{
			$objb_notis = (object)[];

			$tm = date('Y-m-d', strtotime( $notis->tarikh_mula ));
			$ta = date('Y-m-d', strtotime( $notis->tarikh_akhir ));

			if($tm <= $now)
			{
				if($ta >= $now)
				{
					$objb_notis->id 	= $notis->id;
					$objb_notis->path 	= $notis->path;
					$objb_notis->filename 	= $notis->filename;
					$objb_notis->tajuk 		= $notis->tajuk;
					$objb_notis->ringkasan	= $notis->ringkasan;
					$objb_notis->tarikh_notis 	= $notis->tarikh_notis;
					$objb_notis->tarikh_mula	= $notis->tarikh_mula;

					$obj_notis[] = $objb_notis;
				}
			}
		}

		return $obj_notis;
	}

	public function feNotisFilter($request)
	{
		// dd($request->data, $request->tahun, 'sini');exit;
		$now = date('Y-m-d', strtotime(Carbon::now()));

		$notiss  = Notis::where('status', 1)
						->where(function ($query) use($request)
						{
							if($request->data != "")
								$query->where('tajuk', 'like', '%' . $request->data . '%')
									  ->orWhere('keterangan', 'like', '%' . $request->data . '%')
									  ->orWhere('ringkasan', 'like', '%' . $request->data . '%');
							else
								$query;
						})
						->where(function ($query) use($request)
						{
					   		if($request->tahun != "")
					   			$query->where('tarikh_notis_date', 'like', $request->tahun . '%');
					   		else
					   			$query;
						})
						->orderBy('tarikh_notis_date', 'desc')
						->get();

		$obj_notis = [];

		foreach ($notiss as $key => $notis)
		{
			$objb_notis = (object)[];

			$tm = date('Y-m-d', strtotime( $notis->tarikh_mula ));
			$ta = date('Y-m-d', strtotime( $notis->tarikh_akhir ));

			if($tm <= $now)
			{
				if($ta >= $now)
				{
					$objb_notis->id 	= $notis->id;
					$objb_notis->path 	= $notis->path;
					$objb_notis->filename 	= $notis->filename;
					$objb_notis->tajuk 		= $notis->tajuk;
					$objb_notis->ringkasan	= $notis->ringkasan;
					$objb_notis->tarikh_notis 	= $notis->tarikh_notis;
					$objb_notis->tarikh_mula	= $notis->tarikh_mula;

					$obj_notis[] = $objb_notis;
				}
			}
		}

		return $obj_notis;
	}

	public function feNotisDetail($request)
	{
		$notis  = Notis::where('id', $request->id)
					   ->first();

		return $notis;
	}

	public function feAktiviti($type)
	{
		if($type == 'landing')
		{
			$aktiviti  = ProfilAktiviti::with('kampung', 'kategori', 'peringkat')
									   ->orderBy('Tahun', 'desc')
									   ->orderBy('created_at', 'desc')
									   ->skip(1)
									   ->take(4)
									   ->get();
		}

		if($type == 'list')
		{
			$aktiviti  = ProfilAktiviti::with('kampung', 'kategori', 'peringkat')
									   ->orderBy('Tahun', 'desc')
									   ->orderBy('created_at', 'desc')
									   ->get();
		}

		return $aktiviti;
	}

	public function feAktivitifilter($request)
	{
		// dd($request->tahun, $request->data, 'repo');exit;

		$aktiviti  = ProfilAktiviti::with('kampung', 'kategori', 'peringkat')
								   ->where(function ($query) use ($request)
								   {
								   		if($request->data != "")
								   			$query->where('NamaAktiviti', 'like', '%' . $request->data . '%')
								   				  ->orWhere('Penganjur', 'like', '%' . $request->data . '%')
								   				  ->orWhere('Keterangan', 'like', '%' . $request->data . '%')
								   				  ->orWhereHas('kampung', function ($query) use ($request)
								   				  {
								   				  		$query->where('NamaKampung', 'like', '%' . $request->data . '%');
								   				  })
								   				  ->orWhereHas('kategori', function ($query) use ($request)
								   				  {
								   				  		$query->where('description', 'like', '%' . $request->data . '%');
								   				  });
								   		else
								   			$query;

								   })
								   ->where(function ($query) use ($request)
								   {
								   		if($request->tahun != "")
								   			$query->where('Tahun', '=', $request->tahun);
								   		else
								   			$query;
								   })
								   // ->whereHas('kampung', function ($query) use ($request)
								   // {
								   // 		if($request->data != "")
								   // 			$query->where('NamaKampung', 'like', '%' . $request->data . '%');
								   // 		else
								   // 			$query;
								   // })
								   // ->whereHas('kategori', function ($query) use ($request)
								   // {
								   // 		if($request->data != "")
								   // 			$query->where('description', 'like', '%' . $request->data . '%');
								   // 		else
								   // 			$query;
								   // })
								   ->orderBy('Tahun', 'desc')
								   ->orderBy('created_at', 'desc')
								   ->get();

								   // dd($aktiviti);exit;

		return $aktiviti;
	}

	public function feAktivitiDetail($request)
	{
		$aktiviti  = ProfilAktiviti::where('id', $request->id)
								   ->with('kampung', 'kategori', 'peringkat')
								   ->first();

		return $aktiviti;
	}

	public function feLkpDetailProduk()
	{
		$produk  = LkpDetail::with('product_icon')
							->where('fk_lkp_master', 7)
							->where('status', 1)
							// ->orderBy('id', 'desc')
							->get();

		return $produk;
	}

	public function feIcon()
	{
		$icon  = ProductIcon::with('lkp_detail')
							->where('status', 1)
							->get();

		return $icon;
	}

	public function feProduk($request)
	{
		$profilproduk  = ProfilProduk::with('kampung', 'pengeluar.mediasosial', 'kategori', 'jenisproduk')
									 ->where('KategoriProduk', $request->idtype)
									 ->get();

		return $profilproduk;
	}

	public function feProdukFilter($request)
	{

		$profilproduk  = ProfilProduk::with('kampung.daerah', 'kampung.mukim', 'pengeluar.mediasosial', 'kategori', 'jenisproduk')
									 ->where('KategoriProduk', $request->idtype)
									 ->whereHas('kampung.daerah', function ($query) use ($request)
									 {
									 	if($request->daerah != '0')
									 		$query->where('id', '=', $request->daerah);
									 	else
									 		$query;
									 })
									 ->whereHas('kampung.mukim', function ($query) use ($request)
									 {
									 	if($request->mukim != '0')
									 		$query->where('id', '=', $request->mukim);
									 	else
									 		$query;
									 })
									 ->whereHas('kampung', function ($query) use ($request)
									 {
									 	if($request->kampung != '0')
									 		$query->where('id', '=', $request->kampung);
									 	else
									 		$query;
									 })
									 ->get();

									 // dd($profilproduk);exit;

		return $profilproduk;
	}

	public function feProdukList($request)
	{
		return ProfilProduk::where('KategoriProduk', $request->idtype)
							->get();
	}

	public function fePage($request)
	{
		$page  = ContentPage::with('menum')
							->where('fk_menum', $request->pageid)
							->first();

		return $page;
	}

	public function dataListCarian($request)
	{
		$all = array();

		$notis  = Notis::where('status', 1)
					   ->where('tajuk','like', '%' . $request->carian . '%')
					   ->orWhere('keterangan','like', '%' . $request->carian . '%')
					   ->get();

		$aktiviti  = ProfilAktiviti::where('NamaAktiviti','like', '%' . $request->carian . '%')
								   ->orWhere('Penganjur','like', '%' . $request->carian . '%')
								   ->orWhere('Keterangan','like', '%' . $request->carian . '%')
								   ->orWhere('Tahun','like', '%' . $request->carian . '%')
								   ->get();

		$produk  = ProfilProduk::where('NamaProduk','like', '%' . $request->carian . '%')
							   ->orWhere('Keterangan','like', '%' . $request->carian . '%')
							   ->get();

		if(count($notis) > 0)
		{
			$all['notis'] = $notis;
		}

		if(count($aktiviti) > 0)
		{
			$all['aktiviti'] = $aktiviti;
		}

		if(count($produk) > 0)
		{
			$all['produk'] = $produk;
		}

		return $all;
	}

	public function addCountPelawat()
	{
		$counter  = Counter::first();

		$new = $counter->count + 1;

		$counter->count = $new;
		$counter->update();

		// dd($counter);exit;

		return $counter;
	}

	public function findDateLatest()
	{
		$latest = AuditLog::orderBy('id', 'desc')
						  ->first();

		return $latest;
	}

    //-------GIS --------//

    public function jumlahkirGis($request)
	{
		$pemilikanrumah  = VwKampungRumah::with('pemilikanrumah','mukim','daerah')
                                        ->get();

        $latlong = Pemilikanrumah::where("fk_kampung", $request->idkampung)->first();

        $lat = $latlong->Latitud;
        $long = $latlong->Longitud;

		return compact('pemilikanrumah','lat','long');
	}

    public function kirGis($request)
	{
        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        if($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') // pentadbir sistem n Ptinggi n Dataentri
        {
            $kir = VwKetuaIsiRumah::where('fk_kampung', $request->idkampung)
                                ->get();
        }
        elseif($roleuser->role_id == '2') // PDaerah
        {
            $kir = VwKetuaIsiRumah::where('fk_kampung', $request->idkampung)
                            ->where('fk_daerah', $user->Daerah)
                            ->get();
        }
        elseif($roleuser->role_id == '3') // Pmukim
        {
            $kir = VwKetuaIsiRumah::where('fk_kampung', $request->idkampung)
                            ->where('fk_mukim', $user->Mukim)
                            ->get();
        }


		return $kir;
	}

    public function kampungGis($request)
	{
        $kampung = Kampung::where('id', $request->idkampung)
                        ->with('daerah','mukim')
                        ->first();

		return $kampung;
	}

    public function kemudahanGis($request)
	{
        $user = auth()->user();
        $roleuser = AclRoleUser::where('user_id', data_get($user, 'id'))->first();

        $lkpdetail = LkpDetail::where('fk_lkp_master', 4)
                            ->where('status', 1)
                            // ->where('id', 14)
                            ->get();

        $typekemudahan = [];

        foreach ($lkpdetail as $key => $value2)
        {
            if($roleuser->role_id == '1' || $roleuser->role_id == '4' || $roleuser->role_id == '5') // pentadbir sistem n Ptinggi n Dataentri
            {
                $kemudahamawam = VwKemudahanAwam::where('fk_kampung', $request->idkampung)
                                            ->where('KatKemudahan', $value2->id)
                                            // ->skip(0)->take(10)
                                            ->get();

                foreach($kemudahamawam as $key2 => $value3)
                {
                    $typekemudahans = (object)[];

                    $typekemudahans->KatKemudahan = $value3->KatKemudahan;
                    $typekemudahans->JenisKemudahan = $value3->JenisKemudahan;
                    $typekemudahans->NamaKemudahan = $value3->NamaKemudahan;
                    $typekemudahans->Latitud = $value3->Latitud;
                    $typekemudahans->Longitud = $value3->Longitud;
                    $typekemudahans->Description = $value3->Description;
                    $typekemudahans->NamaMukim = $value3->NamaMukim;
                    $typekemudahans->NamaDaerah = $value3->NamaDaerah;

                    $typekemudahan[] = $typekemudahans;
                }
            }
            elseif($roleuser->role_id == '2') // PDaerah
            {
                $kemudahamawam = VwKemudahanAwam::where('fk_kampung', $request->idkampung)
                                                ->where('KatKemudahan', $value2->id)
                                                ->where('fk_daerah', $user->Daerah)
                                                ->get();

                foreach($kemudahamawam as $key2 => $value3)
                {
                    $typekemudahans = (object)[];

                    $typekemudahans->KatKemudahan = $value3->KatKemudahan;
                    $typekemudahans->JenisKemudahan = $value3->JenisKemudahan;
                    $typekemudahans->NamaKemudahan = $value3->NamaKemudahan;
                    $typekemudahans->Latitud = $value3->Latitud;
                    $typekemudahans->Longitud = $value3->Longitud;
                    $typekemudahans->Description = $value3->Description;
                    $typekemudahans->NamaMukim = $value3->NamaMukim;
                    $typekemudahans->NamaDaerah = $value3->NamaDaerah;

                    $typekemudahan[] = $typekemudahans;
                }

            }
            elseif($roleuser->role_id == '3') // Pmukim
            {
                 $kemudahamawam = VwKemudahanAwam::where('fk_kampung', $request->idkampung)
                                                ->where('KatKemudahan', $value2->id)
                                                ->where('fk_mukim', $user->Mukim)
                                                ->get();

                foreach($kemudahamawam as $key2 => $value3)
                {
                    $typekemudahans = (object)[];

                    $typekemudahans->KatKemudahan = $value3->KatKemudahan;
                    $typekemudahans->JenisKemudahan = $value3->JenisKemudahan;
                    $typekemudahans->NamaKemudahan = $value3->NamaKemudahan;
                    $typekemudahans->Latitud = $value3->Latitud;
                    $typekemudahans->Longitud = $value3->Longitud;
                    $typekemudahans->Description = $value3->Description;
                    $typekemudahans->NamaMukim = $value3->NamaMukim;
                    $typekemudahans->NamaDaerah = $value3->NamaDaerah;

                    $typekemudahan[] = $typekemudahans;
                }
            }
        }
		return $typekemudahan;
	}

    public function jumlahGis($request)
	{
		// $pemilikanrumah  = VwKampungRumah::with('pemilikanrumah','mukim','daerah')
        //                                 ->get();

        $latlong = Pemilikanrumah::first();

        $lat = $latlong->Latitud;
        $long = $latlong->Longitud;

		return compact('lat','long');
	}

    public function mainkirGis($request)
	{

        $kir = VwKetuaIsiRumah::get();

		return $kir;
	}

    public function mainkampungGis($request)
	{
        $kampung = Kampung::first();

		return $kampung;
	}






} //end of class
