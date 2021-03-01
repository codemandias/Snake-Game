/*
 *
 *	we are using the following indexing system:
 *
 *
 *			*	0	1	2	3	4	5	... (x index)
 *			0	x	x	x	x	x	x
 *			1	x	x	x	x	x	x
 *			2	x	x	x	x	x	x
 *			3	x	x	x	x	x	x
 *			4	x	x	x	x	x	x
 *			5	x	x	x	x	x	x
 *			.
 *			.
 *			.
 *			(y index)
 *
 *
 *
 */
// variable to check if a food element is already on the matrix
var foodSpawn = false;
var score = 0;
var snake;

// Feature: Implement Food and Score functionality
// Implemented By: Aditya Sharma (B00827775)
// Learned: How to retrieve an element that was created dynamically from the server side.
//			How to add a class element to a div element dynamically using javascript. 

function Food(){
    // generate valid coordinates within the matrix.
    var i = Math.floor(Math.random() * 30);
    var j = Math.floor(Math.random() * 30);
    // if food is not already on the matrix.
    if(!foodSpawn){
        foodSpawn = true;
        document.getElementById(i+' - '+j).classList.add("food");
    }
}

// Feature: SnakeBlocks are elements that constitute a Snake;
// Implemented By: Qiujian Yao (B00793637);
// Learned: Object-Oriented Programming.
class SnakeBlock {
	constructor(x, y){ // position coordinates
		this.x = x;
		this.y = y;
		this.next = null;
	}
	
	setNext(next){
		this.next = next;
	}
}

// Feature: Implementing the Snake Object and link it to HTML;
// Implemented By: Qiujian Yao (B00793637);
// Learned: Object-Oriented Programming.
class Snake {
	constructor(head, tail){
		this.head = head;
		this.tail = tail;
		this.speed = 5; // default speed is 5; range 1 - 10
		this.dir = "right"; // default direction is to the right; can also be "left", "up", or "down"; may be changed by control
		this.dirChanged = false; // marks whether the direction has been reset before next move to prevent multiple direction changes in a single move
		this.nextDir = null; // records the unfulfilled direction change in short time; hold off and fulfill in next move
	}
	
	move(){ // moves one step forward
		this.dirChanged = false;
		let iterBlock = this.head;
		let x = iterBlock.x;
		let y = iterBlock.y;
		switch (this.dir) {
			case "right":
					iterBlock.x++;
				break;
			case "left":
					iterBlock.x--;
				break;
			case "up":
					iterBlock.y--;
				break;
			case "down":
					iterBlock.y++;
				break;
			default:
				break;
		}
		if(!(iterBlock.next.x == x && iterBlock.next.y == y)){
			while (iterBlock.next) {
				iterBlock = iterBlock.next;
				let xTemp = iterBlock.x;
				let yTemp = iterBlock.y;
				iterBlock.x = x;
				iterBlock.y = y;
				x = xTemp;
				y = yTemp;
			}
		}
		// If Snake touches its body, Game over.
		iterBlock = this.head;
		while(iterBlock.next){
			iterBlock = iterBlock.next;
			if(this.head.x == iterBlock.x && this.head.y == iterBlock.y){
				location.replace("index.php?gameover=1&finalScore=".concat(score));
				exit;
			}
		}
		// If Snake touches boundary, Game over.
		if(document.getElementById(this.head.y + " - " + this.head.x)==null){
			location.replace("index.php?gameover=1&finalScore=".concat(score));
		}

		// Feature 1: Display food and detect if food is being eaten by the snake 
		// Feature 1: Store score upon food consumed and display dynmanically. 
		// Implemented By: Aditya Sharma (B00827775);

		// If snake eats food, spawn another food.
		if(document.getElementById(this.head.y + " - " + this.head.x).classList.contains("food")){
			document.getElementById(this.head.y + " - " + this.head.x).classList.remove("food");
			document.getElementById(this.head.y + " - " + this.head.x).classList.add("columns");
			let newBlock = new SnakeBlock(this.head.x, this.head.y);
			newBlock.setNext(this.head.next);
			this.head.setNext(newBlock);
			foodSpawn = false;
			score+=10;
			document.getElementById("score").innerHTML ="Score: "+score;
			Food();
		}
		if(this.nextDir){
			this.dir = this.nextDir;
			this.dirChanged = true;
			this.nextDir = null;
		}
	}
	
