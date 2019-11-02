const needle    = document.querySelector("#needle");
const needleTop = document.querySelector("#needle-top");
const cursor    = document.querySelector("#cursor");
const text      = document.querySelector("#name");
const mouse     = {x:0,y:0};

let dir = null;
let started = null;
let done = false;
let lost = false;
let wins = localStorage.getItem("wins");
if(wins == null) wins = 0; // technically redundant because javascript?

let needle_scale = 1;
for(i=0; i<wins; i++) {
    needle_scale += ((18/31) - needle_scale) / 5; 
}

needle.width  *= needle_scale;
needle.height *= needle_scale;
needleTop.width  *= needle_scale;
needleTop.height *= needle_scale;

function update() {
    let needleBounds = needle.getBoundingClientRect();
    let cursorBounds = cursor.getBoundingClientRect();

    let diffY       = cursorBounds.top    - needleBounds.top;
    let diffYTop    = cursorBounds.bottom - needleBounds.top;
    let diffYBottom = cursorBounds.top    - needleBounds.bottom;
    let diffX       = cursorBounds.left   - needleBounds.left;
    let diffXLeft   = cursorBounds.right  - needleBounds.left;
    let diffXRight  = cursorBounds.left   - needleBounds.right;

    let acceptableY = (diffY >= 7  * needle_scale) 
                   && (diffY <= 38 * needle_scale - cursor.height);
    let outsideY    = diffYTop < 0 || diffYBottom > 0
    let dangerousX  = diffXLeft > 0 && diffXRight < 0;
    let dir = diffX < 0 ? "left" : "right";

    if(acceptableY && !lost && !done &&
      ( (started == "left"  && diffXRight > 0)
      ||(started == "right" && diffXLeft  < 0))) {
        done = true;
        addWin();
    }
    else if(dangerousX && !acceptableY && !outsideY && !lost) {
        lost = true;
        text.innerHTML = "YOU LOSE"
        needle.classList.add(`fall-${dir}`);
        needleTop.classList.add(`fall-${dir}`);
    }
    else if(started && !acceptableY) {
        started = null;
    }
    else if(!started && acceptableY) {
        started = dir;
    }

    if(done) {
        text.innerHTML = "WELL DONE";
    }

    cursor.style.left  = mouse.x + "px";
    cursor.style.top   = mouse.y + "px";
}

function addWin() {
    wins++;
    localStorage.setItem("wins", wins);
}

document.onmousemove = function(e) {
    mouse.x = e.pageX;
    mouse.y = e.pageY;
    update();
};

document.onresize = update;