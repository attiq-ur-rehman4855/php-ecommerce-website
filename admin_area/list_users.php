<style>
    .profile_img {
        width: 50px;
        height: 50px;
        object-fit: contain;
    }
</style>
<h3 class="text-center text-success">All Users</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-info">
        <?php
        $get_users = "select * from `user_table`";
        $result_users = mysqli_query($con, $get_users);
        $row_count = mysqli_num_rows($result_users);
        echo "<tr class='text-center'>
                <th>SI no</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Image</th>
                <th>User Address</th>
                <th>User Mobile No.</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class='bg-secondary text-light'>";
        if ($row_count == 0) {
            echo "<h2 class='text-danger text-center mt-5'>No users found!</h2>";
        } else {
            $number = 0;
            while ($row = mysqli_fetch_assoc($result_users)) {
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_password = $row['user_password'];
                $user_address = $row['user_address'];
                $user_mobile = $row['user_mobile'];
                $number++;
                echo "<tr class='text-center'>
                        <td> $number </td>
                        <td> $user_name </td>
                        <td> $user_email </td>
                        <td><img src='../users_area/users_images/$user_image' class='profile_img' alt='$user_name'></td>
                        <td> $user_address </td>
                        <td> $user_mobile </td>
                        <td><a href='index.php?delete_users=$user_id' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
                    </tr>";
            }
        }
        ?>





        </tbody>
</table>