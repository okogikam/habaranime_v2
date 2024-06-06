<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 card p-2 mb-3">
                <div class="row">
                    <div class="col-8 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Add Category</span>
                        </div>
                        <input type="text" class="form-control" name="kategori">
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-primary">Upload
                        </button>
                        <span class="status"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Post</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody class="kategori-list">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h3>Chart</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    let kategoriList = document.querySelector(".kategori-list");
    tabelKategori();

    async function tabelKategori(){
        let result = await fetch("./api/kategori_api.php");
        let dataKategori = await result.json();

        Object.keys(dataKategori).forEach(i=>{
            if(i != ""){
                let tr = document.createElement("tr");
                tr.innerHTML = `
                <td>${i}</td>
                <td>${displayAngka(dataKategori[i]['post'])}</td>
                <td>${displayAngka(dataKategori[i]['view'])}</td>`
    
                kategoriList.appendChild(tr);
            }
        })
        window.tabelready = true;
        console.log(window.tabelready);
    }

    function displayAngka(angka){
        if(angka > 1000000){
            let hasil = (angka/1000000).toFixed(2) + "M";
            return hasil;
        }else if(angka > 1000){
            let hasil = (angka/1000).toFixed(2) + "K";
            return hasil;
        }
        return angka;
    }
</script>