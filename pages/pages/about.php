<?php 
    $title = "About Us"; 
    include 'base.php';
    
?>

    <body>
        <div class="w-11/12 md:w-4/5 m-auto mt-20 md:flex justify-evenly">
            <div class="text-center bg-white rounded-md pb-4 m-auto divimg my-2 shadow-md w-full md:w-64">
                <div class="overflow-hidden h-64 rounded-md">
                    <img
                        src="../images/clivet.jpg"
                        
                        class="w-full hover:scale-110 duration-500 hover:duration-500"
                    />
                </div>
                <p class="block pt-6 text-lg font-semibold text-gray-800">Clivet Lungu</p>
                <p class="block text-[14px] text-sky-600 font-semibold">20153390</p>
                <p class="block pt-3 text-gray-800">Computer Engineering</p>
            </div>
        
            <div class="text-center bg-white rounded-md pb-4 m-auto divimg my-2 shadow-md w-full md:w-64">
                <div class="overflow-hidden h-64 rounded-md">
                    <img
                        src="../images/humphrey.jpg"
                        
                        class="w-full hover:scale-110 duration-500 hover:duration-500"
                    />
                </div>
                <p class="block pt-6 text-lg font-semibold text-gray-800">Humphrey Mulenga</p>
                <p class="block text-[14px] text-sky-600 font-semibold">20154618</p>
                <p class="block pt-3 text-gray-800">Computer Engineering</p>
            </div>
        </div>

        <script>
            let about = document.getElementById("about")
            about.classList.add("bg-sky-200")
        </script>
        <script src="../JavaScript/toggle.js"></script>
        <script src="../JavaScript/header.js"></script>
    </body>
</html>