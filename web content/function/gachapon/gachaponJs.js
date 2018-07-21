var Canvas , ctx , img ;

window.onload = function(){
	drawBg1();
	drawBg2();
}

function drawBg1(){
	Canvas = document.getElementById("canvas1");
	ctx = Canvas.getContext("2d");
	ctx.fillStyle = "lightblue";
	ctx.fillRect(0,0,Canvas.width,Canvas.height);
	ctx.fillStyle = "LightSteelBlue";
	ctx.fillRect(0,500,399,100);
	ctx.fillStyle = "GoldenRod";
	ctx.fillRect(401,500,399,100);
	
	drawButton();
}

var nSvCoin = 99 , nGdCoin = 99 ;
function drawBg2(){
	Canvas = document.getElementById("canvas1");
	ctx = Canvas.getContext("2d");
	img = document.getElementById("belt");
	ctx.drawImage(img,150,0,100,50);
	ctx.drawImage(img,550,0,100,50);
	ctx.fillStyle = "LightSteelBlue";
	ctx.fillRect(100,50,200,50);
	ctx.fillStyle = "GoldenRod";
	ctx.fillRect(500,50,200,50);
	
	img = document.getElementById("glass");
	ctx.drawImage(img,0,0,400,502);
	img = document.getElementById("glass");
	ctx.drawImage(img,400,0,400,502);
	
	img = document.getElementById("svCoin");
	ctx.drawImage(img,20,510,80,80);
	img = document.getElementById("gdCoin");
	ctx.drawImage(img,420,510,80,80);
	
	ctx.strokeStyle = "black";
	ctx.strokeRect(0,0,400,600);
	ctx.strokeRect(400,0,400,600);
	
	ctx.fillStyle = "Violet"
	ctx.font = "bold 56px Arial"
	ctx.textAlign = "left";
	ctx.fillText(nSvCoin,160,570);
	ctx.fillText(nGdCoin,560,570);
	ctx.textAlign = "center";
	
	ctx.beginPath();
	ctx.moveTo(120,540);
	ctx.lineTo(140,560);
	ctx.moveTo(140,540);
	ctx.lineTo(120,560);
	
	ctx.moveTo(520,540);
	ctx.lineTo(540,560);
	ctx.moveTo(540,540);
	ctx.lineTo(520,560);
	ctx.stroke();
}

var ballX=0,ballH=0,ballT=0,ballAnime,ballV,ballU,ballG , matePx=100 , iKisball=0 , ballXmove = 0 ,tempBH ,waitBelt;
function drawBall(){
	ballX = (gachaSilver==1)? 200 : 600 ;
	ballH = 50 ; ballT = 0 ; ballV = 0 ; ballU = 0 , ballG=10 ,tempBH=0,ballXmove=0;
	waitBelt = 150;
	iKisball = Math.floor(Math.random()*6)
	var sndBelt = new Audio("sound/belt.mp3");
	sndBelt.play();
	ballAnime = setInterval(ballMove,10);
	
}

var sndB ;//= new Audio("sound/ball.mp3");
function ballMove(){
	drawBg1();
	ctx.fillStyle = "red";
	console.log("run");
	if(waitBelt>0){
		beltMove();
		waitBelt--;
		return ;
	}
	
	if(ballXmove==0&&ballH>95){
		ballXmove = Math.random()*4;
		ballXmove *= ((Math.random()*2)<1)? 1 : -1 ;
	}
	
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
		
		var snd2 = document.getElementById("ballsnd");
		snd2.play();
		ballU=ballV*0.7;
		ballT = ballU/ballG;
		ballV = 0;
		ballG = -10;
		
	}else if(ballT<0){
		ballV = 0;
		ballG = 10;
	}
	
	if(gachaSilver==1){
		if(ballX+ballXmove>350||ballX+ballXmove<50){
			ballXmove*=-1;
			sndB = new Audio("sound/ball.mp3");
			sndB.play();
		}
	}else{
		if(ballX+ballXmove>750||ballX+ballXmove<450){
			ballXmove*=-1;
			sndB = new Audio("sound/ball.mp3");
			sndB.play();
		}
	}
	ballX+=ballXmove;
	
	img = (gachaSilver==1)? document.getElementById("kisball"+(Math.floor(iKisball)+1)):
	document.getElementById("kisballg"+(Math.floor(iKisball)+1));
	ctx.drawImage(img,ballX-50,ballH-50,100,100);
	iKisball = (iKisball<5)? iKisball+0.1:0;
	
	
	//ctx.fillStyle = (gachaSilver==1)? "Red" : "Blue" ;
	//ctx.beginPath();
	//ctx.arc(ballX,ballH,50,0,2*Math.PI);
	//ctx.fill();
	
	drawBg2();
	
	if(ballH>451){
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
		else if(clickedX>=700&&clickedX<=790&&clickedY>=525&&clickedY<=565){
			buttonGachaGold();
		}
	}
	else if(gachaSilver==1){
		if(swShowItem==0&&Math.pow(clickedX-ballX,2)+Math.pow(clickedY-ballH,2)<=50*50){
			showItemSilver();
		}
		else if(swShowItem==1&&clickedX>=325&&clickedX<=475&&clickedY>=450&&clickedY<=530){
			swShowItem=0
			gachaSilver=0;
			drawBg1();
			drawBg2();
		}
	}
	else if(gachaGold==1){
		if(swShowItem==0&&Math.pow(clickedX-ballX,2)+Math.pow(clickedY-ballH,2)<=50*50){
			showItemGold();
		}
		else if(swShowItem==1&&clickedX>=325&&clickedX<=475&&clickedY>=450&&clickedY<=530){
			swShowItem=0
			gachaGold=0;
			drawBg1();
			drawBg2();
		}
	}
}

