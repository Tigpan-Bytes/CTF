//Hello hackers, can you find the flag?

let userName;
let usernameField;
let isOnMainMenu = true;

let playerY;
let level;
let levelTime;

let cubes = [];
let cubeTime;
let message;
let finishMessage = '';

function setup()
{
    frameRate(60);

    createCanvas(windowWidth, windowHeight);

    openMainMenu();
    
    windowResized();
}

function draw()
{
    background(30);
    if (isOnMainMenu)
    {
        textAlign(CENTER);
        fill(255);
        noStroke();
        textSize(64);

        text('Runner Cube 4', windowWidth / 2, 64);

        textSize(32);

        text('Reach level 5 to win!', windowWidth / 2, 120);
        text(finishMessage, windowWidth / 2, windowHeight - 48);

        if (mouseX > windowWidth * 0.3 &&
            mouseX < windowWidth * 0.7 &&
            mouseY > windowHeight / 2 - 80 &&
            mouseY < windowHeight / 2)
        {
            fill(90);
            stroke(255);
            strokeWeight(1);
            rect(windowWidth * 0.3, windowHeight / 2 - 80, windowWidth * 0.4, 80);
            //flag, ha theres no flag here but you tried to control-f didn't you. so predictable, you should try and look for where it spawns enemies
            //because it seems to be it checks for a cheat code when it spawns the waves
            fill(255);
            noStroke();
            text('Start Game', windowWidth / 2, windowHeight / 2 - 30);

            if (mouseIsPressed)
            {
                if (usernameField.value() != '')
                {
                    isOnMainMenu = false;
                    userName = usernameField.value();
                    usernameField.remove();

                    playerY = windowHeight / 2;
                    level = 0;
                    levelTime = 0;
                    cubes = [];
                    cubeTime = 1;
                    message = 'Remember, ' + userName + '. Up and Down Arrows, or W and S to move!';
                }
                else
                {
                    finishMessage = 'Please input a name'
                }
            }
        }
        else
        {
            fill(50);
            stroke(200);
            strokeWeight(1);
            rect(windowWidth * 0.3, windowHeight / 2 - 80, windowWidth * 0.4, 80);

            fill(255);
            noStroke();
            text('Start Game', windowWidth / 2, windowHeight / 2 - 30);
        }
    }
    else
    {
        drawGame();
    }
}

function drawGame()
{
    levelTime += deltaTime / 1000;
    cubeTime += deltaTime / 1000;

    if (keyIsDown(38) || keyIsDown(87)) //uparrow or w
    {
        playerY -= 3;
    }
    if (keyIsDown(40) || keyIsDown(83)) //downarrow or s
    {
        playerY += 3;
    }

    if (playerY < 32)
    {
        playerY = 32;
    }
    if (playerY > windowHeight - 32)
    {
        playerY = windowHeight - 32;
    }

    textAlign(CENTER);
    fill(255);
    noStroke();
    textSize(32);

    text('Level ' + level, windowWidth / 2, 64);

    textSize(16);

    text('Time: ' + floor(levelTime * 10) / 10 + " / 7.5sec", windowWidth / 2, 96);

    text(message, windowWidth / 2, windowHeight - 32);

    fill(60, 100, 255);
    stroke(200);
    strokeWeight(2);
    rect(2, playerY - 30, 60, 60);

    spawnCubes();
    moveCubes();

    if (levelTime > 7.5)
    {
        level++;
        levelTime = 0;
    }

    if (level == 5)
    {
        finishMessage = 'Congrats, ' + userName + '! You won!';
        openMainMenu();
    }
    if (collidingWithCube())
    {
        finishMessage = 'Oof, ' + userName + '. Maybe next time?';
        openMainMenu();
        windowResized();
    }
}

function collidingWithCube()
{
    for (let i = 0; i < cubes.length; i++)
    {
        if (abs(playerY - cubes[i][1]) < 20 + 30 &&
            cubes[i][0] < 75)
        {
            return true;
        }
    }
    return false;
}

function spawnCubes()
{
    shouldSpawn = false;
    switch (level)
    {
        case 0:
            shouldSpawn = cubeTime > 1.4;
            message = 'Remember, ' + userName + '. Up and Down Arrows, or W and S to move!';
            break;
        case 1:
            shouldSpawn = cubeTime > 0.7;
            message = 'Not bad ' + userName + '...';
            break;
        case 2:
            shouldSpawn = cubeTime > 0.5;
            message = "It will get harder " + userName + ", don't worry ;)";
            break;
        default:
            if (userName == 'ḞL4G=sh0u1d.h4ve.b3at.1t.l1g1t')
            {
                shouldSpawn = cubeTime > 0.4;
                message = 'Have fun, ' + userName + '. You are so cool!';
            }
            else
            {
                shouldSpawn = true; //lol good luck people
                message = 'Goodbye, ' + userName;
            }
            break;
    }
    
    if (shouldSpawn)
    {
        cubeTime = 0;
        cubes.push([windowWidth + 20, random(20, windowHeight - 20)]); //cubes stores an x,y position array of the cube
    }
}

function moveCubes()
{
    fill(255, 50, 50);
    stroke(200);
    strokeWeight(1);

    for (let i = cubes.length - 1; i >= 0; i--)
    {
        cubes[i][0] -= 4;
        rect(cubes[i][0], cubes[i][1] - 20, 40, 40);
        if (cubes[i][0] < -40)
        {
            cubes.splice(i, 1);
        }
    }
}

function windowResized()
{
    createCanvas(windowWidth, windowHeight);

    if (isOnMainMenu)
    {
        usernameField.size(windowWidth / 3, 40);
        usernameField.position(windowWidth / 3, windowHeight / 2 + 30);
    }
}

function openMainMenu()
{
    isOnMainMenu = true;

    usernameField = createElement('input', '');
    usernameField.attribute('placeholder', 'Input your name.');
}