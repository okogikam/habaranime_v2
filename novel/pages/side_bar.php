<div class="card">
    <div class="card-header">
        <h5 class="card-title m-0">Project</h5>
    </div>
    <div class="card-body">
        <table class="table table-bover">
            <thead>
                <tr>
                    <th>Series</th>
                    <th class="text-right">Ch</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($data_novel as $novel){
                    $all_series = all_novel_series($novel['judul_artikel'],$conn);
                    if(is_string($all_series )){
                        $all_series = array();
                    }
                ?>
                <tr>
                    <td><a href="?s=page&id=<?php echo get_output($novel['no']); ?>&j=<?php echo get_output($novel['judul_artikel']); ?>"><?php echo get_output($novel['judul_artikel']); ?></a></td>
                    <td class="text-right"><?php echo count($all_series); ?> </td>
                </tr>
                <?php 
                }
                ?>
            </tbody>
        </table>
    </div>
</div>