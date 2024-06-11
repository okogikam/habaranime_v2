<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>Daftar User
                    <button class="addUser btn btn-sm btn-primary">Add User</button>
                </h3>
            </div>
            <div class="card-body">
                <table class="table tabel">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php displayTabelUser(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>