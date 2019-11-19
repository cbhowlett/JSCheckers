<html>

<h2>Play Checkers</h2>



Move:<input type = "text" id='move' />
<input type = "submit" onclick="Board.mes()" /><br>
Player:<input type = "text" id='player' /><br>
<form action = "<?php $_PHP_SELF ?>" method = "GET">
<input type = "Reset" onclick="Board.resetBoard()" /><br>      
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

	if( isset($_GET["kill"] )) {
		$file = fopen( $filename, "w" );
		fwrite( $file, '');
		fclose( $file );
	}

	$file = fopen( $filename, "a+" );



	if( isset($_GET["message"] )) {
	$message = $_GET["message"];
	$_GET["message"] = "";
	fwrite( $file, $message . "<br>");
	fclose( $file );
	}
	$file = fopen( $filename, "r" );
	$filesize = filesize( $filename );
	$filetext = fread( $file, $filesize );

?>



<head>
<script src="checkersScript.js"></script>
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


</script>
</head>

</html>