<section class="nav-side-menu" style="">
		<div class="brand">
				<img src="images/logo.png" width="130px"/>
		</div>
		<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
		<div class="menu-list">
				<ul id="menu-content" class="menu-content collapse out">
						<li class="">
							<a href="/">
							    <i class="fa fa-dashboard fa-lg"></i> Dashboard
							</a>
						</li>

						<!--PROJECTS-->
						<li data-toggle="collapse" data-target="#projectList" class="collapsed">
							<a><i class="fa fa-globe fa-lg"></i> Projects <span class="arrow"></span></a>
						</li>  
							<!--ACTIVE&COMPLETED-->
							<ul class="sub-menu collapse" id="projectList">
								<!--ACTIVE-->
								<li data-toggle="collapse" data-target="#activeProj" class="collapsed">Active</li>
										<ul class="sub-menu collapse projList" id="activeProj">
											<!--ACTIVE PROJECT LIST-->
											<li data-toggle="collapse" data-target="#projDetails" class="collapsed pl-10">
												Project 1</li>
												
													<!--UNDER PROJECT 1-->
													<ul class="sub-menu collapse projList" id="projDetails">
														<li class="pl-20"><a href="#">Project Detail</a></li>
														<li class="pl-20"><a href="#">Team</a></li>
														<li class="pl-20"><a href="#">Tasks</a></li>
													</ul>

								<li data-toggle="collapse" data-target="#service" class="collapsed pl-10">
										Project 2</li>
								<li data-toggle="collapse" data-target="#service" class="collapsed pl-10">
										Project 3</li>
										</ul>
							<!--./ACTIVE-->

						<li data-toggle="collapse" data-target="#" class="collapsed">Completed</li>
							</ul>
							<!--ACTIVE&COMPLETED-->
						<!--./PROJECTS-->
					
						 <li class="">
							<a href="/users" class="">
							<i class="fa fa-users fa-lg"></i> Users
							</a>
						</li>
				</ul>
 </div>
</section>