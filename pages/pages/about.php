<?php 
    $title = "About Us"; 
    include 'base.php';
    
?>

    <body>
        <div class="w-11/12 md:w-4/5 m-auto mt-20 md:flex justify-evenly">

            <?php
                $query = "SELECT * FROM About ORDER BY id DESC";
                $result = mysqli_query($conn, $query);
                $num = mysqli_num_rows($result);

                if ($num > 0){
                    
                    while($row = mysqli_fetch_array($result)){
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $sin = $row['sin'];
                        $program = $row['program'];
                        $img_url = $row['img_url'];

                        $name = "$fname $lname";
                        ?>
                            <div class="text-center bg-white rounded-md pb-4 m-auto divimg my-2 shadow-md w-full md:w-64">
                                <div class="overflow-hidden h-64 rounded-md">
                                    <img
                                        src=<?php echo $img_url?>
                                        
                                        class="w-full hover:scale-110 duration-500 hover:duration-500"
                                    />
                                </div>
                                <p class="block pt-6 text-lg font-semibold text-gray-800"><?php echo $name ?></p>
                                <p class="block text-[14px] text-sky-600 font-semibold"><?php echo $sin ?></p>
                                <p class="block pt-3 text-gray-800"><?php echo $program ?></p>
                            </div>
                        <?php
                    }

                }else{
                    echo "No details to display";
                }
            ?>

        </div>

        <script>
            let about = document.getElementById("about")
            about.classList.add("bg-sky-200")
        </script>
        <script src="../JavaScript/toggle.js"></script>
        <script src="../JavaScript/header.js"></script>
    </body>
</html>