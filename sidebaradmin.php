        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu"><!-- sidebar menu -->
            <div class="menu_section">
                <ul class="nav side-menu">
                    
					<?php
					$mes_actualx = date("m"); 
                    $anio_actualx=date("Y"); 
					$TicketData=mysqli_query($con, "select * from ticket");
					$TicketData2=mysqli_query($con, "select * from ticket_control");
                    $TicketData3=mysqli_query($con, "select * from user");
                    $TicketData4=mysqli_query($con, "select * from user where id=$codigo");
                    $TicketData5=mysqli_query($con, "select * from cobranza");
                 
                    
                    $menu =mysqli_query($con,"CALL menu('$id');");
                    
                    ?>
                            <li>
                            <a href="dashboardadmin.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                            </li>
                    <?php

                            while ($row=$menu->fetch_assoc()) {
                                $idsubmenu=$row['idmodulo'];
                               
                                $con->next_result();
                                  $submenu =mysqli_query($con,"CALL submenu('$id','$idsubmenu','1');");
                                //INICIO DE MENU   php sha1("lo que sea el linkulo que quieras.html")
                                ?>
                                
                    <li> 
                        <a href="#pageSubmenuContratos"><i class="<?php echo $row['icono']?>"></i> <?php echo $row['nombre']?></a>
						<ul class="collapse nav flex-column ms-1" id="pageSubmenuContratos" data-bs-parent="#menu"> 
                        <?php  
                                  if (!$submenu||mysqli_num_rows($submenu)!=0){
                                  while ($row_sub=$submenu->fetch_assoc()) { 
                                    //INICIO DE SUBMENU    
                        ?>
                                <li ><a href="<?php   echo $row_sub['archivo']?>?key1=<?php echo $row_sub['idsubmodulo'] ?>" class="nav-link px-0">
                                <i class="<?php echo $row_sub['icono_submodulo']?>"></i><?php echo $row_sub['nombre_submodulo'] ?> </a></li>  
                        <?php
                                    }
                               }
                                $submenu->close();
                                $con->next_result();
                        ?>
                        
                    </ul>
                    </li>  
                    <?php        
                            }
                             $menu->close(); 
                             $con->next_result();
                    ?>
                  
            
                    <li >
                        <a href="action/logout.php"><i class="fa fa-sign-out"></i> Salir</a>
                    </li>
                   
                    <br>
                    <li>
                      
                        
						<img class="thumb-image" style="width: 100%; display: block;" src="images/profiles/logo_principal.png" alt="image" />
									
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div> 
    

    <div class="top_nav">
        <div class="nav_menu">
			
            <nav>
                <div class="nav toggle">
					<a id="menu_toggle"><i class="fa fa-bars"></i></a>
				</div>
                		
                <ul class="nav navbar-nav navbar-right">
					
                    <li class="">
                    
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
							
                            <img src="images/profiles/<?php echo $profile_pic;?>" alt=""><?php echo $name;?>
                            <span class=" fa fa-angle-down"></span>
                        </a>
						
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="dashboardadmin.php"><i class="fa fa-user"></i> Mi cuenta</a></li>
                            <li><a href="action/logout.php"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div><!-- /top navigation -->    
