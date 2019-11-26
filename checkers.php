<html>

<h2>Play Checkers</h2>



Move:<input type = "text" id='move' />
<button id='submit'>Submit</button><br>
Player:<input type = "text" id='player' /><br>
<button id='resetButton'>Reset</button><br>   
</form>


<div style="position: relative;">
 <canvas id="board" width="1000" height="1000" 
   style="position: absolute; left: 0; top: 0; z-index: 0;"></canvas>
 <canvas id="pieces" width="1000" height="1000" 
   style="position: absolute; left: 0; top: 0; z-index: 1;"></canvas>
</div>


<?php
	$quit = False;

	$filename = "checkers.txt";
	if( isset($_POST["kill"]) && $_POST['kill'] == 'true') {
		$_POST['kill'] == '';
		$file = fopen( $filename, "w" );
		fwrite( $file, '');
		fclose( $file );
	}




	if( isset($_POST['message']) && $_POST["message"] != '') {
		$file = fopen( $filename, "a+" );
		$message = $_POST["message"];
		$_POST["message"] = "";
		fwrite( $file, $message . "<br>");
		fclose( $file );
	}
	if( isset($_POST['message'])){
		$file = fopen( $filename, "r" );
		$filesize = filesize( $filename );
		$filetext = fread( $file, $filesize );
	}

?>



<head>
<script src="checkersScript.js?t=" + Math.random()></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
	
	var size = 800;
	var line = size/8;

	var c = document.getElementById('board');
	var ctx = c.getContext('2d');
	ctx.globalCompositeOperation = "destination-over";

	var Board = new checkersBoard(ctx);

	Board.drawBoard();


	var c = document.getElementById('pieces');
	var ctx = c.getContext('2d');
	ctx.globalCompositeOperation = "destination-over";

	Board.ctx = ctx;
	Board.drawPieces();
	Board.update();
	$(function(){ 
		$("#resetButton").click(Board.resetBoard);
		$("#submit").click(Board.mes);
	
	});
	


</script>
</head>

</html>