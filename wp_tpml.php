<?php
/*
Template Name: JSON Data Template
*/
?>

<?php

	wp_enqueue_style( 'bootstrapcdn', "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" );
	wp_enqueue_style( 'bootstrapcdn_font', "https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" );

	
	wp_enqueue_script( 'bootstrapcdn_js', "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" );

	function simpleXmlToArray($xmlObject)
	{
	    $array = [];
	    foreach ($xmlObject->children() as $node) {
	        $array[$node->getName()] = is_array($node) ? simplexml_to_array($node) : (string) $node;
	    }

	    return $array;
	}


	if(isset($_GET['api'])){

		switch ($_GET['api']) {
			case 'feed-01':
					$data = file_get_contents("https://overturehq.com/feeds/mediapage/52f876be/1417256/0/finlay-wilson.json");
					
					try {
						
						if(!$data)
						{
							die("Failed loading JSON DATA, please try again...");
						}  

						
						echo $data;

					} catch (Exception $e) {
					   header('HTTP/1.0 404 Not Found');		   
					}		

					exit(0);				
					
			case 'feed-02':
				$data = file_get_contents("http://feeds.overturehq.com/feeds/d1ada64d/1417256/6.atom");
					
					try {
						
						if(!$data)
						{
							die("Failed loading JSON DATA, please try again...");
						}  


						$xml=simplexml_load_string($data) or die("Error: Cannot create object");


						$resultArr = [];

						foreach($xml->children() as $child)
						{
						  	//echo $child->getName() . ": " . $child . "<br>";

						  	if($child->getName() == 'entry'){
						  		$resultArr[] = simpleXmlToArray($child);
						  	}
						}

						echo json_encode($resultArr);
						
						

					} catch (Exception $e) {
					   header('HTTP/1.0 404 Not Found');		   
					}		

					exit(0);														

		}
	}
	

?>

