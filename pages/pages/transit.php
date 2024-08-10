<?php
$title = "Transit";
include 'base.php';
?>
<main class="w-11/12 md:w-5/6 mx-auto py-5 md:px-10">
    <div class="rounded-md shadow-md overflow-hidden bg-sky-50 mt-3 px-10 py-4">
        <p class="font-bold text-base md:text-2xl text-slate-600">Trunks On Transit Details</p>
        <p class="font-semibold text-sm text-sky-600">View location and alerts on this trip</p>
    </div>

    <div class="md:grid grid-cols-3 gap-4 cursor-pointer mt-6 md:mt-12 overflow-auto scroll-smooth m-auto">
        <?php
        $query = "SELECT * FROM `Transit` WHERE state = 'Active'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result -> fetch_assoc()) {

                $trunk_id = $row['trunk_id'];                
                $transit_id = $row['transit_id'];

                $trans_query = "SELECT * FROM `Trunks` WHERE trunk_id = '$trunk_id'";
                $trans_result = mysqli_query($conn, $trans_query);
                $trans_row = mysqli_fetch_assoc($trans_result);
                $trunk_name = $trans_row['trunk_name'];
                $transporter_id = $row['transporter_id'];
                $destination = $row['destination'];

        ?>
                <div class="rounded-md border border-gray-300 flex w-full md:w-[300px] items-center p-4 bg-white shadow-md my-2">
                    <div class="w-10 h-10 md:h-20 md:w-20 rounded-full mx-1 py-auto text-center align-middle overflow-hidden">
                        <div class="align-middle">
                            <i class="fa-solid fa-user text-gray-400 text-3xl md:text-6xl pt-1"></i>
                        </div>
                    </div>
                    <div class="w-full ml-2 flex md:block justify-between items-center">
                        <div>
                            <p class="text-sm font-bold text-slate-700 py-auto">
                                <?php echo "$trunk_name"; ?>
                            </p>
                            <p class="text-sm">
                                <?php echo "$destination"; ?>
                            </p>
                        </div>
                        <div class="text-right">
                            <form action="details.php" method="get" class="text-right">
                                <input type="text" value="<?php echo $transit_id; ?>" name="id" class="hidden">
                                <button type="submit" class="text-white text-sm py-2 px-3 rounded-md bg-sky-700 text-right">View</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            }

        } else {
            echo ' <p class="py-6 text-center text-gray-800 font-semibold italic">No Active Transporters</p>';
        }
        ?>
    </div>

    <script>
        document.getElementById("transit").classList.add("bg-sky-200")
    </script>
    <script src="../JavaScript/header.js"></script>
</main>