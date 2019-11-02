----------------
title: Junkrat Name Generator
----------------

Press this button to generate: <button onclick="gen()">Generate</button>

<div id="result">
</div>

<br>
This is built with my handy [grammar based text generator](/textgen). Check it out!
<br>
Also suggest more "junk" and "rat" synonyms at me.
<br><br>

<textarea readonly id="grammar" class="code block" rows="14">
grammar.main = "@junk@rat";

grammar.junk = ["Junk", "Trash", "Rubbish", "Garbage", "Debris", 
                "Waste", "Dross", "Litter", "Refuse", "Scrap"];

grammar.rat  = ["Vermin", "Rat", "Rodent", "Vermin", "Wretch", 
                "Vole", "Hamster", "Gerbil", "Gopher"];
</textarea>
<br>

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
    eval(document.querySelector("#grammar").value);
    txt = generate("@main");                                   //<---THE IMPORTANT BIT!
    document.querySelector("#result").innerHTML = "<div class='block'>"+txt+"</div>";
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
</style>

<script>
eval(document.querySelector("#code").value);
eval(document.querySelector("#gencode").value);
</script>
