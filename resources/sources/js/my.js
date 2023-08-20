function tandaPemisahTitik(b){
	var _minus = false;

	if (b<0) _minus = true;

	b = b.toString();
	b=b.replace(".","");
	b=b.replace("-","");

	c = "";

	panjang = b.length;
	j = 0;
	for (i = panjang; i > 0; i--){
		j = j + 1;
		if (((j % 3) == 1) && (j != 1)){
			c = b.substr(i-1,1) + "." + c;
		} else {
			c = b.substr(i-1,1) + c;
		}
	}
	if (_minus) c = "-" + c ;
	return c;
}

function numbersonly(ini, e){
	if (e.keyCode>=49){

		if(e.keyCode<=57){
			a = ini.value.toString().replace(".","");
			b = a.replace(/[^\d]/g,"");
			b = (b=="0")?String.fromCharCode(e.keyCode):b + String.fromCharCode(e.keyCode);
			ini.value = tandaPemisahTitik(b);
			return false;
		}
		else if(e.keyCode<=105){
			if(e.keyCode>=96){
				a = ini.value.toString().replace(".","");
				b = a.replace(/[^\d]/g,"");
				b = (b=="0")?String.fromCharCode(e.keyCode-48):b + String.fromCharCode(e.keyCode-48);
				ini.value = tandaPemisahTitik(b);
				return false;
			}
			else {
				return false;
			}
		}
		else {
			return false; 
		}

	} else if (e.keyCode==48){

		a = ini.value.replace(".","") + String.fromCharCode(e.keyCode);
		b = a.replace(/[^\d]/g,"");
		if (parseFloat(b)!=0){
			ini.value = tandaPemisahTitik(b);
			return false;
		} else {
			return false;
		}

	}else if (e.keyCode==95) {

		a = ini.value.replace(".","") + String.fromCharCode(e.keyCode-48);
		b = a.replace(/[^\d]/g,"");
		if (parseFloat(b)!=0){
			ini.value = tandaPemisahTitik(b);
			return false;
		} else {
			return false;
		}

	} else if (e.keyCode==8 || e.keycode==46){

		a = ini.value.replace(".","");
		b = a.replace(/[^\d]/g,"");
		b = b.substr(0,b.length -1);
		if (tandaPemisahTitik(b)!=""){
			ini.value = tandaPemisahTitik(b);
		} else {
			ini.value = "";
		}

		return false;

	} else if (e.keyCode==9){
		return true;
	} else if (e.keyCode==17){
		return true;
	} else {
		return false;
	}

}

 function format_rupiah(angka){
   var reverse = angka.toString().split('').reverse().join(''),
   ribuan = reverse.match(/\d{1,3}/g);
   ribuan = ribuan.join('.').split('').reverse().join('');
   return ribuan;
 }

function angka(a) {
	var charCode = (a.which) ? a.which : event.keyCode
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	return true;
}

function formatRupiah(angka, prefix)
{
	var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split	= number_string.split(','),
		sisa 	= split[0].length % 3,
		rupiah 	= split[0].substr(0, sisa),
		ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
		
	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}
	
	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}
