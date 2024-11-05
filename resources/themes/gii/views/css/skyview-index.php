<?php
	ob_start();
	@session_start();
	$_SESSION['security_number']=rand(10000,99999);
	require_once 'data/config.php'; 
	require_once 'include/header.php';
	require_once 'include/menu.php';
?>
<!--<div class="lds-facebook"><div></div><div></div><div></div></div> -->
		

	<section class="collection-slider  bg-white" >
		<div class="container-fluid">
			<div class="col-12">

				<div class="header-t mb-3 featured" style="margin-top:-170px;">
					<h1>FEATURED SERVICES</h1>
					
				</div>
		
    <!--<div class="row hover-effect" style="display:none;">
        <div class="col-md-3 col-sm-6">
            <div class="box">
                <img src="https://new.skyviewaerialphotography.com.au/wp-content/uploads/2017/08/service9-270x361.jpg">
                <div class="box-content">
                    <h3 class="title">Aerial Photography</h3>
                    <span class="post">1</span>
                </div>
                <ul class="icon">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-link"></i></a></li>
                </ul>
            </div>
            <div class="sc_services_item_info">
                                <div class="sc_services_item_header">
                                  <h4 class="sc_services_item_title"><a href="services/event-coverage-2/">Aerial Photography</a></h4>
                                </div>
                                <div class="sc_services_item_content">
                                  <ul class="trx_addons_list trx_addons_list_square">
                                    <li>Weddings</li>
                                    <li>Outdoor Festivals</li>
                                    <li>Promotional Events</li>
                                    <li>Concerts</li>
                                    <li>Team Sports</li>
                                  </ul>
                                </div>
                        </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="box">
                <img src="https://new.skyviewaerialphotography.com.au/wp-content/uploads/2017/08/service9-270x361.jpg">
                <div class="box-content">
                    <h3 class="title">Aerial Videography</h3>
                    <span class="post">2</span>
                </div>
                <ul class="icon">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-link"></i></a></li>
                </ul>
            </div>
            <div class="sc_services_item_info">
                                <div class="sc_services_item_header">
                                  <h4 class="sc_services_item_title"><a href="services/event-coverage-2/">Aerial Videography</a></h4>
                                </div>
                                <div class="sc_services_item_content">
                                  <ul class="trx_addons_list trx_addons_list_square">
                                    <li>Weddings</li>
                                    <li>Outdoor Festivals</li>
                                    <li>Promotional Events</li>
                                    <li>Concerts</li>
                                    <li>Team Sports</li>
                                  </ul>
                                </div>
                        </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="box">
                <img src="https://new.skyviewaerialphotography.com.au/wp-content/uploads/2017/08/service9-270x361.jpg">
                <div class="box-content">
                    <h3 class="title">Drone Shoot Photography</h3>
                    <span class="post">3</span>
                </div>
                <ul class="icon">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-link"></i></a></li>
                </ul>
            </div>
            <div class="sc_services_item_info">
                                <div class="sc_services_item_header">
                                  <h4 class="sc_services_item_title"><a href="services/event-coverage-2/">Drone Shoot Photography</a></h4>
                                </div>
                                <div class="sc_services_item_content">
                                  <ul class="trx_addons_list trx_addons_list_square">
                                    <li>Weddings</li>
                                    <li>Outdoor Festivals</li>
                                    <li>Promotional Events</li>
                                    <li>Concerts</li>
                                    <li>Team Sports</li>
                                  </ul>
                                </div>
                        </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="box">
                <img src="https://new.skyviewaerialphotography.com.au/wp-content/uploads/2017/08/service9-270x361.jpg">
                <div class="box-content">
                    <h3 class="title">Drone Shoot Videography</h3>
                    <span class="post">4</span>
                </div>
                <ul class="icon">
                    <li><a href="#"><i class="fa fa-search"></i></a></li>
                    <li><a href="#"><i class="fa fa-link"></i></a></li>
                </ul>
            </div>
            <div class="sc_services_item_info">
                                <div class="sc_services_item_header">
                                  <h4 class="sc_services_item_title"><a href="services/event-coverage-2/">Drone Shoot Videography</a></h4>
                                </div>
                                <div class="sc_services_item_content">
                                  <ul class="trx_addons_list trx_addons_list_square">
                                    <li>Weddings</li>
                                    <li>Outdoor Festivals</li>
                                    <li>Promotional Events</li>
                                    <li>Concerts</li>
                                    <li>Team Sports</li>
                                  </ul>
                                </div>
                        </div>
        </div>
    </div> -->
    
    
    <div class="inflatables_slider">
				    
				    <?php
			$dbh = new PDO($dsn, $username, $password);
			$sql = $dbh->prepare("SELECT * FROM photo_category WHERE pc_active='Y' ");
            $sql->execute();
            $rows = $sql->fetchAll();                         
            for($i=0;$i < count($rows); $i++)
            { 
                ?>
                <?php 
			$dbh1 = new PDO($dsn, $username, $password);
			$sql1 = $dbh1->prepare("SELECT * FROM photo_project WHERE pp_active='Y' AND pp_pc_id=:pc_id");
			$sql1->bindParam(':pc_id', $rows[$i]['pc_id']);     
            $sql1->execute();
            $rows1 = $sql1->fetchAll();                         
            for($j=0;$j < 1; $j++)
            { 		

				$dir = UPLOAD_FILEPATH_PHOTO_IMAGES.$rows[$i]['pc_title']."/".$rows1[$j]['pp_title'] ;
				$dirContents = scandir($dir);
				$count = 0;
				
				 
				foreach($dirContents as $image) {

					if (isImageFile($image)) {

					  

						$path1 = READ_FILEPATH_PHOTO_IMAGES.$rows[$i]['pc_title']."/";

						$pp_title = $rows1[$j]['pp_title'] .'/';

						$imgName = $image ; 
						
						?>
                
                <div class="inflatables">
						
						<div class="img_thumbnail m-auto container ">
							<a href="<?=SITEURL?>photographic-portfolio/<?=$rows[$i]['pc_alias']?>"><img class="img-fluid image" src="<?=$path1?><?=$pp_title?><?=$imgName?>"></a>
							<a href="<?=SITEURL?>photographic-portfolio/<?=$rows[$i]['pc_alias']?>"><div class="overlay">
                                <div class="text"><?=$rows[$i]['pc_title']?></div>
                              </div></a>
						</div>
						
						<div class="sc_services_item_info">
                                <div class="sc_services_item_header">
                                  <h4 class="sc_services_item_title"><a href="<?=SITEURL?>photographic-portfolio/<?=$rows[$i]['pc_alias']?>"><?=$rows[$i]['pc_title']?></a></h4>
                                </div>
                                <div class="sc_services_item_content" style="display:none;">
                                  <ul class="trx_addons_list trx_addons_list_square">
                                    <li>Heli</li>

                                  </ul>
                                </div>
                        </div>
							
					</div>
					
					<?php	 break; $count++;

						

					}

				}
				 
		
			?>
        <?php } ?>
					
                
                
			<?php } ?>
					
					
					
				</div>	
				
				
				
				
				
				
				
	
			</div>	
		</div>	
	</section>

	<section class="about_giant" style="margin-top:20px !important;">
		<div class="container-fluid">
			<div class="col-12">

				<div class="header-t mb-3">
					<a href="<?=SITEURL?>about-skyview"><h1>About SKYview Aerial</h1></a>
				</div>	

				<div class="many_partition">
					<div class="about_part">
						<div class="ab_logo text-center">	
							<img src="images/logo.png" class="img-fluid">
						</div>
						<div class="text-left">	
						    <?php
                    		try {
                    			$dbh = new PDO($dsn, $username, $password);
                    			$sql = "SELECT * FROM webpage WHERE wp_title = 'Home'";
                    			foreach ($dbh->query($sql) as $row)
                    			{
                    				echo  html_entity_decode($row['wp_intro']);
                    			}
                    			$dbh = null;
                    		}
                    		catch(PDOException $e)
                    		{
                    			echo $e->getMessage();
                    		}
                    		?>
						</div>	
						<div class="col-12 text-center mt-xl-3 pt-xl-3">	
							<a href="<?=SITEURL?>about-skyview-aerial-photography-australia" class="red_btn d-inline-block">Read More</a>
						</div>	
					</div>	


					<div class="our_clients ">	
						<h2>Associations</h2>
							<div class="w-100 d-block">							
								<a href="https://www.mbansw.asn.au/" target="_blank"><img src="https://skyviewaerialphotography.com.au/images/mba.png" alt="Master Builders Association" class="img-fluid mb-4"></a>
							</div>	
							<div class="w-100 d-block mt-xl-3">									
								<a href="https://www.propertycouncil.com.au/"  target="_blank"><img src="https://skyviewaerialphotography.com.au/images/pca.png" alt="Property Council" class="img-fluid mb-4"></a>
							</div>
							<div class="w-100 d-block mt-xl-3">									
								<a href="https://papainternational.com/"  target="_blank"><img src="https://skyviewaerialphotography.com.au/images/papa.png" alt="PAPA International" class="img-fluid"></a>
							</div>
					</div>	

					<div class="enquiry_form">
						<?php
	require_once 'include/quickcontact.php';
