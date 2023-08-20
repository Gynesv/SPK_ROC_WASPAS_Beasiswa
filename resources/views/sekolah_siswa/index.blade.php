@extends('layouts.template')
@section('css')
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <h5><i class="mdi mdi-certificate"></i> SISWA </h5>
                    </div>
                </div>    
            </div>

            <div class="card-header header_add">
                <div class="row">
                    <div class="col-md-4">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary waves-effect waves-light btn-xs"id="btn_add" data-toggle="modal" data-target=".modal-default"><i class="mdi mdi-plus-circle-outline"></i> BARU</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group " role="group" aria-label="Basic example">
                            <label>Tahun Ajaran</label>
                                <select class="form-control custom-select select2"  style="width: 100%;" name="filter_tahun" id="filter_tahun" onchange="showFilterTahun(this)"></select>
                        </div>
                    </div> 
                </div>     
            </div>

            <div class="card-body">

                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th style="text-align: center">NO.</th>
                            <th style="text-align: center">NAMA</th>
                            <th style="text-align: center">JEKEL</th>
                            <th style="text-align: center">ALAMAT</th>
                            <th style="text-align: center">TAHUN </th>
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
                        <h5 class="modal-title mt-0"><i class="mdi mdi-plus-circle-outline"></i> Siswa</h5>
                    </div>

                    <div class="modal-body">

                        {!! csrf_field() !!}

                        <div class="row">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama"  >
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input type="text" class="form-control" name="nisn" id="nisn">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jekel</label>
                                    <select type="text" class="form-control custom-select select2" style="width: 100%;" name="jekel" id="jekel"></select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun </label>
                                    <select type="text" class="form-control custom-select select2" style="width: 100%;" name="tahun" id="tahun"></select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat">
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

