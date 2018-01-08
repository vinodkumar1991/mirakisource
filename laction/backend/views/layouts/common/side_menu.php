


<!-- Sidebar -->
<aside
	class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg">
	<header class="sidebar-header">
		<a class="logo-icon" href="index.html"><img
			src="<?php echo Yii::getAlias('@asset').'/img/logo-icon-light.png';?>"
			alt="logo icon"></a> <span class="logo"> <a href="index.html"><img
				src="<?php echo Yii::getAlias('@asset') . '/img/logo-light.png';?>"
				alt="logo"></a>
		</span> <span class="sidebar-toggle-fold"></span>
	</header>
	<nav class="sidebar-navigation">
		<ul class="menu">
			<!-- Dashboard :: SATART -->
			<li class="menu-item"><a class="menu-link" href="general.php"> <span
					class="icon fa fa-home"></span> <span class="title">Dashboard</span>
			</a></li>
			<!-- Dashboard :: END -->
			<!-- Slots :: START -->
			<li class="menu-item"><a class="menu-link" href="#"> <span
					class="icon fa fa-calendar-check-o"></span> <span class="title">Slots</span>
					<span class="arrow"></span>
			</a>

				<ul class="menu-submenu">
					<li class="menu-item"><a class="menu-link"
						href="preview-booking.php"> <span class="dot"></span> <span
							class="title">Preview Booking</span>
					</a></li>

					<li class="menu-item"><a class="menu-link"
						href="audition-bookin.php"> <span class="dot"></span> <span
							class="title">Audition bookin</span>
					</a></li>


				</ul></li>
			<!-- Slots :: END -->
			<!-- User :: START -->
			<li class="menu-item"><a class="menu-link" href="#"> <span
					class="icon fa fa-users"></span> <span class="title">Users</span>
					<span class="arrow"></span>
			</a>
				<ul class="menu-submenu">
					<li class="menu-item"><a class="menu-link"
						href="<?php echo Yii::getAlias('@web').'/create-user';?>"> <span
							class="dot"></span> <span class="title">New User</span>
					</a></li>
				</ul></li>
			<!-- User :: END -->
			<li class="menu-item"><a class="menu-link" href="notifications.php">
					<span class="icon fa fa-bell"></span> <span class="title">notifications</span>
			</a></li>






			<li class="menu-item"><a class="menu-link" href="settings.php"> <span
					class="icon fa fa-cogs"></span> <span class="title">Settings</span>
			</a></li>






		</ul>
	</nav>

</aside>
<!-- END Sidebar -->
