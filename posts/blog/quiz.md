---------------------------
title: WGD Summer Quiz 2017
---------------------------

For a bit of fun, I ran a quiz for Warwick Game Design society for the end of the year.  
These are the questions. They are marked with regular expressions, so apologies if it marks you wrong when you're right!

<script>

function mark(n, q, a, qn) {
    if(q.num == undefined) q.num = 1;
    a = a.toLowerCase().replace(/[,.;:\-\s'"]/g,"");

    var answersRight = 0;
    for(var i=0; i<q.num; i++) {
        for(var an=0; an<q.answer.length; an++) {
             if(a.match(q.answer[an])) {
                 answersRight+=1;
                 a = a.replace(new RegExp(q.answer[an],"g"), "");
                 if(q.style == "first") {
                     q.which = an;
                     break;
                 }
             }
        }
    }

    if(q.style == "first")   q.mark = answersRight>0?q.value[q.which]:0;
    if(q.style == "minimum") q.mark = answersRight>=q.num?q.value:0;
    if(q.style == "each")    q.mark = Math.floor(answersRight * q.value);

    console.log(q.hash);
    let inputBox = document.querySelector(`#${q.hash} input`);
    inputBox.style.border = ""+Math.max(1,Math.min(q.mark,2)) + "px solid "+['red', 'green', 'limegreen'][Math.min(q.mark,2)];

    return q.mark;
}

function markAll(questions, qn, answerfield) {
    var answers = [...document.querySelectorAll("#"+qn + " .answer")].map((s)=>s.value);
    var total = 0;
    console.log(answers);
    for(var i=0; i<answers.length; i++) {
        total += mark(i, questions[i], answers[i], qn);
    }
    answerfield.innerHTML = "Total: " + total;
    answerfield.data("total", total);

    var all = document.querySelectorAll(".mark");
    console.log(all);
    var done = true;
    var tot = 0;
    for(var i=0; i<all.length; i++) {
        if(all[i].dataset.total === undefined) {
            done = false; 
            break;
        }
        else tot += all[i].dataset.total;
    }
    if(done) {
         document.querySelector("#totalmark").innerHTML = "Grand Total: " + tot;
    }
}

function construct(questions, qn) {
    let newRound = document.createElement('div');
    newRound.id = ""+qn;
    document.querySelector("content").appendChild(newRound);
    for(var i=0; i<questions.length; i++) {
        questions[i].hash = btoa(questions[i].question).replace(/[\+=/]/g,'');
        let newQ = document.createElement('div');
        newQ.classList.add('flexr');
        newQ.id = questions[i].hash;
        newQ.innerHTML = `<p class='number'>${i+1}</p></div><div class='question'><p class='question'>${questions[i].question}</p></div><div><p><input class='answer'></input></p></div></div>`;
        newRound.appendChild(newQ);
    }

    let newMark = document.createElement('div');
    newMark.classList.add('flexr');
    newMark.innerHTML = `<button onclick="markAll(${qn}, '${qn}', document.querySelector('#${qn} .mark'))">Mark!</button><div class="mark"></div>`
    newRound.appendChild(newMark);
}

</script>

<style>
.question {
}
audio {
width:100%;
padding:0 1em;
box-sizing:border-box;
    margin-top:1em;
background-color:white;
}
.flexr {
    display:flex;
    position:relative;
    width:100%;
    flex-direction:row;
}
.flexr p {
    top:50%;
    position:relative;
    transform:translate(0,-50%);
    padding:0 2px;
}
.flexr>div {
    display:flex;
    flex-direction:column;
}
.questiond {
    flex-grow:1;
}
.number {
    font-size:2em;
    margin:0.5em;
    vertical-align:baseline;
    width:1em;
}
#content .left {
    text-align:left;
}
input {
    width:240px;
    height:1.5em;
    border:0.5px solid darkorchid;
}
button {
    width: calc(100% - 240px - 2em);
    height: 2em;
    margin: auto;
    margin-top: 2em;
    display:block;
}
.mark {
    width:240px;
    text-align:center;
    font-size:1.5em;
}
#content img {
    width:50% !important;
}
#totalmark {
    font-size:3em;
    text-align:center;   
    margin-top:0.3em;
}
</style>


