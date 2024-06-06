<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card col-12">
                <div class="card-body">
                    <form action="#" id="form_gambar" enctype="multipart/form-data">
                        <label for="gambar_upload">Upload Image <button type="button" class="btn btn-sm btn-primary">Upload</button></label>
                        <span class="status"></span>
                        <div class="row">
                            <div class="col-4 input-group ">
                                <input type="text" name="tag" class="form-control" placeholder="Tag">  
                            </div>
                            <div class="col-4 input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">From File</span>
                                </div>
                                <input type="file" name="gambar" id="gambar_upload" class="form-control">                                
                            </div>
                            <div class="col-4 input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">From URL</span>
                                </div>
                                <input type="text" name="gambarUrl" class="form-control" placeholder="Url">                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <?php displayTagImage(); ?>
        </div>
        <div class="row" id="image-list" data-masonry='{"percentPosition": true }' >    
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
<script>
    let btn = document.querySelector("label[for='gambar_upload']");
    let file = document.querySelector("#form_gambar");
    let status = document.querySelector(".status");
    let gambarList = document.querySelector('#gambar-list');

    btn.addEventListener("click",()=>{
        status.innerHTML = "<i class='fa-solid fa-spinner fa-spin'></i>";
        uploadImg();
    })

    async function uploadImg(){        
        let dataForm = new FormData(file);
        try{
            const respons = await fetch("./api/upload_img.php",{
                method: "POST",
                body: dataForm
            })
            result = await respons.json();
            console.log(result);
            if(result.status > 0){
                status.innerHTML = `<i class='fa-solid fa-check'></i> Berhasil disimpan`;
            }else{
                status.innerHTML = `<i class='fa-solid fa-circle-exclamation'></i> Gagal disimpan : ${result.pesan}`;
            }
        } catch(e){
            status.innerHTML = `<i class='fa-solid fa-circle-exclamation'></i> Gagal disimpan: ${e}`;
            console.error(e)
        }
    }
</script>
<script>
    let btnTag = document.querySelectorAll('.filter');
    let imageList = document.querySelector('#image-list');
    let content = document.querySelector(".content");

    btnTag.forEach((btn)=>{
        btn.addEventListener('click',()=>{
            displayTag(btn.outerText);
        })
    })

    function displayTag(tag){
        imageList.innerHTML = "";
        displayImage(tag);   
    }
    async function displayImage(tag){
        if(tag == "All"){
            tag = ""
        }
        let dataImg = await fetch(`./api/upload_img.php?tag=${tag}`);
        let result = await dataImg.json();
        if(result.status > 0){
            Object.values(result.pesan).forEach((img)=>{
                let div = document.createElement("div");
                div.setAttribute("class","col-1 card m-1 p-0 gambar-item");
                div.innerHTML = `<img src='${img.gambar}' alt='${img.tag}'>`;
                div.addEventListener('click',()=>{
                    displayOneImgage(img)
                })
                imageList.appendChild(div);
                let msnry = new Masonry(imageList);
            })
        }
    }
    async function displayOneImgage(img){
        let div = document.createElement('div');
        div.classList.add("modal-img");
        div.innerHTML = `
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6"><img src="${img.gambar}" alt="${img.tag}"></div>
                        <div class="col-6">
                            <label>Link Gambar</label>
                           <input name="gambar" class="form-control" type="text" value="${img.gambar}">
                           <label>Tag Gambar</label>
                           <input name="tag" class="form-control" type="text" value="${img.tag}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary delete">Delete</button>
                    <button type="button" class="btn btn-primary save">Save changes</button>
                </div>
                </div>
            </div>
        `
        div.querySelector(".close").addEventListener("click",()=>{
            div.remove();
        })
        div.querySelector(".delete").addEventListener("click",()=>{
            imageDelete({
                element: div,
                image: img
            })
        })
        div.querySelector(".save").addEventListener("click",()=>{
            imageUpdate({
                element: div,
                image: img
            });
        })

        content.appendChild(div);
    }

    async function imageUpdate(el){
        let status = el.element.querySelector(".modal-title");
        status.innerHTML = "<i class='fa-solid fa-spinner fa-spin'></i>";
        let dataUpdate = new FormData();
        dataUpdate.append("update","true");
        dataUpdate.append("no",el.image.no);
        dataUpdate.append("gambar",el.element.querySelector("input[name='gambar']").value);
        dataUpdate.append("topik",el.element.querySelector("input[name='tag']").value);

        let update = await fetch("./api/upload_img.php",{
                method: "POST",
                body: dataUpdate
            })
        let result = await update.json()
        if(result.status > 0){
            displayTag(el.image.tag);
            status.innerHTML = `<i class='fa-solid fa-check'></i> ${result.pesan}`;
        }else{
            status.innerHTML = `<i class='fa-solid fa-circle-exclamation'></i>  ${result.pesan}`;
        }
    }
    async function imageDelete(el){
        let status = el.element.querySelector(".modal-title");
        status.innerHTML = "<i class='fa-solid fa-spinner fa-spin'></i>";
        let dataUpdate = new FormData();
        dataUpdate.append("delete","true");
        dataUpdate.append("no",el.image.no);
        let update = await fetch("./api/upload_img.php",{
                method: "POST",
                body: dataUpdate
            })
        let result = await update.json()
        if(result.status > 0){
            status.innerHTML = `<i class='fa-solid fa-check'></i> ${result.pesan}`;
            displayTag(el.image.tag);
            setTimeout(()=>{
                el.element.remove();
            },500)
        }else{
            status.innerHTML = `<i class='fa-solid fa-circle-exclamation'></i>  ${result.pesan}`;
        }
    }
</script>