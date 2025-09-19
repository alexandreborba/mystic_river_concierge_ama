<p class="menu-title sm">OPTIONS <span class="pull-right"></p>
<ul>

    <!-- dashboard -->
    
    <!-- <li><a href='_dashboard.view'><i class="material-icons">dashboard</i> <span class="title">Dashboard</span> </a></li> -->
    
    <!-- sistema -->
    <?php 
    if(f_decode($_SESSION[CONTAINER_NAME."_mAD"])=="1"):
    ?>
    <li class="start "> 
        <a href="#">
            <i class="material-icons">settings</i> 
            <span class="title">System</span> 
            <span class="selected"></span> 
            <span class="arrow "></span> 
        </a>
        <ul class="sub-menu">
            <li><a href='_managers.lst'>Managers</a></li>
            <li><a href='_tokens.lst'>Tokens</a></li>
            <li><a href='_languages.lst'>Languages</a></li>
            <li><a href='_dictionaries.lst'>Dictionaries</a></li>
            <li><a href='_logs.lst'>Logs</a></li>
            <li>
            <a href="#">
                
                <span class="title">Navegação</span> 
                <span class="selected"></span> 
                <span class="arrow "></span> 
            </a>
            <ul class="sub-menu">
                <li><a href='_navGroups.lst'>Groups</a></li>
                <li><a href='_navSubGroups.lst'>SubGroups</a></li>
                <li><a href='_navs.lst'>Items</a></li>
            </ul>
            </li>
        </ul>
    </li>
    <?php 
    endif; // end if
    ?>
    <!-- Concierge -->
    <li class="start "> 
        <a href="#">
            <i class="material-icons">transcribe</i> 
            <span class="title">Concierge</span> 
            <span class="selected"></span> 
            <span class="arrow "></span> 
        </a>
        <ul class="sub-menu">
            <li><a href='_conciergeShips.lst'>Config Concierge</a></li>
            <li>&nbsp;</li>
            <li><a href='_dailyMenusTypes.lst'>Daily Menu Types</a></li>
            <!-- <li><a href='_dailyMenus.lst'>Daily Menu</a></li> -->
            <li><a href='_dailyMenusVertical.lst'>Daily Menu Restaurant</a></li>
            <li>&nbsp;</li>
            <?php if(SHOW_CONCIERGE): ?>
            
                <li><a href='_dailyMenus.lst'>Daily Menu</a></li>
                <li><a href='_dailyPrograms.lst'>Daily Program</a></li>
                <li><a href='_spas.lst'>SPA</a></li>
                <li><a href='_shops.lst'>Shop</a></li> 
            <?php endif; ?>
            <!-- 
            <li><a href='_slidesShows.lst'>Slides Shows</a></li>
            <li><a href='_videos.lst'>Videos</a></li>
            <li><a href='_fastInfos.lst'>Fast Infos (QRCodes)</a></li> 
            -->
        </ul>
    </li>

</ul>

<div class="clearfix"></div>