function drawButton(){
	Canvas = document.getElementById("canvas1");
	ctx = Canvas.getContext("2d");
	
	ctx.fillStyle = (gachaSilver==0&&gachaGold==0)? "red":"darkred";
	ctx.fillRect(300,525,90,40);
	ctx.fillStyle = (gachaSilver==0&&gachaGold==0)? "blue":"darkblue";
	ctx.fillRect(700,525,90,40);
	
	ctx.fillStyle = "white";
	ctx.font = "bold 16px Arial"
	ctx.textAlign = "center";
	ctx.fillText("Start",345,550);
	ctx.fillText("Start",745,550);
}

function buttonGachaSilver(){
	gachaSilver=1;
	
	var snd = document.getElementById("coindrop");
	snd.play();
	
	Canvas = document.getElementById("canvas1");
	ctx = Canvas.getContext("2d");
	randomItem();
	drawBall();
}

function buttonGachaGold(){
	gachaGold=1;
	
	var snd = document.getElementById("coindrop");
	snd.play();
	
	Canvas = document.getElementById("canvas1");
	ctx = Canvas.getContext("2d");
	randomItem();
	drawBall();
}

var itemId = [1,1,1,1,2,2,2,2,3,3,3,4,4,4,5,5,6,6,7,8];
var getItem ;
var nameSvItem = ["item1","item2","item3","item4","item5","item6","item7","item8"];
var nameGdItem = ["Gditem1","Gditem2","Gditem3","Gditem4","Gditem5","Gditem6","Gditem7","Gditem8"];
function randomItem(){
	getItem = itemId[Math.floor(Math.random()*itemId.length)];
}

var sndShw;
function showItemSilver(){
	swShowItem = 1 ;
	clearInterval(ballAnime);
	
	sndShw = new Audio("sound/show.mp3");
	sndShw.play();
	
	Canvas = document.getElementById("canvas1");
	ctx = Canvas.getContext("2d");
	
	img = document.getElementById("smoke");
	ctx.drawImage(img,0,0,Canvas.width,Canvas.height);
	
	img = document.getElementById("shwItem");
	ctx.drawImage(img,50,50,700,500);
	
	ctx.fillStyle = "grey";
	ctx.fillRect(325,450,150,80);
	ctx.fillStyle = "lightgrey";
	ctx.fillRect(330,455,140,70);
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


function showItemGold(){
	swShowItem = 1 ;
	clearInterval(ballAnime);
	
	sndShw = new Audio("sound/show.mp3");
	sndShw.play();
	
	Canvas = document.getElementById("canvas1");
	ctx = Canvas.getContext("2d");
	
	img = document.getElementById("smoke");
	ctx.drawImage(img,0,0,Canvas.width,Canvas.height);
	
	img = document.getElementById("shwItem");
	ctx.drawImage(img,50,50,700,500);
	
	ctx.fillStyle = "grey";
	ctx.fillRect(325,450,150,80);
	ctx.fillStyle = "lightgrey";
	ctx.fillRect(330,455,140,70);
	ctx.fillStyle = "black";
	ctx.font = "bold 28px Arial"
	ctx.textAlign = "center";
	ctx.fillText("OK",400,500);
	
	img = document.getElementById("gdItem"+getItem);
	ctx.drawImage(img,250,70,300,300);
	ctx.fillStyle = "Blue";
	ctx.font = "bold 36px Arial"
	ctx.textAlign = "center";
	ctx.fillText(nameGdItem[getItem-1],400,425);
	
}

var beltW,beltH;
function beltMove(){
	drawBg1();
	Canvas = document.getElementById("canvas1");
	ctx = Canvas.getContext("2d");
	
	img = document.getElementById("belt");
	ctx.drawImage(img,150,0,100,50*(waitBelt/150));
	ctx.drawImage(img,550,0,100,50*(waitBelt/150));
	ctx.fillStyle = "LightSteelBlue";
	ctx.fillRect(100,50*(waitBelt/150),200,50);
	ctx.fillStyle = "GoldenRod";
	ctx.fillRect(500,50*(waitBelt/150),200,50);
	
	img = document.getElementById("glass");
	ctx.drawImage(img,0,0,400,502);
	img = document.getElementById("glass");
	ctx.drawImage(img,400,0,400,502);
	
	img = document.getElementById("svCoin");
	ctx.drawImage(img,20,510,80,80);
	img = document.getElementById("gdCoin");
	ctx.drawImage(img,420,510,80,80);
	
	ctx.strokeStyle = "black";
	ctx.strokeRect(0,0,400,600);
	ctx.strokeRect(400,0,400,600);
	
	ctx.fillStyle = "Violet"
	ctx.font = "bold 56px Arial"
	ctx.textAlign = "left";
	ctx.fillText(nSvCoin,160,570);
	ctx.fillText(nGdCoin,560,570);
	ctx.textAlign = "center";
	
	ctx.beginPath();
	ctx.moveTo(120,540);
	ctx.lineTo(140,560);
	ctx.moveTo(140,540);
	ctx.lineTo(120,560);
	
	ctx.moveTo(520,540);
	ctx.lineTo(540,560);
	ctx.moveTo(540,540);
	ctx.lineTo(520,560);
	ctx.stroke();
}