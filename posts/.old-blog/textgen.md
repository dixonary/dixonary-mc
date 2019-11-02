<!--A small JavaScript grammar based generator-->
#A JS text generator

I do a bit of stuff with text generators from time to time. To help with this I wrote a short[^short] JavaScript engine which can take a grammar and generate a random valid string in that language. 


# How it works

A *grammar* in formal terms may look something like this[^lua]:
![](/images/lua_expr.png){.native}

Grammars are used in compilers (parsers in particular) to work out whether a given piece of code is valid, and what each of the symbols means. You may notice that the example given in the [**Testbed**](#Testbed) section of this page looks similar in structure. Each line of the grammar is called a *production rule* - it shows how the left hand side can be converted to the right-hand side. The symbols of the language are on the left hand side of the production rules. One symbol is called the start symbol, and it is conventionally defined in the top rule.  A *terminal* is something on the right which doesn't appear on the left. In this case `Number`, `String`, `false` and `'...'` are terminals. A *non-terminal* is something on the right which is itself a symbol. `exp` and `prefixexp` are non-terminals here.

In a grammar, you can define a symbol multiple times. `exp` is redefined on almost every line of the grammar above. This represents *nondeterminism*. In fact this means all the definitions hold at once, and anything which fits the format of the RHS can be called an expression. Some of the production rules have the pipe symbol | on the right; this is exactly the same thing. You can determine whether some text is valid within some language by checking if there is any path of evaluation which can take you from the top of the tree, to the given text.

For example, a valid evaluation (parse tree) for the expression `(1000)` might look like this:

![](/images/expr.png){.half}

Here a parser would evaluate `(1000)`, find the parse tree above and determine that it is, in fact, a valid expression. Our job is to do the opposite - to start at the top and pick a parse tree completely at random.

Usage of the grammar is as follows:

1. You define the **symbols**, **terminals** and **non-terminals** of the grammar.
2. You call `generate(top)` where `top` is your "top level" text.
3. The generator will return a generate the result of a random parse tree.

In fact, the grammar defines a degenerate Markov matrix, which is then used to evaluate the grammar depth-first. This is the same thing used in Markov Chain generators, except the probabilities are uniform across all options rather than being weighted by a given corpus of text.

<a name="testbed"></a>
# Testbed / Example

You can edit or replace this grammar in the editable text box below:

<br>

<textarea rows="15" id="grammar" class="code block" style="overflow:auto;">
grammar.main    = "@left : '@right'";           // I use "main" as the root node. Up to you.

grammar.left    = ["@option1", "@option2"];   // Branching! Use an array to specify options.
grammar.option1 = "Derek";
grammar.option2 = "Dave";

grammar.right   = ["@right No... @tomato!", "@tomato."]; // You can have loops! @right is self referential.
grammar.tomato  = "I am % @fruit";           // Helper for generating indefinite article (a/an).
grammar.fruit   = ["apple", "tomato"];       // The article will be correct either way.

</textarea>

<br>

Press this button to generate a random sentence with the grammar: <button onclick="gen()">Generate</button>

<div id="result">
</div>

#Limitations

There aren't currently any ways to hook into the parsing, for instance if you wanted to add your own symbols. I used # in [Doctor Who Mad Libs](/dw) to identify input fields and fill them in. You can check the source code of that page if you want to find out how that works, but the code for the generator is much messier than the tidy code presented here.

It also can't do anything clever like use the relevant pronouns when referring to a particular character. It seems like a very complex problem which would be easier to solve on a case-by-case basis. I recommend using "their" instead of bothering[^their].

#The Code

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
Yep, that's the whole thing. Please put @dixonary somewhere (attribution) if you end up using it, or a modified version of it, in one of your projects. Other than that, go nuts!

Oh, and below is the code for the "generate" button in the Testbed section of this page.

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
</style>

<script>
eval($("#code").val());
eval($("#gencode").val());
</script>