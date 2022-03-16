<li class=" {{ Route::is('admin.page.*') ? 'active active-menu' : '' }}">

    <a href="#page_menu" class="iq-waves-effect collapsed" data-toggle="collapse"
        aria-expanded="{{ Route::is('admin.page.*') ? 'true' : 'false' }}">
        <i class="lar la-file-alt"></i><span>Page Management</span><i class="ri-arrow-right-s-line iq-arrow-right"></i>
    </a>
    <ul id="page_menu" class="iq-submenu collapse  {{ Route::is('admin.page.*') ? 'show' : '' }}"
        data-parent="#iq-sidebar-toggle">
        <li class="{{ Route::is('admin.page.all') ? 'active' : '' }}"><a href="{{ route('admin.page.all') }}"><i
                    class="lar la-circle"></i> Pages</a></li>
        <li class="{{ Route::is('admin.page.add') ? 'active' : '' }}"><a href="{{ route('admin.page.add') }}"><i
                    class="lar la-circle"></i> Add new</a></li>
    </ul>
</li>