<br>
##Round 1 - HISTORY
<script>
var qr1 = 
[
{
question: "What was the name of Peter Molyneux's mobile based 2012 social experiment?<br><i>+1 Mark for the full, 5-word title.</i>",
answer: [/curiositywhatsinsidethecube/,/curiosity/],
value: [2,1],
style:"first",
num: 2
},
{
question: "How many dungeons are there in the original Legend of Zelda?",
answer: [/9/, /nine/],
value: 1,
style:"minimum"
},
{
question: "Which BioWare game series is set in the Forgotten Realms Dungeons and Dragons campaign setting?",
answer: [/baldursgate/, /neverwinternights/, /icewinddale/],
value: 1,
style:"minimum"
},
{
question: "What colour is the '1' in the original Microsoft Minesweeper?",
answer: [/blue/],
value: 1,
style:"minimum"
},
{
question: "Which 1984 space game starts the player with only a small trading ship and 100 credits?",
answer: [/elite/],
value: 1,
style:"minimum"
},
{
question: "Strategy game Age of Empires has 4 resources.<br>1 point if you can name two, 2 points if you can name all.",
answer: [/wood|logs/, /food|meat/, /gold|money/, /stone|rock/],
value: 0.5,
style:"each"
},
{
question: "Which game is credited as the first ever roguelike?",
answer: [/rogue/],
value: 1,
style:"minimum"
},
{
question: "Name TWO ways to die in the original Oregon Trail game.<br><i>This question is worth 2 points!",
answer: [/dysente?ry/, /measles/, /snakebite/, /typhoid/, /cholera/, /drown/, /exhaustion/, /gun|shot/],
value: 2,
style:"minimum",
num: 2
},
{
question: "What was the name of Pac-Man before it was called Pac-Man?",
answer: [/pucman/, /puckman/],
value: 1,
style:"minimum"
},
{
question: "Name any one of the Sims 1 expansion packs.",
answer: [/living?large/, /houseparty/, /hotdate/, /vacation/, /unleashed/, /superstar/, /making?magic/],
value: 1,
style:"minimum"
}
];
construct(qr1, "qr1");
</script>




<br><br><br><br>
##Round 2 - POPULAR GAMES
<script>
var qr2 = 
[
{
question: "What is the best selling videogame of all time?<br><i>Across all platforms and including bundled versions.",
answer: [/tetris/],
value: 1,
style:"minimum"
},
{
question: "How many heroes did Overwatch have at launch?",
answer: [/21|twentyone/],
value: 1,
style:"minimum"
},
{
question: "What are the two flying boss enemies in Minecraft called?<br><i>One point for each.",
answer: [/wither/, /end(er)?dragon/],
value: 1,
style:"each"
},
{
question: "Which city is Grand Theft Auto V's setting based on?",
answer: [/la|losangeles/],
value: 1,
style:"minimum"
},
{
question: "Which tune plays when you complete a level in Peggle?",
answer: [/odetojoy/, /ninthsymphony/, /9thsymphony/],
value: 1,
style:"minimum"
},
{
question: "What is the name of the online virtual world created by Linden Labs?",
answer: [/(2|seco)ndlife/],
value: 1,
style:"minimum"
},
{
question: "Which British celebrity narrates the Little Big Planet series?",
answer: [/ste(v|ph)enfry/],
value: 1,
style:"minimum"
},
{
question: "What colour are Wario's dungarees?",
answer: [/purple/],
value: 1,
style:"minimum"
},
{
question: "Name any non-traditional cake ingredient in the delicious chocolate cake from Portal.",
answer: [/fishshapedcrackers/, /fishshapedcandies/, /fishshapedsolidwaste/, /fishshapeddirt/, /fishshapedethylbenzene/, /pullandpeellicorice/, /fishshapedvolatileorganiccompounds/, /sedimentshapedsediment/, /candycoatedpeanutbutterpiecesshapedlikefish/, /lemonjuice/, /alpharesins/, /unsaturatedpolyesterresin/, /fiberglasssurfaceresins/, /volatilemaltedmilkimpoundments/, /geosyntheticmembranes/, /granulatedsugar/, /howtokillsomeonewithyourbarehands/, /rhubarb/, /crossboreholeelectromagneticimagingrhubarb/, /adjustablealuminumheadpositioner/, /electricneedleinjector/, /injectorneedle/, /cranialcaps/],
value: 1,
style:"minimum"
},
{
question: "What is the name of the FIRST expansion for the Witcher III: Wild Hunt?",
answer: [/hearts?ofstone/],
value: 1,
style:"minimum"
}
];
construct(qr2,"qr2");
</script>



<br><br><br><br>
##Round 3 - CONSOLE GAMING
<script>
var qr3 = 
[
{
question: "How many quadrants light up on the Xbox 360 when a nonspecific hardware failure occurs?",
answer: [/3|three/],
value: 1,
style:"minimum"
},
{
question: "What was the FULL name of the first Halo game?",
answer: [/combatevolved/],
value: 1,
style:"minimum"
},
{
question: "How many inputs total did the original NES controller have?",
answer: [/8|eight/],
value: 1,
style:"minimum"
},
{
question: "What was the first games console released in the 21st Century? <br><i>(on/after Jan 1, 2000)",
answer: [/(ps|playstation)(2|two)/],
value: 1,
style:"minimum"
},
{
question: "Name ONE European launch title for the original Nintendo DS.",
answer: [/asphalt/, /mrdriller/, /pingpals/, /pokemondash/, /polarium/, /projectrub/, /feelthemagic/, /rayman/, /atariclassics/, /robots/, /spiderman/, /sprung/, /supermario64/, /tigerwoods/, /pgatour/, /urbz/, /warioware/, /zookeeper/],
value: 1,
style:"minimum"
},
{
question: "How many units did the PS1 sell worldwide, to the nearest 10 million?",
answer: [/(1|one)(00|hundred)/],
value: 1,
style:"minimum"
},
{
question: "What was the UK name of the Sega Genesis?",
answer: [/megadrive/],
value: 1,
style:"minimum"
},
{
question: "What is the name of Solid Snake's brother in Metal Gear Solid?",
answer: [/liquid/],
value: 1,
style:"minimum"
},
{
question: "Which game for the Wii has a critical bug which allows for homebrew game execution?",
answer: [/zelda/, /twilightprincess/, /smash(.*)brawl/, /smash/, /indianajones/, /yugioh/, /legobatman/, /starwars/, /symphonia/],
value: 1,
style:"minimum"
},
{
question: "Which games company recently announced that they are re-entering the hardware scene?<br><i>(Recent as of June 2017)",
answer: [/atari/],
value: 1,
style:"minimum"
}
];
construct(qr3,"qr3");
</script>




