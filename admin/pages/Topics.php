<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 card p-2 mb-3">
                <div class="row">
                    <div class="col-8 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Add Topic</span>
                        </div>
                        <input type="text" class="form-control" name="tag">
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
                                    <th>Topik</th>
                                    <th>Post</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody class="tag-list">
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
    let tagList = document.querySelector(".tag-list");
    tabelTag();

    async function tabelTag(){
        let result = await fetch("./api/tag_api.php");
        let dataTag = await result.json();

        Object.keys(dataTag).forEach(i=>{
            if(i != ""){
                let tr = document.createElement("tr");
                tr.innerHTML = `
                <td>${i}</td>
                <td>${displayAngka(dataTag[i]['post'])}</td>
                <td>${displayAngka(dataTag[i]['view'])}</td>`
    
                tagList.appendChild(tr);
            }
        })
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