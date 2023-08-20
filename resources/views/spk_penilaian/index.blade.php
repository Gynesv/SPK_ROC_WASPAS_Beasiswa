@extends('layouts.template')

@section('css')
    <style>

    </style>
@endsection

@section('content') 
<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5><i class="mdi mdi-certificate text-danger"></i> PENILAIAN</h5>
                    </div>
                </div>    
            </div>

            <div class="card-header header_add">
                <div class="row">
                    <div class="col-md-2">
                        <div class="btn-group" role="group" aria-label="Basic example">

                            @if(auth()->user()->level == 'A')
                            <button type="button" class="btn btn-primary waves-effect waves-light btn-xs btn_add" data-toggle="modal" id="btn_add"><i class="mdi mdi-plus-circle-outline"></i> BARU</button>
                            <a href="{{ route('penilaian.cetak_pdf') }}" class="btn btn-purple waves-effect waves-light btn-xs btn_print" id="btn_print" target="_blank"><i class="mdi mdi-printer"></i> CETAK</a>
                            
                            @elseif(auth()->user()->level == 'K')
                            <a href="{{ route('penilaian.cetak_pdf') }}" class="btn btn-purple waves-effect waves-light btn-xs btn_print" id="btn_print" target="_blank"><i class="mdi mdi-printer"></i> CETAK</a>> EXCEL</a>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group "  aria-label="Basic example">
                            <label>Tahun</label>
                                <select class="form-control custom-select select2"  style="width: 50%;" name="filter_daftar" id="filter_daftar" onchange="showFilterDaftar(this)"></select>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="form-group "  aria-label="Basic example">
                            <label>Periode</label>
                                <select class="form-control custom-select select2"  style="width: 50%;" name="filter_periode" id="filter_periode" onchange="showFilterPeriode(this)"></select>
                        </div>
                    </div>
                </div>     
            </div>

            <div class="card-body">

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center" rowspan="2">NO.</th>
                            <th style="text-align: center" colspan="3">SISWA</th>
                            <th style="text-align: center" colspan="3">KUANTITATIF</th>
                            <th style="text-align: center" colspan="3">NILAI NORMALISASI</th>
                            <th style="text-align: center" colspan="2">NILAI SIGMA</th>
                            <th style="text-align: center" rowspan="2">AKSI</th>
                        </tr>
                        <tr>
                            <th style="text-align: center">NISN <br> NAMA</th>
                            <th style="text-align: center">KELAS</th>
                            <th style="text-align: center">TAHUN</th>

                            <th style="text-align: center">KRITERIA</th>
                            <th style="text-align: center">TIPE</th>
                            <th style="text-align: center">NILAI</th>


                            <th style="text-align: center">BOBOT</th>
                            <th style="text-align: center">MAXMIN</th>
                            <th style="text-align: center">NILAI</th>

                            <th style="text-align: center">KALI</th>
                            <th style="text-align: center">PANGKAT</th>

                        </tr>
                    </thead>
                    <tbody id="tabel_data"></tbody>
                </table>
                        

            </div>
        </div>
    </div>                     
</div>

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5><i class="mdi mdi-certificate text-danger"></i> RANKING</h5>
                    </div>
                </div>    
            </div>

            <div class="card-body">

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center" rowspan="2">RANKING</th>
                            <th style="text-align: center" colspan="3">SISWA</th>
                            <th style="text-align: center" colspan="4">NILAI SIGMA</th>
                            <th style="text-align: center" rowspan="2">Nilai Qi</th>
                        </tr>
                        <tr>
                            <th style="text-align: center">NISN</th>
                            <th style="text-align: center">NAMA</th>
                            <th style="text-align: center">KELAS</th>

                            <th style="text-align: center">NILAI TAMBAH</th>
                            <th style="text-align: center">NILAI KALI [0.5]</th>
                            <th style="text-align: center">NILAI PANGKAT</th>
                            <th style="text-align: center">NILAI KALI [0.5]</th>

                        </tr>
                    </thead>
                    <tbody id="tabel_data_sigma"></tbody>
                </table>
                        

            </div>
        </div>
    </div>                     
