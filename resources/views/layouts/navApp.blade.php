

<div class="w-40  h-full flex flex-col justify-center relative laptop:hidden animate__animated animate__fadeInLeft z-50">
    <nav class="w-28 h-250 bg-primary rounded-full flex flex-col items-center mx-auto justify-between py-5 shadow-3xl">


        <a  href="{{route('profile.index')}}"
        class="w-20 h-20 bg-white text-primary rounded-full shadow-3xl flex items-center justify-center">
            <iconify-icon icon="ri:user-fill" class="text-3xl font-bold "></iconify-icon>
        </a>

        <ul class="mx-auto panel w-20 h-128 flex flex-col text-center justify-around text-white text-lg">
            <li class="relative group ">
                <a href="{{ url('/admin/dashboard') }}" class="flex flex-col items-center justify-center transition transform duration-300 hover:scale-105">
                    <iconify-icon icon="material-symbols:dashboard" class="{{ Request::is('admin/dashboard') ? 'active' : '' }} text-4xl"></iconify-icon>
                    <span class="opacity-0 group-hover:opacity-100 absolute left-full top-1/2 transform -translate-y-1/2 bg-white text-primary px-4 py-2 rounded-full text-lg whitespace-nowrap ">Dashboard</span>
                </a>
            </li>

            <li class="relative group ">
                <a href="{{ url('/admin/devisi') }}" class="flex flex-col items-center justify-center transition transform duration-300 hover:scale-105">
                    <iconify-icon  icon="ph:office-chair-fill" class="{{ Request::is('admin/devisi*') ? 'active' : '' }} text-4xl"></iconify-icon>
                    <span class="opacity-0 group-hover:opacity-100 absolute left-full top-1/2 transform -translate-y-1/2 bg-white text-primary px-4 py-2 rounded-full text-lg whitespace-nowrap ">Devisi</span>
                </a>
            </li>

            <li class="relative group ">
                <a href="{{ url('/admin/mahasiswa') }}" class="flex flex-col items-center justify-center transition transform duration-300 hover:scale-105">
                    <iconify-icon icon="ph:user-list-bold" class="{{ Request::is('admin/mahasiswa*') ? 'active' : '' }} text-4xl"></iconify-icon>
                    <span class="opacity-0 group-hover:opacity-100 absolute left-full top-1/2 transform -translate-y-1/2 bg-white text-primary px-4 py-2 rounded-full text-lg whitespace-nowrap ">Mahasiswa</span>
                </a>
            </li>

            <li class="relative group ">
                <a href="{{ url('/admin/data-admin') }}" class="flex flex-col items-center justify-center transition transform duration-300 hover:scale-105">
                    <iconify-icon icon="ion:people" class="{{ Request::is('admin/data-admin*') ? 'active' : '' }} text-4xl"></iconify-icon>
                    <span class="opacity-0 group-hover:opacity-100 absolute left-full top-1/2 transform -translate-y-1/2 bg-white text-primary px-4 py-2 rounded-full text-lg whitespace-nowrap ">Data Admin</span>
                </a>
            </li>

       

            <li class="relative group">
                <a href="{{ url('/admin/absensi') }}" class="flex flex-col items-center justify-center transition transform duration-300 hover:scale-105">
                    <iconify-icon icon="mdi:calendar-check-outline" class="{{ Request::is('admin/absensi*') ? 'active' : '' }} text-4xl"></iconify-icon>
                    <span class="opacity-0 group-hover:opacity-100 absolute left-full top-1/2 transform -translate-y-1/2 bg-white text-primary px-4 py-2 rounded-full text-lg whitespace-nowrap ">Absensi</span>
                </a>
            </li>

            <li class="relative group ">
                <a href="{{ url('/admin/users') }}" class="flex flex-col items-center justify-center transition transform duration-300 hover:scale-105">
                    <iconify-icon icon="mdi:user-check" class="{{ Request::is('admin/users*') ? 'active' : '' }} text-4xl"></iconify-icon>
                    <span class="opacity-0 group-hover:opacity-100 absolute left-full top-1/2 transform -translate-y-1/2 bg-white text-primary px-4 py-2 rounded-full text-lg whitespace-nowrap">All Users</span>
                </a>
            </li>
        </ul>

        <div class="w-16 h-16 bg-primary text-white rounded-full flex justify-center items-center text-4xl shadow-3xl">
            <a href="/logout" class="transition transform duration-300 hover:scale-105">
                <iconify-icon icon="ant-design:logout-outlined"></iconify-icon>
                <span class="opacity-0 group-hover:opacity-100 absolute left-full top-1/2 transform -translate-y-1/2 bg-white text-primary px-4 py-2 rounded-full text-lg whitespace-nowrap hover:px-6 hover:py-3 hover:text-xl">Logout</span>
            </a>
        </div>
    </nav>
