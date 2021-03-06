------------
title: Microcosmos: A Tiny Blog
date: 2019-11-02
------------

## About

[Microcosmos](https://github.com/dixonary/microcosmos) is a blog server. It really doesn't do very much at all; it just does exactly the things I would want from a blog CMS. 

Here's the list of features:

* Powered by [Pandoc](https://pandoc.org) for maximum input-file-agnosticism. You can write blog posts in Markdown, LaTeX, or even Microsoft Word and they will be rendered as nicely typeset web pages.

* The entire program is only about 300 lines of readable Haskell code.

* Everything about the blog is designable at runtime. You can edit the css files, obviously, but you can also change the default layout using the Shakespeare template files.

* As soon as you edit a post, the changes are visible.

* The distribution is a single, portable binary.

* Despite doing quite a lot of stuff for you, it's speedy. It's built on top of the Yesod web framework and the Warp webserver, both of which are well optimised.

* Zero frontend load - the site is a "normal" website - no hefty frontend frameworks. When rendering my blog, a page weighs about 70kB - 64kB of which is the header font.

***

## How to use

### Installation

Either download the latest [binary release](https://github.com/dixonary/microcosmos/releases), or clone the [repository](https://github.com/dixonary) and compile with the [stack](https://haskellstack.org) build tool.

### Usage
To start mc, simply run the `mc` executable from the root of your blog. 

The program is slightly opinionated about where things should be (although you can always symlink). It won't run if it can't find some template files at a minimum.

* `posts` is for all the **content** you wish to display.
* `static` is for all the **resources** to be accessed alongside that content.
* `templates` is for the HTML **scaffolding** of the website.
  * `templates/layout.hamlet` is the outer scaffolding for the entire site - resources to be loaded on every page go here.
  * `templates/folder.hamlet` describes the layout of autogenerated folder indices.
  * `templates/post.hamlet` describes the layout of posts.

Hamlet files are like HTML files, but closing tags are omitted in favour of indentation based semantics, and they support variable interpolation.

By default, `mc` will render any file in `posts` as an HTML document, based on the filename. In other words, it determines the URI slug from the filepath. There is one main exception: `home` will be rendered both for `https://my.blog/` and `https://my.blog/home`.

Dotfiles are ignored and will not be rendered by `mc`. 

### Metadata

You can provide limited metadata about your content in a preamble. Start a post with a hyphen-fenced block:

    ------------
    title: Microcosmos - a Tiny Blog
    date: 2019-11-02 10:00
    ------------

    ## About

    Microcosmos is a ...

and the title and date will be appropriately reflected on posts and in directory listings. Without a preamble, the post will use the filename as the title, and the file's modified time as the post date.

***

## Known issues

* Even though its functionality is deliberately tiny, `mc` is really, really huge. This is a known issue with GHC binaries in general. If you compile it from source (and therefore have the libraries on your computer) you can add the `-dynamic` option to GHC which will reduce the total size from >100MB to ~250kB (!!). The `upx` utility is also very effective at shrinking binaries, shrinking from >100MB to ~14MB.

* `mc` is also the short binary name of `midnight-commander`, the terminal file manager. 

* The system is not optimized for performance, although laziness should help avoid the worst excesses. It should only read the preamble of posts in order to get the titles, for example.

* Some errors show up when reading in filetypes for which pandoc only has recent support; eg. `.odt` files should be readable but seem to throw errors. Markdown is still the first-class filetype for posts.

***

## Future work

* **Online editing** is a maybe. It seems out of the scope of `mc` so I might leave that as an exercise to the reader.

* **Preview / Draft mode** so that pages automatically update when updated, and maybe don't show up in directory listings.