<br><br><br><br>
##Round 4 - GENERAL KNOWLEDGE
<script>
var qr4 = 
[
{
question: "Which YouTube pundit is said to have inadvertently created Five Nights at Freddy's, with their review of terrible mobile game Chipper &amp; Sons Lumber Co.?",
answer: [/jim/],
value: 1,
style:"minimum"
},
{
question: "Music round! Name the game. Bonus point if you can name the location in-game where the music plays.<br><audio controls><source src='/s/musq1.mp3' type='audio/mpeg'></audio>",
answer: [/breathofthewild/, /stable/],
value: 1,
style:"each"
},
{
question: "There are three classes in World of Warcraft which do not feature in Hearthstone. One point for each.<br><i>(As of June 2017.)",
answer: [/monk/, /dk|deathknight/, /demonhunter/],
value: 1,
style:"each"
},
{
question: "Music question 2! Name that game.<br><audio controls><source src='/s/musq2.mp3' type='audio/mpeg'></audio>",
answer: [/hexagon/],
value: 1,
style:"minimum"
},
{
question: "What was JAGEX originally short for?",
answer: [/javagam(.*)experts/],
value: 1,
style:"minimum"
},
{
question: "Music question 3! Name that game.<br><audio controls><source src='/s/musq3.mp3' type='audio/mpeg'></audio>",
answer: [/glide/],
value: 1,
style:"minimum"
},
{
question: "Which fantasy console was released by Lexaloffle in 2016?",
answer: [/pico8/],
value: 1,
style:"minimum"
},
{
question: "Last music question! Name that game.<br><audio controls><source src='/s/musq4.mp3' type='audio/mpeg'></audio>",
answer: [/doom/],
value: 1,
style:"minimum"
},
{
question: "In what year did Minecraft first surpass 1000 sales in a 24 hour period?",
answer: [/2010|twentyten|twothousand(.*)ten/],
value: 1,
style:"minimum"
},
{
question: "What is the game with the highest critical rating of all time? It is the only game to have a score of 99 out of 100 on Metacritic.",
answer: [/ocarina/],
value: 1,
style:"minimum"
}
];
construct(qr4,"qr4");
</script>




<br><br><br><br>
##Round 5 - PICTURE ROUND
<br>
In this round, the scoring is as follows:  
**ONE POINTS** for naming the exact game pictured.  
**HALF A POINT** for naming the right *series*.  
**NO POINTS** otherwise.
<br><br>


<script>
var qr5 = 
[
{
question: "<img src='/images/quiz/1.png' />",
answer: [/yoshis?wooll?yworld/, /yoshi/],
value: [1,0.5],
style:"first"
},
{
question: "<img src='/images/quiz/2.png' />",
answer: [/(gta|grandtheftauto)(4|four|iv)/, /gta|grandtheftauto/],
value: [1,0.5],
style:"first"
},
{
question: "<img src='/images/quiz/3.png' />",
answer: [/monumentvalley(2|two|ii)/, /monumentvalley/],
value: [1,0.5],
style:"first"
},
{
question: "<img src='/images/quiz/4.png' />",
answer: [/(cod|callofduty)(4|modernwarfare)/, /cod|callofduty/],
value: [1,0.5],
style:"first"
},
{
question: "<img src='/images/quiz/5.png' />",
answer: [/bubblebobble/],
value: [1,0.5],
style:"first"
},
{
question: "<img src='/images/quiz/6.png' />",
answer: [/monopoly/],
value: [1,0.5],
style:"first"
},
{
question: "<img src='/images/quiz/7.png' />",
answer: [/spelunky/],
value: [1,0.5],
style:"first"
},
{
question: "<img src='/images/quiz/8.png' />",
answer: [/^n\+\+$/,/^n/],
value: [1,0.5],
style:"first"
},
{
question: "<img src='/images/quiz/9.png' />",
answer: [/smash(.*)brawl/, /smash/],
value: [1,0.5],
style:"first"
},
{
question: "<img src='/images/quiz/10.png' />",
answer: [/spyrothedragon|^spyro$/, /spyro/],
value: [1,0.5],
style:"first"
}
];
construct(qr5,"qr5");
</script>

<div id="totalmark"></div>

The best possible mark is 57, including all the bonus points. Please do let me know how you get on!

Oh, and if you want the actual answers, you can see them [here](/s/QuizAs.html).
<br><br><br><br>

