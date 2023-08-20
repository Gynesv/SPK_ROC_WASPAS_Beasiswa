@extends('layouts.template')
@section('css')
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5><i class="mdi mdi-certificate"></i> PESERTA </h5>
                    </div>
                </div>    
            </div>

            <div class="card-header header_add">
                <div class="row">
                    <div class="col-md-2">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary waves-effect waves-light btn-xs"id="btn_add" data-toggle="modal" data-target=".modal-default"><i class="mdi mdi-plus-circle-outline"></i> BARU</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group " role="group" aria-label="Basic example">
                            <label>Tahun Daftar</label>
                                <select class="form-control custom-select select2"  style="width: 100%;" name="filter_tasuk" id="filter_tasuk" onchange="showFilterTasuk(this)"></select>
                        </div>
                    </div> 
                </div>     
            </div>

            <div class="card-body">

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center">NO.</th>
                            <th style="text-align: center">KELAS</th>
                            <th style="text-align: center">NAMA</th>
                            <th style="text-align: center">TAHUN DAFTAR</th>
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
                        <h5 class="modal-title mt-0"><i class="mdi mdi-plus-circle-outline"></i> Peserta</h5>
                    </div>

                    <div class="modal-body">

                        {!! csrf_field() !!}

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <select type="text" class="form-control custom-select select2" style="width: 100%;" name="kelas" id="kelas"></select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Siswa </label>
                                    <select type="text" class="form-control custom-select select2" style="width: 100%;" name="siswa" id="siswa"></select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tahun Masuk </label>
                                    <select type="text" class="form-control custom-select select2" style="width: 100%;" name="daftar" id="daftar"></select>
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
</div>


