<?php

	$data = file_get_contents("https://overturehq.com/feeds/mediapage/52f876be/1417256/0/finlay-wilson.json");
	
	try {
		
		if(!$data)
		{
			die("Failed loading JSON DATA, please try again...");
		}  

		$data = json_decode($data);

	} catch (Exception $e) {
	   die($e->getMessage());
	}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Demo</title>

    <style type="text/css">
    	p {margin:0;}
    	.embed-responsive {
    		margin-bottom: 10px;

    	}
    	h4 {
    		margin-top: 10px;
    	}
    	body {
    		margin-top: 30px;
    		margin-bottom: 30px;
    	}
    </style>
  </head>
  <body>
    <div class="container">
	  <!-- Content here -->
	  <div class="row">
		  <div class="col-xl-9 col-lg-8 col-md-6 col-sm-12">
		  	<h4>Blog</h4>
		  	<p>
		  	<?php echo $data->biog; ?>	  		
		  	</p>

		  	<h4>Image Links</h4>
		  	<div class="col-sm-12">
		  		<?php
		  		$Videos = [];
		  			foreach ($data->images as $key => $img) {
		  				
		  				if(strpos($img->fullsize, 'www.youtube.com/embed/') !== false ){

		  					$Videos[] = array(
		  						//'fullsize' => explode('mediapages/', $img->fullsiez)[1],
		  						'thumbnail' => explode('mediapages/', $img->thumbnail)[1],
		  					);
		  				}else{
		  					# code...
		  					echo '<a href="'.$img->fullsize.'"><img height="auto" src="'.$img->thumbnail.'" alt="'.$img->title.'" class="img-thumbnail col-xl-2 col-lg-3 col-md-4 col-sm-12"></a>';
		  				}
		  				
		  				
		  			}
		  		?>			  
	  		</div>
		  </div>
		  <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
		  	<h4>Video Links</h4>

		  	<?php 
		  		foreach ($Videos as $key => $vid) {
		  			echo '<div class="embed-responsive embed-responsive-4by3">'.
							  '<iframe class="embed-responsive-item" src="'.$vid['thumbnail'].'" allowfullscreen></iframe>'.
						  '</div>';
		  		}
		  	?>


			<h4>Links</h4>

			<?php
				foreach ($data->links as $key => $lin) {
					# code...
					echo '<div>'.
								'<a href="'.$lin->file.'">'.$lin->title.'</a>'.
								'<p>'.$lin->description.'</p>'.
						 '</div>';
				}
			?>

			<h4>Document Links</h4>

			<?php
				foreach ($data->documents as $key => $doc) {
					# code...
					echo '<div>'.
								'<a href="'.$doc->file.'">'.$doc->title.'</a>'.
								'<p>'.$doc->description.'</p>'.
						 '</div>';
				}
			?>
		  </div>  	
	  </div>
	  <div class="row">
	  	

	  </div>

	</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>