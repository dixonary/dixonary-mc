-----------
title: The Mini Metro Problem
date:2019-05-01
-----------
<style type="text/css">


    html, body { margin-top: 0 !important; }
    :root {
        font-family: sans-serif;
    }
    html {
    }
    main {
        background-color:white;
    }
    p,li {
        margin-bottom: 1rem;
        line-height:1.5;
    }

    section {
        display:flex;
        flex-direction:row;
        position:relative;
        margin-top:4rem;
    }
    section content:after{
        content:none;
    }
    section:before {
        height:4px;
        width:calc(100% - 4rem);
        display:block;
        margin:2rem;
        background-color:#ccc;
        content:'';
        position:absolute;
        top:-4rem;
    }
    section>* {
        width:50%;
    }
    section img {
        object-fit:contain;
        width:100%;
    }
    span.ed {
        color:#aaa;
        font-style:italic;
        padding:0 0.5em;
    }

    em {
        font-style:italic;
    }
    ul {
        list-style-type:disc;
        list-style-position: inside;
    }
    li {
        padding-left:0.5em;
    }
    strong {
        font-weight:bold;
    }


@media screen and (max-width:768px) {
    section {
        flex-direction: column-reverse;
    }

    section>* {
        width:100%;
    }
}

</style>
    
<div id="top">
<p>This talk was originally given to the University of Warwick's <a href="https://warwickgamedesign.co.uk">Game Design Society</a> in early 2019; a version was also given at the Birmingham Video Game Indies talk sessions (BITS) in April of 2019.</p>

<p>If you have any questions or queries, please do contact me directly.</p>

<p>This is an image rendering of somewhat dynamic slides. If the visualisation is not obvious it will be explained in [square brackets].</p>

</div>        
<section>
<content>
<p>My name is Alex Dixon. I am a PhD student in Computer Science, teacher, CTO, journalist, and mostly-amateur game designer. I'm also an invited speaker from time to time.</p>
<p>If you want to contact me then you can do so on Twitter <a href="https://twitter.com/dixonary_">@dixonary_</a><span class="ed">[Yes, I got my own Twitter handle wrong on the slides. &mdash;Ed.]</span> or at the email address listed here.</p>
<p>Today I'm going to introduce to you what I like to call the <em>Mini Metro problem</em> &mdash; we'll get into what that is in a short while.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide1.png"></figure>
</section>

<section>
<content>
<p>Just a quick overview of what we'll be talking about today. We'll cover <span class="ed">[deep breath]</span> minimalism, maximalism, reductivism, reductionism, aesthetics, aestheticism, essentialism and the general idea of goodness.</p>
<p>If that sounds like a lot to cover in an hour then buckle up &mdash; this talk is only half an hour long. We'll go swimming in critical theory, we'll quote artists and draw pretty shapes.</p>
<p>It's a bit of a rollercoaster, and like all the best rollercoasters it goes off the rails at the end.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide2.png"></figure>
</section>

<section>
<content>
<p>Let's first discuss the main thesis of the talk.</p>
<p>It comes in two parts. The first is almost axiomatic, but let's talk it through anyway - that Mini Metro is a <em>good</em> game.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide3.png"></figure>
</section>

<section>
<content>
<p><span class="ed">[Thesis slide parts like a curtain, revealing Thesis slide 2]</span></p>
<p>And the second part is that Mini Metro is actually <em>bad</em> at minimalism.</p>
<p>Now this is really only here for shock factor, but there really is an important point to be made here. There is lot that we want to unpack and discuss.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide4.png"></figure>
</section>

<section>
<content>
<p>But first... I want to take you back in time.</p>
<p>Let us travel back to a happier time. Barack Obama was still the leader of the free world. Brexit was still a glint in the eye of the far right. And Ludum Dare was <em>really</em> starting to take off.</p>
<p>April of that year saw over 2300 submissions. The theme was <em>Minimalism</em>. For three days, more than 3000 game developers tried to cram as much minimalism as they could into their games.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide5.png"></figure>
</section>

