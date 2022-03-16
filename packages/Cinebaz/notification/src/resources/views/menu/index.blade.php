<li class=" {{ Route::is('admin.notification.*') ? 'active active-menu' : '' }}">

    <a href="#notification_menu" class="iq-waves-effect collapsed" data-toggle="collapse"
        aria-expanded="{{ Route::is('admin.notification.*') ? 'true' : 'false' }}">
        <i class="lar la-file-alt"></i><span>Notification Management</span><i class="ri-arrow-right-s-line iq-arrow-right"></i>
    </a>
    <ul id="notification_menu" class="iq-submenu collapse  {{ Route::is('admin.notification.*') ? 'show' : '' }}"
        data-parent="#iq-sidebar-toggle">
        <li class="{{ Route::is('admin.notification.index') ? 'active' : '' }}"><a href="{{ route('admin.notification.index') }}"><i
                    class="lar la-circle"></i> Notifications</a></li>
        <li class="{{ Route::is('admin.tag.add') ? 'active' : '' }}"><a href="{{ route('admin.notification.add') }}"><i
                    class="lar la-circle"></i> Add Notifications</a></li>
    </ul>
</li>
