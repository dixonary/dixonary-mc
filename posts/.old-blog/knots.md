<!--Knot name generator-->
#Knot name generator

Press this button to generate: <button onclick="gen()">Generate</button>

<div id="result">
</div>

<br>
This is built with my handy [grammar based text generator](/textgen). Check it out!
<br><br>

<a onclick="$('#grammar').slideToggle()" href="#">Click to show/hide grammar</a> 
<textarea rows="15" id="grammar" class="code block" style="overflow:auto;">
grammar.main    = "@mod @surnames@part@type";           // I use "main" as the root node. Up to you.

grammar.mod     = ["", "@mod1", "@mod1", "@mod1 @mod"];
grammar.mod1    = ["half", "reverse", "backward", "slippery", "left-handed"];
grammar.part    = ["top-", "square-", "box-", "death-", "double-","slip-","","",""];
grammar.type    = ["knot", "hitch", "bight", "turn", "bend", "bowline"];

grammar.loc     = ["French", "Portuguese", "German", "Macedonian", "Yemenese", "Japanese", "Iranian", "Iraqi", "Scottish"];
grammar.extras = ["Fisherman's", "Woodsman's", "Butcher's", "Undertaker's", "Teacher's"];
grammar.surnames = ["", "@loc ", "@extras ", "@surname ","@surname "]
grammar.surname = ["Abram",
"Acton",
"Addington",
"Adley",
"Ainsley",
"Ainsworth",
"Alby",
"Allerton",
"Alston",
"Altham",
"Alton",
"Anderton",
"Ansley",
"Anstey",
"Appleton",
"Asheton",
"Ashley",
"Ashton",
"Astley",
"Atherton",
"Atterton",
"Axton",
"Badger",
"Barclay",
"Barlow",
"Barney",
"Barton",
"Beckwith",
"Benson",
"Bentham",
"Bentley",
"Berkeley",
"Beverly",
"Bing",
"Birkenhead",
"Blackwood",
"Blakeley",
"Blakely",
"Blankley",
"Blyth",
"Blythe",
"Bradford",
"Bradley",
"Bradly",
"Bradshaw",
"Brady",
"Brandon",
"Branson",
"Braxton",
"Breeden",
"Brent",
"Bristol",
"Brixton",
"Browning",
"Brownrigg",
"Buckingham",
"Budd",
"Burton",
"Byron",
"Camden",
"Carlisle",
"Carlton",
"Carlyle",
"Cason",
"Charlton",
"Chatham",
"Chester",
"Cholmondeley",
"Churchill",
"Clapham",
"Clare",
"Clayden",
"Clayton",
"Clifford",
"Clifton",
"Clinton",
"Clive",
"Colby",
"Colgate",
"Colton",
"Compton",
"Coombs",
"Copeland",
"Cornish",
"Cotton",
"Crawford",
"Cromwell",
"Cumberbatch",
"Dalton",
"Darby",
"Darlington",
"Davenport",
"Dayton",
"Deighton",
"Denholm",
"Digby",
"Dryden",
"Dudley",
"Eastaughffe",
"Eastoft",
"Easton",
"Elton",
"Emsworth",
"Enfield",
"England",
"Everleigh",
"Everly",
"Farley",
"Fawcett",
"Fulton",
"Garfield",
"Garrick",
"Gladstone",
"Goody",
"Graeme",
"Graham",
"Gresham",
"Hackney",
"Hadlee",
"Hadleigh",
"Hadley",
"Hailey",
"Hale",
"Hales",
"Haley",
"Hallewell",
"Halsey",
"Hamilton",
"Hampton",
"Harlan",
"Harley",
"Harlow",
"Harrington",
"Hartford",
"Hastings",
"Hayden",
"Hayes",
"Hayhurst",
"Hayley",
"Holton",
"Home",
"Hornsby",
"Huckabee",
"Huxley",
"Kelsey",
"Kendal",
"Kendall",
"Kenley",
"Kensley",
"Kent",
"Kimberley",
"Kimberly",
"Kinsley",
"Kirby",
"Lancaster",
"Landon",
"Langdon",
"Langley",
"Langston",
"Law",
"Leighton",
"Lester",
"Lincoln",
"Lindsay",
"Lindsey",
"Livingstone",
"Manley",
"Marlee",
"Marleigh",
"Marley",
"Marlowe",
"Marston",
"Merton",
"Middleton",
"Milton",
"Mitchell",
"Morley",
"Morton",
"Myerscough",
"Nash",
"Nibley",
"Northcott",
"Norton",
"Oakes",
"Oakley",
"Ogden",
"Paxton",
"Payton",
"Perry",
"Peyton",
"Pickering",
"Pinkerton",
"Prescott",
"Presley",
"Preston",
"Quinton",
"Ramsay",
"Ramsey",
"Rayden",
"Read",
"Redfield",
"Reed",
"Reid",
"Remington",
"Ridley",
"Riley",
"Rodney",
"Roscoe",
"Rowley",
"Royal",
"Royston",
"Rutherford",
"Rutland",
"Rylan",
"Ryland",
"Ryley",
"Scarboro",
"Scarbrough",
"Shelby",
"Sheldon",
"Shelley",
"Shelly",
"Sherwood",
"Shipley",
"Shirley",
"Skelton",
"Snape",
"Snowdon",
"Soames",
"Southey",
"Spalding",
"Spaulding",
"Springfield",
"Stafford",
"Stanford",
"Stanley",
"Stansfield",
"Stanton",
"Stapleton",
"Start",
"Stratford",
"Sutherland",
"Sutton",
"Sydney",
"Tattersall",
"Tatum",
"Tenley",
"Tewksbury",
"Thackeray",
"Thornton",
"Thorpe",
"Tickle",
"Tindall",
"Tinley",
"Trollope",
"Tyndall",
"Upton",
"Vance",
"Wade",
"Wakefield",
"Walcott",
"Wallace",
"Walpole",
"Warwick",
"Washington",
"Webley",
"Wedgwood",
"Weld",
"Wellington",
"Wentworth",
"Wesley",
"Westbrook",
"Westcott",
"Weston",
"Wharton",
"Wheatley",
"Whitby",
"Wilberforce",
"Willoughby",
"Winchester",
"Windsor",
"Winterbourne",
"Winthrop",
"Wordsworth",
"Yardley",
"Yeardley",
"York",
"Yorke"
];
</textarea>


