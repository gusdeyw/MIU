<?php
include "db_connect.php";
$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Drag Drop</title>
</head>

<body>
    <div class="m-6 ">
        <form action="edit_data.php" method="post" enctype="multipart/form-data">
            <h2 class="text-xl font-bold text-center mb-6">Update Image</h2>
            <div class="mb-6">
                <?php
                $sql = "SELECT * FROM property_list where id_property = '" . $id . "' ";
                $property = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($property)) {
                    $name = $row['name'];
                    $oldImage = $row['images'];
                }
                ?>
                <label class="text-lg font-semibold">Input Image :</label>
                <input type="file" name="image[]" class="flex" multiple>
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="hidden" name="name" value="<?php echo $name ?>">
                <input type="hidden" name="oldImage" value="<?php echo $oldImage ?>">
                <input type="submit" name="update" id="update" class="mt-2 p-2 bg-blue-600 rounded-lg text-white" value="Update">
            </div>



        </form>
    </div>
    <hr>
    <div class="m-6">
        <ul id="sortable" class="grid grid-cols-4 gap-6 ">
            <?php

            $property = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($property)) {
                $name = $row['name'];
                $images = $row['images'];
                $array_image = explode(', ', $row['images']);
                foreach ($array_image as $key => $img) {

            ?>

                    <li class="ui-state-default relative" data-id="<?php echo $id ?>">
                        <img src="<?php echo $img ?>" id="image_link" class="image_link rounded-2xl h-56 w-full hidden" data-key="<?php echo $key ?>" />
                        <div class=" h-56 rounded-2xl bg-center bg-cover mx-auto" style="background-image: url('<?php echo $img ?>');"></div>
                        <a href="delete_image.php?id=<?php echo $id ?>&img=<?php echo $img ?>">
                            <button id="delete" class="px-2 py-2 bg-red-600 text-white font-medium text-xs uppercase rounded-full shadow-md hover:bg-red-700 hover:shadow-lg absolute top-0 right-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m-15 0l15 15" />
                                </svg>
                            </button>
                        </a>
                    </li>
            <?php
                }
            }
            ?>
        </ul>

        <div>
            <a href="index.php" type='button' id='back' class="bg-gray-500 mt-6 p-2 rounded-lg">Back</a>
            <button type='submit' value='Submit' id='submit' class="bg-blue-600 mt-6 p-2 rounded-lg">Submit</button>
        </div>

        <p id="notif"></p>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        $(document).ready(function() {
            $("#sortable").sortable();

            $("#submit").on('click', function() {
                var images_arr = [];
                $(".image_link").each(function() {
                    var image = $(this).attr("src");
                    images_arr.push(image);

                });
                var id_image = 0;
                $("#sortable li").each(function() {
                    id_image = $(this).attr("data-id");
                });

                // var allImage = images_arr.toString();
                // console.log(images_arr);
                var allimage = [];
                $.each(images_arr, function(idx, val) {
                    var str = val;
                    allimage.push(str);
                });
                var imagetostr = allimage.join(", ");
                console.log(imagetostr);

                $.ajax({
                    type: "POST",
                    url: "update_image.php",
                    data: {
                        image: imagetostr,
                        id: id_image
                    },
                    success: function(response) {
                        // document.getElementById("notif").innerHTML = response;
                        alert(response);
                    },
                    error: function() {
                        alert("error");
                    }
                });
            });

            $("#delete").on("click", function() {
                // $('img').eq(0).removeAttr('src');

                key = $(".image_link").attr("data-key");
                console.log(key);
                // var theRowId = $('#image_link:eq('+key+')').attr('src');
                // console.log(theRowId);
                // var key = 0;
                // $("#sortable li").each(function(){
                //     key = $(this).attr("data-key");

                //     var theRowId = $('#image_link:eq('+key+')').attr('src');
                //     $('#image_link#'+theRowId).remove();
                //     $('#image_link[data-key="'+key+'"]').remove();
                //     console.log(theRowId);
                // });

            });

            // function deleteImage(e) {
            //     // $('#image_link').removeAttr('src');
            //     var element = e;
            //     element.removeAttr('src'); 
            // }
        });
    </script>
</body>

</html>