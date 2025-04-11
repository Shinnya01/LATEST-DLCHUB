<?php error_reporting(0);

$parts = explode('/', __FILE__);
$filename = $parts[count($parts) - 1];

if (strpos($_SERVER["SCRIPT_URI"], $filename) !== false) {
	exit("illegal method");
}
?>
<aside id="logo-sidebar" class="fixed top-0 mt-10 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
       <ul class="space-y-2 font-medium">
          <li>
             <a href="<?= $_HOME_FILE ?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group ">
               <i class="ri-dashboard-line"></i>
                <span class="ms-3">Dashboard</span>
             </a>
          </li>
          <li>
             <a href="<?= $_ANNOUNCEMENT_FILE ?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="ri-notification-4-line"></i>
                <span class="flex-1 ms-3 whitespace-nowrap">Announcement</span>
                 </a>
          </li>
          <li>
             <a href="<?= $_VOTING_FILE ?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="ri-bar-chart-line"></i>
                <span class="flex-1 ms-3 whitespace-nowrap">Voting</span>
                  </a>
          </li>
          
          <li>
            <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
            <i class="ri-chat-4-line"></i>
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Chat Room</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                  <li>
                     <a href="<?= $_MY_ROOM_FILE ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"><i class="ri-team-fill mr-4"></i> My Rooms</a>
                  </li>
                  <li>
                     <a href="<?= $_JOIN_ROOM_FILE ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"><i class="ri-shake-hands-line mr-4"></i> Join Room</a>
                  </li>
                  <li>
                     <a href="<?= $_CREATE_ROOM_FILE ?>" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"><i class="ri-add-line mr-4"></i> Create Room</a>
                  </li>
            </ul>
         </li>
          <li>
             <a href="<?= $_ADVERTISEMENT_FILE ?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="ri-t-shirt-2-line"></i>
                <span class="flex-1 ms-3 whitespace-nowrap">Advertisement</span>
             </a>
          </li>
          <li>
             <a href="<?= $_ACCOUNT_INFO_FILE ?>" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="ri-t-shirt-2-line"></i>
                <span class="flex-1 ms-3 whitespace-nowrap">Account</span>
             </a>
          </li>

          <?php if($isAdmin): ?>
         <li>
       
         <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-admin-area" data-collapse-toggle="dropdown-admin-area">
            <i class="ri-chat-4-line"></i>
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Admin Area</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="dropdown-admin-area" class="hidden py-2 space-y-2">
                  <li>
                     <a href="room_control.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"><i class="ri-team-fill mr-4"></i> Room Control</a>
                  </li>
                  <li>
                     <a href="user_control.php" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"><i class="ri-shake-hands-line mr-4"></i> User Control</a>
                  </li>
         
            </ul>
         </li>
         <?php endif; ?>
       </ul>
    </div>
 </aside>