<div class="modal modal-default fade" id="formModalAdd">
            <div class="modal-dialog">
                <div class="modal-content" style="background-color: #ffffff">

                    <div class="modal-header">
                        <h5 class="modal-title mt-0"><i class="mdi mdi-plus-circle-outline"></i> Form</h5>
                    </div>

                    <div class="modal-body">

                        {!! csrf_field() !!}

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kode</label>
                                    <input type="text" class="form-control" name="kode" id="kode" maxlength="3" >
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Level</label>
                                    <select type="text" class="form-control custom-select select2" style="width: 100%;" name="level" id="level"></select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fakultas</label>
                                    <select type="text" class="form-control custom-select select2" style="width: 100%;" name="fakultas" id="fakultas"></select>
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
                        <h5 class="modal-title mt-0"><i class="fas fa-pencil-alt"></i> Siswa </h5>
                    </div>

                    <div class="modal-body">

                        {!! csrf_field() !!}
            
                        <div class="row">

                            <input type="hidden" name="id_edit" id="id_edit" readonly="readonly">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NAMA</label>
                                    <input type="text" class="form-control" name="nama_edit" id="nama_edit">
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NISN</label>
                                    <input type="text" class="form-control" name="nisn_edit" id="nisn_edit" readonly="readonly">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Jekel</label>
                                    <select class="form-control custom-select select2" style="width: 100%;" name="jekel" id="jekel_edit"></select>
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" class="form-control" name="alamat_edit" id="alamat_edit">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <select class="form-control custom-select select2" style="width: 100%;" name="tahun" id="tahun_edit"></select>
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

            combo_filter_tahun()

            var filter_tahun = $('#filter_tahun').val();
            view(filter_tahun);
        });

        function showFilterTahun(select){
            var filter_tahun = $('#filter_tahun').val();
            view(filter_tahun);
        }

        /* == AJAX TAMPILKAN DATA == */
        function view(filter_tahun) {

        $.ajax({
            type: 'GET',
            url: "{{ route('siswa.view') }}",
            dataType: 'JSON',
            async: true,
            data:{filter_tahun:filter_tahun},
            success: function(result) {
                
                $('#datatable').DataTable().destroy();
                $('#tabel_data').empty();

                var i;
                data = result.data;
                
                if (data.length) {
                    for (i = 0; i < data.length; i++) {

                        if((data[i].siswa_aktif) == 'Y'){
                            var tr = $('<tr>').append([
                                $('<td width="10%" align="center">'),
                                $('<td width="20%">'),
                                $('<td width="10%">'),
                                $('<td width="20%">'),
                                $('<td width="20%">'),
                                $('<td width="20%" align="center">')
                            ]);
                        } else {
                            var tr = $('<tr>').append([
                                $('<td width="10%" align="center">'),
                                $('<td width="20%">'),
                                $('<td width="10%">'),
                                $('<td width="20%">'),
                                $('<td width="20%">'),
                                $('<td width="20%" align="center">')
                            ]);
                        }
                       

                        tr.find('td:nth-child(1)').html((i + 1));

                        tr.find('td:nth-child(2)').append($('<div>')
                            .html(('<b>'+data[i].siswa_nama)));

                        tr.find('td:nth-child(2)').append($('<div>')
                            .html((data[i].siswa_nisn)));

                        tr.find('td:nth-child(3)').append($('<div>')
                        .html((data[i].siswa_jekel)));

                        tr.find('td:nth-child(4)').append($('<div>')
                            .html((data[i].siswa_alamat)));

                        tr.find('td:nth-child(5)').append($('<div>')
                            .html((data[i].tahun_nama)));

                        tr.find('td:nth-child(6)').append('<div class="btn-group"><a href="javascript:;" class="btn btn-soft-warning btn-xs item_edit" data="'+data[i].siswa_id+'"><i class="fas fa-pencil-alt"></i></a><a href="javascript:;" class="btn btn-soft-danger btn-xs item_delete" data="' + data[i].siswa_id + '"><i class="far fa-trash-alt"></i></a></div>');

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
            combo_jekel(),
            combo_tahun()
        )
        .done(function(){
            $('#nama').val("");
            $('#nisn').val("");
            $('#alamat').val("");
            $('#formModalAdd').modal('show');
        })

    });

    /* == AJAX SIMPAN DATA == */

    $('#btn_save').on('click', function(){

    if (!$('#nama').val()) {
        $.toast({
        text: 'NAMA HARUS DI ISI ',
        position: 'top_right',
        loaderBg: '#fff716',
        icon: 'error',
        hideAfter: 3000
    });
    $('#nama').focus();
    return false;

    } else if (!$('#nisn').val()) {
        $.toast({
        text: 'NISN HARUS DI ISI ',
        position: 'top_right',
        loaderBg: '#fff716',
        icon: 'error',
        hideAfter: 3000
    });
    $('#nisn').focus();
    return false;

    } else if (!$('#jekel').val()) {
        $.toast({
        text: 'JEKEL HARUS DI ISI ',
        position: 'top_right',
        loaderBg: '#fff716',
        icon: 'error',
        hideAfter: 3000
    });
    $('#jekel').focus();
    return false;

    }else if (!$('#tahun').val()) {
        $.toast({
        text: 'TAHUN HARUS DI ISI ',
        position: 'top_right',
        loaderBg: '#fff716',
        icon: 'error',
        hideAfter: 3000
    });
    $('#tahun').focus();
    return false;

    }else if (!$('#alamat').val()) {
        $.toast({
        text: 'ALAMAT LAHIR HARUS DI ISI ',
        position: 'top_right',
        loaderBg: '#fff716',
        icon: 'error',
        hideAfter: 3000
    });
    $('#alamat').focus();
    return false;
    }


    var nama = $('#nama').val();
    var nim = $('#nisn').val();
    var jekel = $('#jekel').val();
    var tahun = $('#tahun').val();
    var alamat = $('#alamat').val();
    var token = $('[name=_token]').val();

    var formData = new FormData();
    formData.append('nama', nama);
    formData.append('nisn', nim);
    formData.append('jekel', jekel);
    formData.append('tahun', tahun);
    formData.append('alamat', alamat);
    formData.append('_token', token);

    $.ajax({
        type: "POST",
        url: "{{ route('siswa.save') }}",
        dataType: "JSON", 
        data: formData,
        cache: false,
        processData: false,
        contentType: false,
        success: function(data) {

            $('#formModalAdd').modal('hide');
            swal("Berhasil!", "Data Berhasil Disimpan", "success");
            view();

        }

            

        });
        return false;
    });

    


    /* == AJAX EDIT DATA == */

    $('#tabel_data').on('click','.item_edit',function(){

        var id=$(this).attr('data');

        $.when(
            combo_jekel(),
            combo_tahun()
        )
        .done(function(){

            $.ajax({
                type: "GET",
                url: "{{ route('siswa.edit') }}",
                dataType: "JSON",
                data: {id:id},
                success: function(data){

                    $('#formModalEdit').modal('show');
                    $('#formModalEdit').find('[name="id_edit"]').val(data.siswa_id);
                    $('#formModalEdit').find('[name="nama_edit"]').val(data.siswa_nama);
                    $('#formModalEdit').find('[name="nisn_edit"]').val(data.siswa_nisn);
                    $('#formModalEdit').find('[name="alamat_edit"]').val(data.siswa_alamat);
                    $('#formModalEdit').find('[name="jekel"]').val(data.siswa_jekel).trigger("change");
                    $('#formModalEdit').find('[name="tahun"]').val(data.tahun_id).trigger("change");
                }
            });
        });
        return false;
    });

    /*==AJAX UPDATE DATA == */


    $('#btn_update').on('click', function(){

    if (!$("#nama_edit").val()){
        $.toast({
            text : 'NAMA HARUS DI ISI',
            position: 'top-right',
            loaderBg: 'fff716',
            icon: 'error',
            hideAfter: 3000
        });
    $("#nama_edit").focus();
    return false;

    } else if (!$("#nisn_edit").val()){
        $.toast({
            text : 'NISN HARUS DI ISI',
            position: 'top-right',
            loaderBg: 'fff716',
            icon: 'error',
            hideAfter: 3000
        });
    $("#nisn_edit").focus();
    return false;

    }else if (!$("#jekel_edit").val()){
        $.toast({
            text : 'NISN HARUS DI ISI',
            position: 'top-right',
            loaderBg: 'fff716',
            icon: 'error',
            hideAfter: 3000
        });
    $("#jekel_edit").focus();
    return false;

    }else if (!$("#alamat_edit").val()){
        $.toast({
            text : 'ALAMAt HARUS DI ISI',
            position: 'top-right',
            loaderBg: 'fff716',
            icon: 'error',
            hideAfter: 3000
        });
    $("#alamat_edit").focus();
    return false;
    }else if (!$("#tahun_edit").val()){
        $.toast({
            text : 'TAHUN HARUS DI ISI',
            position: 'top-right',
            loaderBg: 'fff716',
            icon: 'error',
            hideAfter: 3000
        });

    $("#tahun_edit").focus();
    return false;
    }

    var id = $('#id_edit').val();
    var nama = $('#nama_edit').val();
    var nisn = $('#nisn_edit').val();
    var jekel = $('#jekel_edit').val();
    var alamat = $('#alamat_edit').val();
    var tahun = $('#tahun_edit').val();
    var token = $('[name=_token]').val();

    var formData = new FormData();
    formData.append('id',id);
    formData.append('nama',nama);
    formData.append('nisn',nisn);
    formData.append('jekel',jekel);
    formData.append('alamat',alamat);
    formData.append('tahun',tahun);
    formData.append('_token',token);

    $.ajax({
    type : "POST",
    url : "{{ route('siswa.update')}}",
    dataType: "JSON",
    data : formData,
    cache : false,
    processData : false,
    contentType : false,
    success: function(data){

        $("#formModalEdit").modal('hide');
        swal("Berhasil", "Data Berhasil Diupdate", "success");
        view();

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
                    url : "{{ route('siswa.delete') }}",
                    dataType: "JSON",
                    data : {id,_token},
                    success: function(data){
                        swal("Hapus !", "Data Sudah Hapus !!.","success");
                        view();
                    }
                });
            }
        });
    });

    /* == AJAX COMBO LEVEL == */

    function combo_jekel(){
        $('select[name=jekel]').empty() 
        var html = '';
        html = '<option value="L">Laki-Laki</option>'+
               '<option value="P">Perempuan</option>';
        $('select[name=jekel]').append(html)

    }

    /* == AJAX COMBO Tahun == */

    function combo_tahun(){
        $.ajax({
        type : 'GET',
        url  : "{{ route('combo.tahun') }}",
        async : false,
        dataType : 'JSON',
        success : function(data){

            var html = '';
            var i;
            $('select[name=tahun]').empty()
            for(i=0; i<data.length; i++){
                var html = '';
                html = '<option value='+(data[i].tahun_id)+'>'+(data[i].tahun_nama)+'</option>';
                $('select[name=tahun]').append(html)
            }
        }
    });
}

    /* == AJAX COMBO Tahun Masuk== */

    function combo_filter_tahun(){
        $.ajax({
        type : 'GET',
        url  : "{{ route('combo.tahun') }}",
        async : false,
        dataType : 'JSON',
        success : function(data){

            var html = '';
            var i;
            $('select[name=filter_tahun]').empty()
            for(i=0; i<data.length; i++){
                var html = '';
                html = '<option value='+(data[i].tahun_id)+'>'+(data[i].tahun_nama)+'</option>';
                $('select[name=filter_tahun]').append(html)
            }
        }
    });
}

</script>
@endsection

