var Canvas , ctx , img ;

window.onload = function(){
	drawBg1();
	//drawBall();
}

function drawBg1(){
	Canvas = document.getElementById("canvas1");
	ctx = Canvas.getContext("2d");
	ctx.fillStyle = "lightblue";
	ctx.fillRect(0,0,Canvas.width,Canvas.height);
	img = document.getElementById("belt");
	ctx.drawImage(img,150,0,100,50);
	ctx.drawImage(img,550,0,100,50);
	ctx.strokeStyle = "black";
	ctx.strokeRect(0,0,400,600);
	ctx.strokeRect(400,0,400,600)
	ctx.fillStyle = "silver";
	ctx.fillRect(0,500,399,100);
	ctx.fillRect(100,50,200,50);
	ctx.fillStyle = "gold";
	ctx.fillRect(401,500,399,100);
	ctx.fillRect(500,50,200,50);
	
	drawButton();
}

function drawBg2(){
	Canvas = document.getElementById("canvas1");
	ctx = Canvas.getContext("2d");
	ctx.fillStyle = "lightblue";
	img = document.getElementById("belt");
	ctx.drawImage(img,150,0,100,50);
	ctx.drawImage(img,550,0,100,50);
	ctx.strokeStyle = "black";
	ctx.strokeRect(0,0,400,600);
	ctx.strokeRect(400,0,400,600)
	ctx.fillStyle = "silver";
	ctx.fillRect(100,50,200,50);
	ctx.fillStyle = "gold";
	ctx.fillRect(500,50,200,50);
}

var ballH=0,ballT=0,ballAnime,ballV,ballU,ballG , matePx=100;
function drawBall(){
	ballH = 50 ; ballT = 0 ; ballV = 0 ; ballU = 0 , ballG=10  ;
	ballAnime = setInterval(ballMove,10);
}

function ballMove(){
	drawBg1();
	ctx.fillStyle = "red";
	console.log("run");
	
	if(ballG==-10){
		ballV=ballU+ballG*0.01;
		ballH-=(ballV*0.01)*(matePx);
		ballT-=0.01;
	}else if(ballG==10){
		ballV=ballU+ballG*0.01;
		ballH+=(ballV*0.01)*(matePx);
	}
	
	ballU=ballV;
	
	if(ballH>450){
		ballU=ballV*0.7;
		ballT = ballU/ballG;
		ballV = 0;
		ballG = -10;
		
	}else if(ballT<0){
		ballV = 0;
		ballG = 10;
	}
	
	ctx.beginPath();
	ctx.arc(200,ballH,50,0,2*Math.PI);
	ctx.fill();
	
	drawBg2();
	
	if(ballH>452){
		clearInterval(ballAnime);
	}
	
}

var clickedX,clickedY ,gachaSilver=0,gachaGold=0,swShowItem=0;
window.onclick = function(){
	clickedX = event.pageX;
	clickedY = event.pageY;
	console.log(clickedX+"||"+clickedY);
	if(gachaSilver==0&&gachaGold==0){
		if(clickedX>=300&&clickedX<=390&&clickedY>=525&&clickedY<=565){
			buttonGachaSilver();
		}
	}
	else if(gachaSilver==1){
		if(Math.pow(clickedX-200,2)+Math.pow(clickedY-ballH,2)<=50*50){
			showItemSilver();
		}
		if(swShowItem==1&&clickedX>=325&&clickedX<=475&&clickedY>=450&&clickedY<=530){
			swShowItem=0
			gachaSilver=0;
			drawBg1();
		}
	}
}

function drawButton(){
	Canvas = document.getElementById("canvas1");
	ctx = Canvas.getContext("2d");
	ctx.fillStyle = (gachaSilver==0)? "red":"darkred";
	
	ctx.fillRect(300,525,90,40);
	
	ctx.fillStyle = "black";
	ctx.font = "bold 16px Arial"
	ctx.textAlign = "center";
	ctx.fillText("Start",345,550);
}

function buttonGachaSilver(){
	gachaSilver=1;
	Canvas = document.getElementById("canvas1");
	ctx = Canvas.getContext("2d");
	randomItem();
	drawBall();
}

var itemId = [1,1,1,1,2,2,2,2,3,3,3,4,4,4,5,5,6,6,7,8];
var getItem ;
var nameSvItem = ["item1","item2","item3","item4","item5","item6","item7","item8"];
function randomItem(){
	getItem = itemId[Math.floor(Math.random()*itemId.length)];
}

function showItemSilver(){
	swShowItem = 1 ;
	Canvas = document.getElementById("canvas1");
	ctx = Canvas.getContext("2d");
	
	clearInterval(ballAnime);
	ctx.fillStyle = "Moccasin";
	ctx.fillRect(50,50,700,500);
	ctx.fillStyle = "lightgrey";
	ctx.fillRect(325,450,150,80);
	ctx.fillStyle = "black";
	ctx.font = "bold 28px Arial"
	ctx.textAlign = "center";
	ctx.fillText("OK",400,500);
	
	img = document.getElementById("svItem"+getItem);
	ctx.drawImage(img,250,70,300,300);
	ctx.fillStyle = "Blue";
	ctx.font = "bold 36px Arial"
	ctx.textAlign = "center";
	ctx.fillText(nameSvItem[getItem-1],400,425);
	

}