?>	
					</div>		
				</div>	

			</div>	
		</div>	
	</section>

	<section class="collection-slider"  style="margin-top:20px !important;">
		<div class="container-fluid">
			<div class="col-12">

				<div class="header-t text-center mb-3">
					<a href="<?=SITEURL?>photographic-portfolio"><h1>Photographic Portfolio</h1></a>
					<p style="display:none;">Home to a huge collection of in-stock and custom</p>
				</div>
				
				
				<div class="inflatables_slider Photographic  mb-3">
				    
				    <?php
			$dbh = new PDO($dsn, $username, $password);
			$sql = $dbh->prepare("SELECT * FROM photo_category WHERE pc_active='Y' ");
            $sql->execute();
            $rows = $sql->fetchAll();                         
            for($i=0;$i < count($rows); $i++)
            { 
                ?>
					<div class="inflatables  hover-effect">
					
						<div class="img_thumbnail m-auto">
						     <?php 
			$dbh1 = new PDO($dsn, $username, $password);
			$sql1 = $dbh1->prepare("SELECT * FROM photo_project WHERE pp_active='Y' AND pp_pc_id=:pc_id");
			$sql1->bindParam(':pc_id', $rows[$i]['pc_id']);     
            $sql1->execute();
            $rows1 = $sql1->fetchAll();                         
            for($j=0;$j < 1; $j++)
            { 		

				$dir = UPLOAD_FILEPATH_PHOTO_IMAGES.$rows[$i]['pc_title']."/".$rows1[$j]['pp_title'] ;
				$dirContents = scandir($dir);
				$count = 0;
				
				 
				foreach($dirContents as $image) {

					if (isImageFile($image)) {

					  

						$path1 = READ_FILEPATH_PHOTO_IMAGES.$rows[$i]['pc_title']."/";

						$pp_title = $rows1[$j]['pp_title'] .'/';

						$imgName = $image ; 
						
						?>
                        
                        
        <a href="<?=SITEURL?>photographic-portfolio/<?=$rows[$i]['pc_alias']?>"><img src="<?=$path1?><?=$pp_title?><?=$imgName?>" alt="<?=$rows[$i]['pc_title']?>" 
        title="<?=$rows[$i]['pc_desc']?>" class="img-fluid" /></a>
        
        
        <?php	 break; $count++;

						

					}

				}
				 
		
			?>
        <?php } ?>
						<?php /* ?>	<img class="img-fluid" src="https://www.motorsportweek.com/wp-content/uploads/2020/11/jm1513ma474-Custom-750x500.jpg"><?php */ ?>
						</div>
						<div class="sc_services_item_info">
                                <div class="sc_services_item_header">
                                  <h4 class="sc_services_item_title"><a href="<?=SITEURL?>photographic-portfolio/<?=$rows[$i]['pc_alias']?>"><?=$rows[$i]['pc_title']?></a></h4>
                                </div>
                                <div class="sc_services_item_content">
                                  <ul class="trx_addons_list trx_addons_list_square">
                                      <?php 
			$dbh1 = new PDO($dsn, $username, $password);
			$sql1 = $dbh1->prepare("SELECT * FROM photo_project WHERE pp_active='Y' AND pp_pc_id=:pc_id");
			$sql1->bindParam(':pc_id', $rows[$i]['pc_id']);     
            $sql1->execute();
            $rows1 = $sql1->fetchAll();                         
            for($j=0;$j < count($rows1); $j++)
            { 	?>
                                    <li><a href="<?=SITEURL?>photographic-portfolio/<?=$rows[$i]['pc_alias']?>/<?=$rows1[$j]['pp_alias']?>"><?=$rows1[$j]['pp_title']?></a></li>
                                    <?php } ?>
                                  </ul>
                                </div>
                        </div>
						<div class="bottom_links d-flex justify-content-between">
							<div class="bottom_links1">
								<a href="<?=SITEURL?>photographic-portfolio/<?=$rows[$i]['pc_alias']?>"> <i class="fa fa-eye"></i> &nbsp; View All </a>
							</div>
							
						</div>	
					</div>
			<?php } ?>
					
					
					
				</div>	
				
				
