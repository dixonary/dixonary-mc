---
title: The Pain Points of Haskell: A Practical Summary
date: 2020-06-07 16:00
description: What is it that trips people up when using Haskell, and how can we make the situation better?
---

I would like to preface this article by saying that Haskell is great. I have been using it as my go-to for native applications for several years now. Everything that follows is a product of my love and affection for the language, and a desire to see it succeed. And none of this is intended to disparage the efforts of people improving the Haskell ecosystem. It's hard work and there's a lot of it, and I thank you all for what has been done so far.

That said, I will not be pulling any punches here.

As of now, there are a number of pain points which frequently occur when using Haskell. These are a product of my own experience and that of some of my good friends at varying levels of Haskell education and practise. If you are an intrepid Haskeller, some or all of these will already be known to you. I would like to lay them out here for a couple of reasons:

* For one, having the pain points made clear will hopefully encourage Haskellers to think about how to overcome them. Attempts have been made (we will come to that!) but given that the problems still exist, there is work yet to be done.
* Secondly, if you are a Haskell learner, I hope that it will help you  to see that these things are known problems in the community and you are not just "doing it wrong". People are aware that these things need to be improved and many people before you have encountered exactly the same problems.

If you just want the skinny, check the [very end](#summary) for a shorthand version of the article.

<img src="/static/images/hask-pride.png" style="width:10em;filter:drop-shadow(0.125em 0.125em 0.0625em #666)">

## The Toolchain

Contrary to popular belief, there are multiple [Haskell compilers](https://wiki.haskell.org/Implementations). Even so the vast majority of application code is written with the GHC compiler firmly in mind. There are good reasons for this. The most critical is that GHC has the most money and time invested in it, and as such moves faster to accommodate new concepts than other compilers. Almost all production code initially written for GHC will not work with any other compiler, owing to the inclusion of language pragmas such as `TupleSections`, `RecordWildCards`, `OverloadedStrings` and so on. This itself is not a pain point though; Haskell.org simply proposes to download GHC. (Except on Arch Linux, [which is a whole other kettle of fish](/cabal-2020)). 

The problems start *after* downloading GHC. At time of writing, *thirty years after Haskell 1.0*, there is no bespoke Haskell IDE. There is no featureful Haskell plugin for any major text editor which can be installed without command-line intervention[^1]. Either of these things alone would be somewhat problematic; taken together, it can be enough to put people off the language entirely. Hard to blame them.

There is hope in this regard. The tooling community seem to have unified on making `haskell-language-server` the standard. Luke Lao wrote a great [summary](https://mpickering.github.io/ide/posts/2020-05-08-state-of-haskell-ide.html) which I would not be doing justice to summarize here. But it feels pretty rough to tell people "Hey, just go without tooling until we sort this whole thing out", or "stick with this old version of GHC, it is the one that works".

For the time being, I suggest people find an extension which integrates only with `ghci`, such as [`Simple GHC (Haskell) Integration`](https://marketplace.visualstudio.com/items?itemName=dramforever.vscode-ghc-simple) for Visual Studio Code. The lack of moving parts is a virtue. I also strongly recommend the wonderful tool [`ghcid`](https://github.com/ndmitchell/ghcid) which provides live reloading and testing out of the box, again built only around `ghci` but with integration with `stack` where relevant.

## Cabal

Cabal is super cool. It is very featureful and powerful, and getting more so with every release. 

You know what else is super cool, featureful and helps people write computer programs? `git`. As a sprawling tool with multiple interfaces for even small tasks, it's no surprise that `git` has a million and one books dedicated to working with it in the most practical way. By contrast, Cabal has the [Cabal User's Guide](https://www.haskell.org/cabal/users-guide/nix-local-build-overview.html?highlight=new). Unfortunately, the guide doesn't really do much in the way of *guiding*. For example, it doesn't tell you that the preferred way to use cabal in 2020 is with the `v2-` prefixed commands which are not even introduced until chapter five of seven, roughly *forty thousand words into the guide*[^4].

In my view, the principal reason that many people recommend `stack` over `cabal` is twofold. Firstly, the defaults are sensible. If you type `stack build`, you are doing it right. And secondly, you do not need to know *everything about it* in order to get it to do what you want. As a Haskell programmer of five years, I am still too intimidated by `cabal` to use it as my daily driver, and I will reach for `stack` even for small tasks. 

Oh, and it doesn't help that the documentation hosted on `haskell.org`, which is the first search result for me, is three minor versions behind the documentation hosted at `cabal.readthedocs.io`, which is itself a minor version *ahead* of what comes by default on the usually bleeding-edge Arch Linux repositories[^5]. Harumph.

If you are new to programming in Haskell, `stack` is still the path of least resistance. I look forward to the day that I can say `cabal` is all we need.

## Monads

The invention of the monad may be the most important piece of programming language theory of the last quarter century. They are so powerful that a virtual cheer goes up any time another language even *imitates* their implementation in Haskell. Despite many attempts though, I don't think we have yet found the best way of explaining what they actually *are*. The [Wikipedia article](https://en.wikipedia.org/wiki/Monad_(functional_programming)#Non-Technical_Explanation) has quite a good example of non-explanation.

At Warwick University we have a competently designed and taught Functional Programming module for first year students. In the module, monads are introduced as a mechanism for abstracting sequential composition. This seems to be quite effective as a motivator, but it is also hiding a decent amount of complexity. For example, the `List` monad does not compose sequentially in the way that might be expected. Additionally, the effect composition order is not always defined by the direction of `(>>=)` (consider the reverse state monad, for example).

Functors can be broadly explained in terms of containers, where `fmap` modifies the value(s) in the container without modifying the container itself. The container may be structural (in the case of data functors) or computational (in the case of control functors); both of these concepts survive the box explanation. There are similar analogies that can be made for monads, but they all fall apart in some critical aspect. "A monad is like a burrito" is [famous](https://byorgey.wordpress.com/2009/01/12/abstraction-intuition-and-the-monad-tutorial-fallacy/) for how true it isn't.[^2] 

Hopefully we will find the platonic ideal of a monad tutorial before too long. In the mean time, we will have to stick to teaching by motivated examples.  

### Monads and Documentation

The introduction of monads to new learners is not the only pain point, however. Friends and colleagues have pointed out that a similar issue arises whenever trying to learn a new library which has a monad at its core.

Very rarely do libraries document the underlying mechanism by which effects are composed. As a result, the user is left guessing at what the core of a library actually does. Even some of the best-documented libraries[^3] seem to suffer from this affliction.

I implore library writers to define the functionality of their fundamental types upfront. And while we're at it, please consider documentation-by-documentation as more of a priority than documentation-by-blog-post. The Haskell community is inseparable from the blogosphere (and we have many talented bloggers around, not including myself) but blogs *do* decay over time. Inline documentation serves as a source of truth, and is found precisely where people first look.

If anyone needs an example of good, readable documentation, even on more advanced topics, I can highly recommend reading some of [Alexis King](https://lexi-lambda.github.io/index.html)'s libraries, such as [Eff](https://hasura.github.io/eff/Control-Effect.html). 

## Records

At risk of sounding like a broken, erm... yeah. 

Haskell's record system is outdated. In a universe of abstractions and minimally-constrained types, the monomorphic nature of records sticks out like a sore thumb. For example, there is no built-in way of saying "given a record of this shape, I will produce a record that is the same with this extra field". Even having two records which share fields is difficult. Such construction is natural in many modern languages. This concretion is frequently used as a stick to [beat Haskell programmers over the head with](https://www.youtube.com/watch?v=YR5WdGrpoug). 

[A](https://hackage.haskell.org/package/CTRex) [number](http://hackage.haskell.org/package/extensible-data) [of](http://hackage.haskell.org/package/vinyl) [libraries](https://hackage.haskell.org/package/superrecord) [have](https://hackage.haskell.org/package/data-diverse) [been](http://hackage.haskell.org/package/records) [developed](https://hackage.haskell.org/package/row-types) which extend or replace the functionality of built-in records. Each of these libraries is far superior to the default state of affairs, and that makes Haskell look bad. 

If you are a learner, I recommend simply believing sensible record management to be impossible in Haskell until further notice. If you desperately need this functionality, see the libraries above.

Fingers crossed that the Haskell community can unify on one approach, at least enough to get built into GHC as a language extension or, ideally, to make its way into the Haskell Report. 

I won't hold my breath.

## Compilation 

GHC uses a frankly astonishing amount of time and memory to do its job. It's a known problem that some programs and libraries [literally cannot be compiled](https://gitlab.haskell.org/ghc/ghc/issues/11415) on even competent hardware due to a lack of resources. In addition, long compile times are off-putting to people trying out Haskell for the first time.

Part of this is down to another known issue with Haskell libraries which is that some of them pull in the known universe as dependencies. [`pandoc`](http://hackage.haskell.org/package/pandoc) is a good example of this. The upshot is using [nasty workarounds](https://github.com/dixonary/microcosmos/blob/e482c80ec85dfa29c52125061c8c25633794d8f7/src/Main.hs#L303) or to simply give up and buy a more powerful machine.

But even so, it's unclear to me why compiling a program which has a hundred or so files uses *plural gigabytes* of memory to compile. I'm not sure there's anything we can do about this, because GHC is such a monolith, other than slowly improve its codebase over time. 

To library and application developers, *please* stop depending on enormous libraries like `lens` and `Cabal` wherever possible. I do not think that a dependency on `Cabal` is required by almost any program, and `lens` can almost always be replaced with [`microlens`](https://hackage.haskell.org/package/microlens), a minimal reimplementation designed with library devs in mind.

No advice for new learners, I'm afraid. Maybe take up swordfighting. 

<img src="https://imgs.xkcd.com/comics/compiling.png">

## Summary

I have left out some pain points that people told me about while I was researching for this article. That's not because they're invalid, but because most of them are a product of the environment in which they were learning and might not be as universal as the things listed above.

None of these problems are insurmountable. Indeed, a lot of them are currently in the process of being fixed. But unless we can look each other in the eye and say that they exist, people will keep being turned away.

Below I've summarized the content above in a handy flash-card form for your convenience.

Problem | What do we do about it? | Advice for new learners
:-------|:--------------|:-----------------------|
Tooling is janky | Get a unified toolchain to maturity ASAP! | Use your favourite text editor, and Haskell tooling which only relies on `ghc` and `ghci`.
Cabal is impenetrable | Produce a *practical* guide to using `cabal`, and fix the default commands. | Use `stack` and follow the [guide](https://docs.haskellstack.org/en/stable/GUIDE/#hello-world-example).
Advanced topics are hard to teach | Invest a lot of time and effort into pedagogy for advanced topics in Haskell. | Learn by example as far as you can. Ask around for accessible introductions to advanced topics you're interested in.
Documentation is imperfect | Learn from the masters, and document alongside your code and not only in blog posts. | Talk to Haskellers in the community for recommended sources of truth for given libraries.
Records are outdated | Unify around a common syntax for polymorphic, extensible records. | Understand that records are imperfect; use alternative abstractions if you need extensibility or polymorphism.
Compilation is slow and resource intensive | Minimize your libraries' and applications' dependencies aggressively. | Take up swordfighting.

If you know of regular issues which come up and which I have not mentioned here, I'd love to hear about it. There's plenty to discuss.

[^1]: Trust me, I have tried them all. I have been trying for years. Apparently `haskell-mode` for emacs may come close; I did not have success with it.
[^4]: Copied and pasted chapters 1-4 into wordcounter.net.
[^2]: This is without even mentioning the classic examples of "A monad is a monoid over the category of endofunctors" or "A monad is a lax functor over a terminal bicategory", which both serve as unfair but amusing characterisations of certain members of the Haskell community. 
[^3]: One example is the fantastic [`SBV`](https://hackage.haskell.org/package/sbv) library. It has a type `Symbolic` on which a lot of functionality is based. I have been using this library for a long time, but if you asked me what the `Monad` instance for `Symbolic` did, I would not be able to tell you. In the docs, `Symbolic` is described as "a specialisation of `SymbolicT` to the `IO` monad"; `SymbolicT` is defined as "a generalisation of `Symbolic`". I hope the problem is clear. 
[^5]: It turns out that this problem is [known](https://github.com/haskell/cabal/issues/6866) and will hopefully be resolved soon. Thanks to `george_____t` on Reddit for the pointer.
