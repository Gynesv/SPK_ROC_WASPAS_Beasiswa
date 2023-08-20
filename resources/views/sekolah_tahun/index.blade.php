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
                        <h5><i class="mdi mdi-calendar"></i> TAHUN PELAJARAN</h5>
                    </div>
                </div>    
            </div>

            <div class="card-header header_add">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary waves-effect waves-light btn-xs btn_add" data-toggle="modal" id="btn_add"><i class="mdi mdi-plus-circle-outline"></i> BARU</button>
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
                <h5 class="modal-title mt-0"><i class="mdi mdi-plus-circle-outline"></i> Tahun Pelajaran</h5>
            </div>

            <div class="modal-body">

                {!! csrf_field() !!}
    
                <div class="row">
    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control" name="kode" id="kode" maxlength="4" onkeypress="return angka(this, event)">
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama">
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
        view();
    });

    /* == AJAX TAMPILKAN DATA == */

    function view() {

        $.ajax({
            type: 'GET',
            url: "{{ route('tahun.view') }}",
            dataType: 'JSON',
            async: true,
            success: function(result) {
                
                $('#datatable').DataTable().destroy();
                $('#tabel_data').empty();

                var i;
                data = result.data;
                
                if (data.length) {
                    for (i = 0; i < data.length; i++) {

                        var tr = $('<tr>').append([
                            $('<td width="5%" align="center">'),
                            $('<td width="10%" align="center">'),
                            $('<td width="30%">'),
                            $('<td width="5%" align="center">')
                        ]);

                        tr.find('td:nth-child(1)').html((i + 1));

                        tr.find('td:nth-child(2)').append($('<div>')
                            .html((data[i].tahun_kode)));

                        tr.find('td:nth-child(3)').append($('<div>')
                            .html((data[i].tahun_nama)));

                        tr.find('td:nth-child(4)').append('<div class="btn-group"><a href="javascript:;" class="btn btn-soft-warning btn-xs item_edit" data="'+data[i].tahun_id+'"><i class="fas fa-pencil-alt"></i></a><a href="javascript:;" class="btn btn-soft-danger btn-xs item_delete" data="' + data[i].tahun_id + '"><i class="far fa-trash-alt"></i></a></div>');
                        
                        tr.appendTo($('#tabel_data'));
                    }
                } else {

                    $('#tabel_data').append('<tr><td colspan="4">Data Kosong</td></tr>');
                }

                $('#datatable').DataTable('refresh'); 
            }
        });
    }

    /* == AJAX TAMBAH DATA == */

    $('#btn_add').on('click', function(){

        $('#kode').val("");
        $('#nama').val("");
        $('#formModalAdd').modal('show');

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

        } else if (!$("#nama").val()) {
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

        var kode = $('#kode').val();
        var nama = $('#nama').val();
        var token = $('[name=_token]').val();

        var formData = new FormData();
        formData.append('kode', kode);
        formData.append('nama', nama);
        formData.append('_token', token);

        $.ajax({
            type: "POST",
            url: "{{ route('tahun.save') }}",
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
        var nama    = $('#nama_edit').val();
        var token   = $('[name=_token]').val();

        var formData = new FormData();
        formData.append('id',id);
        formData.append('kode',kode);
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
                    url   : "{{ route('tahun.delete') }}",
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

</script>
@endsection
