<?php
	session_start();
	include 'connect.php';
	$_SESSION['message']='';
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
			$i_name=$_POST['i_name'];
			$category=$_POST['category'];
			$i_desc = $_POST['i_desc'];			
			$Pathimg='../images/iupload/'.$_FILES['img']['name'];
			$color = $_POST['color'];
			$size=$_POST['size'];
			$price = $_POST['price'];
			$discount=$_POST['discount'];
			
			$i_name = mysqli_real_escape_string($db,$i_name);
			$category = mysqli_real_escape_string($db,$category);
			$i_desc = mysqli_real_escape_string($db,$i_desc);
			$Pathimg = mysqli_real_escape_string($db,$Pathimg);
			$color = mysqli_real_escape_string($db,$color);
			$size = mysqli_real_escape_string($db,$size);
			$price = mysqli_real_escape_string($db,$price);
			$discount = mysqli_real_escape_string($db,$discount);
			
			
				if(copy($_FILES['img']['tmp_name'],$Pathimg)){
					$_SESSION['i_name']=$i_name;
					$_SESSION['category']=$category;
					$_SESSION['i_desc']=$i_desc;
					$_SESSION['Pathimg']=$Pathimg;
					$_SESSION['color']=$color;
					$_SESSION['size']=$size;
					$_SESSION['price']=$price;
					$_SESSION['discount']=$discount;
					
					$sql="INSERT INTO item(itemName,category,itemDesc,image,availableColors,availableSize,price,discount)
							VALUES('$i_name','$category','$i_desc','$Pathimg','$color','$size','$price','$discount')";
					if(mysqli_query($db,$sql)){
						$_SESSION['message']="Successfully Inserted";
						header("location: AddItems.php");
					}
					else{
						$_SESSION['message']="Something is wrong";
					}
				}
				else{
					$_SESSION['message']="File Upload fail";
				}
			
			}
		
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Items</title>
		<link rel="stylesheet" href="../css/main.css" />
		<link rel="stylesheet" href="../css/item.css"/>
	 <link rel="stylesheet" href="../others/icons/css/all.css"/> 
</head>

<body>
<nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="../images/logo.png" alt="LOGO">
                </span>

                <div class="text logo-text">
                    <span class="name">Miss Fashion</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links">
                    
                    <li class="nav-link">
                        <a href="dashboard.php">
                            <i class="fa-brands fa-sketch"></i>
							<i></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
					
					<li class="nav-link">
                        <a href="AdminPanal.php">
                            <i class="fa-solid fa-user"> </i>
                            <span class="text nav-text"> Admin Panal</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="RegisterForm.php">
							<i class="fa-solid fa-registered"></i>
                            <span class="text nav-text">Register</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="AddItems.php">
                            <i class="fa-solid fa-images"></i>
                            <span class="text nav-text">Update Images</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="viewItems.php">
                            <i class="fa-solid fa-image"></i>
                            <span class="text nav-text">Display Images</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="logout.php">
						<i class="fa-solid fa-right-from-bracket"></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                
                
            </div>
        </div>

    </nav>

<section class="home">
	<center>
		<h1>Add New Items</h1>
	</center>
	<div class = "form">	
	<?php
		echo($_SESSION['message']);
	?>
	<form action="" method="post" enctype = "multipart/form-data" >

	<?php
		if(isset($error)){
		foreach($error as $error){
		echo '<span class = "error-msg">' .$error. '</span>';
		};
		};
	?>
	
	<table class ="ftable">
		<tr>
			<th><label for="i_name">Item Name : </label></th>
			<td><input type="text" name="i_name" required placeholder="Item Name"></td>
		</tr>
		
		<tr>
			<th><label for="category">Category : </label></th>
			<td><input type="text" name="category" required placeholder="Men, Women, Kids"></td>
		</tr>
				
		<tr>
			<th><label for="i_desc">Item Description : </label></th>
			<td><input type="text" name="i_desc" required placeholder="Item Description"></td>
		</tr>
						
								
		<tr>
			<th><label for="img">Upload Image : </label></th>
			<td><input type ="file" name ="img" accept=".jpg, .jpeg"></td>
		</tr>
						
		<tr>
			<th><label for="color">Available Colors:</label></th>
				<td><input type="text" name="color" required placeholder="Dress Color"></td>
		</tr>
						
		<tr>
			
			<th><label for="size">Available Size:</label></th>
			<td><input type="text" name="size" required placeholder="Dress Sizes"></td>
			
		</tr>
			</td>
		</tr>
						
		<tr>
			<th><label for="price">Dress Price : </label></th>
			<td><input type="text" name="price" required placeholder="Dress Price"></td>
			
		</tr>
						
		<tr>
			<th><label for="discount">Discount : </label></th>
			<td><input type="text" name="discount" required placeholder="Dress Price"></td>
		</tr>
						
		<tr class ="btn">
			<div class="inputBox">
			<th><input type="reset" name="reset" value="Reset"></th>
			</div>
							
			<div class="inputBox">
			<th><input type="submit" name="submit" value="Submit"></th>
			</div>
		</tr>
	</table>
	</form>
</section>
   <script>
        const body = document.querySelector('body'),
		sidebar = body.querySelector('nav'),
		toggle = body.querySelector(".toggle"),
		searchBtn = body.querySelector(".search-box"),
		modeSwitch = body.querySelector(".toggle-switch"),
		modeText = body.querySelector(".mode-text");


toggle.addEventListener("click" , () =>{
    sidebar.classList.toggle("close");
})

searchBtn.addEventListener("click" , () =>{
    sidebar.classList.remove("close");
})

</script>
</body>
</html>