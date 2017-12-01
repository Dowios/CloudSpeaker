<?php session_start(); ?>
<html>

<head>

    <meta charset="utf-8" />
    
    <title>Chat</title>
    
    <link href="https://fonts.googleapis.com/css?family=Caveat+Brush|Source+Sans+Pro" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css" />
    
    <script type="text/javascript" src="../jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="chat.js"></script>
    <script type="text/javascript">
         var chat =  new Chat();
        $(document).ready(function(){
        // ask user for name with popup prompt    
            var name = '<?php echo $_SESSION['myusername']; ?>';
        
        // default name is 'Guest'
    	/*if (!name || name === ' ') {
    	   name = "Guest";	
    	}*/
    	
    	// strip tags
    	//name = name.replace(/(<([^>]+)>)/ig,"");
    	
    	// display name on page
    	    $('#name-area').append("You are: <span>" + name + "</span>");
            var chat =  new Chat();
            chat.getState(); 
    		 
    		 // watch textarea for key presses
             $("#sendie").keydown(function(event) {  
             
                 var key = event.which;  
           
                 //all keys including return.  
                 if (key >= 33) {
                   
                     var maxLength = $(this).attr("maxlength");  
                     var length = this.value.length;  
                     
                     // don't allow new content if length is maxed out
                     if (length >= maxLength) {  
                         event.preventDefault();  
                     }  
                 }  
    		 });
    		 // watch textarea for release of key press
    		 $('#sendie').keyup(function(e) {	
    		 					 
    			  if (e.keyCode == 13) { 
    			  
                    var text = $(this).val();
    				var maxLength = $(this).attr("maxlength");  
                    var length = text.length; 
                     
                    // send 
                    if (length <= maxLength + 1) { 
                     
    			        chat.send(text, name);	
    			        $(this).val("");
    			        
                    } else {
                    
    					$(this).val(text.substring(0, maxLength));
    					
    				}	
    				
    				
    			}
             });
        });
    </script>

</head>

<body onload="setInterval('chat.update()', 1000)">

    <div id="page-wrap">
        <header>
            <p id="name-area"></p>
            <br />
            <h2>Welcome to Tutorial</h2>
        </header>
        <div id="chat-wrap"><div id="chat-area">
            <?php
                $myfile = fopen("chat.txt", "r") or die("Unable to open file!");
                // Output one line until end-of-file
                while($dia = fgets($myfile)) {
                  echo "<div>".$dia."<img src=\"images/plus.png\"></img></div>";
                }
                fclose($myfile);
            ?>

            <form id="send-message-area">
                <textarea id="sendie" maxlength = '100' ></textarea>
            </form>
        </div>
    </div>
    
    </div>

</body>

</html>