<h3 class="text-center text-success">All brands</h3>
<table class="table table-bordered mt-5">
  <thead class="bg-info">
    <tr class="text-center">
      <th>SIno</th>
      <th>Brands title</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody class="bg-secondary text-light">
    <?php
    $select_brands = "Select * from `brands`";
    $result_brands = mysqli_query($con, $select_brands);
    $number = 0;
    while ($row = mysqli_fetch_assoc($result_brands)) {
      $brands_id = $row['brands_id'];
      $brands_title = $row['brands_title'];
      $number++;

    ?>
      <tr class="text-center">
        <td><?php echo $number ?></td>
        <td><?php echo $brands_title ?></td>
        <td><a href='index.php?edit_brand=<?php echo $brands_id ?>' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
        <td><a href='index.php?delete_brand=<?php echo $brands_id ?>' type="button" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $brands_id; ?>" class='text-light'><i class='fa-solid fa-trash'></i></a></td>
      </tr>

      <!-- Modal -->
      <div class="modal fade" id="deleteModal<?php echo $brands_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <h4>Are you sure you want to delete this?</h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> <a href="index.php?view_brands" class="text-light text-decoration-none">No</a></button>
              <button type="button" class="btn btn-primary"> <a href='index.php?delete_brand=<?php echo $brands_id ?>' class="text-light text-decoration-none">Yes</a></button>
            </div>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </tbody>
</table>