<?php /* ?>
				<div class="inflatables_slider Photographic">
                    <?php
        			$dbh = new PDO($dsn, $username, $password);
        			$sql = $dbh->prepare("SELECT * FROM photo_category WHERE pc_active='Y' ");
                    $sql->execute();
                    $rows = $sql->fetchAll();                         
                    for($i=0;$i < count($rows); $i++)
                    { 
			        ?>
					<div class="inflatables hover-effect">
						<div class="img_thumbnail m-auto">
							<img class="img-fluid" src="https://www.motorsportweek.com/wp-content/uploads/2020/11/jm1513ma474-Custom-750x500.jpg">
						</div>
                        <div class="sc_services_item_info">
                                <div class="sc_services_item_header">
                                  <h4 class="sc_services_item_title"><a href="<?=SITEURL?>photographic-portfolio/<?=$rows[$i]['pc_alias']?>"><?=$rows[$i]['pc_title']?></a></h4>
                                </div>
                                <div class="sc_services_item_content">
                                  <ul class="trx_addons_list trx_addons_list_square">
                                      <?php 
			$dbh1 = new PDO($dsn, $username, $password);
			$sql1 = $dbh1->prepare("SELECT * FROM photo_project WHERE pp_active='Y' AND pp_pc_id=:pc_id");
			$sql1->bindParam(':pc_id', $rows[$i]['pc_id']);     
            $sql1->execute();
            $rows1 = $sql1->fetchAll();                         
            for($j=0;$j < count($rows1); $j++)
            { 	?>
                                    <li><?=$rows1[$j]['pp_title']?></li>
                                    <?php } ?>
                                  </ul>
                                </div>
                        </div>
						<div class="bottom_links d-flex justify-content-between">
							<div class="bottom_links1">
								<a href="<?=SITEURL?>photographic-portfolio/<?=$rows[$i]['pc_alias']?>"> <i class="fa fa-eye"></i> &nbsp; View All </a>
							</div>
							
						</div>
					</div>
					<?php } ?>
					
					
					
			

				</div>
				
				<?php */ ?>
				
				
				
				
			</div>	
		</div>	
	</section>

