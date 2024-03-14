<section class="navigation">
                <div class="top">
                    <a href="dashboard.php"><h1>roadnote</h1></a>
                </div>
                
                <div class="sidebar">
                        <a href="dashboard.php">
                            <img src="svg/house.svg" class="sidebar-menu__item-icon1" />
                            <h3>Dashboard</h3>
                        </a>
                        <a href="calendar.php">
                            <img src="svg/calendar.svg" class="sidebar-menu__item-icon2" />
                            <h3>Calendar</h3>
                        </a>
                        <a href="informations.php">
                            <img src="svg/info.svg" class="sidebar-menu__item-icon3" />
                            <h3>Informations</h3>
                        </a>
                        <a href="map.php">
                            <img src="svg/map.svg" class="sidebar-menu__item-icon4" />
                            <h3>Map</h3>
                        </a>
                        <a href="attractions.php">
                            <img src="svg/attractions.svg" class="sidebar-menu__item-icon5" />
                            <h3>Attractions</h3>
                        </a>
                        <a href="trips.php">
                            <img src="svg/trips.svg" class="sidebar-menu__item-icon6" />
                            <h3>Trips</h3>
                        </a>
                        <a href="settings.php">
                            <img src="svg/settings.svg" class="sidebar-menu__item-icon7" />
                            <h3>Settings</h3>
                        </a>
                        
                        <a onclick="lout_openPopup()">
                            <img src="svg/logout.svg" class="sidebar-menu__item-icon8" />
                            <h3>Log out</h3>
                        </a>
                </div>
</section>
            <div class="lout_popup" id="lout_popup">
                            <h2>LOG OUT</h2>
                            <p>Are you sure you want to log out?<br/>Your data will be saved.</p>
                            <form action="login/lout.php" method="POST">
                            <button class="yes-btn" type="submit">YES</button>
                            </form>
                            <button class="cancel-btn" type="button" onclick="lout_closePopup()">CANCEL</button>
                        </div>
            <div id="logoutBackDrop"></div>

            <script>
                let popup = document.getElementById("lout_popup");
                const logoutBackDrop = document.getElementById('logoutBackDrop');
                function lout_openPopup() {
                    popup.classList.add("open-popup");
                    logoutBackDrop.style.display = 'block';
                }
                function lout_closePopup() {
                    popup.classList.remove("open-popup");
                    logoutBackDrop.style.display = 'none';
                }

            </script>