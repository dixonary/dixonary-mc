<!--WGD Christmas Quiz 2017-->
#WGD Christmas Quiz 2017

In keeping with a new tradition... we have another quiz for Warwick Game Design!

Provided below for your enjoyment. Again, marked with regular expressions, please forgive any mistakes in the answers!

<script>

String.prototype.hashCode = function() {
  var hash = 0, i, chr;
  if (this.length === 0) return hash;
  for (i = 0; i < this.length; i++) {
    chr   = this.charCodeAt(i);
    hash  = ((hash << 5) - hash) + chr;
    hash |= 0; // Convert to 32bit integer
  }
  return hash;
};


function mark(n, q, a, qn) {
    if(q.num == undefined) q.num = 1;
    a = a.toLowerCase().replace(/[,.;:\-\s'"]/g,"");

    if(q.style == "numeric") {
       // This represents an answer followed by valid ranges, and the value is the relative range value.
       var ans = q.answer[0];
       var crange = 0;
       while(crange < q.answer.length-1) {
           if(Math.abs(a - ans) <= q.answer[crange+1]) break;
           crange++;
       }
       q.mark = q.value[crange];

       $("#"+q.hash+" input").css({"border": ""+Math.max(1,Math.min(q.mark,2)) + "px solid "+['red', 'green', 'limegreen'][Math.min(q.mark,2)]});
       return q.mark;
    }

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

    $("#"+q.hash+" input").css({"border": ""+Math.max(1,Math.min(q.mark,2)) + "px solid "+['red', 'green', 'limegreen'][Math.min(q.mark,2)]});

    return q.mark;
}

function markAll(questions, qn, answerfield) {
    var answers = $("#"+qn + " .answer").get().map(s=>s.value);
    var total = 0;
    console.log(answers);
    for(var i=0; i<answers.length; i++) {
        total += mark(i, questions[i], answers[i], qn);
    }
    answerfield.html("Total: " + total);
    answerfield.data("total", total);

    var all = $(".mark");
    console.log(all);
    var done = true;
    var tot = 0;
    for(var i=0; i<all.length; i++) {
        if(all.eq(i).data("total") === undefined) {
            done = false; 
            break;
        }
        else tot += all.eq(i).data("total");
    }
    if(done) {
         $("#totalmark").html("Grand Total: " + tot);
    }
}

function construct(questions, qn) {
    $("<div id='"+qn+"'></div>").appendTo($("#content"));
    for(var i=0; i<questions.length; i++) {
        questions[i].hash = questions[i].question.hashCode();
        $("<div class='flexr' id='"+questions[i].hash+"'><div><p class='number'>"+(i+1)+"</p></div><div class='questiond'><p class='question'>"+questions[i].question+"</p></div><div><p><input class='answer'></input></p></div></div>").appendTo($("#"+qn));
    }
    $('<div class="flexr"><button onclick="markAll('+qn+', \''+qn+'\', $(this).parent().find(\'.mark\'))">Mark!</button><div class="mark"></div></div>').appendTo($("#"+qn));
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
##Round 1 - HISTORY{.left}
<script>
var qr1 = 
[
{
question: "In which classic text adventure could you be eaten by a grue?",
answer: [/zork/],
value: 1,
style:"minimum",
num: 1
},
{
question: "Which font is used in the UI for <i>The Sims</i> (2000)?",
answer: [/comicsans/],
value: 1,
style:"minimum"
},
{
question: "Which game is regarded as the first to have included same-sex marriage?",
answer: [/fallout2|fallouttwo|falloutii/],
value: 1,
style:"minimum"
},
{
question: "Which was the first officially-licensed LEGO video game?",
answer: [/island/],
value: 1,
style:"minimum"
},
{
question: "What was interesting about the voice actors from Sega's 1990 game <i>Golden Axe</i>?",
answer: [/deathrow/],
value: 1,
style:"minimum"
},
{
question: "What is the in-game name for the first level of <i>Super Mario Bros</i>?",
answer: [/world11/],
value: 1,
style:"minimum"
},
{
question: "What is the FULL name of the protagonist from the LucasArts game <i>The Secret of Monkey Island</i>?",
answer: [/guybrush.*threepwood/],
value: 1,
style:"minimum"
},
{
question: "What is the name of Sid Meier's 1987 pirate adventure game?",
answer: [/pirates/],
value: 1,
style:"minimum"
},
{
question: "What was the full name of the Pinball game which came with every copy of Windows XP?",
answer: [/spacecadet/],
value: 1,
style:"minimum"
},
{
question: "Which video game is considered (above all others) to be a major contributing factor to the video game industry crash of 1983?",
answer: [/et/],
value: 1,
style:"minimum"
}
];
construct(qr1, "qr1");
</script>




<br><br><br><br>
##Round 2 - POPULAR GAMES{.left}
<script>
var qr2 = 
[
{
question: "What was the placeholder name for <i>Minecraft</i>'s villager NPCs?",
answer: [/testificate/],
value: 1,
style:"minimum"
},
{
question: "Which famous (old) musician collaborated with Bungie on the soundtrack to <i>Destiny</i>?",
answer: [/paulmccartney/],
value: 1,
style:"minimum"
},
{
question: "Which word does Wheatley ask you to say, to check for brain damage at the beginning of <i>Portal 2</i>?",
answer: [/apple/],
value: 1,
style:"minimum"
},
{
question: "Which real-world punctuation mark is used for the currency in the Sims universe?",
answer: [/sectionmark/, /§/],
value: 1,
style:"minimum"
},
{
question: "Newly released <i>Overwatch</i> character Moira has a skin based on which famous pop star?",
answer: [/bowie/],
value: 1,
style:"minimum"
},
{
question: "What was the total prize pool for The International 7, to the nearest million? <br><i>(3 points for exact, 1 point within 5 million. write your answer numerically!)</i>",
answer: [25000000, 500000, 5000000],
value: [3, 1, 0],
style:"numeric"
},
{
question: "What are the fruits called which Crash Bandicoot eats?",
answer: [/w(u|o)mpa/],
value: 1,
style:"minimum"
},
{
question: "What is the starting town in browser-based MMO <i>Runescape</i> called?",
answer: [/lumbridge/],
value: 1,
style:"minimum"
},
{
question: "What is the name of the dog musician in the <i>Animal Crossing</i> series?",
answer: [/kkslider/],
value: 1,
style:"minimum"
},
{
question: "What is the name of the innkeeper in <i>Hearthstone</i>?",
answer: [/he?arth/, /he?arthstonebrew/],
value: 1,
style:"minimum"
}
];
construct(qr2,"qr2");
</script>



<br><br><br><br>
##Round 3 - GENERAL KNOWLEDGE{.left}
<script>
var qr3 = 
[
{
question: "Which player character from <i>World of Warcraft</i> entered meme history when he charged into a raid alone while yelling his own name?",
answer: [/le+ro+yje+nki+n+s+/],
value: 1,
style:"minimum"
},
{
question: "Which company has sold more video game consoles than any other?",
answer: [/nintendo/],
value: 1,
style:"minimum"
},
{
question: "Which top-level domain is often used for simple, massively multiplayer online games?",
answer: [/io/],
value: 1,
style:"minimum"
},
{
question: "What is the name of the Big Bad Evil Guy in <i>Borderlands 2</i>?",
answer: [/handsomejack/],
value: 1,
style:"minimum"
},
{
question: "The SNES released in the USA was grey and what other colour?",
answer: [/purple/],
value: 1,
style:"minimum"
},
{
question: "What is the name of the protagonist from <i>DOOM</i>?",
answer: [/doomguy/, /marine/, /spacemarine/],
value: 1,
style:"minimum"
},
{
question: "Which video games company produced the <i>The Walking Dead</i> games?",
answer: [/telltale/],
value: 1,
style:"minimum"
},
{
question: "Tim Schafer started which games production company in the year 2000?",
answer: [/doublefine/],
value: 1,
style:"minimum"
},
{
question: "E3 is a major event in the video gaming calendar. But what does E3 stand for?",
answer: [/electronics?entertainments?expo/],
value: 1,
style:"minimum"
},
{
question: "What is EA Sports' motto, played at the start of every EA Sports game since 1994?",
answer: [/inthegame/],
value: 1,
style:"minimum"
}
];
construct(qr3,"qr3");
</script>




<br><br><br><br>
##Round 4 - INDIE GAMES{.left}
<script>
var qr4 = 
[
{
question: "Complete the first line of a popular indie game: <br><i>&quot;This is the story of a man named ______.&quot;",
answer: [/stanle?y/],
value: 1,
style:"minimum"
},
{
question: "Which (in)famous indie developer created <i>Fez</i>?",
answer: [/phil.*fish/],
value: 1,
style:"minimum"
},
{
question: "Which year did <i>Cuphead</i> begin development?",
answer: [/2010/, /twentyten/, /twothousand(and)?ten/],
value: 1,
style:"minimum"
},
{
question: "In which fictional eastern European country does <i>Papers, Please</i> take place?",
answer: [/arstotzka/],
value: 1,
style:"minimum"
},
{
question: "Which classic game primarily inspired <i>Stardew Valley</i>?",
answer: [/harvestmoon/],
value: 1,
style:"minimum"
},
{
question: "Indie &quot;walking simulator&quot; <i>Dear Esther</i> is supposedly set on an island in which archipelago?",
answer: [/hebride/],
value: 1,
style:"minimum"
},
{
question: "Name any TWO races from <i>FTL: Faster Than Light</i>. (2 points available!)",
answer: [/human/, /engi/, /mantis/, /rock/, /crystal/, /zoltan/, /slug/, /lanius/, /ghost/, /virus/],
value: 2,
style : "minimum",
num : 2
},
{
question: "What was the name of the cancelled indie game based around youtube network The Yogscast, which was funded over £500,000 through Kickstarter?",
answer: [/yogs?ventures/],
value: 1,
style:"minimum"
},
{
question: "Fill in the blank from the infamous Dwarf Fortress patch notes from 2010:<br><i>&quot;_____ kills everything it lands on.&quot;</i>",
answer: [/rain/],
value: 1,
style:"minimum"
},
{
question: "Which indie company produced the tiny game <i>Super Crate Box</i>?",
answer: [/vlambeer/],
value: 1,
style:"minimum"
}
];
construct(qr4,"qr4");
</script>




<br><br><br><br>
##Round 5 - PICTURE ROUND{.left}
<br>
In this round, the scoring is as follows:  
**ONE POINTS** for naming the exact game pictured.
**NO POINTS** otherwise.
<br><br>


<script>
var qr5 = 
[
{
question: "<img src='/images/quiz2/image1.png' />",
answer: [/spelunky/],
value: 1,
style:"minimum"
},
{
question: "<img src='/images/quiz2/image2.png' />",
answer: [/cuphead/],
value: 1,
style:"minimum"
},
{
question: "<img src='/images/quiz2/image3.png' />",
answer: [/hearthstone/],
value: 1,
style:"minimum"
},
{
question: "<img src='/images/quiz2/image4.png' />",
answer: [/(starwars)?battlefront(2|two)/],
value: 1,
style:"minimum"
},
{
question: "<img src='/images/quiz2/image5.png' />",
answer: [/connect(4|four)/],
value: 1,
style:"minimum"
},
{
question: "<img src='/images/quiz2/image6.png' />",
answer: [/odyssey/],
value: 1,
style:"minimum"
},
{
question: "<img src='/images/quiz2/image7.png' />",
answer: [/destiny/],
value: 1,
style:"minimum"
},
{
question: "<img src='/images/quiz2/image8.png' />",
answer: [/supermeatboy/],
value: 1,
style:"minimum"
},
{
question: "<img src='/images/quiz2/image9.png' />",
answer: [/room/],
value: 1,
style:"minimum"
},
{
question: "<img src='/images/quiz2/image10.png' />",
answer: [/sonicforces/],
value: 1,
style:"minimum"
},
];
construct(qr5,"qr5");
</script>

<div id="totalmark"></div>

The best possible mark is 53, including all the bonus points. Please do let me know how you get on!

Oh, and if you want the actual answers, you can see them [here](/s/2017ChristmasQuizAs.html).
<br><br><br><br>
