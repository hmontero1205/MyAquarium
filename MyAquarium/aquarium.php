<!DOCTYPE HTML>
<!--Hans Montero-->
<html onresize ="updateDimensions();">
	<head>
		<title>MyAquarium</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
  		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<style> 
			body{
				overflow: hidden;
			}
			body,html{
				height:100%;
			}
			#contain {
				border:2px solid black;
				position: absolute;
				display: inline-block;
				width: 300px;
				height:220px;
				top:0;
				left:0;
				background-color: rgba(83,115,202,.9);
				z-index: 50;
			}
			.contain2{
				overflow:auto;
				max-height:200px;
			}
			#ft{
				left:0px;
				top:0px;
				display:inline-block;
				position: absolute;
				width:100%;
				height:100%;
				
			}

			.menu{
				width:15%;
			}
			.dnd{
				position: absolute;
				display: inline-block;
				width:100%;
				height:15%;
				bottom:0;
				left:0;
				z-index: 21;
			}
			button.pur{
				position: relative;
				display: inline-block;
				border: 1px solid teal;
				border-radius: 10px;
				background-color: lightblue;
				left:55px;
				bottom:20px;
			}
			button.angel{
				position: relative;
				display: inline-block;
				border: 1px solid teal;
				border-radius: 10px;
				background-color: lightblue;
				left:55px;
				bottom:50px;
			}
			.ui-widget-content{
				background:none;
				
			}
			span.ui-widget-header{
				display:inline-block;
				width:99.2%;
				cursor: move;	
			}
			#drag2{
				border:2px solid black;
				position: absolute;
				display: inline-block;
				width: 300px;
				top:220px;
				left:0;
				background-color: rgba(83,115,202,.9);
				height:222px;
				z-index: 50;
			}
			#drag3{
				border:2px solid black;
				position: absolute;
				display: inline-block;
				width: 200px;
				top:0;
				right:0;
				background-color: rgba(83,115,202,.9);
				height:100px;
				z-index: 50;
			}
			.desc{
				position: absolute;
				width:120px;
				font-size: 14px;
				font-style: italic;
				right:30px;
				margin-top:4%;
				display: inline-block;
			}
			.desc2{
				position: absolute;
				width:120px;
				font-size: 14px;
				font-style: italic;
				top:50px;
				right:30px;
				display: inline-block;
			}
			.desc3{
				position: absolute;
				width:120px;
				font-size: 14px;
				font-style: italic;
				top:50px;
				right:20px;
				display: inline-block;
			}
			.desc4{
				position: absolute;
				width:120px;
				font-size: 14px;
				font-style: italic;
				top:50px;
				right:40px;
				display: inline-block;
			}
			.opt{
				position: relative;
				border:2px solid black;
			}
			.logo{
				position: relative;
				border:2px solid teal;
				background-color: lightblue;
				font-style: italic;
				border-radius: 10px;
			}
			.bc{
				position:fixed;
				top:0px;
				left:0px;
				width:100%;
				height:100%;
				z-index: -200;
			}
			.bi{
				width:100%;
				height:100%;
				z-index: -200;
			}
			#bod{
				position: absolute;
				left:0;
				top:0;
				height:100%;
				width:100%;
			}

			.feedZone{
				position: absolute;
				left:0;
				top:0;
				height:100%;
				width:100%;
				z-index: 20;
			}
		</style>
		<?php 
			$conn = new PDO("mysql:hostname=localhost;dbname=hans", "root", "");
			$uName = $_POST['user'];

			function getDatabaseResults($cmd,$type){
				global $conn;
				global $uName;
				$dataResult = $conn->prepare($cmd);
				$dataResult->execute();
				$returnVal = $dataResult->fetchAll(PDO::FETCH_ASSOC);

				if($dataResult->rowCount() >= 1)
					return $returnVal;
				else{
					if($dataResult->rowCount() == 0 && $type==1 )
						return [];
					else{
						if($type == 0){
							$newCmd = "INSERT INTO `userd`(`username`,`money`,`hunger`) VALUES ('{$uName}',500,0)";
							$newDataResult = $conn->prepare($newCmd);
							$newDataResult->execute();
							
							$newCmd = "SELECT * FROM `userd` WHERE `username`='{$uName}'";
							$newDataResult = $conn->prepare($cmd);
							$newDataResult->execute();
							$newReturnVal = $newDataResult->fetchAll(PDO::FETCH_ASSOC);
							return $newReturnVal;
						}
					}
				}
				
			}


		?>
		<script> 
			$(function() {
   				$( "#contain" ).draggable({ handle: "span.ui-widget-header",containment: "window"});
  			})
  			$(function() {
   				$( "#drag2" ).draggable({ handle: "span.ui-widget-header",containment: "window"});
  			})
  			$(function() {
   				$( "#drag3" ).draggable({ handle: "span.ui-widget-header",containment: "window"});
  			})
			function initialize(){
				userInfo = <?php echo json_encode(getDatabaseResults("SELECT * FROM `userd` WHERE `username`='{$uName}'",0)) ?>[0];
				storeCataloge = <?php echo json_encode(getDatabaseResults("SELECT * FROM `stored`",1))?>;
				dStoreCataloge=<?php echo json_encode(getDatabaseResults("SELECT * FROM `dstored`",1))?>;
				myFish = <?php echo json_encode(getDatabaseResults("SELECT * FROM `fishd` WHERE `username`='{$uName}'",1))?>;
				myDecor = <?php echo json_encode(getDatabaseResults("SELECT * FROM `decord` WHERE `username`='{$uName}'",1))?>;

				currentItm="";
				fishImgArr = [];
				fishObjArr = [];
				droppedPlantsArr=[];
				plantImgSrcArr=[];

				userName = userInfo.username;
				userMoney = parseInt(userInfo.money);
				fishHunger = parseInt(userInfo.hunger);

				hungerInterval = setInterval(getHungry,9000);
				currentCursor = "auto";

				fishTank = document.getElementById("ft");
				store=document.getElementById("store");
				dStore=document.getElementById("decor");
				dropZone=document.getElementById("area");
				moneyDiv = document.getElementById("mcnt");
				userDiv = document.getElementById("u");
				hungerDiv = document.getElementById("h");
				docBody = document.getElementById("bod");
				feedArea = document.getElementById("fd");

				updateDivInfo();	
				createFishTank(0);
				createStores();

				oldWinWidth = parseInt(window.innerWidth);
			}

			function createFishTank(f){
				for(var f;f<myFish.length;f++){
					var tempFish = myFish[f];
					var fishObj = new Fish(tempFish.breed,tempFish.price,tempFish.img);
					fishObjArr.push(fishObj);
					tempImg = document.createElement("img");
					tempImg.src = "images/" + fishObj.imgSrc;
					tempImg.myIdx = f;
					tempImg.style.transitionDuration = "1.5s";
					tempImg.ondragstart = function(){
						return false;
					};
					fishImgArr.push(tempImg);
					fishTank.appendChild(tempImg);
					fishObj.spawnMe(tempImg,tempFish);
				} 
				for(var d=0;d<myDecor.length;d++){
					var tempDecor = myDecor[d];
					var decorImg = document.createElement("img");
					decorImg.src = "images/"+tempDecor.img;
					decorImg.style.position="absolute";
					decorImg.style.display="inline-block";
					decorImg.style.top = tempDecor.cTop+"px";
					decorImg.style.left = tempDecor.cLeft+"px";
					decorImg.style.zIndex = tempDecor.z;
					decorImg.ondragstart = function(){
						return false;
					};
					droppedPlantsArr.push(decorImg);
					dropZone.appendChild(decorImg);
					
				}
			}

			function Fish(b,p,i){
				this.breed = b;
				this.price=parseInt(p);
				this.imgSrc = i;
				this.flipValue = 0;
				this.flipMe = function(fImg){
					this.flipValue += 180;
					fImg.style.transform = "rotatey("+this.flipValue+"deg)";
				}
				this.swimAround = function(fImg,fishO){
					randAct = getRandomInteger(1,4);
					if(randAct <= 3){
						var xPos = parseInt(fImg.style.left);
						var yPos = parseInt(fImg.style.top);
						xTransition = xPos + getRandomInteger(-150,150);
						yTransition = yPos + getRandomInteger(-150,150);
						if(xTransition < 50)
							xTransition +=90;
						if(xTransition > window.innerWidth-210)
							xTransition-=90;
						if(yTransition < 50)
							yTransition += 120;
						if(yTransition > window.innerHeight-200 || fishO.breed=="Angelfish" && yTransition > window.innerHeight-300 || fishO.breed=="Gourami" && yTransition > window.innerHeight-250)
							yTransition-=120;
						if(fishO.breed == "Cory"||fishO.breed=="Algae Eater")
							yTransition=window.innerHeight-120;
						if(fishO.flipValue%360==0 && xTransition > xPos || fishO.flipValue%360==180 && xTransition < xPos){
							fishO.flipMe(fImg);
							setTimeout(changeImgPosition,500,fImg,yTransition,xTransition);
						}
						else
							changeImgPosition(fImg,yTransition,xTransition);
						
					}
				}
				this.spawnMe=function(fImg,fObj){
					fImg.style.position = "absolute";
					var yCoord = getRandomInteger(0,window.innerHeight-150);
					var xCoord = getRandomInteger(0,window.innerWidth-150);
					if(fObj.breed == "Cory"||fObj.breed=="Algae Eater")
						yCoord=window.innerHeight-120;
					changeImgPosition(fImg,yCoord,xCoord);
					var spawnFlip = getRandomInteger(1,2);
					if(spawnFlip==1)
						this.flipMe(fImg);
					this.swimCounter = setInterval(this.swimAround,1200,fImg,this);
				}
			}

			function createStores(){
				for(var s=0;s<storeCataloge.length;s++){
					var tempItm = storeCataloge[s];
					var tempDiv = document.createElement("div");
					var tempImg = document.createElement("img");
					var tempButt = document.createElement("button");
					tempButt.setAttribute("onclick","buyMe(this.myIdx,'fish')");					
					tempButt.innerHTML = "Purchase";
					tempImg.src="images/"+tempItm.img;
					tempImg.ondragstart = function(){
						return false;
					};
					if(tempItm.breed=="Angelfish"){
						tempButt.className = "angel";
					}
					else{
						tempButt.className = "pur";
					}

					tempDiv.style.position="relative";
					tempDiv.innerHTML = tempItm.breed + " - $" + tempItm.price + "<br/>";
					tempDiv.style.border="2px solid grey";
					tempButt.myIdx = s;
					tempImg.style.width="30%";
					tempDiv.appendChild(tempImg);
					tempDiv.appendChild(tempButt);
					store.appendChild(tempDiv);
				}
				for(var t=0;t<dStoreCataloge.length;t++){
					tempDecor = dStoreCataloge[t];
					var tempDiv2 = document.createElement("div");
					var dragImg = document.createElement("img");
					var tempSideDiv = document.createElement("div");
					tempSideDiv.innerHTML="Drag and drop me on the bottom of the tank to purchase me!";
					tempSideDiv.className = "desc";
					tempDiv2.innerHTML = tempDecor.name + " - $" + tempDecor.price + "<br/>";
					tempDiv2.style.position="relative";
					dragImg.src="images/"+tempDecor.img;
					plantImgSrcArr.push(dragImg.src);
					dragImg.draggable="true";
					dragImg.setAttribute("ondragstart","startDrag(event)")
					dragImg.style.width="30%";
					tempDiv2.style.border="2px solid darkgreen";
					tempDiv2.appendChild(dragImg);
					tempDiv2.appendChild(tempSideDiv);
					dStore.appendChild(tempDiv2);
				}
			}

			function buyMe(idx,type){
				if(type=='fish'){
					var storePrice = storeCataloge[idx].price
				}
				else{
					var storePrice = dStoreCataloge[idx].price;
				}
				if(parseInt(storePrice) > parseInt(userMoney)){
					if(type=='plant'){
						dropZone.removeChild(dropZone.lastChild);					
					}

				}
				else{
					userMoney -= storePrice;
					updateDivInfo();
					updateUserInfo('money',userMoney);
					if(type=='fish'){
						updateDatabase(storeCataloge[idx],'fish');
					}
					else{
						updateDatabase(droppedPlantsArr[droppedPlantsArr.length-1],'plant',dStoreCataloge[idx].img);
					}
				}
			}
				

			function updateUserInfo(name,value){
				var req1 = new XMLHttpRequest();
				var url="updateinfo.php?column="+name+"&value="+value+"&table=userd&action=update&user="+userName;
				req1.open("GET",url,true);
				req1.send(null);
			}
			function updateDatabase(itmBought,type,img){
				var req2 = new XMLHttpRequest();
				switch(type){
					case 'fish':
						var url ="updateinfo.php?bd="+itmBought.breed+"&price="+parseInt((itmBought.price/2).toFixed())+"&idx="+(getRandomInteger(11111,99999))+"&img="+itmBought.img+"&table=fishd&action=add&user="+userName;
						req2.onreadystatechange=function(){
							if(req2.readyState == 4)
								updateLocalFish();
						}
						break;
					case 'plant':
						var url = "updateinfo.php?top="+itmBought.style.top+"&left="+itmBought.style.left+"&idx="+(getRandomInteger(11111,99999))+"&z="+itmBought.style.zIndex+"&price=50&img="+img+"&table=decord&action=add&user="+userName;
							req2.onreadystatechange=function(){
								if(req2.readyState == 4)
									updateLocalDecor();
							}
						break;
				}
				req2.open("GET",url,true);
				req2.send(null);
			}
			function updateLocalFish(){
				var req3 = new XMLHttpRequest();
				var url="updateinfo.php?table=fishd&action=return&user="+userName;
				req3.onreadystatechange=function(){
					if(req3.readyState == 4){	
						myFish = eval(req3.responseText);
						createFishTank(myFish.length-1);	
					}
				}
				req3.open("GET",url,true);
				req3.send(null);
			}
			function updateLocalDecor(){
				var req4 = new XMLHttpRequest();
				var url="updateinfo.php?table=decord&action=return&user="+userName;
				req4.onreadystatechange=function(){
					if(req4.readyState == 4)	
						myDecor = eval(req4.responseText);	
				}
				req4.open("GET",url,true);
				req4.send(null);
			}
			function updateDimensions(){
				for(var c=0;c<fishObjArr.length;c++){
					var tempFO = fishObjArr[c];
					var tempFI = fishImgArr[c];
					clearInterval(fishObjArr[c].swimCounter);
					var xPos = parseInt(tempFI.style.left);
					var yPos = parseInt(tempFI.style.top);
					var yTran = (window.innerHeight/2) + getRandomInteger(-250,250);
					var xTran = (window.innerWidth/2) + getRandomInteger(-250,250);
					if(tempFO.breed == "Cory"||tempFO.breed=="Algae Eater")
						yTran=window.innerHeight-120;
					if(tempFO.flipValue%360==0 && xTran > xPos || tempFO.flipValue%360==180 && xTran < xPos){
						tempFO.flipMe(tempFI);
						setTimeout(changeImgPosition,500,tempFI,yTran,xTran);
					}
					else
						changeImgPosition(tempFI,yTran,xTran);
					tempFO.swimCounter = setInterval(tempFO.swimAround,1200,tempFI,tempFO);

					decorArr=dropZone.getElementsByTagName("img");
					widthProportion = (parseInt(window.innerWidth))/oldWinWidth;
					for(d=0;d<decorArr.length;d++){
						newLeft = widthProportion*parseInt(decorArr[d].style.left)+"px";
						decorArr[d].style.left = newLeft;
					}
					oldWinWidth=parseInt(window.innerWidth);

				} 
			}
			function getRandomInteger(lower, upper){
				multiplier = upper - (lower - 1);
				rnd = parseInt(Math.random() * multiplier) + lower;
				return rnd;
			}	

			function startDrag(e)
			{
				e.dataTransfer.setData("source",e.target.src);

			}
			function allowDrag(e)
			{
				e.preventDefault();
			}
			function dropElement(e)
			{
				e.preventDefault();
				var imgSrc = e.dataTransfer.getData("source");
				newImg = document.createElement("img");
				newImg.src = imgSrc;
				newImg.style.position = "absolute";
				newImg.style.display="inline-block";
				e.target.appendChild(newImg);
				if(e.clientY > window.innerHeight-60){
					dropVar = 100;
					newImg.style.zIndex = "50";
				}
				else{
					dropVar = -20;
					newImg.style.zIndex = "-50";
				}
				newImg.style.top =(window.innerHeight - e.clientY - newImg.height + dropVar) + "px";
				newImg.style.left = e.clientX - newImg.width + 70 + "px";
				newImg.ondragstart = function(){
					return false;
				};
				droppedPlantsArr.push(newImg);
				buyMe(plantImgSrcArr.indexOf(imgSrc),'plant');
			}
			function getHungry(){
				if(fishObjArr.length == 0){
					fishHunger = 0;
					updateUserInfo("hunger",fishHunger);
					updateDivInfo();
				}
				else{
					fishHunger = parseInt(fishHunger)+2;
					if(fishHunger > 100)
						fishHunger = 100;
					updateDivInfo();
					updateUserInfo("hunger",fishHunger);
					updateUserInfo("money",userMoney);
					if(fishHunger>60){
						deadPossibilty = getRandomInteger(0,8);
						if(deadPossibilty <= 2 && fishObjArr.length > 0){
							var deadI = getRandomInteger(0,fishObjArr.length-1);
							deadFish = fishObjArr.splice(deadI,1)[0];
							clearInterval(deadFish.swimCounter);
							var deadImg = fishImgArr.splice(deadI,1)[0];
							deadImg.setAttribute("onclick","removeImg(this)");
							deadImg.style.zIndex = 70;
							dataFish = myFish.splice(deadI,1)[0];
							setTimeout(killFish,400,deadImg);

							var req6 = new XMLHttpRequest();
							var url = "updateinfo.php?idx="+dataFish.idx+"&user="+userName+"&action=remove&table=fishd";
							req6.open("GET",url,true);
							req6.send(null);
						}
					}
				}

			}	
			function killFish(img){
				img.style.transform = "rotateX("+180+"deg)";
				changeImgPosition(img,10,parseInt(img.style.left));

			}

			function removeImg(imgNode){
				if(currentCursor == "net")
					fishTank.removeChild(imgNode);
			}

			function changeMode(mode){
				switch(mode){
					case 'clean':
						docBody.style.cursor = "url('images/net.png'),auto";
						feedArea.style.cursor = "url('images/net.png'),auto";
						currentCursor = "net";
						break;
					case 'feed':
						docBody.style.cursor = "url('images/food.png'),auto";
						feedArea.style.cursor = "url('images/food.png'),auto";
						currentCursor = "food";
						break;
					case 'norm':
						docBody.style.cursor = "auto";
						currentCursor = "auto";
						feedArea.style.cursor = "auto";

				}
			}	

			function activateTank(click){
				if(currentCursor=="food"){
					spawnFood(click);
					userMoney-=5;
					if(fishHunger>0){
						fishHunger-=5;
						userMoney += 25;
						if(fishHunger<0)
							fishHunger=0;
					}
					updateDivInfo();	
				}
				
			}

			function spawnFood(e){
				var flakesImg = document.createElement("img");
				flakesImg.src = "images/flakes.png";
				flakesImg.style.position = "absolute";
				xVal = e.clientX;
				yVal = e.clientY;
				feedArea.appendChild(flakesImg);
				changeImgPosition(flakesImg,yVal,xVal);
				flakesImg.style.transitionDuration = "6s";
				setTimeout(changeImgPosition,100,flakesImg,yVal+300,xVal);
				setTimeout(destroyFood,6000,flakesImg);
				for(var s=0;s<fishImgArr.length;s++){
					clearInterval(fishObjArr[s].swimCounter);
					if(fishObjArr[s].flipValue%360==0 && parseInt(flakesImg.style.left) > parseInt(fishImgArr[s].style.left) || fishObjArr[s].flipValue%360==180 && parseInt(flakesImg.style.left) < parseInt(fishImgArr[s].style.left)){
						fishObjArr[s].flipMe(fishImgArr[s]);
						setTimeout(changeImgPosition,600,fishImgArr[s],parseInt(flakesImg.style.top),parseInt(flakesImg.style.left));
					}
					else
						changeImgPosition(fishImgArr[s],parseInt(flakesImg.style.top),parseInt(flakesImg.style.left));
					fishObjArr[s].swimCounter = setInterval(fishObjArr[s].swimAround,1200,fishImgArr[s],fishObjArr[s]);
				}

			}
			function changeImgPosition(img,top,left){
				img.style.top = top+"px";
				img.style.left =left+"px";
			}

			function destroyFood(img){
				feedArea.removeChild(img);
			}

			function updateDivInfo(){
				userDiv.innerHTML = userName;
				moneyDiv.innerHTML = "$"+userMoney;
				hungerDiv.innerHTML = fishHunger+"%";
			}
		</script>
	</head>
	<body onload = "initialize();" onresize ="updateDimensions();">
		<div id="fd" onclick="activateTank(event);" class="feedZone"></div>
		<div id="bod">
			<div id="ft">
			</div>
			<div id="contain" class="ui-widget-content">
				<span class="ui-widget-header">Store</span><br/>
				<div class="contain2">
					<div id="decor"></div>
					<div id="store"></div>
				</div>
			</div>
			<div class="ui-widget-content" id="drag2">
				<span class="ui-widget-header">Tools</span><br/>
					<div class="contain2">
						<div class="sub">
							<div class="opt">Net<br/>
								<label onclick="changeMode('clean');">
									<img draggable="false" src="images/net.png"/>
									<div class="desc2">Use me to remove dead fish!(Click to activate)</div>
								</label>
							</div>
						</div>
						<div class="sub">
							<div class="opt">Food<br/>
								<label onclick="changeMode('feed');">
									<img draggable="false" src="images/food.png"/>
									<div class="desc3">Use me to feed your fish!(Click to activate)</div>
								</label>
							</div>
						</div>
						<div class="sub">
							<div class="opt">Cursor<br/>
								<label onclick="changeMode('norm');">
									<img draggable="false" src="images/cursor.png"/>
									<div class="desc4">Default(Click to activate)</div>
								</label>
							</div>
						</div>
					</div>
			</div>

			<div class="ui-widget-content" id="drag3">
				<span class="ui-widget-header">Information</span><br/>
				 Logged in as: <span id="u"></span> <button class="logo" onclick="window.location.href='login.html'">Log out</button><br/>
				 Money: <span id="mcnt" class="money"></span><br/>
				 Hunger: <span id="h"></span>
			</div>


			<div ondragover="allowDrag(event);" ondrop="dropElement(event);" id="area" class="dnd"></div>
		
			<div class="bc">
				<img class="bi" src="images/back1.jpg"/>
			</div>
		</div>
	</body>
</html>