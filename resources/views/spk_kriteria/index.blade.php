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
                        <h5><i class="mdi mdi-chemical-weapon"></i> KRITERIA</h5>
                    </div>
                </div>    
            </div>

            <div class="card-header header_add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group " role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary waves-effect waves-light btn_add" data-toggle="modal" id="btn_add"><i class="mdi mdi-plus-circle-outline"></i> BARU</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group " role="group" aria-label="Basic example">
                            <label>Periode</label>
                                <select class="form-control custom-select select2"  style="width: 100%;" name="filter_periode" id="filter_periode" onchange="showFilterPeriode(this)"></select>
                        </div>
                    </div> 
                </div>     
            </div>

            <div class="card-body">

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center">NO.</th>
                            <th style="text-align: center">KODE</th>
                            <th style="text-align: center">NAMA</th>
                            <th style="text-align: center">TIPE</th>
                            <th style="text-align: center">URUT</th>
                            <th style="text-align: center">BOBOT (W)</th>
                            <th style="text-align: center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody id="tabel_data"></tbody>
                </table>
                        

            </div>
        </div>
    </div>                     
</div>

<div class="modal modal-default fade" id="formModalAdd">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #ffffff">

            <div class="modal-header">
                <h5 class="modal-title mt-0"><i class="mdi mdi-plus-circle-outline"></i> Kriteria</h5>
            </div>

            <div class="modal-body">

                {!! csrf_field() !!}
    
                <div class="row">
    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control" name="kode" id="kode" maxlength="4">
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama">
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Type</label>
                            <select type="text" class="form-control custom-select select2" style="width: 100%;" name="tipe" id="tipe"></select>
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Urutan</label>
                            <input type="text" class="form-control" name="urut" id="urut">
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Periode</label>
                            <select type="text" class="form-control custom-select select2" style="width: 100%;" name="periode" id="periode"></select>
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