<div class="modal modal-default fade" id="formModalEdit">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #ffffff">

            <div class="modal-header">
                <h5 class="modal-title mt-0"><i class="fas fa-pencil-alt"></i> Peserta </h5>
            </div>

            <div class="modal-body">

                {!! csrf_field() !!}
    
                <div class="row">

                    <input type="hidden" name="id_edit" id="id_edit" readonly="readonly">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Kelas</label>
                            <select type="text" class="form-control custom-select select2" style="width: 100%;" name="kelas" id="kelas_edit"></select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Siswa </label>
                            <select type="text" class="form-control custom-select select2" style="width: 100%;" name="siswa" id="siswa_edit"></select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tahun Daftar </label>
                            <select type="text" class="form-control custom-select select2" style="width: 100%;" name="daftar" id="daftar_edit"></select>
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
<script id="text/javascript">

    $(document).ready(function(){
            $('#datatable').DataTable();
            $('.select2').select2();

            combo_filter_daftar()

            var filter_tasuk = $('#filter_tasuk').val();
            view(filter_tasuk);
        });

        function showFilterTasuk(select){
            var filter_tasuk = $('#filter_tasuk').val();
            view(filter_tasuk);
        }

        /* == AJAX TAMPILKAN DATA == */
        function view(filter_tasuk) {

        $.ajax({
            type: 'GET',
            url: "{{ route('peserta.view') }}",
            dataType: 'JSON',
            data:{filter_tasuk:filter_tasuk},
            async: true,
            success: function(result) {
                
                $('#datatable').DataTable().destroy();
                $('#tabel_data').empty();

                var i;
                data = result.data;
                
                if (data.length) {
                    for (i = 0; i < data.length; i++) {

                        if((data[i].peserta_aktif) == 'Y'){
                            var tr = $('<tr>').append([
                                $('<td width="10%" align="center">'),
                                $('<td width="20%">'),
                                $('<td width="10%">'),
                                $('<td width="10%" align="center">'),
                                $('<td width="20%" align="center">')
                            ]);
                        } else {
                            var tr = $('<tr>').append([
                                $('<td width="10%" align="center">'),
                                $('<td width="20%">'),
                                $('<td width="10%">'),
                                $('<td width="10%" align="center">'),
                                $('<td width="20%" align="center">')
                            ]);
                        }

                        

                        tr.find('td:nth-child(1)').html((i + 1));

                        tr.find('td:nth-child(2)').append($('<div>')
                            .html((data[i].kelas_nama)));

                        tr.find('td:nth-child(3)').append($('<div>')
                            .html((data[i].siswa_nama)));

                        tr.find('td:nth-child(4)').append($('<div>')
                            .html((data[i].daftar_nama)));

                        tr.find('td:nth-child(5)').append('<div class="btn-group"><a href="javascript:;" class="btn btn-soft-warning btn-xs item_edit" data="'+data[i].peserta_id+'"><i class="fas fa-pencil-alt"></i></a><a href="javascript:;" class="btn btn-soft-danger btn-xs item_delete" data="' + data[i].peserta_id + '"><i class="far fa-trash-alt"></i></a></div>');

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
            combo_kelas(),
            combo_siswa(),
            combo_daftar()
        )
        .done(function(){
            $('#formModalAdd').modal('show');
        })

    });

    /* == AJAX SIMPAN DATA == */

    $('#btn_save').on('click', function(){


    var kelas = $('#kelas').val();
    var siswa = $('#siswa').val();
    var daftar = $('#daftar').val();
    var token = $('[name=_token]').val();

    var formData = new FormData();
    formData.append('kelas', kelas);
    formData.append('siswa', siswa);
    formData.append('daftar', daftar);
    formData.append('_token', token);

    $.ajax({
        type: "POST",
        url: "{{ route('peserta.save') }}",
        dataType: "JSON", 
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {

            $('#formModalAdd').modal('hide');
                swal("Berhasil!", "Data Berhasil Disimpan", "success");
                var filter_tasuk = $('#filter_tasuk').val();
                view(filter_tasuk);
            }
        });
        return false;
    });

    


    /* == AJAX EDIT DATA == */

    $('#tabel_data').on('click','.item_edit',function(){

        var id=$(this).attr('data');

        $.when(
            combo_kelas(),
            combo_siswa(),
            combo_daftar()
        )
        .done(function(){

            $.ajax({
                type: "GET",
                url: "{{ route('peserta.edit') }}",
                dataType: "JSON",
                data: {id:id},
                success: function(data){

                    $('#formModalEdit').modal('show');
                    $('#formModalEdit').find('[name="id_edit"]').val(data.peserta_id);
                    $('#formModalEdit').find('[name="kelas"]').val(data.kelas_id).trigger("change");
                    $('#formModalEdit').find('[name="siswa"]').val(data.siswa_id).trigger("change");
                    $('#formModalEdit').find('[name="daftar"]').val(data.daftar_id).trigger("change");
                }
            });
        });
        return false;
    });

    /*==AJAX UPDATE DATA == */


    $('#btn_update').on('click', function(){

    if (!$("#kelas_edit").val()){
        $.toast({
            text : 'KELAS HARUS DI ISI',
            position: 'top-right',
            loaderBg: 'fff716',
            icon: 'error',
            hideAfter: 3000
        });
    $("#kelas_edit").focus();
    return false;

    } else if (!$("#siswa_edit").val()){
        $.toast({
            text : 'SISWA HARUS DI ISI',
            position: 'top-right',
            loaderBg: 'fff716',
            icon: 'error',
            hideAfter: 3000
        });
    $("#siswa_edit").focus();
    return false;

    }

    var id = $('#id_edit').val();
    var kelas = $('#kelas_edit').val();
    var siswa = $('#siswa_edit').val();
    var token = $('[name=_token]').val();

    var formData = new FormData();
    formData.append('id',id);
    formData.append('kelas',kelas);
    formData.append('siswa',siswa);
    formData.append('_token',token);

    $.ajax({
    type : "POST",
    url : "{{ route('peserta.update')}}",
    dataType: "JSON",
    data : formData,
    cache : false,
    processData : false,
    contentType : false,
    success: function(data){

        $("#formModalEdit").modal('hide');
        swal("Berhasil", "Data Berhasil Diupdate", "success");
        var filter_tasuk = $('#filter_tasuk').val();
        view(filter_tasuk);

        }
    });
    return false;

    });

    /* == AJAX DELETE DATA == */ 

    $('#tabel_data').on('click','.item_delete',function(){
        var id=$(this).attr('data');
        swal({
                title: "Anda Yakin Hapus Data Ini ? ",
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
                    url : "{{ route('peserta.delete') }}",
                    dataType: "JSON",
                    data : {id,_token},
                    success: function(data){
                        swal("Hapus !", "Data Sudah Hapus !!.","success");
                        var filter_tasuk = $('#filter_tasuk').val();
                        view(filter_tasuk);
                    }
                });
            }
        });
    });

    /* == AJAX COMBO Kelas == */

    function combo_kelas(){
        $.ajax({
            type : 'GET',
            url  : "{{ route('combo.kelas') }}",
            async : false,
            dataType : 'JSON',
            success : function(data){

                var html = '';
                var i;
                $('select[name=kelas]').empty()
                for(i=0; i<data.length; i++){
                    var html = '';
                    html = '<option value='+(data[i].kelas_id)+'>'+(data[i].kelas_nama)+'</option>';
                    $('select[name=kelas]').append(html)
                }
            }
        });
    }

    /* == AJAX COMBO Siswa == */

    function combo_siswa(){
        $.ajax({
            type : 'GET',
            url  : "{{ route('combo.siswa') }}",
            async : false,
            dataType : 'JSON',
            success : function(data){

                var html = '';
                var i;
                $('select[name=siswa]').empty()
                for(i=0; i<data.length; i++){
                    var html = '';
                    html = '<option value='+(data[i].siswa_id)+'>'+(data[i].siswa_nama)+'</option>';
                    $('select[name=siswa]').append(html)
                }
            }
        });
    }

    /* == AJAX COMBO Tahun Daftar == */

    function combo_daftar(){
        $.ajax({
            type : 'GET',
            url  : "{{ route('combo.daftar') }}",
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

    /* == AJAX COMBO Filter Tahun Daftar == */

    function combo_filter_daftar(){
        $.ajax({
            type : 'GET',
            url  : "{{ route('combo.daftar') }}",
            async : false,
            dataType : 'JSON',
            success : function(data){

                var html = '';
                var i;
                $('select[name=filter_tasuk]').empty()
                for(i=0; i<data.length; i++){
                    var html = '';
                    html = '<option value='+(data[i].daftar_id)+'>'+(data[i].daftar_nama)+'</option>';
                    $('select[name=filter_tasuk]').append(html)
                }
            }
        });
    }

</script>
@endsection

