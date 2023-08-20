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
                        <h5><i class="mdi mdi-certificate"></i> KUANTITATIF </h5>
                    </div>
                </div>    
            </div>

            <div class="card-header header_add">
                <div class="row">
                    <div class="col-md-6">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary waves-effect waves-light btn-xs" id="btn_add" data-toggle="modal" data-target=".modal-default"><i class="mdi mdi-plus-circle-outline"></i> BARU</button>
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
                            <th style="text-align: center">KETERANGAN NILAI</th>
                            <th style="text-align: center">NILAI BOBOT</th>
                            <th style="text-align: center">KRITERIA</th>
                            <th style="text-align: center">PERIODE</th>
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
                <h5 class="modal-title mt-0"><i class="mdi mdi-plus-circle-outline"></i> Kuantitatif</h5>
            </div>

            <div class="modal-body">

                {!! csrf_field() !!}
    
                <div class="row">

                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Periode</label>
                            <select type="text" class="form-control custom-select select2" style="width: 100%;" name="periode" id="periode" onchange="showPeriode(this)"></select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kriteria</label>
                            <select type="text" class="form-control custom-select select2" style="width: 100%;" name="kriteria" id="kriteria"></select>
                        </div>
                    </div>
    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Sub Kriteria</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" >
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nilai Kuantitatif</label>
                            <input type="text" class="form-control" name="nilai" id="nilai">
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
                        <h5 class="modal-title mt-0"><i class="fas fa-pencil-alt"></i> Kantitatif </h5>
                    </div>

                    <div class="modal-body">

                        {!! csrf_field() !!}
            
                        <div class="row">

                            <input type="hidden" name="id_edit" id="id_edit" readonly="readonly">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keterangn Nilai</label>
                                    <input type="text" class="form-control" name="keterangan_edit" id="keterangan_edit" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nilai Bobot</label>
                                    <input type="text" class="form-control" name="nilai_edit" id="nilai_edit">
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Periode</label>
                                    <select class="form-control custom-select select2" style="width: 100%;" name="periode" id="periode_edit"></select>
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kriteria</label>
                                    <select class="form-control custom-select select2" style="width: 100%;" name="kriteria" id="kriteria_edit"></select>
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
            url: "{{ route('kuantitatif.view') }}",
            dataType: 'JSON',
            async: true,
            data:{filter_periode:filter_periode},
            success: function(result) {
                
                $('#datatable').DataTable().destroy();
                $('#tabel_data').empty();

                var i;
                data = result.data;
                
                if (data.length) {
                    for (i = 0; i < data.length; i++) {

                        if((data[i].nilai_aktif) == 'Y'){
                            var tr = $('<tr>').append([
                                $('<td width="10%" align="center">'),
                                $('<td width="25%">'),
                                $('<td width="10%">'),
                                $('<td width="25%">'),
                                $('<td width="25%">'),
                                $('<td width="30%" align="center">')
                            ]);
                        } else {
                            var tr = $('<tr>').append([
                                $('<td width="10%" align="center">'),
                                $('<td width="25%">'),
                                $('<td width="10%">'),
                                $('<td width="25%">'),
                                $('<td width="25%">'),
                                $('<td width="30%" align="center">')
                            ]);
                        }

                        tr.find('td:nth-child(1)').html((i + 1));

                        tr.find('td:nth-child(2)').append($('<div>')
                            .html((data[i].nilai_ket)));

                        tr.find('td:nth-child(3)').append($('<div>')
                        .html((data[i].nilai_bobot)));

                        tr.find('td:nth-child(4)').append($('<div>')
                        .html((data[i].kriteria_nama)));

                        tr.find('td:nth-child(5)').append($('<div>')
                        .html((data[i].periode_nama)));

                        tr.find('td:nth-child(6)').append('<div class="btn-group"><a href="javascript:;" class="btn btn-soft-warning btn-xs item_edit" data="'+data[i].kua_id+'"><i class="fas fa-pencil-alt"></i></a><a href="javascript:;" class="btn btn-soft-danger btn-xs item_delete" data="' + data[i].kua_id + '"><i class="far fa-trash-alt"></i></a></div>');

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
            // combo_kriteria(),
            combo_periode()
        
        )
        .done(function(){

            var filter_periode = $('#periode').val();
            combo_filter_kriteria(filter_periode);
            
            $('#keterangan').val("");
            $('#nilai').val("");

            $('#formModalAdd').modal('show');
        })

    });

    function showPeriode(select){
        var filter_periode=$('#periode').val();
        combo_filter_kriteria(filter_periode);
    }

    /* == AJAX SIMPAN DATA == */

    $('#btn_save').on('click', function(){

    if (!$('#keterangan').val()) {
        $.toast({
        text: 'KETERANGAN HARUS DI ISI ',
        position: 'top_right',
        loaderBg: '#fff716',
        icon: 'error',
        hideAfter: 3000
    });
    $('#keterangan').focus();
    return false;

    } else if (!$('#nilai').val()) {
         $.toast({
            text: 'NILAI HARUS DI ISI ',
            position: 'top_right',
            loaderBg: '#fff716',
            icon: 'error',
            hideAfter: 3000
        });
    $('#nilai').focus();
    return false;

    } else if (!$('#kriteria').val()) {
        $.toast({
            text: 'KRITERIA HARUS DI ISI ',
            position: 'top_right',
            loaderBg: '#fff716',
            icon: 'error',
            hideAfter: 3000
        });
    $('#kriteria').focus();
    return false;

    }


    var keterangan = $('#keterangan').val();
    var nilai = $('#nilai').val();
    var kriteria = $('#kriteria').val();
    var token = $('[name=_token]').val();

    var formData = new FormData();
    formData.append('keterangan', keterangan);
    formData.append('nilai', nilai);
    formData.append('kriteria', kriteria);
    formData.append('_token', token);

    $.ajax({
    type: "POST",
    url: "{{ route('kuantitatif.save') }}",
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
                combo_kriteria()
            )
            .done(function(){

                $.ajax({
                    type: "GET",
                    url: "{{ route('kuantitatif.edit') }}",
                    dataType: "JSON",
                    data: {id:id},
                    success: function(data){

                        $('#formModalEdit').modal('show');
                        $('#formModalEdit').find('[name="id_edit"]').val(data.kua_id);
                        $('#formModalEdit').find('[name="keterangan_edit"]').val(data.nilai_ket);
                        $('#formModalEdit').find('[name="nilai_edit"]').val(data.nilai_bobot);
                        $('#formModalEdit').find('[name="kriteria"]').val(data.kriteria_id).trigger("change");
                    }
                });
            });
            return false;
    });

    /*==AJAX UPDATE DATA == */


    $('#btn_update').on('click', function(){

    if (!$("#keterangan_edit").val()){
        $.toast({
        text : 'KETERANGAN HARUS DI ISI',
        position: 'top-right',
        loaderBg: 'fff716',
        icon: 'error',
        hideAfter: 3000
    });
    $("#keterangan_edit").focus();
    return false;
    } else if (!$("#nilai_edit").val()){
        $.toast({
        text : 'NILAI HARUS DI ISI',
        position: 'top-right',
        loaderBg: 'fff716',
        icon: 'error',
        hideAfter: 3000
    });
    $("#nilai_edit").focus();
    return false;
    }else if (!$("#kriteria_edit").val()){
        $.toast({
        text : 'KRITERIA HARUS DI ISI',
        position: 'top-right',
        loaderBg: 'fff716',
        icon: 'error',
        hideAfter: 3000
    });
    $("#kriteria_edit").focus();
    return false;
    }

    var id = $('#id_edit').val();;
    var keterangan = $('#keterangan_edit').val();
    var nilai = $('#nilai_edit').val();
    var kriteria = $('#kriteria_edit').val();
    var token = $('[name=_token]').val();

    var formData = new FormData();
    formData.append('id',id);
    formData.append('keterangan',keterangan);
    formData.append('nilai',nilai);
    formData.append('kriteria',kriteria);
    formData.append('_token',token);

    $.ajax({
    type : "POST",
    url : "{{ route('kuantitatif.update')}}",
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
            url : "{{ route('kuantitatif.delete') }}",
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

    /* == AJAX COMBO Kriteria == */

    function combo_kriteria(){
        $.ajax({
            type : 'GET',
            url  : "{{ route('combo.kriteria') }}",
            async : false,
            dataType : 'JSON',
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

    /* == AJAX COMBO Kriteria == */

    function combo_filter_kriteria(filter_periode){
        $.ajax({
            type : 'GET',
            url  : "{{ route('combo.filter_kriteria') }}",
            async : false,
            dataType : 'JSON',
            data : {filter_periode:filter_periode},
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

