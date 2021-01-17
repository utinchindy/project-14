<?php 

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;
/**
 * 
 */
class HomeController extends Controller
{
	
	function showBeranda()
	{
		return view('admin/beranda');
	}
	
	function showKategori()
	{
		return view('admin/kategori');
	}
	
	function showProduk()
	{
		return view('admin/produk');
	}

	function testAjax(){
		$data['list_provinsi'] = Provinsi::all();
		return view('test-ajax', $data);
	}
}