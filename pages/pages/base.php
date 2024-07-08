<?php 
    include "session.php";
    $remarks = isset($_GET['remarks']) ? $_GET['remarks'] :'';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/fa/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../images/th.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="../css/css.js"></script>
    <title><?php echo $title ?></title>
</head>
<body class="md:flex bg-gray-200">
    
    <!-- Desktop view navbar -->
    <nav class="hidden md:block w-[225px] rounded-md fixed h-full bg-white border border-gray-300 shadow-md">

        <div>
            <p class="py-10 px-10 mb-5 text-gray-700 font-bold text-lg border-b border-gray-300 text-slate-800">
                Secure Alert System - (SAS)
            </p>
        </div>
        
        <div class="px-2">
            <p class="w-full rounded-md text-gray-800 hover:bg-sky-100 mb-2"  id="transporter">
                <a href="./" class="block py-3 px-5 w-full">
                    <button class="w-10 text-slate-600">
                        <i class="fa-solid fa-users-line px-2"></i>
                    </button>
                    Transporters
                </a>
            </p>
            <p class="w-full rounded-md text-gray-800 hover:bg-sky-100 mb-2" id="trunks">
                <a href="./trunk.php" class="block py-3 px-5 w-full">
                    <button class="w-10 text-slate-600">
                        <i class="fa-solid fa-box px-2"></i>
                    </button>
                    Trunks
                </a>
            </p>
            <p class="w-full flex items-center text-gray-800 rounded-md hover:bg-sky-100 mb-2" id="transit">
                    <a href="transit.php" class="block py-3 px-5 w-full">
                        <button class="w-10 text-slate-600">
                            <i class="fa-solid fa-truck px-2"></i>
                        </button>
                        On Transit
                    </a>
            </p>
            <p class="w-full flex items-center text-gray-800 rounded-md hover:bg-sky-100 mb-2" id="alerts">
                <a href="notifications.php" class="block py-3 px-5 w-full">
                    <button class="w-10 text-slate-600">
                        <i class="fa-solid fa-bell p"></i>
                    </button>
                    Notifications    
                </a>
            </p>
            
            
            <p class="w-full rounded-md mb-2">
                <a href="logout.php" class="flex text-gray-800 block py-3 px-5 w-full">
                    <button class="w-10 text-slate-600">
                        <i class="fa-solid fa-arrow-right-from-bracket px-2"></i>
                    </button>
                    Logout
                </a>
            </p>
            
        </div>
    </nav>

    <!-- Mobile view nav bar -->
    <nav class="md:hidden w-full bg-white h-14 relative">

        <div class="h-full flex justify-between items-center">
            <p class="w-full px-4 text-xs font-semibold">Security Alert System</p>
            <button class="px-4 h-full text-gray-800 font-semibold" id="button" onclick="toggle('menu')">
                <i class="fa-solid fa-bars" id="icon"></i>
            </button>
        </div>
        <div class="hidden px-2 bg-sky-50 w-full rounded-md shadow-md absolute" id="menu">
            <p class="w-full rounded-md text-gray-800 hover:bg-sky-100 mb-2">
                <a href="./" class="block py-3 px-5 w-full">
                    <button class="w-10 text-slate-600">
                        <i class="fa-solid fa-users-line px-2"></i>
                    </button>
                    Transporters
                </a>
            </p>
            <p class="w-full rounded-md text-gray-800 hover:bg-sky-100 mb-2">
                <a href="./trunk.php" class="block py-3 px-5 w-full">
                    <button class="w-10 text-slate-600">
                        <i class="fa-solid fa-box px-2"></i>
                    </button>
                    Trunks
                </a>
            </p>
            <p class="w-full flex items-center text-gray-800 rounded-md hover:bg-sky-100 mb-2">
                    <a href="transit.php" class="block py-3 px-5 w-full">
                        <button class="w-10 text-slate-600">
                            <i class="fa-solid fa-truck px-2"></i>
                        </button>
                        On Transit
                    </a>
            </p>
            <p class="w-full flex items-center text-gray-800 rounded-md hover:bg-sky-100 mb-2">
                <a href="notifications.php" class="block py-3 px-5 w-full">
                    <button class="w-10 text-slate-600">
                        <i class="fa-solid fa-bell p"></i>
                    </button>
                    Notifications    
                </a>
            </p>
            
            
            <p class="w-full rounded-md mb-2">
                <a href="logout.php" class="flex text-gray-800 block py-3 px-5 w-full">
                    <button class="w-10 text-slate-600">
                        <i class="fa-solid fa-power-off px-2"></i>
                    </button>
                    Logout
                </a>
            </p>            
    
        </div>
    </nav>
    
    <div class="md:w-1/5"></div>
    
</body>
</html>
<style>    
    *{
        font-family: montserrat;
    }
    
</style>
