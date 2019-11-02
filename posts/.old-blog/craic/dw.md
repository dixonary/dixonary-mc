<!--Doctor Who Story Mad-Libs-->
#Build a Doctor Who Episode

1. Click "Generate new Lib".
1. Fill in the blanks.
1. Press "Fill Lib" and watch your amazing™ story come to life.

<div id="libs">
</div>
<button onclick="gen()">Generate new Lib</button>
<button onclick="done()">Fill Lib</button>

<div id="result">
</div>

<script>

var segs = [];

segs["loc"] = "#{Location}";
segs["c"]   = "#{Celestial Object}";
segs["o"]   = "#{Object (singular)}";
segs["opl"] = "#{Object (plural)}";
segs["bp"]  = "#{Body Part (plural)}";
segs["ip"]  = "#{Inhabited Planet}";
segs["ant"] = "#{Type of Animal}";
segs["an"]  = "#{Animal}";
segs["verb"]= "#{Verb}";
segs["badv"]= "#{Bad verb (-ing ending)}";
segs["p2"]   = "#{Planet}";
segs["trav"]= "#{Mode of Transport}";
segs["tp"] =  "#{Time period}";
segs["comp"] = "#{Companion}";
segs["enemy"] = "#{Enemy of the Doctor (singular)}";
segs["enpl"] = "#{Enemy of the Doctor (plural)}";
segs["tv"] = "#{Something you do to someone}";
segs["m"] = "#{Material}";
segs["race"] = "#{Species}";
segs["machine"] = "#{Machine}";
segs["put"] = "#{Somewhere you put things}";

segs["main"] = "@beginning @middle @ending";

segs["ent"] = ["", "entirely "];
segs["p"] = ["@p2", "% @c made @ent&zwnj;of @m"];

segs["fate"] = [
"@badv", "@badv", "@badv", "@badv", "@badv", "@badv", "@badv", "@badv", "@badv", "@badv", "exploding", "falling apart", "imploding", "cracking in two", "falling apart", "turning to @m", "being @tv&zwnj;ed by @enemy"];

segs["tora"] = ["@trav", "@an", "@ant" ];
segs["luck"] = [ "Luckily, t", "T", "In the nick of time, t" ];
segs["in"] = [ "", " in @when" ];

segs["distant"] = ["the distant ", "the "];
segs["locin"]   = ["@loc in ", ""];
segs["when"] = [
   "@loc",
   "@tp",
   "the @time",
   "@locin&zwnj;@distant&zwnj;@time",
];
segs["time"] = ["future", "past"];
   
segs["beginning"] = [
  "The story begins in @loc with @begmult", 
  "The Doctor is flying the TARDIS around @loc@in. @begmult2", 
  "@cord is in trouble on @p. @escape",
  "The episode opens with @begmult",
  "A huge @an is rampaging around @loc.",
  "The TARDIS is stuck in a @uord."
];

segs["uord"] = [
  "dream state", 
  "@put universe", 
  "@put dimension"
];

segs["escape"] = [
  "@luck&zwnj;hey are able to escape on a space @tora.",
  "@luck&zwnj;hey escape by firing % @thing into the centre of the @c."
];

segs["thing"] = ["@o", "@enemy", "@an"];

segs["begmult"] = [
   "a heartfelt reunion between @comp and The Doctor.",
   "everything @fate.",
   "all the @opl on @ip @fate.",
];

segs["dim"] = ["tele", "trans"];
segs["begmult2"] = [
   "Suddenly, everyone is @dim&zwnj;ported to @loc.",
   "Suddenly, everyone is @dim&zwnj;ported to @when.",
   "Suddenly, everyone is @dim&zwnj;ported to @p.",
];

segs["cord"] = [
  "@comp", 
  "The Doctor"
];

segs["someone"] = [
  "@comp",
  "@enemy",
  "the @race race"
];


segs["middle"] = "@midstart @middle2 @solution";
segs["midstart"] = [
  "Now it gets personal.",
  "Meanwhile, a huge space @trav is crashing into the @c.",
  "They discover a new species which @ability.",
  "Meanwhile, the @enemy are roaming the streets of @loc.",
  "@ip is infiltrated by a race of @racetype",
  "Everything around them is actually a hologram.",
  "Two or three characters receive a @tv from @enemy.",
];

segs["racetype"] = [
   "@sent&zwnj;@an people",
   "@sent&zwnj;@an people",
   "@sent&zwnj;@an people",
   "@m harvesters"
];

segs["sent"] = ["", "sentient "];
segs["ability"] = [
  "turns any @o into @m with a single @tv",
  "can kill you with one @tv",
  "is unable to @tv",
  "turns everyone into @m",
  "has no @bp."
];
segs["middle2"] = [
  "The Doctor seeks the help of @someone.",
  "The Doctor turns to @someone for advice.",
  "@comp is revealed to actually be an incarnation of River Song.",
  "The Cloister Bell rings in the TARDIS.",
  "The @enpl have become more powerful than ever before.",
  "",
  ""
];
segs["solution"] = [
  "The enemy is beaten with the power of emotions.",
  "The Doctor builds % @machine out of @buildm.",
  "@comp comes out of nowhere and saves the day.",
]
segs["ending"] = "@e1 @e2";
segs["e1"] = [
  "The day is saved.",
  "They escape with only their lives.",
  "@comp has their @bp turned into @m but is otherwise unscathed.",
  "",
  ""
];

segs["e2"] = [
  "It turns out the whole episode took place inside of a @uord.",
  "@comp is returned to their home planet.",
  "There is an emotional farewell with @comp."
];

segs["buildm"] = ["TARDIS parts", "bits and bobs", "@m"];

// Look up an element in the story segments table.
function seg(name, p1) {
    if(typeof(segs[p1]) == "undefined") {
        return "@" + p1;
    }
    else if(typeof(segs[p1]) == "string") {
        return segs[p1];
    }
    else {
        return pick(segs[p1]);
    }
}

// Select a random element from an array.
function pick(arr) {
    n = Math.random() * arr.length;
    return arr[Math.floor(n)];
}

// Count occurrences of a character in a string.
function count(str,char) {
    return str.split('').map( function(e){ return e===char; } )
             .filter(Boolean).length;
}

// Generate appropriate indefinite article.
function article(m, o) {
    console.log(m);
    return ("aeiouAEIOU".indexOf(m[2]) == -1?"a ":"an ") + m[2];
}

// Add a lib to the libs div.
function addlib(name, p1) {
    console.log(p1);
    var k = $('<div style="order:'+Math.floor(Math.random()*0)+'"><p class="label">'+p1+'</p><input></input></div>');
    $("#libs").append(k);
}

function fill() {
    ctr++;
    return $("#libs>div:nth-child("+ctr+")>input").val();
}

var lib;
var ctr;

function gen() {
    lib = "@main";

    var i = 0;                                      //max depth of 100; avoid infinite loops!
    while (count(lib, "@") > 0 && i++<100) {
        lib = lib.replace(/@([a-zA-Z0-9]+)/g, seg);
    }
    $("#libs").empty();
    $("#result").empty();
    lib.replace(/#{(.*?)}/g, addlib);
    console.log(lib);
}

function done() {
    ctr = 0;
    lib2=lib.replace(/#{(.*?)}/g, fill); 
    console.log(lib2);
    lib2=lib2.replace(/\%\s[a-zA-Z]/g, article); 
    $("#result").html(lib2);
}

</script>
<style>
p.label { width:50%; display:inline-block; }
#libs { display:flex; flex-flow:column; }
</style>