<section>
<content>
<p><span class="ed">[Video plays of <em>Mind the Gap</em> gameplay]</span></p>
<p>One such team of game developers built this game for the Jam, which was released under the name <em>Mind the Gap</em>. </p>
<p>As you can see, <span class="ed">[You can't. &mdash;Ed.]</span> the game has only a few elements. There are these larger unfilled shapes, which we will call <em>stations.</em> Smaller filled shapes which we will call <em>passengers.</em> Large rectangles which we will call <em>trains</em>. And coloured lines, which we will call, er... <em>lines.</em></p>
<p>From the description alone this game is pretty darn minimal. Maybe even minimal<em>ist.</em></p>
<p><span class="ed">[Vertical thirds appear.]</span></p>
<p>And people seemed to agree. The game was fifth in the jam for the Theme category and seventh overall. It even came in the top 300 for humour, which is quite fascinating.</p>
<p>Our heroes then thought "Hold on, people really <em>do</em> like this. So they went ahead and formed a company, called it Dinosaur Polo Club, and set to work.</p>
<p>Just over a year later, the game was released on Steam Early Access under the name <em>Mini Metro</em>. It left early access just over a year later again to great acclaim.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide6.png"></figure>
</section>

<section>
<content>
<p>Now let's fast forward to early 2017. Barack Obama is no longer the leader of the free world and Brexit has been born with full and unpleasant force. But there is some good still left in the world, and I set off to the USA in search of it.</p>
<p>My search took me to Chicago first, at which point I boarded a train bound for San Fransisco with upwards of 300 other übernerds for the annual event known as TRAIN JAM.</p>
<p>That's right, a 52-hour game jam set aboard a moving train. Since I'm giving this talk you might be able to guess that I'm a bit of a train fan, but this is seriously one of the best experiences a person could have. If you ever get the chance to go, <em>go</em> - you won't be disappointed.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide7.png"></figure>
</section>

<section>
<content>
<p>On arrival in San Fransisco, we put up in a hotel with comically low shower heads, and picked up our badges for the annual Game Developer's Conference.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide8.png"></figure>
</section>

<section>
<content>
<p>This was a brilliant opportunity to hear about the good work of game developers around the world. (Though there are definitely groups that are underrepresented even now at GDC, since getting there is often cost-prohibitive.)</p>
<p>The talks were invariably great. This one pictured here was given by the creators of the Pandemic Legacy board game.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide9.png"></figure>
</section>

<section>
<content>
<p>I was also lucky enough to meet some of the Dinosaur Polo Club team at a mixer for Global Game Jam organisers and participants.</p>
<p>They were incredibly nice and it was wonderful to meet some people who had made one of my favourite games.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide10.png"></figure>
</section>

<section>
<content>
<p>One member of the team, a person called Jamie Churchman, gave a great talk about, well, the minimalist nature of Mini Metro. (Which doesn't inspire great confidence in getting this talk accepted to GDC, but never mind.)</p>
<p>The talk was wonderful and in depth, but the fundamental idea was quite simple: The core of your game is absolutely the most important thing.</p>
<p>Anything you add should only seek to enhance, amplify and support the core <em>aesthetic</em> of your game.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide11.png"></figure>
</section>

<section>
<content>
<p>Let's talk about that word for a moment. Aesthetic.</p>
<p>The aesthetic of a game specifically concerns its beauty. This can mean different things depending on the context, but in games we often associate it with two main ideas:</p>

* The <em>direction</em> of the game, in terms of art and sound design among other things;</li>
* The overall <em>design philosophy</em> of the designers and developers in creating the game.</li>

</content>
<figure><img src="/static/mini-metro-talk/Slide12.png"></figure>
</section>

<section>
<content>
<p>Moreover, we can say that a person &mdash; designer, philosopher, etc. &mdash; is <em>aestheticist</em> when they are valuing the <em>aesthetic</em> of their creation over all other goals.</p>
<p>When the most important thing to a creator is the aesthetic beauty of their art, we say that they are aestheticist.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide13.png"></figure>
</section>

<section>
<content>
<p><span class="ed">[Owing to a lack of font embedding in the BITS version of this talk, this slide, normally one of my favourites, was comically mangled. &mdash;Ed.]</span></p>
<p>It's time to dive into specifics now. What do we mean when we talk about something being minimalist?</p>
<p>What <em>is</em> minimalism?</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide14.png"></figure>
</section>

<section>
<content>
<p>Let's ask Google Images what minimalism looks like.</p>
<p>What is it that unifies of these images? Aside from a weirdly high amount of yellow, that is? I posit that the answer is "Not a lot".</p>
<p>Which is to say that there's <em>not a lot</em> in any of these pictures. The unifying feature is merely a lack of stuff. The minimalist aspect of these artworks is that they simply have not very much in them.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide15.png"></figure>
</section>

<section>
<content>
<p>Returning back to the world of games now. Let's say that this circle is the core of your game. You might call it your MVP (minimum viable product), or even just a well-refined prototype.</p>
<p>The important point is that it is tight, it is simple, it is regular. Uncomplicated and perfect.</p>
<p>What happens if we introduce some new elements without paying attention to our core?</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide16.png"></figure>
</section>

<section>
<content>
<p>Well, you might get something like this.</p>
<p>We're not all artists but I think we can generally agree that this is artistically less nice than our core alone.</p>
<p>It's more <em>interesting,</em> sure &mdash; there's more going on &mdash; but that doesn't mean it is <em>better.</em></p>
</content>
<figure><img src="/static/mini-metro-talk/Slide17.png"></figure>
</section>

<section>
<content>
<p>So let's try again. What if we follow Jamie Churchman's advice?</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide18.png"></figure>
</section>

<section>
<content>
<p>Here we have introduced some new elements, but we have made sure to pay attention to the core and build around it and with it.</p>
<p>If we maintain the aesthetic of the core of our game, we can introduce new features without losing the focus and beauty that our core already had.</p>
<p>These new features, this additional complexity, can support and amplify what is great about our game, rather than obscure or deflect from it.</p>
<p>When Jamie Churchman speaks of the minimalism of Mini Metro, he is really claiming that the <em>core</em> of the game is minimalist &mdash; and that careful introduction of new features makes it no less so.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide19.png"></figure>
</section>

<section>
<content>
<p>Churchman's is a very pragmatic view of minimalism. But it's one that is not shared by many in the minimalist world.</p>
<p>Let's look at what Ad Reinhardt had to say on the matter. Reinhardt was an artist and painter who was quite famous in the minimalist movement of the early-mid 1920s.</p>
<p>Most of this is bumf. This famous minimalist could definitely have got the point across in fewer words. The most important part is the last line: <strong>Art begins with the getting rid of nature.</strong></p>
</content>
<figure><img src="/static/mini-metro-talk/Slide20.png"></figure>
</section>

<section>
<content>
<p>For the sake of convenience I have provided some nature for us to look at.</p>
<p>What do we <em>not</em> see here? What's missing? I appreciate that many of us are scientists and would rather a less nebulous question, but if you haven't noticed by now this is a very artistic and theoretical talk. So let's give it a go.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide21.png"></figure>
</section>

<section>
<content>
<p>We certainly don't see any straight lines or solid colours here. Everything is very messy and colours blend from one to the next easily.</p>
<p>There is no perfect symmetry and there is no congruence of shape! In other words, every single aspect of nature is different. No two things are the same.</p>
<p>In other words, then, the main thing missing from nature is <em>simplicity.</em></p>
<p>When Reinhardt says that "art begins with the getting rid of nature", what they really mean is that art begins by removing the <em>simple</em> and embracing the <em>complex.</em></p>
<p>That art is simplicity, and <em>more stuff is bad minimalism.</em></p>
</content>
<figure><img src="/static/mini-metro-talk/Slide22.png"></figure>
</section>

<section>
<content>
<p>It's time to move on to another philosopher now, the <em>reductionist.</em></p>
</content>
<figure><img src="/static/mini-metro-talk/Slide23.png"></figure>
</section>

<section>
<content>
<p>The philosophy of reductionism is that we can break concepts into their fundamental components. We'll be sticking to games for the sake of this talk.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide24.png"></figure>
</section>

<section>
<content>
<p>Moreover, a reductionist would say that the act of doing so, the act of breaking ideas down into smaller, simpler ones, is good and virtuous.</p>
<p>I won't comment on whether or not this is morally or philosophically <em>right</em> - these are just things that some people hold true.</p>
<p>And so, our reductionist will try to break things down into what they are. If the constituent parts of two things are the same, then a reductionist might say that the two things are similar.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide25.png"></figure>
</section>

<section>
<content>
<p>Let's use Tetris as a fairly simple example.</p>
<p>A reductionist might break Tetris down into the following key elements:</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide26.png"></figure>
</section>

<section>
<content>
<p>1. It has block puzzle mechanics.</p>
<p>By moving controls, blocks on the screen move by discrete quantities.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide27.png"></figure>
</section>

<section>
<content>
<p>2. We have arcade pacing.</p>
<p>We can just define that to say that things will happen even if you take your hands off the controls, normally resulting in a game over. The game gets more complex over time.</p>
<p>There is also a score counter which has no significant effect on the gameplay. Another fundamental feature which a reductionist might say defines the "arcade" genre.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide28.png"></figure>
</section>

<section>
<content>
<p>3. And we have a skill test.</p>
<p>The game is constantly challenging your ability to play it. As gameplay continues, the challenge increases until it overwhelms you.</p>
<p>We can say that the main challenge is one of hand-eye coordination. In the case of Tetris we also have spatial reasoning and planning challenges.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide29.png"></figure>
</section>

<section>
<content>
<p>But what's the point of this? Why is reductionism useful for us as game developers?</p>
<p>Well, it allows us to describe different aspects of our games with <em>precision.</em></p>
<p>It might be difficult to describe the differences and similarities of Tetris versus <em>Baba is You</em>, say, but we could talk about the control scheme of the two, or which has the better sound design.</em> Reductionism gives us a tool in our critical theory arsenal.</p>
<p>This kind of reduction is usually quite doable for video games, moreso than for some other creative media. There's a reason we hire sound designers and art directors separately &mdash; they have different skill sets and their output is intertwined, but still separable.</p>
<p>A quick sidenote: I know that we have heard plenty about "what gamers want", and especially with respect to games journalism. But this is where a lot of the (benign) friction between gamers and journalists exists. Gamers are often asking for a <em>reductionist</em> approach to journalism - separated and precise analysis of a game's component parts.</p>
<p>Journalists are (quite rightly) not keen to take them up on this. Firstly it would make any two reviews pretty darn similar, but there is also a loss of information when we do this reduction. We can talk about the parts, but we lose the ability to describe the whole. Communicating the <em>feeling</em> of a game, the emotional impact and the fundamental experience - this is something that simply cannot be done in a reductionist way.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide30.png"></figure>
</section>

<section>
<content>
<p>Let's briefly mention reductivism. Reductivism is what happens when Reductionism Goes Too Far, if you like.</p>
<p>To try and apply these reductionist techniques to people; to interpersonal relationships; or even to entire economic systems; these are all examples of reductivism. We lose the nuance and the important silent voices that can only emerge from the whole.</p>
<p>If you hear about someone being <em>overly reductive</em> then this is the criticism which is being made.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide31.png"></figure>
</section>

<section>
<content>
<p>Our third and final philosopher for the time being: the <em>essentialist.</em></p>
<p>The essentialist is closely related to the reductionist, with a key difference in the nuance.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide32.png"></figure>
</section>

<section>
<content>
<p>The essentialist claims that every game is built around some fundamental <em>essence</em> &mdash; some core from which the game cannot be divorced, and which is a basis upon which everything else is built.</p>
<p>Moreover we might say that if two games share this essence, they have a common core, then we can call those games fundamentally similar.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide33.png"></figure>
</section>

<section>
<content>
<p>Let's be proper philosphers about this and cherry-pick an example which proves the point: <em>League of Legends</em> and <em>Defense of the Ancients (DOTA)</em>.</p>
<p>A superfan of either of these games will jump at the chance to say <em>just how different</em> these two games are. But, being close to the topic, they are really talking about this area.<span class="ed">[The aubergine and green coloured areas &mdash;Ed.]</span></p>   
</content>
<figure><img src="/static/mini-metro-talk/Slide34.png"></figure>
</section>

<section>
<content>         
<p>As a person who's not too well acquainted with either of the games, I would say they share the same common core &mdash; the <em>Aeon-of-Strife</em> style fortress assault game (more generally speaking, a MOBA).</p>
<p>An essentialist might agree - and would therefore say the two games are fundamentally similar.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide35.png"></figure>
</section>

<section>
<content>
<p>Just like reductionism, we can make use of essentialism as designers, critics or just in everyday conversation with others.</p>
<p>Essentialism allows us to compare two similar games directly. We can put aside the similarities and make judgements on the things that make them <em>different.</em></p>
<p>In fact, you might not realise it but you probably practice this already! If you have ever said something like "<em>Family Guy</em> is way better than <em>American Dad</em>" then you are making this essentialist argument. When two things clearly share a common core, we often ignore the fundamental similarities and concentrate only on the differences. A variant of this is sometimes called the <a href="https://en.wikipedia.org/wiki/Narcissism_of_small_differences"><em>narcissism of small differences</em></a>. We actually get very good at this from a young age. Even children frequently talk in these terms.</p>
<p>Essentialism is made easier by the <em>zeitgeist</em> - the idea that the popular culture tends to cling on to certain ideas for a while. This is why there are so many Battle Royale games in ~2019, just as there were many point-and-click adventures in the 90s. This technique is also applicable to other creative media in the same way.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide36.png"></figure>
</section>

<section>
<content>
<p>A quick recap:</p>
<ul>
    <li>The <em>reductionist</em> wants to break games into discrete, minimal components.</li>
    <li>An <em>essentialist</em> says that there is a fundamental, characteristic core around which additional complexity is built.</li>
    <li>And a <em>minimalist</em> would say that this "additional complexity" should be as little as possible.</li>
</ul>
<p><span class="ed">[Well done. Three more fates correct. &mdash;Ed.]</span></p>
</content>
<figure><img src="/static/mini-metro-talk/Slide37.png"></figure>
</section>

<section>
<content>
<p><span class="ed">[Video plays of <em>Mind the Gap</em> gameplay]</span></p>

<p>Let's return to our prototype <em>Mind the Gap</em> then. What would our three philosophers have to say about this?</p>

<ul>
    <li>Our reductionist might struggle. There are few individual components - the art style, the gameplay, and not much besides.</li>
    <li>Our essentialist could say that <em>Mind the Gap is its own common core.</em> There is zero additional complexity. and the game is as simple as it could possibly be.</li>
    <li>And our minimalist would call that Good.</li>
</ul>    
</content>
<figure><img src="/static/mini-metro-talk/Slide38.png"></figure>
</section>

<section>
<content>
<p>Now we come to the present day. Here's a picture of Mini Metro, from the Steam version which I captured a couple of weeks ago.</p>
<ul>
    <li>We can click Play to start the game, as you would expect.</li>
    <li>There's another layer of menus above this one which gives us access to the game's settings.<span class="ed">[see Question appendix. &mdash;Ed.]</span></li>
    <li>There are <em>challenges</em> to complete which are specific restrictions on how we may build out our metro; and Achievements which are integrated with Steam and measure the player's competence milestones.</li>
    <li>We have different game modes including an Endless mode. There are personal scores and leaderboards.</li>
    <li>We also have Daily Challenges which provide everyone with a specific, global goal to attempt every day.</li>
    <li>And much more besides, including a dozen or so different real-world cities and gameplay extensions too.</li>
</ul>
<p>There's an awful lot of the real world here. A lot of <em>nature</em>. So what happened to minimalism?</p>
<p>We might be close to embracing a different philosophy altogether...</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide39.png"></figure>
</section>

<section>
<content>
<p>Maximalism was a reaction to the minimalist movement in the earlier part of the 20th century.</p>
<p>The philosophy is simple: That getting rid of stuff isn't more artistic, it's more <em>boring</em>. By removing the stuff, by "getting rid of nature", we're actually getting rid of anything interesting about our art. Minimalism is bad.</p>

<p>You might be able to tell from my slide design that I am not a fan of maximalism as a design choice. But in the game design world I would be in a minority.</p>
<p>Think about any E3, any game release season. You will have seen rap sheets a mile long, laundry lists of features. All the classic assault weapons in Farming Simulator, or Fish AI in FIFA 20. Game developers and publishers are happy to implement and share hundreds of different features, because they are fundamentally <em>maximalist.</em> They strongly believe that more stuff means more meaning; that their games are more interesting and better for it.</p>
<p>Please understand: I'm not slating any game developers for adding features to their game. They've got to keep the lights on, after all, and features <em>do</em> sell games.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide40.png"></figure>
</section>

<section>
<content>
<p>We've seen the views of minimalists; we know how maximalists think. There's clearly a disparity here.</p>
<p>Which leads us to ask the question: Is minimalism even a <em>good</em> thing?</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide41.png"></figure>
</section>

<section>
<content>
<p>Actually, is <em>anything</em> a good thing?</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide42.png"></figure>
</section>

<section>
<content>
<p>What the heck does this <em>good</em> thing mean, anyway?</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide43.png"></figure>
</section>

<section>
<content>
<p>Two last philosophers to round out our dinner table: The <em>objectivist</em> and the <em>subjectivist</em>. These are both very wide-ranging theories but we'll restrict to a very specific subset.</p>
<p>An objectivist will tell you that a game is Good &mdash; minimalist or otherwise &mdash; if it does what it set out to do. If the game is effective in carrying out the goals of its creator, then it is a Good Game.</p>
<p>By contrast, a subjectivist says that a game is Good if it does what the <em>players</em> want. Since that's a bit nebulous we might instead say that the game is <em>enjoyed</em> by the players &mdash; that they went away after playing the game believing that it was a worthwhile experience.</p>
<p>Now, we're going to skip a step and say that the Subjectivist would be satisfied. Everyone I've met who's played Mini Metro has come away thinking of it as nothing less than brilliant.</p>
<p>Which leaves us with the objectivist. Do they think that Mini Metro is Good?</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide44.png"></figure>
</section>

<section>
<content>
<p>Well, to find out if Mini Metro is <em>effective</em>, we'll need to answer a different question. What did Mini Metro <em>want</em> to be?</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide45.png"></figure>
</section>

<section>
<content>
<p>Let's close the circle by looking at what Jamie Churchman had to say once again.</p>
<p>Jamie says that you need to understand your game. To identify the essential core, find its edges and make it perfect.</p>
<p>And that the new features that are added, in particular the user experience and interface design, should support and enhance this essential core.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide46.png"></figure>
</section>

<section>
<content>
<p>In the case of Mini Metro, that means the <em>minimalist aesthetic</em> that the game wears so brilliantly.</p>
<p>And therefore our first claim is that Mini Metro, and its development team, are <em>aestheticist</em> in nature. They value the beauty and simplicity of the core game above all other things, and any new features &mdash; of which, remember, there are many! &mdash; amplify, support and enhance the beauty of that core.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide47.png"></figure>
</section>

<section>
<content>
<p>Claim two is that Mini Metro has fully succeeded in maintaining that aesthetic. While the game as a whole is no longer minimalist, everything about the design is built around enchancing the "small game" aesthetic that is fundamental to Mini Metro's beauty.</p>
<p>And if they set out to maintain the aesthetic while making a Good Game, and they did exactly that, then our objectivist is satisfied as well.</p>
<p>So if both of our philosophers are happy then we have to conclude...</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide48.png"></figure>
</section>

<section>
<content>
<p>That Mini Metro is a Good Game.</p>
<p>(It's just not a minimalist one!)</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide49.png"></figure>
</section>

<section>
<content>
<p><strong>Questions</strong></p>
<p>I received some very good questions but one which I think is worth answering again. The question asked about the maximalist approach and specifically whether I thought that Mini Metro was bound by platformholders to introduce specific pieces of complexity, such as a bespoke Start menu, in order to publish the game to specific places.</p>
<p>My response was quite involved but mostly boiled down to this:</p>
<p>There will always be a push and pull between different stakeholders and a game's development team. One must appease the platform holders, that much is for sure. And publishers too will often, as mentioned, prefer a maximalist approach even when it conflicts with the design goals of the team. Fortunately as indie developers we're not so bound by our overlords, but in some places we are.</p>
<p>And this friction is not always a bad thing! For example, I mentioned that there is a settings menu, This includes accessibility options such as various colour schemes which allows those less able to play and enjoy the game. Making a game more accessible to everybody is incredibly valuable and well worth modifications to a game's design goals. And the earlier we consider these accommodations in development, the more naturally they will fit with our game.</p>
</content>
<figure><img src="/static/mini-metro-talk/Slide50.png"></figure>
</section>
