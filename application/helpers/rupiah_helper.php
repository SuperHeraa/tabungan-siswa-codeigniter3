<?php
//membuat format rupiah dengan PHP 
function rupiah($angka)
{
	$hasil_rupiah = number_format($angka, 0, ',', '.');
	return $hasil_rupiah;
}

function reset_rupiah($hasil_rupiah)
{
	$pecah = explode('.', $hasil_rupiah);
	$return		= implode('', $pecah);
	return  $return;
}
