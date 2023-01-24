<?php 
namespace Workbench\Dashboard\Data\Repo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use File;
use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

use Workbench\Site\Model\Lookup\Kampung;
use Workbench\Site\Model\Lookup\VwKemudahanDetail;
use Workbench\Site\Model\Lookup\VwKerja;
use Workbench\Site\Model\Lookup\VwPendapatanPenduduk;
use Workbench\Site\Model\Lookup\VwStatusMilikanDetail;
use Workbench\Site\Model\Lookup\VwJenisRumahDetail;
use Workbench\Site\Model\Lookup\VwKemudahanAwamDetail;
use Workbench\Site\Model\Lookup\VwKahwinDetail;
use Workbench\Site\Model\Lookup\VwAgeDetail;
use Workbench\Site\Model\Lookup\VwKemudahanAsasDetail;



/**
 *  
 *
 * @laravolt site
 * @author apip
 **/
class DashboardDORepo
{
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apip
	 **/

	public function tablechart1($request) // status pemilikan rumah
	{
		$daerah = $request->daerah;
		$mukim 	= $request->mukim;
		$parlimen 	= $request->parlimen;
		$dun 		= $request->dun;
		$catpet 	= $request->catpetempatan;
		$kampung 	= $request->kampung;
		$cattype 	= $request->cattype;

		// dd($cattype);exit;

		$data = VwStatusMilikanDetail::where(function ($query) use ($daerah)
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
									->where(function ($query) use ($catpet)
									{
										if($catpet != '0')
											$query->where('KategoriPetempatan', '=', $catpet);
										else
											$query;
									})
									->where(function ($query) use ($kampung)
									{
										if($kampung != '0')
											$query->where('fk_kampung', '=', $kampung);
										else
											$query;
									})
									->where(function ($query) use ($cattype)
									{
										if($cattype != '0')
											$query->where('StatusMilikan', '=', $cattype);
										else
											$query;
									})
									->get();

		// dd($data);exit;
		return $data;

	}

	public function tablechart2($request) // jenis rumah
	{
		$daerah = $request->daerah;
		$mukim 	= $request->mukim;
		$parlimen 	= $request->parlimen;
		$dun 		= $request->dun;
		$catpet 	= $request->catpetempatan;
		$kampung 	= $request->kampung;
		$cattype 	= $request->cattype;

		$data = VwJenisRumahDetail::where(function ($query) use ($daerah)
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
									->where(function ($query) use ($catpet)
									{
										if($catpet != '0')
											$query->where('KategoriPetempatan', '=', $catpet);
										else
											$query;
									})
									->where(function ($query) use ($kampung)
									{
										if($kampung != '0')
											$query->where('fk_kampung', '=', $kampung);
										else
											$query;
									})
									->where(function ($query) use ($cattype)
									{
										if($cattype != '0')
											$query->where('JenisRumah', '=', $cattype);
										else
											$query;
									})
									->get();

		// dd($data);exit;
		return $data;
	}

	public function tablechart3($request) // kemudahan awam & infra
	{
		$daerah = $request->daerah;
		$mukim 	= $request->mukim;
		$parlimen 	= $request->parlimen;
		$dun 		= $request->dun;
		$catpet 	= $request->catpetempatan;
		$kampung 	= $request->kampung;
		$cattype 	= $request->cattype;

		$data = VwKemudahanAwamDetail::where(function ($query) use ($daerah)
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
										->where(function ($query) use ($catpet)
										{
											if($catpet != '0')
												$query->where('KategoriPetempatan', '=', $catpet);
											else
												$query;
										})
										->where(function ($query) use ($kampung)
										{
											if($kampung != '0')
												$query->where('fk_kampung', '=', $kampung);
											else
												$query;
										})
										->where(function ($query) use ($cattype)
										{
											if($cattype != '0')
												$query->where('kat_kemudahan_id', '=', $cattype);
											else
												$query;
										})
										->get();

		// dd($data);exit;
		return $data;

	}

	public function tablechart4($request) // kemudahan asas rumah
	{
		$daerah = $request->daerah;
		$mukim 	= $request->mukim;
		$parlimen 	= $request->parlimen;
		$dun 		= $request->dun;
		$catpet 	= $request->catpetempatan;
		$kampung 	= $request->kampung;
		$cattype 	= $request->cattype;

		// dd($cattype);exit;

		$data = VwKemudahanAsasDetail::where(function ($query) use ($daerah)
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
									->where(function ($query) use ($catpet)
									{
										if($catpet != '0')
											$query->where('KategoriPetempatan', '=', $catpet);
										else
											$query;
									})
									->where(function ($query) use ($kampung)
									{
										if($kampung != '0')
											$query->where('idKampung', '=', $kampung);
										else
											$query;
									})
									->where(function ($query) use ($cattype)
									{
										if($cattype != '0')
										{
											if ($cattype == "10") // eletrik no
											{
												$query->where('KElektrik', '0');
											}
											if ($cattype == "20") // air no
											{
												$query->where('KAir', '0');
											}
											if ($cattype == "30") // astro no
											{
												$query->where('KAstro', '0');
											}
											if ($cattype == "40") // internet no
											{
												$query->where('KInternet', '0');
											}
											if ($cattype == "50") // telefon no
											{
												$query->where('KTelefon', '0');
											}

											if ($cattype == "11") // eletrik yes
											{
												$query->where('KElektrik', '1');
											}
											if ($cattype == "21") // air yes
											{
												$query->where('KAir', '1');
											}
											if ($cattype == "31") // astro yes
											{
												$query->where('KAstro', '1');
											}
											if ($cattype == "41") // internet yes
											{
												$query->where('KInternet', '1');
											}
											if ($cattype == "51") // telefon yes
											{
												$query->where('KTelefon', '1');
											}
										}
										else
											$query;
									})
									->get();

		// dd($data);exit;
		return $data;

	}

	public function tablechart5($request) // status kerja
	{
		$daerah = $request->daerah;
		$mukim 	= $request->mukim;
		$parlimen 	= $request->parlimen;
		$dun 		= $request->dun;
		$catpet 	= $request->catpetempatan;
		$kampung 	= $request->kampung;
		$cattype 	= $request->cattype;

		// dd($cattype);exit;

		$data = VwKerja::where(function ($query) use ($daerah)
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
						->where(function ($query) use ($catpet)
						{
							if($catpet != '0')
								$query->where('KategoriPetempatan', '=', $catpet);
							else
								$query;
						})
						->where(function ($query) use ($kampung)
						{
							if($kampung != '0')
								$query->where('idKampung', '=', $kampung);
							else
								$query;
						})
						->where(function ($query) use ($cattype)
						{
							if($cattype != '0')
								$query->where('StatusPekerjaan', '=', $cattype);
							else
								$query;
						})
						->get();

		// dd($data);exit;
		return $data;
	}

	public function tablechart6($request) // taraf kahwin
	{
		$daerah = $request->daerah;
		$mukim 	= $request->mukim;
		$parlimen 	= $request->parlimen;
		$dun 		= $request->dun;
		$catpet 	= $request->catpetempatan;
		$kampung 	= $request->kampung;
		$cattype 	= $request->cattype;

		// dd($cattype);exit;

		$data = VwKahwinDetail::where(function ($query) use ($daerah)
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
								->where(function ($query) use ($catpet)
								{
									if($catpet != '0')
										$query->where('KategoriPetempatan', '=', $catpet);
									else
										$query;
								})
								->where(function ($query) use ($kampung)
								{
									if($kampung != '0')
										$query->where('idKampung', '=', $kampung);
									else
										$query;
								})
								->where(function ($query) use ($cattype)
								{
									if($cattype != '0')
										$query->where('TarafKahwin', '=', $cattype);
									else
										$query;
								})
								->get();

		// dd($data);exit;
		return $data;
	}

	public function tablechart7($request) // umur penduduk
	{
		$daerah = $request->daerah;
		$mukim 	= $request->mukim;
		$parlimen 	= $request->parlimen;
		$dun 		= $request->dun;
		$catpet 	= $request->catpetempatan;
		$kampung 	= $request->kampung;
		$cattypes 	= $request->cattype;

		// dd($cattypes);exit;

		if ($cattypes == "1") 
		{
			$cattype = "Kanak-kanak & Remaja Awal 0-14";
		}
		elseif ($cattypes == "2") 
		{
			$cattype = "Belia Awal 15-18";
		}

		elseif ($cattypes == "3") 
		{
			$cattype = "Belia Petengahan 19-24";
		}

		elseif ($cattypes == "4") 
		{
			$cattype = "Belia Akhir 25-30";
		}

		elseif ($cattypes == "5") 
		{
			$cattype = "Belia Dewasa 31-40";
		}

		elseif ($cattypes == "6") 
		{
			$cattype = "Dewasa 41-64";
		}

		elseif ($cattypes == "7") 
		{
			$cattype = "Warga Emas 65 ++";
		}
		else
		{
			$cattype = "";
		}

		// dd($cattype);exit;

		$data = VwAgeDetail::where(function ($query) use ($daerah)
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
								->where(function ($query) use ($catpet)
								{
									if($catpet != '0')
										$query->where('KategoriPetempatan', '=', $catpet);
									else
										$query;
								})
								->where(function ($query) use ($kampung)
								{
									if($kampung != '0')
										$query->where('idKampung', '=', $kampung);
									else
										$query;
								})
								->where(function ($query) use ($cattype)
								{
									if($cattype != '0')
										$query->where('peringkat', '=', $cattype);
									else
										$query;
								})
								->with('kampung')
								->where('kira', '1')
								->get();

		// dd($data);exit;
		return $data;
	}

	public function tablechart8($request)
	{
		$daerah = $request->daerah;
		$mukim 	= $request->mukim;
		$parlimen 	= $request->parlimen;
		$dun 		= $request->dun;
		$catpet 	= $request->catpetempatan;
		$kampung 	= $request->kampung;
		$cattype 	= $request->cattype;

		// dd($cattype);exit;

		$data = VwPendapatanPenduduk::where(function ($query) use ($daerah)
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
									->where(function ($query) use ($catpet)
									{
										if($catpet != '0')
											$query->where('KategoriPetempatan', '=', $catpet);
										else
											$query;
									})
									->where(function ($query) use ($kampung)
									{
										if($kampung != '0')
											$query->where('fk_kampung', '=', $kampung);
										else
											$query;
									})
									->where(function ($query) use ($cattype)
									{
										if($cattype != '0')
											$query->where('no_peringkat', '=', $cattype);
										else
											$query;
									})
									->with('daerah', 'mukim')
									->get();

		// dd($data);exit;
		return $data;
	}

}