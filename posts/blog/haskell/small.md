---
title: Generating small binaries in Haskell
date: 2020-01-10 14:28
---

Last year I wrote the first version of [microcosmos](/mc), which is a webserver for running simple blogs. Since then I've been mulling over the biggest problem that microcosmos has: It's huge. To be precsise, it's 113MB once compiled.

To be clear, this isn't just a problem with microcosmos. It's pervasive among Haskell programs. The venerable [Pandoc](https://pandoc.org) document translator comes in at 68MB on its own. Cabal is 28MB. This isn't just a problem with compiled binaries, though - some libraries are so cumbersome to use that they [literally cannot be compiled](https://gitlab.haskell.org/ghc/ghc/issues/11415) on lower-end devices.


## Why?

Why are we lumbered with titanic binaries when other programming languages aren't?

Well, there are a few reasons.

1. Haskell's standard library is considerably smaller than that of most modern, mature languages. (For example, the `Data.Map` type, which is pervasive in Haskell, comes from the `containers` package and is not part of `base`.) This means that people are likely to turn to external libraries much earlier than one might in, say, Python.

1. There are multiple ways of doing everything. The case that springs to mind is with String types. A program that interacts with 3 or more external libraries may well end up containing an implementation of String, Text, Bytestring and Lazy ByteString, and possibly more besides. The lack of canonical "use this and only this" basic data types has resulted in the patchwork of drop-in replacements that we see today. Sure, some are better suited to some tasks and some to others, but that's true in any programming language - the mantra of "use the best possible option" means that in practice, we end up with *every* option.

1. Haskell compiles everything statically, so your binary contains a compiled of every module you've used, directly or transitively. I don't actually think this is a problem.

1. GHC doesn't take many steps to reduce binary sizes. It compiles the code you've got, and then it's done. This means there's a lot of space in the binary which we can squeeze out.

1. People don't seem to care about binary size in the Haskell community. Now this isn't universal, but many people really don't seem to mind that binaries for Haskell programs are gigantic. Most online threads on the topic seem to conclude with "Yeah, it's because Haskell compiles everything statically, that's just the way it is."

## What can I do about it?

If you want to produce smaller Haskell programs, you have a few tools at your disposal.

### Dependencies
The first and most important: **Introduce dependencies with care**. The `interpolatedstring-perl6` library gives you perl-style string interpolation within QuasiQuotes. This is a relatively simple feature, so you might expect it to depend on TemplateHaskell and a couple of other things, right? In fact, it transitively depends on [`Cabal`](https://hackage.haskell.org/package/Cabal/). It's surprising (and depressing) how many libraries depend on `Cabal`, or `lens`, or some other behemoth. Avoiding such naughty libraries will not only reduce your file size, but reduce first-compilation times and disk usage for other people who use your code.

If your needs are minimal, you might want to consider looking at alternative libraries. Compare the dependency lists for [`lens`](https://hackage.haskell.org/package/lens) and [`microlens`](https://hackage.haskell.org/package/microlens-platform) - which features do you need?

Some "platform" libraries come with a single `Import ___` line which then imports a large number of modules on your behalf. Given that you are compiling in every module which you're transitively using, it might be worth replacing these "catch-all" imports with the specific parts of the library you need.

### Dynamic Linking
It is usual to compile your Haskell programs statically. This ensures that the correct libraries and versions are available to the program, and makes your binaries more portable. However, some Linux distributions are moving over to a dynamically-linked model of Haskell binaries, which means you can lift dependencies at the level of the package manager. If this is the use case for you, then consider passing the `-dynamic` flag to ghc, which will exclude the libraries from your binary. This will make your binaries much, much smaller - but they will only be able to run on computers which have the requisite set of libraries.

### Stripping
This one's nice and easy! GHC includes symbol names by default. These are helpful when debugging, but for compiled, distributed programs they are not necessary. Running the `strip` command over your binaries will shrink the filesize by about 1/3, with no real downsides! (If you write programs which crash a lot, though, maybe leave the symbols in!)

*Thanks to [\@tsprlng](https://twitter.com/tsprlng) on Twitter for showing me just how big of a difference this makes!*

### Compression

Once you've cut out the maximum possible amount of dead code, you will probably still be left with a fairly large binary. Fortunately some brilliant people (Markus F.X.J. Oberhumer, Laszlo Molnar, and John F. Reiser) are on the case. They developed [`upx`](https://upx.github.io/), which is a mature executable packer. It doesn't delete code, it just removes the hot air from your binary files - and there's a lot of hot air in a Haskell binary. It's common to see the file size drop by 80-90%.

## Microcosmos Version 2

So, after learning the above, I tried to put it all into practice with the blog program Microcosmos. 

The first thing I did was remove the dependency on `Yesod`, which is a kitchen-sink-included web framework. `Yesod` was way, way too heavy for this very simple task, and I was only using it due to familiarity (and the nice DSLs it comes with!). I also went through and cut out any dependencies which I was barely using (eg. for a single helper function), instead producing a small number of helper functions as a replacement.

<table>
<thead><th>Microcosmos-Yesod</th><th>Microcosmos</th></thead>
<tbody><tr><td>
containers    
warp          
http-types    
text          
time          
friendly-time     
filepath          
directory         
yesod-static      
yesod-core        
shakespeare       
blaze-html    
pandoc        
megaparsec    
</td>
<td>
containers    
warp          
http-types    
text          
time          
friendly-time    
filepath      
directory     
wai           
bytestring    
file-embed    
split         
process       
</td>
</tr></tbody>
</table>

It might not look like I've made much difference here, but almost all of the dependencies on the right were already transitively included on the left. The ones on the right are also smaller, and depend on far fewer libraries transitively.

One notable thing is that I removed the dependency on `Pandoc`. While microcosmos still uses Pandoc internally, it now calls out to it from the shell rather than using the Haskell library. Slightly less neat, perhaps, but much, much more concise.

|                    | Microcosmos-Yesod | Microcosmos |
|--------------------|-------------------|-------------|
| Before compression | 113MB             | 15MB        |  
| After compression  | 14MB              | 1.84MB      |


So following these techniques I was able to get from a 113MB binary down to something less than 2MB. (This is all still statically linked - when linking dynamically the binaries shrink to well under 100 kilobytes.)

You might not be someone who cares about big executable sizes, but if you are, please consider implementing some of the above! Save a life, drop a dependency :)
