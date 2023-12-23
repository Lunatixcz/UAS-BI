<?php
require_once "config/database.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])){
	echo "<meta http-equiv='refresh' content='0; url=../pos/auth/login.php?alert=1'>";
}

else{
    if ($_GET['module'] == 'beranda') {
		include "modules/home/dashboard.php";
	}
    elseif ($_GET['module'] == 'tabel') {
		include "modules/home/dashboard.php";
	}
	elseif ($_GET['module'] == 'dataItem') {
		include "modules/master/barang/view.php";
	}
	elseif ($_GET['module'] == 'dataSup') {
		include "modules/master/supplier/view.php";
	}
	elseif ($_GET['module'] == 'historySup') {
		include "modules/history/history_sup.php";
	}
	elseif ($_GET['module'] == 'dataCust') {
		include "modules/master/customer/view.php";
	}
	elseif ($_GET['module'] == 'historyCus') {
		include "modules/history/history_cus.php";
	}
	elseif ($_GET['module'] == 'dataJasa') {
		include "modules/master/jasa/view.php";
	}
	elseif ($_GET['module'] == 'pihakJasa') {
		include "modules/master/pihakJasa/view.php";
	}
	elseif ($_GET['module'] == 'dataMobil') {
		include "modules/master/mobil/view.php";
	}
	elseif ($_GET['module'] == 'noAcc') {
		include "modules/master/akunbank/view.php";
	}
	elseif ($_GET['module'] == 'detailAkun') {
		include "modules/master/akunbank/detail.php";
	}
	elseif ($_GET['module'] == 'historyAkun') {
		include "modules/history/history_akun.php";
	}
	elseif ($_GET['module'] == 'User') {
		include "modules/user/view.php";
	}
	elseif ($_GET['module'] == 'buyItem'){
		include "modules/transaksi/pembelian/view.php";
	}
	elseif ($_GET['module'] == 'detailPembelian') {
		include "modules/transaksi/pembelian/detail.php";
	}
	elseif ($_GET['module'] == 'historyPembelian'){
		include "modules/history/history_pembelian.php";
	}
	elseif ($_GET['module'] == 'sellItem'){
		include "modules/transaksi/penjualan/view.php";
	}
	elseif ($_GET['module'] == 'detailPenjualan') {
		include "modules/transaksi/penjualan/detail.php";
	}
	elseif ($_GET['module'] == 'historyPembelian'){
		include "modules/history/history_pembelian.php";
	}
	elseif ($_GET['module'] == 'historyPenjualan'){
		include "modules/history/history_penjualan.php";
	}
	elseif ($_GET['module'] == 'historyPihakJasa') {
		include "modules/history/history_pihak_jasa.php";
	}
	elseif ($_GET['module'] == "historyNamaJasa") {
		include "modules/history/history_nama_jasa.php";
	}
	elseif ($_GET['module'] == 'cekMobil'){
		include "modules/mobil/view.php";
	}
	elseif ($_GET['module'] == 'detailMobil'){
		include "modules/mobil/detail.php";
	}
	elseif ($_GET['module'] == 'historyPenjualan'){
		include "modules/history/history_penjualan.php";
	}
	elseif ($_GET['module'] == 'cashMasuk'){
		include "modules/cash/pemasukan/view.php";
	}
	elseif ($_GET['module'] == 'historyMasuk'){
		include "modules/history/history_cashmasuk.php";
	}
	elseif ($_GET['module'] == 'cashKeluar'){
		include "modules/cash/pengeluaran/view.php";
	}
	elseif ($_GET['module'] == 'historyKeluar'){
		include "modules/history/history_cashkeluar.php";
	}
	elseif ($_GET['module'] == 'detailCashMasuk'){
		include "modules/cash/pemasukan/detail.php";
	}
	elseif ($_GET['module'] == 'detailCashKeluar'){
		include "modules/cash/pengeluaran/detail.php";
	}
	elseif ($_GET['module'] == 'sellReport'){
		include "modules/laporan/penjualan/view.php";
	}
	elseif ($_GET['module'] == 'buyReport'){
		include "modules/laporan/pembelian/view.php";
	}
}

?>