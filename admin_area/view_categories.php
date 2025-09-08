<h3 class="text-center text-success">All categories</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <tr class="text-center">
            <th>SIno</th>
            <th>Category title</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
        <?php
        $select_category = "SELECT * FROM `categories`";
        $result_category = mysqli_query($con, $select_category);
        $number = 0;
        while ($row = mysqli_fetch_assoc($result_category)) {
            $category_id = $row['category_id'];
            $category_title = $row['category_title'];
            $number++;
        ?>
            <tr class="text-center">
                <td><?php echo $number ?></td>
                <td><?php echo $category_title ?></td>
                <td><a href='index.php?edit_category=<?php echo $category_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td>
                    <a href="index.php?delete_category=<?php echo $category_id ?>" class='text-light' data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $category_id; ?>">
                        <i class='fa-solid fa-trash'></i>
                    </a>
                </td>
            </tr>

            <!-- Modal for each category -->
            <div class="modal fade" id="deleteModal<?php echo $category_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4>Are you sure you want to delete this?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                            <a href='index.php?delete_category=<?php echo $category_id ?>' class="btn btn-primary text-light text-decoration-none">Yes</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </tbody>
</table>
  
