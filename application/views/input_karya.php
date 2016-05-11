<style type="text/css">
  #jurusan, #kategori_karya, #jenis_karya{
    color: black;
  }  
</style>

<?php echo form_open_multipart('index.php/site/create'); ?>
  <div class="row" style="color: white; font-weight: bolder; margin-top: 6%;:">
    <div class="col-md-4 col-md-offset-4">
    <h1><strong>Form Karya</strong></h1>
        <div class="form-group">
          <label for="nama">Nama</label>
          <input id="nama" class="form-control" type="text" name="nama"/><br/>
        </div>

        <div class="form-group">
          <label for="jurusan" id="jurusan"  style="color: white ;">Jurusan</label><br/>
          <select name="jurusan" class="form-control">
              <option value="Pilih Jurusan"></option>
              <option value="Komputer Akuntansi (D3)">Komputer Akuntansi (D3)</option>
              <option value="Manajemen Infromatika (D3)">Manajemen Infromatika (D3)</option>  
              <option value="Sistem Informasi (S1 Reguler)">Sistem Informasi (S1 Reguler)</option>
              <option value="Sistem Informasi (S1 Profesional)">Sistem Informasi (S1 Profesional)</option>
              <option value="Sistem Informasi (S1 Bilingual)">Sistem Informasi (S1 Bilingual)</option>
              <option value="Teknik Komputasi dan Jaringan (TKJ) (D3)">Teknik Komputasi dan Jaringan (TKJ) (D3)</option>
              <option value="Teknik Komputer (D3)">Teknik Komputer (D3)</option>
              <option value="Sistem Komputer (S1 Reguler)">Sistem Komputer (S1 Reguler)</option>
              <option value="Sistem Komputer (S1 Profesional)">Sistem Komputer (S1 Profesional)</option>            
              <option value="Teknik Informatika (S1 Reguler)">Teknik Informatika (S1 Reguler)</option>
              <option value="Teknik Informatika (S1 Bilingual)">Teknik Informatika (S1 Bilingual)</option>
              <option value="Lainnya">Lainnya</option>
          </select>
        </div><br/>

        <div class="form-group">
          <label for="nama_karya">Nama Karya</label>
          <input id="nama_karya" class="form-control" type="text" name="nama_karya"></input>
        </div><br/>

        <div class="form-group">
          <label for="kategori_karya" id="kategori_karya" style="color: white ;">Kategori Karya</label><br/>
          <select name="kategori_karya" class="form-control">
              <option value="Pilih Kategori Karya"></option>
              <option value="Akademik">Akademik</option>
              <option value="Nonakademik">Nonakademik</option>
          </select>
        </div><br/>

        <div class="form-group">
          <label for="jenis_karya" id="jenis_karya" style="color: white ;">Jenis Karya</label><br/>
          <select name="jenis_karya" class="form-control">
              <option value="Pilih Jenis Karya"></option>
              <option value="Apps">Sofeware</option>
              <option value="Hardware">Hardware</option>
              <option value="Lainnya">Lainnya</option>
          </select>
        </div><br/>

        <div class="form-group">
        <label for="img_karya" id="img_karya">Upload Gambar</label>
        <?php 
          echo form_upload('userfile');
        ?><br/>
        <p style="color: red;">Gunakan gambar berukuran (1024 x 700) pixels.</p>
        </div><br/>

        <div class="form-group">
          <label for="url_karya">URL Karya</label>
          <input id="url_karya" class="form-control" type="text" name="url_karya"></input>
        </div><br/>

        <div class="form-group">
          <label for="detail_karya">Deskripsi Karya</label>
          <textarea class="form-control" name="detail_karya" rows="7" cols="10"></textarea>
        </div><br/>

        <div class="row">
            <div class="col-md-1">
              <input type="submit" value="Insert" class="btn btn-success">
            </div>
        </div><br/>
    </div>
  </div>
<?php echo form_close(); ?>