<div class="modal modal-default fade" id="formModalEdit">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #ffffff">

            <div class="modal-header">
                <h5 class="modal-title mt-0"><i class="fas fa-pencil-alt"></i> Tahun Pelajaran</h5>
            </div>

            <div class="modal-body">

                {!! csrf_field() !!}
    
                <div class="row">

                    <input type="hidden" name="id_edit" id="id_edit" readonly="readonly">
    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control" name="kode_edit" id="kode_edit" maxlength="4" onkeypress="return angka(this, event)" readonly="readonly">
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tahun</label>
                            <input type="text" class="form-control" name="masuk_edit" id="masuk_edit" maxlength="4" onkeypress="return angka(this, event)">
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama_edit" id="nama_edit">
                        </div>
                    </div> 
    

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning btn-xs" id="btn_update"><i class="fas fa-save"></i> UPDATE</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

    $(document).ready(function(){
        $('#datatable').DataTable();

        combo_filter_periode()


        var filter_periode = $('#filter_periode').val();
        view(filter_periode);
    });

    function showFilterPeriode(select){
        var filter_periode = $('#filter_periode').val();
        view(filter_periode);
    }

    /* == AJAX TAMPILKAN DATA == */

    function view(filter_periode) {

        $.ajax({
            type: 'GET',
            url: "{{ route('kriteria.view') }}",
            async: true,
            data:{filter_periode:filter_periode},
            dataType: 'JSON',
            success: function(result) {
                
                $('#datatable').DataTable().destroy();
                $('#tabel_data').empty();

                var i;
                data = result.data;
                
                if (data.length) {
                    for (i = 0; i < data.length; i++) {
                        
                        if((data[i].kriteria_aktif) == 'Y'){
                            var tr = $('<tr>').append([
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="30%">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">')
                            ]);
                        } else {
                            var tr = $('<tr>').append([
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="30%">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">'),
                                $('<td width="5%" align="center">')
                            ]);
                        }
                        

                        tr.find('td:nth-child(1)').html((i + 1));

                        tr.find('td:nth-child(2)').append($('<div>')
                            .html((data[i].kriteria_kode)));

                        tr.find('td:nth-child(3)').append($('<div>')
                            .html((data[i].kriteria_nama)));

                        tr.find('td:nth-child(4)').append($('<div>')
                            .html((data[i].kriteria_tipe)));

                        tr.find('td:nth-child(5)').append($('<div>')
                            .html((data[i].kriteria_urut)));

                        tr.find('td:nth-child(6)').append($('<div>')
                            .html((data[i].kriteria_bobot)));


                        tr.find('td:nth-child(7)').append('<div class="btn-group"><a href="javascript:;" class="btn btn-soft-warning btn-xs item_edit" data="'+data[i].kriteria_id+'"><i class="fas fa-pencil-alt"></i></a><a href="javascript:;" class="btn btn-soft-danger btn-xs item_delete" data="' + data[i].kriteria_id + '"><i class="far fa-trash-alt"></i></a></div>');
                        
                        tr.appendTo($('#tabel_data'));
                    }
                } 

                $('#datatable').DataTable('refresh'); 
            }
        });
    }

    /* == AJAX TAMBAH DATA == */

    $('#btn_add').on('click', function(){

        $.when(
            combo_tipe(),
            combo_periode()
        )
        .done(function(){
            $('#kode').val("");
            $('#nama').val("");
            $('#urut').val("");
            $('#formModalAdd').modal('show');
        })

    });

    /* == AJAX SIMPAN DATA == */

    $('#btn_save').on('click', function(){

        if (!$("#kode").val()) {
            $.toast({
                text: 'KODE HARUS DI ISI',
                position: 'top-right',
                loaderBg: '#fff716',
                icon: 'error',
                hideAfter: 3000
            });
            $("#kode").focus();
            return false;

        }  else if (!$("#nama").val()) {
            $.toast({
                text: 'NAMA HARUS DI ISI',
                position: 'top-right',
                loaderBg: '#fff716',
                icon: 'error',
                hideAfter: 3000
            });
            $("#nama").focus();
            return false;

        }

        var kode    = $('#kode').val();
        var nama    = $('#nama').val();
        var tipe    = $('#tipe').val();
        var urut    = $('#urut').val();
        var periode = $('#periode').val();
        var token   = $('[name=_token]').val();

        var formData = new FormData();
        formData.append('kode', kode);
        formData.append('nama', nama);
        formData.append('tipe', tipe);
        formData.append('urut', urut);
        formData.append('periode', periode);
        formData.append('_token', token);

        $.ajax({
            type: "POST",
            url: "{{ route('kriteria.save') }}",
            dataType: "JSON",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {

                if (data == true) {

                    $('#formModalAdd').modal('hide'); 
                    swal("Berhasil!", "Data Berhasil Disimpan", "success");
                    view();
                     
                } else if (data == false){

                    swal("Gagal!", "Data Gagal Disimpan", "error");

                }

            }
        });

        return false;

    });

    /* == AJAX EDIT DATA == */

    $('#tabel_data').on('click','.item_edit',function(){

        var id=$(this).attr('data');

        $.ajax({
            type : "GET",
            url   : "{{ route('tahun.edit') }}",
            dataType : "JSON",
            data : {id:id},
            success: function(data){

                $('#formModalEdit').modal('show');
                $('#formModalEdit').find('[name="id_edit"]').val(data.tahun_id);
                $('#formModalEdit').find('[name="kode_edit"]').val(data.tahun_kode);
                $('#formModalEdit').find('[name="masuk_edit"]').val(data.tahun_masuk);
                $('#formModalEdit').find('[name="nama_edit"]').val(data.tahun_nama);

            }
        });
      
        return false;
    });

    /* == AJAX UPDATE DATA == */

    $('#btn_update').on('click',function(){

        if (!$("#kode_edit").val()) {
            $.toast({
                text: 'KODE HARUS DI ISI',
                position: 'top-right',
                loaderBg: '#fff716',
                icon: 'error',
                hideAfter: 3000
            });
            $("#kode_edit").focus();
            return false;

        } else if (!$("#masuk_edit").val()) {
            $.toast({
                text: 'TAHUN MASUK HARUS DI ISI',
                position: 'top-right',
                loaderBg: '#fff716',
                icon: 'error',
                hideAfter: 3000
            });
            $("#masuk_edit").focus();
            return false;

        } else if (!$("#nama_edit").val()) {
            $.toast({
                text: 'NAMA HARUS DI ISI',
                position: 'top-right',
                loaderBg: '#fff716',
                icon: 'error',
                hideAfter: 3000
            });
            $("#nama_edit").focus();
            return false;

        }

        var id      = $('#id_edit').val();
        var kode    = $('#kode_edit').val();
        var masuk   = $('#masuk_edit').val();
        var nama    = $('#nama_edit').val();
        var token   = $('[name=_token]').val();

        var formData = new FormData();
        formData.append('id',id);
        formData.append('kode',kode);
        formData.append('masuk',masuk);
        formData.append('nama',nama);
        formData.append('_token',token);

        $.ajax({
            type : "POST",
            url   : "{{ route('tahun.update') }}",
            dataType : "JSON",
            data : formData,
            cache : false,
            processData : false,
            contentType : false,
            success: function(data){

                $('#formModalEdit').modal('hide');
                swal("Berhasil!", "Data Berhasil Diupdate", "success");
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
                    url   : "{{ route('kriteria.delete') }}",
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

        /* == AJAX COMBO Type == */

    function combo_tipe(){
        $('select[name=tipe]').empty() 
        var html = '';
        html = '<option value="B">Benefit</option>'+
            '<option value="C">Cost</option>';
        $('select[name=tipe]').append(html)

    }

    /* == AJAX COMBO Periode == */

    function combo_periode(){
    $.ajax({
    type : 'GET',
    url  : "{{ route('combo.periode') }}",
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

    /* == AJAX COMBO Filter Periode == */

    function combo_filter_periode(){
    $.ajax({
    type : 'GET',
    url  : "{{ route('combo.periode') }}",
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

</script>
@endsection
