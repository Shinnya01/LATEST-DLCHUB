<html>
<?php
require("config/db.php");
require("layout/head.php");


?>
<body>
    <?php require("layout/navtop.php") ?>
    <?php require("layout/sidebar.php") ?>


    <div class="p-4 mt-10 sm:ml-64">

        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 flex  gap-4 w-full h-160">
           
        <!-- LEFT -->
        <div class="bg-red-100 w-[60%] flex flex-col gap-4 p-4">
        
              <!-- WELCOME USER -->
              <section class="bg-green-100 flex justify-between items-center p-4">
                <p class="text-2xl ">Welcome, User</p>
                <p class="text-base">10:28 PM | 04 09 2025</p>
              </section>

              <!-- ABOUT ROOM -->
               <section class="grid grid-cols-2 w-full h-full gap-4">
                    <!-- GROUPS -->
                    <div class="bg-gray-100 row-span-2">Group Info</div>

                    <!-- ANNOUNCEMENT -->
                    <div class="bg-gray-100 ">Announcement</div>

                    <!-- VOTING -->
                    <div class="bg-gray-100">Voting</div>
               </section>

        <!-- END LEFT -->
        </div>
  
        <!-- RIGHT -->
         <div class="bg-green-100 w-[40%] p-4">

           <!-- ADVERTISEMENT -->
            <section class="w-full h-full bg-red-100">
            ADVERTISEMENT
            </section>

         </div>

         

      </div>


  </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>