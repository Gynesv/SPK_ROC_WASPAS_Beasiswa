<div class="row">
    <div class="col-12">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5><i class="mdi mdi-account-group text-danger"></i> MAHASISWA</h5>
                    </div>
                </div>    
            </div>

            <div class="card-header header_add">
                <div class="row">
                    <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-primary waves-effect waves-light btn-xs" data-toggle="modal" data-target=".modal-default"><i class="mdi mdi-plus-circle-outline"></i> BARU</button>
                            <a href="#" class="btn btn-purple waves-effect waves-light btn-xs btn_print" target="_blank"><i class="mdi mdi-printer"></i> CETAK</a>
                            <a href="#" class="btn btn-success waves-effect waves-light btn-xs btn_excel" target="_blank"><i class="mdi mdi-file-excel-box"></i> EXCEL</a>
                        
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
                            <th style="text-align: center">JEKEL</th>
                            <th style="text-align: center">PROGRAM STUDI</th>
                            <th style="text-align: center">TAHUN MASUK</th>
                            <th style="text-align: center">CARA MASUK</th>
                            <th style="text-align: center">ASAL</th>
                            <th style="text-align: center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center">1</th>
                            <td>Mahasiswa 1</th>
                            <td style="text-align: center">Laki-Laki</th>
                            <td>Sistem Informasi</th>
                            <td style="text-align: center">2022/2023</th>
                            <td style="text-align: center">Mandiri</th>
                            <td>SMAN 3 Padang</th>
                            <td style="text-align: center"><div class="btn-group"><a href="#" class="btn btn-soft-warning btn-xs"><i class="fas fa-pencil-alt"></i></a><a href="#" class="btn btn-soft-info btn-xs"><i class="mdi mdi-check"></i></a><a href="#" class="btn btn-soft-danger btn-xs"><i class="mdi mdi-window-close"></i></a></div></th>
                        </tr>

                        <tr>
                            <td style="text-align: center">1</th>
                            <td>Mahasiswa 2</th>
                            <td style="text-align: center">Perempuan</th>
                            <td>Sistem Informasi</th>
                            <td style="text-align: center">2022/2023</th>
                            <td style="text-align: center">Mandiri</th>
                            <td>MAN 2 Padang</th>
                            <td style="text-align: center"><div class="btn-group"><a href="#" class="btn btn-soft-warning btn-xs"><i class="fas fa-pencil-alt"></i></a><a href="#" class="btn btn-soft-info btn-xs"><i class="mdi mdi-check"></i></a><a href="#" class="btn btn-soft-danger btn-xs"><i class="mdi mdi-window-close"></i></a></div></th>
                        </tr>
                    </tbody>
                </table>
                        

            </div>
        </div>
    </div>                     
</div>

<div class="modal modal-default fade">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #ffffff">

            <div class="modal-header">
                <h5 class="modal-title mt-0"><i class="mdi mdi-plus-circle-outline"></i> Form</h5>
            </div>

            <div class="modal-body">
    
                <div class="row">
    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>NIM</label>
                            <input type="text" class="form-control" name="nim" id="nim">
                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control custom-select select2"  style="width: 100%;" name="jekel" id="jekel">
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>

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
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control" name="lahir_tmp" id="lahir_tmp">
                        </div>
                    </div> 
    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" class="form-control" name="lahir_tgl" id="lahir_tgl">
                        </div>
                    </div> 
    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. KTP [NIK]</label>
                            <input type="text" class="form-control" name="nik" id="nik" maxlength="16" onkeypress="return angka(this, event)">
                        </div>
                    </div> 
    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No. HP</label>
                            <input type="text" class="form-control" name="hp" id="hp" maxlength="13" onkeypress="return angka(this, event)">
                        </div>
                    </div> 
    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" name="alamat" id="alamat"></textarea>
                        </div>
                    </div> 
    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tahun Akademik</label>
                            <select class="form-control custom-select select2"  style="width: 100%;" name="tahun" id="tahun">
                                <option value="2022">2022/2023</option>
                                <option value="2021">2021/2022</option>
                            </select>

                        </div>
                    </div> 

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Cara Masuk</label>
                            <select class="form-control custom-select select2"  style="width: 100%;" name="cara" id="cara"></select>
                        </div>
                    </div>
    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Asal Sekolah</label>
                            <select class="form-control custom-select select2"  style="width: 100%;" name="sekolah" id="sekolah"></select>
                        </div>
                    </div> 

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Program Studi</label>
                            <select class="form-control custom-select select2"  style="width: 100%;" name="prodi" id="prodi">
                                <option value="SI">Sistem Informasi</option>
                                <option value="TI">Teknik Informatika</option>
                            </select>
            
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