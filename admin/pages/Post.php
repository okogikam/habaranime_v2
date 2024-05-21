<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 m-auto">
          <div class="card">
            <div class="card-body">
              <table class="table tabel" id="tabel1">
                <thead>
                  <tr>
                    <th>Post</th>
                  </tr>
                </thead>
                <tbody>
                <?php tabel_daftar_post(); ?> 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

<script>
    async function konfirmasi(id) {
      var x = confirm("Are you sure you want to delete?");
      if (x){
         try{
           del = await fetch(`./api/delete_api.php?id=${id}`);
           response = await del.json();
           let post = document.querySelector(`.post-${id}`);
           post.setAttribute("style","display:none;");
         } catch(e){
          response = e;
        }
        toogleMessage(response);
        return true;
      }    
      else{
          return false;
      }
      return x; 
    }
</script>
<script>
  function toogleMessage(message){
    let doc = document.querySelector(".content");
    let div = document.createElement("div");
    div.setAttribute("class","col-md-3 pesan-api");
    if(message.status > 0){
      div.innerHTML = `            
      <!-- /.card -->
      <div class="card bg-gradient-success">
        <div class="card-header">
          <h3 class="card-title">Sukses</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          Berhasil Dihapus
        </div>
        <!-- /.card-body -->
      </div>`
    }else{
      div.innerHTML = `            
      <!-- /.card -->
      <div class="card bg-gradient-danger">
        <div class="card-header">
          <h3 class="card-title">Gagal</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          Gagal dihapus <br>
          ${message.pesan}
        </div>
        <!-- /.card-body -->
      </div>`
    }

    div.querySelector(".btn-tool").addEventListener("click",()=>{
      div.remove();
    })
    doc.appendChild(div);
  }
</script>