<textarea readonly id="code" class="code block" rows="23">
var maxDepth = 100; // Maximum number of replacements before giving up.
var grammar = [];
var lib;

// Look up an element in the story segments table.
function seg(g, name, p1) {
    if     (typeof(g[p1]) == "undefined") return "@" + p1;
    else if(typeof(g[p1]) == "string")    return g[p1];
    else                                  return pick(g[p1]);
}

// Helper functions for array selection and indefinite article.
var pick = (arr) => arr[Math.floor(Math.random() * arr.length)];
var article = (m, o) => ("aeiouAEIOU".indexOf(m[2]) == -1?"a ":"an ") + m[2];

// The heavy lifting!
function generate(txt, g=grammar) {
    var i = 0; //max depth of 100; avoid infinite loops!
    while(txt.indexOf("@")>=0&&i++<maxDepth) txt = txt.replace(/@([a-zA-Z0-9]+)/g, seg.bind(this,g));
    if(i>=maxDepth) txt += "<p style='color:red;'>[Hit maximum iteration depth ("+maxDepth+")]</p>";
    txt=txt.replace(/\%\s[a-zA-Z]/g, article); 
    return txt;
}
</textarea>
<br>

<textarea readonly id="gencode" class="code block" rows="6">
function gen() {
    grammar = [];
    eval($("#grammar").val());
    txt = generate("@main");                                   //<---THE IMPORTANT BIT!
    $("#result").html("<div class='block'>"+txt+"</div>");
}
</textarea>

[^short]: 23 lines!
[^lua]: This is the part of the Lua language definition, in particular defining an Expression.
[^their]: [Link to why](https://www.youtube.com/watch?v=46ehrFk-gLk)

<style>
.code {
    width:100%;
    resize:none;
    overflow:hidden;
    border:none;
    height:auto;
    background-color:#eee;
    border:2px solid #ddd;
    outline:none;
}
textarea {
display:none;
}
</style>

<script>
eval($("#code").val());
eval($("#gencode").val());
</script>