<?php /* ?>
	<section class="collection-slider" style="margin-top:20px !important;display:none;">
		<div class="container-fluid">
			<div class="col-12">

				<div class="header-t mb-3" >
					<a href="<?=SITEURL?>video-portfolio"><h1>VIDEOGRAPHIC</h1></a>
					<p  style="display:none;">Home to a huge collection of in-stock and custom</p>
				</div>	

				<div class="inflatables_slider Photographic">
<?php
			$dbh = new PDO($dsn, $username, $password);
			$sql = $dbh->prepare("SELECT * FROM video_category WHERE vc_active='Y' ");
            $sql->execute();
            $rows = $sql->fetchAll();                         
            for($i=0;$i < count($rows); $i++)
            { ?>
					<div class="inflatables hover-effect">
						<div class="img_thumbnail m-auto">
							<img class="img-fluid" src="https://www.motorsportweek.com/wp-content/uploads/2020/11/jm1513ma474-Custom-750x500.jpg">
						</div>
                        <div class="sc_services_item_info">
                                <div class="sc_services_item_header">
                                  <h4 class="sc_services_item_title"><a href="<?=SITEURL?>video-portfolio/<?=$rows[$i]['vc_alias']?>"><?=$rows[$i]['vc_title']?></a></h4>
                                </div>
                                <div class="sc_services_item_content">
                                  <ul class="trx_addons_list trx_addons_list_square">
                                      <?php
                                      
                                      $sql1 = $dbh1->prepare("SELECT * FROM video_project WHERE vp_active='Y' AND vp_vc_id=:vc_id");
						$sql1->bindParam(':vc_id', $rows[$i]['vc_id']);     
						$sql1->execute();
						$rows1 = $sql1->fetchAll();                         
						for($j=0;$j < count($rows1); $j++)
						{ 
						
			?>
                                    <li><?=$rows1[$j]['vp_title']?></li>
                                    <?php } ?>
                                  </ul>
                                </div>
                        </div>
						<div class="bottom_links d-flex justify-content-between">
							<div class="bottom_links1">
								<a href="<?=SITEURL?>video-portfolio/<?=$rows[$i]['vc_alias']?>"> <i class="fa fa-eye"></i> &nbsp; View All </a>
							</div>
							
						</div>
					</div>
					
					
					<?php } ?>
					

				</div>
				
				
				
			</div>	
		</div>	
	</section>
	<?php */ ?>
	
	<section class="collection-slider"  style="margin-top:20px !important;" >
		<div class="container-fluid">
			<div class="col-12">

				<div class="header-t text-center mb-3">
					<a href="<?=SITEURL?>photographic-portfolio/plane-chopper"><h1>Plane-Chopper</h1></a>
					
				</div>	

				<div class="inflatables_slider Photographic">
                    
                    
                    
                    <?php 
			$dbh1 = new PDO($dsn, $username, $password);
			$sql1 = $dbh1->prepare("SELECT * FROM photo_project WHERE pp_active='Y' AND pp_pc_id='15'");
	    
            $sql1->execute();
            $rows1 = $sql1->fetchAll(); 
            $pc_alias="plane-chopper";
            for($j=0;$j < count($rows1); $j++)
            { 	?>
                                    
                                    
                                    
                                    <div class="inflatables hover-effect">
						<div class="img_thumbnail m-auto">
							<a href="<?=SITEURL?>photographic-portfolio/<?=$pc_alias?>/<?=$rows1[$j]['pp_alias']?>"><img class="img-fluid" src="https://www.motorsportweek.com/wp-content/uploads/2020/11/jm1513ma474-Custom-750x500.jpg"></a>
						</div>
                        <div class="sc_services_item_info">
                                <div class="sc_services_item_header">
                                  <h4 class="sc_services_item_title"><a href="<?=SITEURL?>photographic-portfolio/<?=$pc_alias?>/<?=$rows1[$j]['pp_alias']?>"><?=$rows1[$j]['pp_title']?></a></h4>
                                </div>
                        </div>
						<div class="bottom_links d-flex justify-content-between">
							<div class="bottom_links1">
								<a href="<?=SITEURL?>photographic-portfolio/<?=$pc_alias?>/<?=$rows1[$j]['pp_alias']?>"> <i class="fa fa-eye"></i> &nbsp; View All </a>
							</div>
							
						</div>
					</div>
                                    <?php } ?>
                    
                    
					

				</div>	
			</div>	
		</div>	
	</section>
	
	

	<section class="collection-slider"  style="margin-top:20px !important;">
		<div class="container-fluid">
			<div class="col-12">

				<div class="header-t text-center mb-3">
					<a href="<?=SITEURL?>photographic-portfolio/drone"><h1>DRONE</h1></a>
					
				</div>	

				<div class="inflatables_slider Photographic">

					<?php 
			$dbh1 = new PDO($dsn, $username, $password);
			$sql1 = $dbh1->prepare("SELECT * FROM photo_project WHERE pp_active='Y' AND pp_pc_id='16'");
	    
            $sql1->execute();
            $rows1 = $sql1->fetchAll(); 
            $pc_alias="drone";
            for($j=0;$j < count($rows1); $j++)
            { 	?>
                                    
                                    
                                    
                                    <div class="inflatables hover-effect">
						<div class="img_thumbnail m-auto">
							<a href="<?=SITEURL?>photographic-portfolio/<?=$pc_alias?>/<?=$rows1[$j]['pp_alias']?>"><img class="img-fluid" src="https://www.motorsportweek.com/wp-content/uploads/2020/11/jm1513ma474-Custom-750x500.jpg"></a>
						</div>
                        <div class="sc_services_item_info">
                                <div class="sc_services_item_header">
                                  <h4 class="sc_services_item_title"><a href="<?=SITEURL?>photographic-portfolio/<?=$pc_alias?>/<?=$rows1[$j]['pp_alias']?>"><?=$rows1[$j]['pp_title']?></a></h4>
                                </div>
                        </div>
						<div class="bottom_links d-flex justify-content-between">
							<div class="bottom_links1">
								<a href="<?=SITEURL?>photographic-portfolio/<?=$pc_alias?>/<?=$rows1[$j]['pp_alias']?>"> <i class="fa fa-eye"></i> &nbsp; View All </a>
							</div>
							
						</div>
					</div>
                                    <?php } ?>

				</div>	
			</div>	
		</div>	
	</section>
	
	

	<section class="collection-slider"  style="margin-top:20px !important;">
		<div class="container-fluid">
			<div class="col-12">

				<div class="header-t text-center mb-3">
					<a href="<?=SITEURL?>photographic-portfolio/timelapse"><h1>TIMELAPSE</h1></a>
					
				</div>	

				<div class="inflatables_slider Photographic">

					<?php 
			$dbh1 = new PDO($dsn, $username, $password);
			$sql1 = $dbh1->prepare("SELECT * FROM photo_project WHERE pp_active='Y' AND pp_pc_id='17'");
	    
            $sql1->execute();
            $rows1 = $sql1->fetchAll(); 
            $pc_alias="timelapse";
            for($j=0;$j < count($rows1); $j++)
            { 	?>
                                    
                                    
                                    
                                    <div class="inflatables hover-effect">
						<div class="img_thumbnail m-auto">
							<a href="<?=SITEURL?>photographic-portfolio/<?=$pc_alias?>/<?=$rows1[$j]['pp_alias']?>"><img class="img-fluid" src="https://www.motorsportweek.com/wp-content/uploads/2020/11/jm1513ma474-Custom-750x500.jpg"></a>
						</div>
                        <div class="sc_services_item_info">
                                <div class="sc_services_item_header">
                                  <h4 class="sc_services_item_title"><a href="<?=SITEURL?>photographic-portfolio/<?=$pc_alias?>/<?=$rows1[$j]['pp_alias']?>"><?=$rows1[$j]['pp_title']?></a></h4>
                                </div>
                        </div>
						<div class="bottom_links d-flex justify-content-between">
							<div class="bottom_links1">
								<a href="<?=SITEURL?>photographic-portfolio/<?=$pc_alias?>/<?=$rows1[$j]['pp_alias']?>"> <i class="fa fa-eye"></i> &nbsp; View All </a>
							</div>
							
						</div>
					</div>
                                    <?php } ?>

				</div>	
			</div>	
		</div>	
	</section>
	
	
		<section class="collection-slider"  style="margin-top:20px !important;">
		<div class="container-fluid">
			<div class="col-12">

				<div class="header-t text-center mb-3">
					<a href="<?=SITEURL?>photographic-portfolio/360"><h1>360</h1></a>
					
				</div>	

				<div class="inflatables_slider Photographic">

					<?php 
			$dbh1 = new PDO($dsn, $username, $password);
			$sql1 = $dbh1->prepare("SELECT * FROM photo_project WHERE pp_active='Y' AND pp_pc_id='18'");
	    
            $sql1->execute();
            $rows1 = $sql1->fetchAll(); 
            $pc_alias="360";
            $pc_title="360";
            for($j=0;$j < count($rows1); $j++)
            { 	?>
                                    
                                    
                                    
                                    <div class="inflatables hover-effect">
						<div class="img_thumbnail m-auto">
						    
						     <?php                     
                                    $dir = UPLOAD_FILEPATH_PHOTO_IMAGES.$pc_title."/".$rows1[$j]['pp_title'] ;
                                    $dirContents = scandir($dir);
                                    $count = 0;                    
                                    foreach($dirContents as $image) {                    
                                        if (isImageFile($image)) {
                                            $path1 = READ_FILEPATH_PHOTO_IMAGES.$pc_title."/";                    
                                            $pp_title = $rows1[$j]['pp_title'] .'/';                    
                                            $imgName = $image ; ?>
                            <a href="<?=SITEURL?>photographic-portfolio/<?=$pc_alias?>/<?=$rows1[$j]['pp_alias']?>"><img src="<?=SITEURL.$path1?><?=$pp_title?><?=$imgName?>" alt="<?=$pc_title?>" title="<?=$pc_title?>" class="img-fluid" /></a>
                            <?php	  break;  $count++;
                    
                                            
                    
                                        }
                                    }
                    
                                ?>
						    
						    
							<a href="<?=SITEURL?>photographic-portfolio/<?=$pc_alias?>/<?=$rows1[$j]['pp_alias']?>"><img class="img-fluid" src="https://www.motorsportweek.com/wp-content/uploads/2020/11/jm1513ma474-Custom-750x500.jpg"></a>
						</div>
                        <div class="sc_services_item_info">
                                <div class="sc_services_item_header">
                                  <h4 class="sc_services_item_title"><a href="<?=SITEURL?>photographic-portfolio/<?=$pc_alias?>/<?=$rows1[$j]['pp_alias']?>"><?=$rows1[$j]['pp_title']?></a></h4>
                                </div>
                        </div>
						<div class="bottom_links d-flex justify-content-between">
							<div class="bottom_links1">
								<a href="<?=SITEURL?>photographic-portfolio/<?=$pc_alias?>/<?=$rows1[$j]['pp_alias']?>"> <i class="fa fa-eye"></i> &nbsp; View All </a>
							</div>
							
						</div>
					</div>
                                    <?php } ?>

				</div>	
			</div>	
		</div>	
	</section>
	
	

<!-- 	<section class="experts bg-white py-1">
		<div class="container-fluid">
			<div class="col-12">
				<div class="header-t mb-4">
					<h1>Speak with one of our experts</h1>
				</div>	

				<ul>
					<li><a href="mailto:sales@giantiflatables.com"><img src="images/email_icon_black.png"><span>sales@giantiflatables.com</span></a></li>
					<li><a href="mailto:sales@giantiflatables.com"><img src="images/chat_icon_black.png"> <span>Chat </span> </a></li>
					<li><a href="mailto:sales@giantiflatables.com"><img src="images/phone_icon_black.png"> <span>(866) 705-1595 </span> </a></li>
				</ul>
			</div>	
		</div>	
	</section> -->
<?php
	require_once 'include/footer.php';
?>
	