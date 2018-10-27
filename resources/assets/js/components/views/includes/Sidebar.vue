<template>
    <section class="nav-side-menu" style="">
        <div class="brand">
            <img src="/images/logo.png" width="130px"/>
        </div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
        <div class="menu-list">
            <ul id="menu-content" class="menu-content collapse out">
                <li class="">
                    <!-- <a href="/">
                        <i class="fa fa-dashboard fa-lg"></i> Dashboard
                    </a> -->
                    <router-link :to="{ name: 'dashboard' }">
                        <i class="fa fa-dashboard fa-lg"></i> Dashboard
                    </router-link>
                </li>
            
                <li class="">
                <!-- <a href="/users" class="">
                <i class="fa fa-users fa-lg"></i> Users
                </a> -->
                <router-link :to="{ name: 'users' }">
                    <i class="fa fa-users fa-lg"></i> Users
                </router-link>
                </li>
            </ul>
        </div>
    </section>
</template>