<?php get_header(); ?>

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

    	.r-images{
			display: -ms-flexbox; /* IE10 */
			display: flex;
			-ms-flex-wrap: wrap; /* IE10 */
			flex-wrap: wrap;
			padding: 0 4px;
    	}

    	/* Create four equal columns that sits next to each other */
		.r-images .column {
		  -ms-flex: 25%; /* IE10 */
		  flex: 25%;
		  max-width: 25%;
		  padding: 0 4px;
		}

		.r-images .column img {
		  margin-top: 8px;
		  vertical-align: middle;
		  width: 100%;
		}

		/* Responsive layout - makes a two column-layout instead of four columns */
		@media screen and (max-width: 800px) {
		  .r-images .column {
		    -ms-flex: 50%;
		    flex: 50%;
		    max-width: 50%;
		  }
		}

		/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
		@media screen and (max-width: 600px) {
		  .r-images .column {
		    -ms-flex: 100%;
		    flex: 100%;
		    max-width: 100%;
		  }
		}

		.content-area{
			width: 100%;	
			overflow-y: auto;	    
		}


		.content-area:empty::after{
			content: "";
			display: block;
			width: 100%;
			height: 100%;
			border-radius: 6px;
			box-shadow: 0 10px 45px rgba(0, 0, 0, 0.1);

			background-repeat: no-repeat;
			background-image: 		    	

				linear-gradient(90deg, 
					rgba(211, 211, 211, 0.1) 100%, 
					rgba(211, 211, 211, 0.7) 30%, 
					rgba(211, 211, 211, 0.5) 20%, 
					rgba(211, 211, 211, 0.3) 5%, 
					rgba(211, 211, 211, 0.1) 3%, 
					rgba(211, 211, 211, 0) 2%),
				linear-gradient(#f8f9fa 100%, transparent 0);

			background-size: 
				0 100%,
				100% 100%;
			background-position: 
				0 0,
				0 0;

			-webkit-animation: loading 1.5s infinite;
			animation: loading 1.5s infinite;
		}

		#bio.content-area:empty::after{
			height: 500px;
		}

		#bio{
			margin-bottom: 20px;
		}

		#images.content-area{
			height: 500px;
		}

		#videos.content-area{
			height: 450px;
		}

		#links.content-area{
			height: 400px;
		}

		#documents.content-area{
			height: 300px;
		}

		#events .event {
			float: left;
			padding:5px;
		}

		#events .card {			
			width: 100%;
			height: 100%;
		}

		#events .card .table {
			font-size: 14px;
		}

		#events .card .card-body {
			overflow-y: auto;
		}

		.event a.showmore{
			text-decoration: none;
			font-size: small;
		}

		.event a.showmore[aria-expanded='true'] > .sm {
			display: none;
		}

		.event a.showmore[aria-expanded='true'] > .sl {
			display: block;
		}

		.event a.showmore[aria-expanded='false'] > .sm{
			display: block;
		}

		.event a.showmore[aria-expanded='false'] > .sl{
			display: none;
		}


		@-webkit-keyframes loading {
		  to {
		    /*background-position: 350% 0, 0 0;*/
		    background-size: 100% 100%;
		  }
		}

		@keyframes loading {
		  to {
		    /*background-position: 350% 0, 0 0;*/
		    background-size: 100% 100%;
		  }
		}

		figure {
		  margin: 6px auto;
		  width: 128px;
		  height: 111px;
		  background-color: #ffffff;
		  border-radius: 10px;
		  position: relative;
		}
		figure:before {
		  content: '';
		  display: block;
		  width: 128px;
		  height: 69px;
		  border-radius: 10px 10px 0 0;
		  background-image: -webkit-linear-gradient(white 0%, #edeeef 100%);
		  background-image: -moz-linear-gradient(white 0%, #edeeef 100%);
		  background-image: -o-linear-gradient(white 0%, #edeeef 100%);
		  background-image: linear-gradient(white 0%, #edeeef 100%);
		}
		figure header {
		  width: 128px;
		  height: 27px;
		  position: absolute;
		  top: -1px;
		  background-color: #fa7956ed;
		  border-radius: 10px 10px 0 0;
		  border-bottom: 3px solid #e5e5e5;
		  font: 400 15px/27px Arial, Helvetica, Geneva, sans-serif;
		  letter-spacing: 0.5px;
		  color: #fff;
		  text-align: center;
		}
		figure section {
		  width: 128px;
		  height: 80px;
		  position: absolute;
		  top: 28px;
		  font: 400 55px/75px "Helvetica Neue", Arial, Helvetica, Geneva, sans-serif;
		  letter-spacing: -2px;
		  color: #4c566b;
		  text-align: center;
		  z-index: 10;
		}
		figure section:before {
		  content: '';
		  display: block;
		  position: absolute;
		  top: 35px;
		  width: 3px;
		  height: 10px;
		  background-image: -webkit-linear-gradient(#b5bdc5 0%, #e5e5e5 100%);
		  background-image: -moz-linear-gradient(#b5bdc5 0%, #e5e5e5 100%);
		  background-image: -o-linear-gradient(#b5bdc5 0%, #e5e5e5 100%);
		  background-image: linear-gradient(#b5bdc5 0%, #e5e5e5 100%);
		}
		figure section:after {
		  content: '';
		  display: block;
		  position: absolute;
		  top: 35px;
		  right: 0;
		  width: 3px;
		  height: 10px;
		  background-image: -webkit-linear-gradient(#b5bdc5 0%, #e5e5e5 100%);
		  background-image: -moz-linear-gradient(#b5bdc5 0%, #e5e5e5 100%);
		  background-image: -o-linear-gradient(#b5bdc5 0%, #e5e5e5 100%);
		  background-image: linear-gradient(#b5bdc5 0%, #e5e5e5 100%);
		}

		.main-panel {
			display: flex;
		}

		.right-panel{
			padding-left: 15px;
    		padding-top: 5px;
		}
    </style>

  	<div class="container">
		  <!-- Content here -->
		  <div class="row">
			  <div class="col-xl-9 col-lg-8 col-md-6 col-sm-12">
			  	<h2>Finaly Wilson</h2>

			  	<div class="content-area " id="bio"></div>
			  	

			  	<h4>Images</h4>
			  	
			  		<div class="r-images content-area " id="images"></div>
		  		
			  </div>
			  <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">
			  	<h4>Videos</h4>
			  	<div class="content-area " id="videos"></div>

				<h4>Links</h4>

				<div class="content-area " id="links"></div>

				<h4>Documents</h4>

				<div class="content-area " id="documents"></div>

			  </div>  	
		  </div>
		  <div class="row">
		  		
				<div class="content-area " id="events"></div>
		  </div>
	</div>
    
	<script type="text/javascript">
		window.onload = function(){

		}

			var serialize = function(obj) {
			  var str = [];
			  for (var p in obj)
			    if (obj.hasOwnProperty(p)) {
			      str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
			    }
			  return str.join("&");
			}





			fetch(`?${serialize({api: 'feed-01'})}`, {
				method: 'GET'				
			}).then( (res) =>{
				return res.json();
			} ).then( (data) => {
			   		console.log("2",data);
			   		// bio
			   		let txts = data.biog.split("\n");
			   		for (var i = 0; i < txts.length; i++) {
			   			txts[i] == ""? txts[i] = "</p><p>":null;
			   		}

			   		document.getElementById('bio').innerHTML = `<p>${txts.join("")}</p>`;


			   		// documents
			   		let html = '';
			   		data.documents.forEach(function(doc){			   			
			   			
			   			html += `<div><a href="${doc.file}">${doc.title}</a><p>${doc.description}</p></div>`
			   		});
			   		document.getElementById('documents').innerHTML = html;		

			   		html = '';
			   		// links
			   		data.links.forEach(function(lin){			   			
			   			
			   			html += `<div><a href="${lin.file}">${lin.title}</a><p>${lin.description}</p></div>`
			   		});
			   		document.getElementById('links').innerHTML = html;		

			   		// parse videos and images
			   		let videos = [];
		  			let images = [];

		  			data.images.forEach(function(img) {		  				
		  				if(img.fullsize !== undefined && img.fullsize.includes('www.youtube.com/embed/')){
		  					videos.push({'thumbnail' : img.thumbnail.split('mediapages/')[1]});
		  				}else{
		  					images.push(img);		  					
		  				}		  				
		  			});


		  			html = '';
		  			// videos
			   		videos.forEach(function(vid){			   			
			   			html += `<div class="embed-responsive embed-responsive-4by3"><iframe class="embed-responsive-item" src="${vid.thumbnail}" allowfullscreen></iframe></div>`;
			   		});

			   		document.getElementById('videos').innerHTML = html;				

			   		// images

	  				let $i = 0;
	  				let $t = true;
	  				let $c = Math.ceil(images.length/4);
	  				let $d = images.length % $c;
	  				let $h = [];
	  				
	  				html = '';
	  				while($i != images.length) {
	  					$img = images[$i];	

	  					if(((!$t &&  ( $i % $c == $c - 1)) )  && $i != images.length - 1){
	  						if($d > 0){
	  							$i++;
	  							$d--;
	  							html += '</div>';
	  							$t = true;
	  							$h.push($img);
	  							continue;
	  						}
	  					}
	  					

	  					if($t && ($i % $c == 0)){
	  						html += '<div class="column">';
	  						$t = false;	
	  					}

							  					

	  					html += `<a href="${$img.fullsize}"><img height="auto" src="${$img.fullsize}" alt="${$img.title}"></a>`;

	  					if($i == images.length - 1){
	  						$h.forEach(function(_$img){
								html += `<a href="${_$img.fullsize}"><img height="auto" src="${_$img.fullsize}" alt="${_$img.title}"></a>`;	  							
	  						});
	  					}

	  					if( ((!$t &&  ( $i % $c == $c - 1)) ) || $i == images.length - 1){

	  						html += '</div>';
	  						$t = true;
	  					}
	  					
	  					$i++;


	  					
	  				}

	  				
	  				document.getElementById('images').innerHTML = html;					
					
			} ).catch((error) => {
			   		console.error(error);
			    	let html = 'Faile to load data';

			    	
			    	document.getElementById('documents').innerHTML = html;
			    	
			    	document.getElementById('links').innerHTML = html;
			    	
			    	document.getElementById('videos').innerHTML = html;
			}); 		


			fetch(`?${serialize({api: 'feed-02'})}`, {
				method: 'GET'				
			}).then( (res) =>{
				return res.json();
			} ).then( (data) => {

			   		console.log("1",data);

			   		let html = ''; 
			   		
		   			for (var i = 0; i < data.length; i++) {
		   				let ev = data[i];
		   				let state = '';

		   				let gigatools = ev.gigatools.split(',');

		   				ev.state = gigatools[2].trim();
		   				ev.country = gigatools[3].trim();


		   				if( ev.state == '' && ev.country){
		   					state = ev.country;
		   				}else if(ev.state && ev.country == ''){
		   					state = ev.state;
		   				}else if(ev.state && ev.country) {
		   					
		   					state = ev.state + ', ' + ev.country;
		   				}
		   				let regexp = /\d{1,2}\/\d{1,2}\/\d{2}/g;
		

						let date_array = [...ev.title.matchAll(regexp)];

						let sd = null;

						if(date_array[0]){

							let date_obj = new Date(date_array[0]);
			   				date_obj = date_obj.toDateString().split(" ");

			   				sd = {
			   					dd: date_obj[0],
			   					month: date_obj[1],
			   					day: date_obj[2],
			   					year: date_obj[3]
			   				}

						}


						let ed = null;

		   				if(date_array[1]){
			   							   				
			   					let e_date_obj = new Date(date_array[1]);
			   					e_date_obj = e_date_obj.toDateString().split(" ");
			   					
			   					ed = {
			   						dd: e_date_obj[0],
			   						month: e_date_obj[1],
			   						day: e_date_obj[2],
			   						year: e_date_obj[3]
			   					}
			   		   					
		   				}


		   				const get_date_string = function(d){
		   					return `${d.dd}, ${d.month} ${d.day}`;
		   				};

		   				// <div><i class="fa fa-clock-o"></i>${ev.time?ev.time:''}</div>
		   				let summaryhtml = '';
		   				if(ev.summary){
		   					summaryhtml = `<a class="showmore" data-toggle="collapse" href="#summary${ev.id}" role="button" aria-expanded="false">
											   	<span class="sm">Show more</span><span class="sl">Show less</span>
											</a>
											<div class="collapse" id="summary${ev.id}">
											  <p>
											    ${ev.summary}
											  </p>
											</div>`;
		   				}

		   				html += `<div class="event col-sm-12">
		   								<div class="card" style="background-color: #f8f9fa;">
										  <div class="card-body">
										  	<div class="main-panel">
										  		<div class="left-panel">
													<figure>
														<header>
															${sd.month}
														</header>
														<section>
															${sd.day}
														</section>
													</figure>
										  		</div>
										  		<div class="right-panel">
										  			<h5 class="card-title" id="${ev.id}">${ev.eventname} ${state?' - ' + state:''}</h5>
													<div><i class="fa fa-calendar-check-o"></i>&nbsp;${get_date_string(sd)} ${ed? '~ '+get_date_string(ed):''}</div>
													${ev.address?'<div><i style="padding: 1px 3px;" class="fa fa-map-marker"></i>&nbsp;<span>'+ev.address+'</span></div>':''}
													${ev.registrationlink? '<div><a href="'+ev.registrationlink+'"><i class="fa fa-chain"></i><span> ' +ev.registrationlink + '</a> </span></div>' :''}
													${summaryhtml?summaryhtml:''}										
										  		</div>
										  	</div>
											
										  </div>
										</div></div>`;	
		   			}

	


					document.getElementById('events').innerHTML = '<h2 class="text-center">Events</h2>' + html;		

			} ).catch((error) => {
				console.error(error);
			    	alert( "error" );	
			    	document.getElementById('events').append('Failed to load data');
			}); 			
	</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>