	changeDir(dir){ // changes direction
		this.dir = dir;
	}
	
	toString(){ // returns positions of all snake blocks from head to tail
		let string = "";
		let iterBlock = this.head;
		while (iterBlock) {
			string += "(" + iterBlock.x + "," + iterBlock.y + ")";
			iterBlock = iterBlock.next;
			if(iterBlock){
				string += "<-"
			}
		}
		return string;
	}
	
	display(){
		document.querySelectorAll(".columns").forEach(elem =>{
			elem.style.background = "black";
		});
		document.querySelectorAll(".food").forEach(elem =>{
			elem.style.background = "white";
		});
		let iterBlock = this.head;
		
		while (iterBlock) {
			document.getElementById(iterBlock.y + " - " + iterBlock.x).style.background = "green";
			iterBlock = iterBlock.next;
		}
	}
}

// Feature: First constructing multiple SnakeBlocks and connecting them as link list and then using them to create Snake;
// Implemented By: Qiujian Yao (B00793637);
// Learned: Object-Oriented Programming.
function initSnake(x, y, l) { // x, y: head position; l: initial length
	head = new SnakeBlock(x, y);
	tail = head;
	for(i = 1; i < l; i++){
		tail.setNext(new SnakeBlock(x - i, y));
		tail = tail.next;
	}
	return new Snake(head, tail);
}

// Feature: Making the Snake controllable by arrow keys and w/a/s/d for direction and PAGE UP/ PAGE DOWN for speed;
// Implemented By: Qiujian Yao (B00793637);
// Learned: JavaScript keyboard control.
function initControl(snake) {
	document.addEventListener("keydown", function (e) {
		if(e.keyCode == 33 && snake.speed < 11){
			snake.speed++;
		}
		else if(e.keyCode == 34 && snake.speed > 0){
			snake.speed--;
		}
		if(!snake.dirChanged){
			switch (e.keyCode) {
				case 37:
				case 65:
					if(snake.dir == "up" || snake.dir == "down"){
						snake.dir = "left";
						snake.dirChanged = true;
					}
					break;
				case 38:
				case 87:
					if(snake.dir == "left" || snake.dir == "right"){
						snake.dir = "up";
						snake.dirChanged = true;
					}
					break;
				case 39:
				case 68:
					if(snake.dir == "up" || snake.dir == "down"){
						snake.dir = "right";
						snake.dirChanged = true;
					}
					break;
				case 40:
				case 83:
					if(snake.dir == "left" || snake.dir == "right"){
						snake.dir = "down";
						snake.dirChanged = true;
					}
					break;
				default:
					break;
			}
		}
		else if(!snake.nextDir){ // records the unfulfilled direction change in short time
			switch (e.keyCode) {
				case 37:
				case 65:
					if(snake.dir == "up" || snake.dir == "down"){
						snake.nextDir = "left";
					}
					break;
				case 38:
				case 87:
					if(snake.dir == "left" || snake.dir == "right"){
						snake.nextDir = "up";
					}
					break;
				case 39:
				case 68:
					if(snake.dir == "up" || snake.dir == "down"){
						snake.nextDir = "right";
					}
					break;
				case 40:
				case 83:
					if(snake.dir == "left" || snake.dir == "right"){
						snake.nextDir = "down";
					}
					break;
				default:
					break;
			}
		}
	}, false);
}

async function init(){
	// Spawning first food 
	Food();
	snake = initSnake(15, 15, 3);
	initControl(snake);
	snake.display();
	while (1) {
		await new Promise(resolve => setTimeout(resolve, 150 - 10*snake.speed));
		snake.move();
		snake.display();
	}
}