</div>




{{-- responsive --}}

<div class="w-full h-20 bg-primary flex items-center justify-between p-5 text-white lg:hidden">


  <div class="relative inline-block text-left">
    <button type="button"
        class=" z-50 inline-flex items-center justify-center w-full px-5 py-2 text-base font-medium leading-5 text-white transition duration-150 ease-in-out bg-gray-600 border border-transparent rounded-md hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-800"
        id="menuButton" onclick="toggleMenu()">
       
            <iconify-icon icon="pajamas:hamburger" class="text-xl mr-3"></iconify-icon>
       
        Menu
    </button>

    <div id="menuDropdown"
        class="animate__animated absolute left-1 mt-2 bg-white border rounded-md shadow-lg transform transition-transform duration-300 hidden z-40"
        role="menu">
        <a href="/admin/dashboard"
            class="flex items-center px-6 py-3 text-base leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
            <iconify-icon icon="material-symbols:dashboard" class="mr-3 text-xl"></iconify-icon>
            Dashboard
        </a>

        <a href="/admin/devisi"
        class="flex items-center px-6 py-3 text-base leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
        <iconify-icon icon="ph:office-chair-fill" class="mr-3 text-xl"></iconify-icon>
        Devisi
    </a>
        <a href="/admin/mahasiswa"
            class="flex items-center px-6 py-3 text-base leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
            <iconify-icon icon="ph:user-list-bold" class="mr-3 text-xl"></iconify-icon>
            Mahasiswa
        </a>

        <a href="/admin/admin-data"
        class="flex items-center px-6 py-3 text-base leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
        <iconify-icon icon="ion:people"class="mr-3 text-xl"></iconify-icon>
        Admin
    </a>

        <a href="/admin/absensi"
            class="flex items-center px-6 py-3 text-base leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
            <iconify-icon icon="mdi:calendar-check-outline" class="mr-3 text-xl"></iconify-icon>
            Absensi
        </a>
        <a href="/admin/users"
            class="flex items-center px-6 py-3 text-base leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
            <iconify-icon icon="mdi:user-check" class="mr-3 text-xl"></iconify-icon>
            User
        </a>
    </div>
</div>






  <div class="relative inline-block text-left">
      <div>
          <button type="button"
              class="z-50 inline-flex items-center justify-center w-full px-5 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-gray-600 border border-transparent rounded-md hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-800"
              id="userDropdown" onclick="toggleDropdown()">
              <span id="dropdownIcon" class="mr-3 text-gray-200">
                  <iconify-icon icon="teenyicons:down-solid"></iconify-icon>
              </span>
              {{ auth()->user()->name }}
          </button>
      </div>
  
      <div id="dropdownMenu"
          class="animate__animated absolute right-0 mt-2 bg-white border rounded-md shadow-lg transform transition-transform duration-300 hidden z-40"
          role="menu">
  
          <a href=""
              class="flex items-center px-5 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
              <span class="mr-2 text-xl text-gray-400">
                  <iconify-icon icon="iconamoon:profile-fill"></iconify-icon>
              </span>
              Profil
          </a>
  
          <div class="border-t border-gray-100"></div>
          <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
              class="flex items-center px-5 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
              <span class="mr-2 text-xl text-gray-400">
                  <iconify-icon icon="solar:logout-outline"></iconify-icon>
              </span>
              Logout
          </a>
        
      </div>
  </div>
  
  
  


</div>
