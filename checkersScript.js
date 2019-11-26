
class checkersBoard {
	
	constructor(ctx){
		this.positions = [['10','30','50','70', '01','21','41','61', '12','32','52','72'], ['17','37','57','77', '06','26','46','66', '15','35','55','75']];
		this.positionsDefault = [...this.positions];
		this.ctx = ctx;
		this.letters = ['A','B','C','D','E','F','G','H'];
		
	}
	
	drawPieces(){
		var ii = 0;
		var jj = 0;
		for(ii=0;ii<12;ii++){
			for(jj=0;jj<12;jj++){
				this.ctx.clearRect(ii*line,jj*line,line,line);
			}
		}
		
		this.ctx.fillStyle = "Red";
		this.ctx.beginPath();
		this.ctx.fill();
		this.ctx.moveTo(0, 0);
		var ii = 0;
		for(ii=0;ii<12;ii++){
			this.ctx.arc(this.positions[0][ii][0]*line + line/2,this.positions[0][ii][1]*line + line/2, 45, 0, 2 * Math.PI);
			this.ctx.fill();
			this.ctx.moveTo(0, 0);
		}
		this.ctx.closePath();
		this.ctx.fill();
		this.ctx.beginPath();
		this.ctx.fillStyle = "Blue";
		for(ii=0;ii<12;ii++){
			this.ctx.arc(this.positions[1][ii][0]*line + line/2,this.positions[1][ii][1]*line + line/2, 45, 0, 2 * Math.PI);
			this.ctx.fill();
			this.ctx.moveTo(0, 0);
		this.ctx.closePath();
		}
		
	}

	move(player,x,y,X,Y){
		var val = String(X)+String(Y);
		var cur = String(x)+String(y);
		if(this.positions[player].includes(cur) == true && this.positions[Math.abs(player-1)].includes(val) == false && Math.abs(val[0] - cur[0]) + Math.abs(val[1] - cur[1]) == 2) {
			this.positions[player][this.positions[player].indexOf(cur)] = val;
			this.ctx.clearRect(x*line,y*line,line,line);
		}
		else{return(this.positions)};
		this.drawPieces();
		return(this.positions);
		
	}
		
	drawBoard(){
		this.ctx.beginPath();
		var ii = 0;
		var jj = 0;
		for(ii=0;ii<8;ii++){
			for(jj=0;jj<8;jj++){
				if((jj+ii) % 2 == 0){ctx.fillStyle = "#D8D8D8";}
				else{ctx.fillStyle = "#2E2E2E";}   
				this.ctx.fillRect(ii*line,jj*line,line,line);
			}
			
			this.ctx.font = "30px Arial";
			this.ctx.fillText(this.letters[ii], ii*line + 50, 850);
			this.ctx.fillText(ii + 1, 850, ii*line + 50);
			
		}
		this.ctx.closePath();
	}

	update(){
		function connect(board){
			$(function(){$.get('checkers.txt', function(data,status){
				if(status == 'success'){
					this.board = board;
					this.positionsDefault = [['10','30','50','70', '01','21','41','61', '12','32','52','72'], ['17','37','57','77', '06','26','46','66', '15','35','55','75']];
					var response = data.split('<br>');
					var index = 0;
					for(index = 0; index < response.length -1 && response.length >= 2; index++){
						var movement = response[index].split('');
						this.board.move(movement[0],movement[1],movement[2],movement[3],movement[4],this.board.positions);
						
					}
					
					if(response.length < 2){this.board.positions = this.positionsDefault.slice(0);}
					
					this.board.drawPieces();
				}
			});});
		}
		setInterval(connect,50, this);
		
	}
	
	mes(){
		var moveCoord = String(document.getElementById('move').value);
		var name = String(document.getElementById('player').value);
		$(function(){$.post('canvas.php',{message:name+moveCoord}, function(data,status){});});
		document.getElementById('move').value = '';
		document.getElementById('player').value = '';
	}
	
	
	resetBoard(){
		$(function(){$.post('canvas.php',{kill:'true'},function(data,status){});});
		
		
		
	}
	}