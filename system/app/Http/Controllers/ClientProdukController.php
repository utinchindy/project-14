<?php 


namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\User;
use App\Models\ClientProduk;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;

/**
 * 
 */
class ClientProdukController extends Controller
{
	
	function index()
	{
		$data['list_produk'] = Produk::all();
		$list_produk = Produk::all();
		// Sorting
		// Sort By Harga Terendah
		//dd($list_produk->sortBy('harga'));
		// Sort By Harga Tertinggi
		//dd($list_produk->sortByDesc('harga'));
		

		// Filter

		//$filtered = $list_produk->filter(function($item){
			//return $item->harga < 200000;
		//});
		//dd($filtered);

		//$sum = $list_produk->sum('stok');
		//dd($sum);

		$data['list_produk'] = Produk::Paginate(8);
		return view('user/index', $data);


		return view('user/index', $data);
	}

	function checkout()
	{
		
		$data['list_belanja'] = ClientProduk::all();
		$list_belanja = ClientProduk::all();


		$data['list_provinsi'] = Provinsi::all();
		return view('user/checkout', $data);
		return view('user/checkout', $data);
	}

	
	function create(Produk $produk)
	{
		$data['produk'] = $produk;
		return view('user/keranjang', $data);
	}
	
	function store(Produk $produk)
	{
		$data['produk'] = $produk;
		$check = new ClientProduk;
		$check->nama = request('nama');
		$check->harga = request('harga');
		$check->jumlah = request('jumlah');
		$check->save();

		return redirect('/')->with('success', 'Barang Berhasil di Masukan ke Keranjang');
	}
	
	function show(Produk $produk)
	{
		$data['produk'] = $produk;
		return view('user/detail', $data);
	}
	
	function edit(ClientProduk $produk)
	{
		$data['produk'] = $produk;
		return view('user/edit', $data);
		
	}
	
	function update(ClientProduk $produk)
	{
		$produk->nama = request('nama');
		$produk->harga = request('harga');
		$produk->jumlah = request('jumlah');
		$produk->save();

		return redirect('checkout')->with('success', 'Barang Berhasil di Ubah pada Keranjang');
	}
	
	function destroy(ClientProduk $produk)
	{
		$produk->delete();

		return redirect('checkout')->with('danger', 'Barang Berhasil di Hapus dari Keranjang');
	}

	function filter(){
		$nama = request('nama');
		$stok = explode(",", request('stok'));
		$data['harga_min'] = $harga_min = request('harga_min');
		$data['harga_max'] = $harga_max = request('harga_max');
		// $data['list_produk'] = Produk::where('nama','like', "%$nama%")->get();
		//$data['list_produk'] = Produk::whereIn('stok', $stok)->get();
		$data['list_produk'] = Produk::whereNotIn('stok', [0])->whereIn('stok', $stok)->whereBetween('harga', [$harga_min, $harga_max])->where('nama','like', "%$nama%")->get();
		$data['nama'] = $nama;
		$data['stok'] = request('stok');
		

		return view('user/index', $data);	
	}
	
		function alamat(){
		$data['list_provinsi'] = Provinsi::all();
		return view('user/checkout', $data);
	}

}