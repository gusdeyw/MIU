<?php
include "db_connect.php";
// $query = "SELECT * FROM property_list";
// $result = mysqli_query($koneksi, $query);

// $multiple_image = [];
// while ($row = mysqli_fetch_array($result))  {
//     $multiple_image = $row['images'];
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Multiple Upload</title>

</head>
<body>
    <div class="">
        <form action="image_upload.php" enctype="multipart/form-data" method="POST">
        <div class="p-4">
        <label>
            Nama Property
        </label> <br>
        <input type="text" name="name" class="border-solid border-gray-500 border-2">
        </div>
        <div class="p-4">
        <label>
            Masukkan gambar
        </label> <br>
        <input type="file" name="image[]" multiple>
        </div>
        <input type="submit" name="submit" value="Submit" class="bg-gray-500 m-4 p-2">

        </form>

        <div class="m-4 ">
            
            <table id="table_id" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $fetch_images = mysqli_query($con,"SELECT * FROM property_list");
                        
                        foreach($fetch_images as $row){
                            $id = $row['id_property'];
                            $name = $row['name'];
                            $images = $row['images'];
                    
                    echo '<tr>
                            <td>'.$id.'</td>
                            <td>'.$name.'</td>
                            <td>
                                <a href="drag_drop.php?id='.$id.'" class = "text-blue-700">Detail</a>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    

    <script>
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
    </script>

    

    
    <script src="cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"></script>
</body>
</html>