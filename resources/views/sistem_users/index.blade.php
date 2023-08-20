@extends('layouts.template')

@section('css')
    <!-- JIKA ADA PENAMBAHAN CODE CSS LETAKKAN DISINI -->
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5><i class="mdi mdi-account-multiple-outline"></i> MANAJEMEN USERS</h5>
                    </div>
                </div>    
            </div>

            <div class="card-header header_add">
                <div class="row">
                    <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary waves-effect waves-light btn-xs" id="btn_add" data-toggle="modal" data-target=".modal-default"><i class="mdi mdi-plus-circle-outline"></i> BARU</button>
                        
                        </div>
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
                            <th style="text-align: center">USERNAME</th>
                            <th style="text-align: center">EMAIl</th>
                            <th style="text-align: center">LEVEL</th>
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
                <h5 class="modal-title mt-0"><i class="mdi mdi-plus-circle-outline"></i> Form</h5>
            </div>

            <div class="modal-body">
    
                <div class="row">
    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama">
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" id="username">
                        </div>
                    </div> 
    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" id="email">
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control custom-select select2"  style="width: 100%;" name="level" id="level">
                            </select>
                        </div>
                    </div> 
    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" id="password">
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
                <h5 class="modal-title mt-0"><i class="fas fa-pencil-alt"></i> Manajemen Users</h5>
            </div>

            <div class="modal-body">

                {!! csrf_field() !!}
    
                <div class="row">

                    <input type="hidden" name="id_edit" id="id_edit" readonly="readonly">
    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama_edit" id="nama_edit" readonly="readonly">
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username_edit" id="username_edit" readonly="readonly">
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email_edit" id="email_edit" readonly="readonly">
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Level</label>
                            <select class="form-control" name="level" id="level_edit" readonly="readonly"></select>
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password_edit" id="password_edit">
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
        $('.select2').select2();
        view();
    });

    /* == AJAX TAMPILKAN DATA == */

    function view() {

        $.ajax({
            type: 'GET',
            url: "{{ route('users.view') }}",
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
                            $('<td width="10%" align="center">'),
                            $('<td width="30%">'),
                            $('<td width="30%">'),
                            $('<td width="30%">'),
                            $('<td width="30%">'),
                            $('<td width="10%" align="center">')
                        ]);

                        tr.find('td:nth-child(1)').html((i + 1));

                        tr.find('td:nth-child(2)').append($('<div>')
                            .html((data[i].name)));

                        tr.find('td:nth-child(3)').append($('<div>')
                            .html((data[i].username)));

                        tr.find('td:nth-child(4)').append($('<div>')
                            .html((data[i].email)));

                        tr.find('td:nth-child(5)').append($('<div>')
                            .html((data[i].level)));

                        tr.find('td:nth-child(6)').append('<div class="btn-group"></a><a href="javascript:;" class="btn btn-soft-warning btn-xs item_edit" data="'+data[i].id+'"><i class="fas fa-pencil-alt"></i></a><a href="javascript:;" class="btn btn-soft-danger btn-xs item_delete" data="' + data[i].id + '"><i class="far fa-trash-alt"></i></a></div>');

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

        $.when(
            combo_level()
        )
        .done(function(){
            $('#nama').val("");
            $('#username').val("");
            $('#email').val("");
            $('#password').val("");
            $('#formModalAdd').modal('show');

        })

    });


        /* == AJAX SIMPAN DATA == */

    $('#btn_save').on('click', function(){

        if (!$("#nama").val()) {
            $.toast({
                text: 'NAMA HARUS DI ISI',
                position: 'top-right',
                loaderBg: '#fff716',
                icon: 'error',
                hideAfter: 3000
            });
            $("#nama").focus();
            return false;

        } else if (!$("#username").val()) {
            $.toast({
                text: 'USERNAME HARUS DI ISI',
                position: 'top-right',
                loaderBg: '#fff716',
                icon: 'error',
                hideAfter: 3000
            });
            $("#username").focus();
            return false;

        } else if (!$("#email").val()) {
            $.toast({
                text: 'EMAIL LAHIR HARUS DI ISI',
                position: 'top-right',
                loaderBg: '#fff716',
                icon: 'error',
                hideAfter: 3000
            });
            $("#email").focus();
            return false;

        } else if (!$("#password").val()) {
            $.toast({
                text: 'PASSWORD LAHIR HARUS DI ISI',
                position: 'top-right',
                loaderBg: '#fff716',
                icon: 'error',
                hideAfter: 3000
            });
            $("#passwrord").focus();
            return false;

        } 

        var nama = $('#nama').val();
        var username = $('#username').val();
        var email = $('#email').val();
        var level = $('#level').val();
        var password = $('#password').val();
        var token = $('[name=_token]').val();

        var formData = new FormData();
        formData.append('nama', nama);
        formData.append('username', username);
        formData.append('email', email);
        formData.append('level', level);
        formData.append('password', password);
        formData.append('_token', token);

        $.ajax({
            type: "POST",
            url: "{{ route('users.save') }}",
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

        $.when(
            combo_level()
        )
        .done(function() {
            $.ajax({
                type : "GET",
                url   : "{{ route('users.edit') }}",
                dataType : "JSON",
                data : {id:id},
                success: function(data){

                    $('#formModalEdit').modal('show');
                    $('#formModalEdit').find('[name="id_edit"]').val(data.id);
                    $('#formModalEdit').find('[name="nama_edit"]').val(data.name);
                    $('#formModalEdit').find('[name="username_edit"]').val(data.username);
                    $('#formModalEdit').find('[name="email_edit"]').val(data.email);
                    $('#formModalEdit').find('[name="level"]').val(data.level).trigger("change");

                }
            });
        });
      
        return false;
    });

    $('#btn_update').on('click', function(){


    var id = $('#id_edit').val();
    var password = $('#password_edit').val();
    var token = $('[name=_token]').val();

    var formData = new FormData();
    formData.append('id',id);
    formData.append('password',password);
    formData.append('_token',token);

    $.ajax({
        type : "POST",
        url : "{{ route('users.update')}}",
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

    /* == AJAX COMBO LEVEL == */

    function combo_level(){
    $('select[name=level]').empty()
        var html = '';
        html = '<option value="A">Admin</option>'+
                '<option value="K">Karyawan</option>';
        $('select[name=level]').append(html)
    }


</script>
@endsection