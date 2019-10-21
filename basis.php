<html>

<h2>Chat</h2>
<p id='err'></p>
<p id='chat'></p>


<p id='log'>'LOG'</p>

Move:<input type = "text" id='move' />
<input type = "submit" onclick="mes()" /><br>
Player:<input type = "text" id='player' /><br>
<form action = "<?php $_PHP_SELF ?>" method = "GET">
         
</form>


<div style="position: relative;">
 <canvas id="board" width="1000" height="1000" 
   style="position: absolute; left: 0; top: 0; z-index: 0;"></canvas>
 <canvas id="pieces" width="1000" height="1000" 
   style="position: absolute; left: 0; top: 0; z-index: 1;"></canvas>
</div>
<script>
var size = 800
var line = size/8
var letters = ['A','B','C','D','E','F','G','H']
var positions = [[],[]]


var c = document.getElementById('board');
var ctx = c.getContext('2d');
ctx.globalCompositeOperation = "destination-over";
ctx.beginPath();
for(ii=0;ii<8;ii++){
    for(jj=0;jj<8;jj++){
        if((jj+ii) % 2 == 0){ctx.fillStyle = "#D8D8D8";}
        else{ctx.fillStyle = "#2E2E2E";}   
        ctx.fillRect(ii*line,jj*line,line,line);
    }
    
    ctx.font = "30px Arial";
    ctx.fillText(letters[ii], ii*line + 50, 850);
    ctx.fillText(ii + 1, 850, ii*line + 50);
    
}
ctx.closePath();
var c = document.getElementById('pieces');
var ctx = c.getContext('2d');
ctx.globalCompositeOperation = "destination-over";

positions = [['10','30','50','70', '01','21','41','61', '12','32','52','72'], ['17','37','57','77', '06','26','46','66', '15','35','55','75']];
//positions = [[[1,0],[3,0],[5,0],[7,0], [0,1],[2,1],[4,1],[6,1], [1,2],[3,2],[5,2],[7,2]], [[1,7],[3,7],[5,7],[7,7], [0,6],[2,6],[4,6],[6,6], [1,5],[3,5],[5,5],[7,5]]];
//ctx.beginPath();

function drawPieces(positions){
    ctx.fillStyle = "Red";
	ctx.beginPath();
	ctx.fill();
	ctx.moveTo(0, 0);
    for(ii=0;ii<12;ii++){
        ctx.arc(positions[0][ii][0]*line + line/2,positions[0][ii][1]*line + line/2, 45, 0, 2 * Math.PI);
        ctx.fill();
        ctx.moveTo(0, 0);
    }
    ctx.closePath();
    ctx.fill();
    ctx.beginPath();
    ctx.fillStyle = "Blue";
    for(ii=0;ii<12;ii++){
        ctx.arc(positions[1][ii][0]*line + line/2,positions[1][ii][1]*line + line/2, 45, 0, 2 * Math.PI);
        ctx.fill();
        ctx.moveTo(0, 0);
    ctx.closePath();
}
}

function move(player,x,y,X,Y){
    var val = String(X)+String(Y);
    var cur = String(x)+String(y);
    
    if(positions[player].includes(cur) == true && positions[Math.abs(player-1)].includes(val) == false) {
        positions[player][positions[player].indexOf(cur)] = val;
        ctx.clearRect(x*line,y*line,line,line);
    }
    else{return(false)};
    drawPieces(positions);
	document.getElementById('log').innerHTML = positions;
    return(true);
    
}


//function Turn(turn,input){
//    var val = input.Split(',')[0];
//    var cur = input.Split(',')[1];
//    
//    move(turn,x,y,X,Y);
//}

drawPieces(positions);
//move('0','1','0','3','3');
document.getElementById('log').innerHTML = positions;


function mes(){
   var message = document.getElementById('move').value;
   var name = document.getElementById('player').value;
   var xhttp = new XMLHttpRequest();
   xhttp.open('GET', 'canvas.php?message='+String(name)+String(message), false);
   xhttp.send();
   document.getElementById('in').value = '';}

//while(quit != true){
//    if(document.getElementById('move').input != ''){
//    turn = Math.abs(turn);
//    
//    turn = turn - 1;
//    }
//}

</script>


<?php
   $quit = False;
   
   $filename = "checkers.txt";
   $file = fopen( $filename, "a+" );

   

   if( isset($_GET["message"] )) {
   $message = $_GET["message"];
   $pickle = "01033";
   $_GET["message"] = "";
   fwrite( $file, $message . "<br>");
   fclose( $file );
   }
   $file = fopen( $filename, "r" );
   $filesize = filesize( $filename );
   $filetext = fread( $file, $filesize );
   fclose( $file );
   
   echo "<script type='text/javascript'> setInterval(function(){
   var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
       var response = this.responseText.split('<br>');
       var movement = response[response.length-2].split('');
       document.getElementById('chat').innerHTML = movement;
       move(movement[0],movement[1],movement[2],movement[3],movement[4]);
   }
   };
   xhttp.open('GET', 'checkers.txt?t=' + Math.random(), true);
   xhttp.send();},250);
   </script>";

?>

</html>