</div>

<div class="modal modal-default fade" id="formModalAdd">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #ffffff">

            <div class="modal-header">
                <h5 class="modal-title mt-0"><i class="mdi mdi-plus-circle-outline"></i> Penilaian</h5>
            </div>

            <div class="modal-body">

                {!! csrf_field() !!}
    
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tahun Daftar</label>
                            <select class="form-control custom-select select2"  style="width: 100%;" name="daftar" id="daftar" onchange="showDaftar(this)"></select>
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Peserta</label>
                            <select class="form-control custom-select select2"  style="width: 100%;" name="filter_peserta" id="filter_peserta"></select>
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Periode</label>
                            <select class="form-control custom-select select2"  style="width: 100%;" name="periode" id="periode" onchange="showPeriode(this)"></select>
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Kriteria</label>
                            <select class="form-control custom-select select2"  style="width: 100%;" name="kriteria" id="kriteria" onchange="showKriteria(this)"></select>
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Kuantitatif</label>
                            <select class="form-control custom-select select2"  style="width: 100%;" name="kuantitatif" id="kuantitatif"></select>
                        </div>
                    </div> 
    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-xs" id="btn_save"><i class="fas fa-save"></i> SIMPAN</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

    $(document).ready(function(){
        $('#datatable').DataTable();
        $('.select2').select2();

        combo_filter_daftar(),
        combo_filter_periode()

        var filter_daftar = $('#filter_daftar').val();
        var filter_periode = $('#filter_periode').val();
        
        view(filter_daftar,filter_periode);
    });

    function showFilterDaftar(select){
        var filter_daftar = $('#filter_daftar').val();
        var filter_periode = $('#filter_periode').val();
        view(filter_daftar,filter_periode);
    }

    function showFilterPeriode(select){
        var filter_daftar = $('#filter_daftar').val();
        var filter_periode = $('#filter_periode').val();
        view(filter_daftar,filter_periode);
    }

    /* == AJAX TAMPILKAN DATA == */

    function view(filter_daftar,filter_periode) {

        $.ajax({
            type: 'GET',
            url: "{{ route('penilaian.view') }}",
            dataType: 'JSON',
            async: true,
            data:{filter_daftar:filter_daftar,filter_periode:filter_periode},
            success: function(result) {
                
                $('#datatable').DataTable().destroy();
                $('#tabel_data').empty();

                var i;
                data = result.data;
                
                if (data.length) {
                    for (i = 0; i < data.length; i++) {

                        // if((data[i].periode_aktif) == 'Y'){
                            var tr = $('<tr>').append([
                                $('<td width="5%" align="center">'),
                                $('<td width="5%">'),
                                $('<td width="15%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="10%">'),
                                $('<td width="10%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">')
                            ]);
                        // } else {
                            var tr = $('<tr>').append([
                                $('<td width="5%" align="center">'),
                                $('<td width="5%">'),
                                $('<td width="15%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="10%">'),
                                $('<td width="10%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">')
                            ]);
                        // }


                        tr.find('td:nth-child(1)').html((i + 1));

                        tr.find('td:nth-child(2)').append($('<div>')
                            .html(('<b>'+data[i].siswa_nama)));

                        tr.find('td:nth-child(2)').append($('<div>')
                            .html((data[i].siswa_nisn)));

                        tr.find('td:nth-child(3)').append($('<div>')
                            .html((data[i].kelas_nama)));

                        tr.find('td:nth-child(4)').append($('<div>')
                            .html((data[i].daftar_nama)));

                        tr.find('td:nth-child(5)').append($('<div>')
                            .html((data[i].kriteria_kode)));

                        tr.find('td:nth-child(6)').append($('<div>')
                            .html((data[i].kriteria_tipe)));

                        tr.find('td:nth-child(7)').append($('<div>')
                            .html((data[i].nilai_ket)));

                        tr.find('td:nth-child(8)').append($('<div>')
                            .html((data[i].nilai_bobot)));

                        tr.find('td:nth-child(9)').append($('<div>')
                            .html((data[i].nilai_maxmin)));

                        tr.find('td:nth-child(10)').append($('<div>')
                            .html((data[i].nilai_normalisasi)));

                        tr.find('td:nth-child(11)').append($('<div>')
                            .html((data[i].nilai_sigma_kali)));

                        tr.find('td:nth-child(12)').append($('<div>')
                            .html((data[i].nilai_sigma_pangkat)));

                        tr.find('td:nth-child(13)').append('<div class="btn-group"><a href="javascript:;" class="btn btn-soft-danger btn-xs item_delete" data="' + data[i].penilaian_id + '"><i class="far fa-trash-alt"></i></a></div>');
                        
                        tr.appendTo($('#tabel_data'));
                    }
                } 

                $('#datatable').DataTable('refresh'); 



    /* DATA SIGMA */

    $('#tabel_data_sigma').empty();

        var i;
        data_sigma = result.data_sigma;
            
            if (data_sigma.length) {
                for (i = 0; i < data_sigma.length; i++) {

                    // if((data[i].periode_aktif) == 'Y'){

                    //     var tr = $('<tr>').append([
                    //         $('<td width="5%" align="center">'),
                    //         $('<td width="5%" align="center">'),
                    //         $('<td width="20%">'),
                    //         $('<td width="5%" align="center">'),
                    //         $('<td width="10%" align="center">'),
                    //         $('<td width="10%" align="center">'),
                    //         $('<td width="10%" align="center">'),
                    //         $('<td width="10%" align="center">'),
                    //         $('<td width="10%" align="center">')
                    //     ]);
                    // } else {
                    //     var tr = $('<tr>').append([
                    //         $('<td width="5%" align="center">'),
                    //         $('<td width="5%" align="center">'),
                    //         $('<td width="20%">'),
                    //         $('<td width="5%" align="center">'),
                    //         $('<td width="10%" align="center">'),
                    //         $('<td width="10%" align="center">'),
                    //         $('<td width="10%" align="center">'),
                    //         $('<td width="10%" align="center">'),
                    //         $('<td width="10%" align="center">')
                    //     ]);

                    // }

                    var tr = $('<tr>').append([
                            $('<td width="5%" align="center">'),
                            $('<td width="5%" align="center">'),
                            $('<td width="20%">'),
                            $('<td width="5%" align="center">'),
                            $('<td width="10%" align="center">'),
                            $('<td width="10%" align="center">'),
                            $('<td width="10%" align="center">'),
                            $('<td width="10%" align="center">'),
                            $('<td width="10%" align="center">')
                        ]);


                    tr.find('td:nth-child(1)').html((i + 1));

                    tr.find('td:nth-child(2)').append($('<div>')
                        .html((data_sigma[i].siswa_nisn)));

                    tr.find('td:nth-child(3)').append($('<div>')
                        .html((data_sigma[i].siswa_nama)));

                    tr.find('td:nth-child(4)').append($('<div>')
                        .html((data_sigma[i].kelas_nama)));

                    tr.find('td:nth-child(5)').append($('<div>')
                        .html((data_sigma[i].sigma_kali_jumlah)));

                    tr.find('td:nth-child(6)').append($('<div>')
                        .html((data_sigma[i].sigma_nilai_kali_jumlah)));

                    tr.find('td:nth-child(7)').append($('<div>')
                        .html((data_sigma[i].sigma_kali_pangkat)));

                    tr.find('td:nth-child(8)').append($('<div>')
                        .html((data_sigma[i].sigma_nilai_kali_pangkat)));

                    tr.find('td:nth-child(9)').append($('<div>')
                        .html((data_sigma[i].nilai_qi)));

                    tr.appendTo($('#tabel_data_sigma'));
                }
            } 

        }
        });
    }

    /* == AJAX TAMPILKAN DATA SIGMA == */





    /* == AJAX TAMBAH DATA == */

    $('#btn_add').on('click', function(){

        $.when(
            // combo_peserta(),
            // combo_kriteria(),
            combo_daftar(),
            combo_periode()
        )
        .done(function(){

            var filter_daftar=$('#daftar').val();
            combo_filter_peserta(filter_daftar);
            
            var filter_periode=$('#periode').val();
            combo_filter_kriteria(filter_periode);

            var filter_kriteria=$('#kriteria').val();
            combo_kuantitatif(filter_kriteria);
            
            $('#formModalAdd').modal('show');

        })

    });

    function showDaftar(select){
        var filter_daftar=$('#daftar').val();
        combo_filter_peserta(filter_daftar);
    }

    function showPeriode(select){
        var filter_periode=$('#periode').val();
        combo_filter_kriteria(filter_periode);
    }

    function showKriteria(select){
        var filter_kriteria=$('#kriteria').val();
        combo_kuantitatif(filter_kriteria);
    }

    /* == AJAX SIMPAN DATA == */

    $('#btn_save').on('click', function(){

        var daftar = $('#daftar').val();
        var filter_peserta = $('#filter_peserta').val();
        var periode = $('#periode').val();
        var kuantitatif = $('#kuantitatif').val();  
        var token = $('[name=_token]').val();

        var formData = new FormData();
        formData.append('daftar', daftar);
        formData.append('filter_peserta', filter_peserta);
        formData.append('periode', periode);
        formData.append('kuantitatif', kuantitatif);
        formData.append('_token', token);

        $.ajax({
            type: "POST",
            url: "{{ route('penilaian.save') }}",
            dataType: "JSON",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {

                if (data == true) {

                    $('#formModalAdd').modal('hide'); 
                    swal("Berhasil!", "Data Berhasil Disimpan", "success");
                    
                     
                } else if (data == false){

                    swal("Gagal!", "Data Sudah Ada", "error");

                }

                view();

            }
        });

        return false;

    });

    /* == AJAX DELETE DATA == */

    $('#tabel_data').on('click','.item_delete',function(){
        var id=$(this).attr('data');
        swal({
                title: "Anda Yakin Hapus Data Ini ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, Hapus !",
                closeOnConfirm: false
        }, function (isConfirm) {
            if (isConfirm) {
                var _token = $('meta[name=csrf-token]').attr('content');
                $.ajax({
                    type : "GET",
                    url   : "{{ route('penilaian.delete') }}",
                    dataType : "JSON",
                    data : {id,_token},
                    success: function(data){
                        swal("Hapus !", "Data Sudah Hapus !!.", "success");
                        view();
                    }
                });  
            }
        });
    });

    /* == COMBO == */
    
    // function combo_peserta(){
    //     $.ajax({
    //         type  : 'GET',
    //         url   : "{{ route('combo.peserta') }}",
    //         async : false,
    //         dataType : 'JSON',
    //         success : function(data){
               
    //             var html = '';
    //             var i;
    //             $('select[name=peserta]').empty()
    //             for(i=0; i<data.length; i++){
    //                 var html = '';
    //                 html = '<option value='+(data[i].peserta_id)+'>'+(data[i].siswa_nama)+'</option>';
    //                 $('select[name=peserta]').append(html)
    //             }
    //         }
    //     });
    // }

    function combo_periode(){
        $.ajax({
            type  : 'GET',
            url   : "{{ route('combo.periode') }}",
            async : false,
            dataType : 'JSON',
            success : function(data){
               
                var html = '';
                var i;
                $('select[name=periode]').empty()
                for(i=0; i<data.length; i++){
                    var html = '';
                    html = '<option value='+(data[i].periode_id)+'>'+(data[i].periode_nama)+'</option>';
                    $('select[name=periode]').append(html)
                }
            }
        });
    }

    function combo_daftar(){
        $.ajax({
            type  : 'GET',
            url   : "{{ route('combo.daftar') }}",
            async : false,
            dataType : 'JSON',
            success : function(data){
               
                var html = '';
                var i;
                $('select[name=daftar]').empty()
                for(i=0; i<data.length; i++){
                    var html = '';
                    html = '<option value='+(data[i].daftar_id)+'>'+(data[i].daftar_nama)+'</option>';
                    $('select[name=daftar]').append(html)
                }
            }
        });
    }

    function combo_filter_daftar(){
        $.ajax({
            type  : 'GET',
            url   : "{{ route('combo.daftar') }}",
            async : false,
            dataType : 'JSON',
            success : function(data){
               
                var html = '';
                var i;
                $('select[name=filter_daftar]').empty()
                for(i=0; i<data.length; i++){
                    var html = '';
                    html = '<option value='+(data[i].daftar_id)+'>'+(data[i].daftar_nama)+'</option>';
                    $('select[name=filter_daftar]').append(html)
                }
            }
        });
    }

    function combo_kriteria(){
        $.ajax({
            type  : 'GET',
            url   : "{{ route('combo.kriteria') }}",
            async : false,
            dataType : 'JSON',
            success : function(data){
               
                var html = '';
                var i;
                $('select[name=kriteria]').empty()
                for(i=0; i<data.length; i++){
                    var html = '';
                    html = '<option value='+(data[i].kriteria_id)+'>'+(data[i].kriteria_kode)+' - '+(data[i].kriteria_nama)+'</option>';
                    $('select[name=kriteria]').append(html)
                }
            }
        });
    }

    function combo_kuantitatif(filter_kriteria){
        $.ajax({
            type  : 'GET',
            url   : "{{ route('combo.kuantitatif') }}",
            async : false,
            data : {filter_kriteria:filter_kriteria},
            dataType : 'JSON',
            success : function(data){
               
                var html = '';
                var i;
                $('select[name=kuantitatif]').empty()
                for(i=0; i<data.length; i++){
                    var html = '';
                    html = '<option value='+(data[i].kua_id)+'>'+(data[i].nilai_ket)+'</option>';
                    $('select[name=kuantitatif]').append(html)
                }
            }
        });
    }

    function combo_filter_periode(){
        $.ajax({
            type  : 'GET',
            url   : "{{ route('combo.periode') }}",
            async : false,
            dataType : 'JSON',
            success : function(data){
               
                var html = '';
                var i;
                $('select[name=filter_periode]').empty()
                for(i=0; i<data.length; i++){
                    var html = '';
                    html = '<option value='+(data[i].periode_id)+'>'+(data[i].periode_nama)+'</option>';
                    $('select[name=filter_periode]').append(html)
                }
            }
        });
    }

    function combo_filter_peserta(filter_daftar){
        $.ajax({
            type  : 'GET',
            url   : "{{ route('combo.filter_peserta') }}",
            async : false,
            dataType : 'JSON',
            data:{filter_daftar:filter_daftar},
            success : function(data){
               
                var html = '';
                var i;
                $('select[name=filter_peserta]').empty()
                for(i=0; i<data.length; i++){
                    var html = '';
                    html = '<option value='+(data[i].peserta_id)+'>'+(data[i].siswa_nama)+'</option>';
                    $('select[name=filter_peserta]').append(html)
                }
            }
        });
    }

    function combo_filter_kriteria(filter_periode){
        $.ajax({
            type  : 'GET',
            url   : "{{ route('combo.filter_periode_kriteria') }}",
            async : false,
            dataType : 'JSON',
            data:{filter_periode:filter_periode},
            success : function(data){
               
                var html = '';
                var i;
                $('select[name=kriteria]').empty()
                for(i=0; i<data.length; i++){
                    var html = '';
                    html = '<option value='+(data[i].kriteria_id)+'>'+(data[i].kriteria_nama)+'</option>';
                    $('select[name=kriteria]').append(html)
                }
            }
        });
    }

</script>
@endsection
