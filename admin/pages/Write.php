<?php
$data_post = array(
    "post_id"=>"",
    "title"=>"",
    "isi"=>"",
    "kategori"=>"",
    "tag"=>"",
    "series"=>"",
    "gambar"=>""
);

if(isset($_GET['id'])){
    $post_id = get_input($_GET['id']);
    $result = openPost($post_id);
    $data_post = array(
        "post_id"=>get_post($result['no']),
        "title"=>get_post($result['judul_artikel']),
        "isi"=>get_post($result['isi']),
        "kategori"=>get_post($result['kategori']),
        "tag"=>get_post($result['tag']),
        "series"=>get_post($result['anime']),
        "gambar"=>get_post($result['gambar'])
    );
}
?>
<section class="content">
    <div class="container-fluid">
    <!-- Info boxes -->
    <form id="form-fill" action="#" method="post" enctype="multipart/form-data">
        <div class="row">
        <div class="col-12 col-md-9">
            <div class="card">
                
            <div class="card-body">
                <div class="input-group mb-3">
                <button class="btn btn-sm mr-1 btn-primary" data-type="publish">
                    Publish
                </button>
                <button class="btn btn-sm mr-1 btn-default" data-type="draft">
                    Draft
                </button>
                <span class="status"></span>
                </div>
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Title</span>
                </div>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Title"
                    name="title"
                    value="<?php echo $data_post['title']; ?>"
                />
                <input
                    type="hidden"
                    class="form-control"
                    value="<?php echo $data_post['post_id']; ?>"
                    name="post_id"
                />
                </div>
                <div class="input-group mb-3">
                <textarea id="summernote" rows="50" style="width: 100%;overflow:auto" name="isi">
                <?php echo $data_post['isi']; ?>
                </textarea>
                </div>
            </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card">
            <div class="card-body">
                <div class="form-group">
                <label for="select1">Kategori</label>
                <select
                    class="custom-select form-control-border"
                    id="select1"
                    multiple="multiple"
                    name="kategori[]"
                >
                
                <?php displayKategori($data_post['kategori']); ?>
                </select>
                </div>
                <div class="form-group">
                <label for="select2">Topics</label>
                <select
                    class="custom-select form-control-border"
                    id="select2"
                    multiple="multiple"
                    name="topik[]"
                >
                
                <?php displaytopik($data_post['tag']); ?>

                </select>
                </div>
                <div class="form-group">
                <label for="select2">Series</label>
                <select
                    class="custom-select form-control-border"
                    id="select3"
                    name="series"
                >
                <?php displayseris($data_post['series']); ?>

                </select>
                </div>
                <div class="form-group">
                <label for="thumbneil">Gambar utama</label>
                <!-- <input name="gambar" type="file" class="mb-3 form-control-border" /> -->
                <input name="url-gambar" type="text" class="mb-3 form-control" placeholder="URL" value="<?php echo $data_post['gambar']; ?>" />
                <div class="privew">
                    <img id="imgPreview" src="<?php echo $data_post['gambar']; ?>" alt="" />
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- /.col -->
        </div>
    </form>
    <!-- /.row -->

    <!-- Main row -->
    <div class="row">
        <!-- /.col -->
    </div>
    <!-- /.row -->
    </div>
    <!--/. container-fluid -->
</section>

<script>
    let btn = document.querySelectorAll('.btn');
    let form = document.querySelector("#form-fill");
    let status = document.querySelector(".status");
    let thumbnell = document.querySelector("input[name='url-gambar']");
    let imgPreview = document.querySelector("#imgPreview");

    thumbnell.addEventListener("change",()=>{
        imgPreview.src = thumbnell.value
    })

    btn.forEach((b) => {
        b.addEventListener("click",(even)=>{
            even.preventDefault();
            status.innerHTML = "<i class='fa-solid fa-spinner fa-spin'></i>";
            if(b.dataset.type === "publish"){
                publish();
            }else{
                draft();
            }
        })
    });

    async function publish(){
        let dataForm = new FormData(form);
        try{
            const respons = await fetch("./api/write_api.php?stat=1",{
                method: "POST",
                body: dataForm
            })
            result = await respons.json();
            console.log(result);
            if(result.status > 0){
                status.innerHTML = "<i class='fa-solid fa-check'></i> Berhasil disimpan";
            }else{
                status.innerHTML = `<i class='fa-solid fa-circle-exclamation'></i> Gagal disimpan : ${status.pesan}`;
            }
        } catch(e){
            status.innerHTML = `<i class='fa-solid fa-circle-exclamation'></i> Gagal disimpan: ${e}`;
            console.error(e)
        }
    }
    async function draft(){
        let dataForm = new FormData(form);
        try{
            const respons = await fetch("./api/write_api.php?stat=0",{
                method: "POST",
                body: dataForm
            })
            result = await respons.json();
            console.log(result);
            if(result.status > 0){
                status.innerHTML = "<i class='fa-solid fa-check'></i> Berhasil disimpan";
            }else{
                status.innerHTML = `<i class='fa-solid fa-circle-exclamation'></i> Gagal disimpan: ${status.pesan}`;
            }
        } catch(e){
            status.innerHTML = `<i class='fa-solid fa-circle-exclamation'></i> Gagal disimpan: ${e}`;
            console.error(e)
        }
    }
</script>