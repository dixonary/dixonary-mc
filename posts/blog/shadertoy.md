---
title: Shaders, HaxeFlixel, and ShaderToy
date: 2017-08-11
---
<style>
iframe {display:block; margin:2em auto; }
iframe.shader {width:600px; height:400px; }
</style>

> Word of warning: I am a massive shaders noob. Take most of this with a pinch of salt. This is just what I have found to work. if I am wrong then please [correct me](https://twitter.com/dixonary_)!

<hr>
## Shadertoy

Of all the websites which crash my browser, [ShaderToy](//shadertoy.com/) is by far the one I have visited the most. It is evidence of the awesome things that can be done with only a few dozen lines of code and some clever mathematics. Some of my favourite shaders include:

* [This awesome ocean shader](https://www.shadertoy.com/view/Ms2SD1);
* [A mountain flyover](https://www.shadertoy.com/view/MdX3Rr);
* [A voxel world with glowy edges](https://www.shadertoy.com/view/4dfGzs).

The latter two of these were developed by the wonderful [Inigo Quilez](http://www.iquilezles.org/index.html) who worked on some of the impressive visual effects in Pixar's *Brave* (and many, many other things).

I have translated the first shader, `seascape`, to openfl/HaxeFlixel as a motivating example. Here is the shadertoy version:

<iframe class="shader" frameborder="0" src="https://www.shadertoy.com/embed/Ms2SD1?gui=false&t=10&paused=true"></iframe>

And here's a video of it running on a sprite in HaxeFlixel:
<iframe width="600" height="450" src="https://www.youtube.com/embed/v0K1uOjINgw?&amp;showinfo=0&amp;start=5" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

<hr>

## HaxeFlixel

Since I am a shader noob, I'd much rather use smarter people's pre-written shaders and modify them for my own needs. But ShaderToy uses its own internal variables to track the state of the universe - we have to emulate this in order to use ShaderToy examples out of the box.

As of HaxeFlixel 4.3.0 (the current stable version) there are two ways to apply shaders to the game:

1. Per-sprite shaders;
2. Post-processing effects ("filters").

There are advantages to both methods and we will talk about them separately. However, both use the same underlying `openfl.display.Shader` type. 

**NOTE: ** To use shaders, if you are using the current setup, you must enable the `next` OpenFL renderer, by adding `<haxedef name="next">` to your `Project.xml` file. If you are getting errors like `Type not found: openfl.display.Shader` then `next` is not enabled.

<br>

### Per-Sprite shaders{.left}

The [FlxSprite](http://api.haxeflixel.com/flixel/FlxSprite.html#shader) class has a `shader` field. By setting this, you apply some shader to the entire area of the sprite:

    import openfl.filters.ShaderFilter;
    import openfl.display.Shader;
    [...]
      override public function create() {
        super.create();
        var pSwapShader = new PSwapShader();
        var spr = new FlxSprite(0,0,"pixelart.png");
        spr.shader = pSwapShader;
      }


This is normally what you want, if you're trying to apply an effect to only one element of the game. For example you can use this for:

* Palette swapping
* Special effects, like a warp or stretch
* Procedurally generated graphics.

This is the easier of the two to work with from a shader-translation perspective (for reasons we will get onto later). 

<br> 

### Post-processing effects{.left}

Post-processing effects are effects which happen across the whole screen, after the scene has been drawn. This allows you to do some nice effects like lighting the whole scene, or applying some transform to everything.

To apply a post-processing effect, there is a second step as these are handled by the Filter system. You can create a custom Filter based on a Shader by creating a new filter with the `openfl.filters.ShaderFilter` class, with your shader as a parameter:

    import openfl.filters.ShaderFilter;
    import openfl.display.Shader;
    [...]
      override public function create() {
        super.create();
        var waterShader = new WaterShader();
        var shaderFilter = new ShaderFilter(waterShader);
      }

A post-processing effect can be applied either to a specific camera, or to the entire screen. In each case you specify 

```FlxG.camera.setFilters([shaderFilter]);```

 or 

```FlxG.game.setFilters([shaderFilter]);```

 respectively. These can be added or removed at will, though it **will** make your game lag when these are loaded so it's recommended to do it on a loading screen. Also note that this function takes an Array - you can provide more than one filter and they will be applied in order. This is in contrast to the per-sprite system which only allows one shader per sprite.


<hr>
## Lost in Translation

In OpenFL, GLSL shaders can be created quite easily. All one has to do is create a subclass of `openfl.display.Shader` and add the relevant field(s). Here's the skeleton code for a custom shader:

    import openfl.display.Shader;

    class CustomShader extends Shader {
      @fragment var fragCode = ' 
        /* GLSL goes in this string! */ 
      ';
      @vertex var vertCode = ' 
        /* GLSL goes in this string! */
       ';

      public function new() {
        super();
      }
    }

See `@fragment` and `@vertex`? That's the secret sauce (read: Haxe macros) that OpenFL uses to translate these GLSL shaders into actual, useful shaders. Sadly they're not actually syntax-checked at compile time, but at initialisation - which is probably part of why they are so slow to load. 

**NOTE:** You can leave out the vertex shader if you aren't doing anything with the vertices. In truth I have absolutely no idea how the vertex shader works and have not yet succeeded at getting it to do *anything*. Answers on a postcard, please. However, if you do want to use the vertex shader then you need a fragment shader as well!

There are some subtle differences between how GLSL operates in ShaderToy and how it works here. This is essentially a list of things that you will manually need to change, if you want to translate a ShaderToy shader to one that will work in OpenFL / HaxeFlixel.

<br>

### Main{.left}  

The main function in ST is called `mainImage` and takes some arguments. In current OpenFL this is not used, and the gl_FragColor variable is written to directly. Instead we use a `void main()` function which takes no arguments:

<pre>
    void mainImage( out vec4 fragColor, in vec2 fragCoord ) {

// Becomes...

    void main() {
</pre>

<br>

### Textures{.left}

Of course, we still have access to the fragment coordinates. This is done with the faux-Static member `vTexCoord` on `Shader`. Likewise we can get the texture colour (which, in ShaderToy, is `texture(iChannel0,vec2)` (???) ) through the `texture2D` function. We can write out the color with `gl_fragColor`:

    vec2 uv = fragCoord.xy;
    vec4 currentColor = texture(iChannel0, uv);
    fragColor = currentColor;

    // Becomes...
    
    vec2 uv = ${Shader.vTexCoord}.xy;
    vec4 currentColor = texture2D(${Shader.uSampler}, uv);
    gl_FragColor = currentColor;

We are using String interpolation here to insert `Shader.vTexCoord` and `Shader.uSampler`. In truth, these are just aliases to some openfl-specific strings, but it's best to write these in case openfl's underlying systems change[^1].

Importantly, **fragment coordinates in ShaderToy are measured in pixels**, whereas HaxeFlixel uses the range [0,1] instead. If your shader is being super weird, this is a good thing to check.

[^1]: Breaking changes are introduced roughly once a week.

<hr>
## Times Change

Shaders are not static things. We want to change how the shader works based on the surroundings of the game. In ShaderToy, the following variables are provided automatically to the shader. Shaders will never be using all of these things, so we only need to copy over the relevant ones to the top of our shader.

    uniform vec3      iResolution;           // viewport resolution (in pixels)
    uniform float     iTime;                 // shader playback time (in seconds)
    uniform float     iTimeDelta;            // render time (in seconds)
    uniform int       iFrame;                // shader playback frame
    uniform float     iChannelTime[4];       // channel playback time (in seconds)
    uniform vec3      iChannelResolution[4]; // channel resolution (in pixels)
    uniform vec4      iMouse;                // mouse pixel coords. xy: current, zw: click
    uniform samplerXX iChannel0..3;          // input channel. XX = 2D/Cube
    uniform vec4      iDate;                 // (year, month, day, time in seconds)
    uniform float     iSampleRate;           // sound sample rate (i.e., 44100)

OpenFL allows us to pass values through to the shader using `ShaderParameter`. If we create a `ShaderParameter` instance, openfl will be able to write the provided values into the shader code at runtime.

Here is an example of a ShaderParameter being passed through to the shader:

    import openfl.display.Shader;
    // inside of create() or update() or wherever...

    var param:GLShaderParameter = new GLShaderParameter("vec2",2);
    param.value = [FlxG.stage.stageWidth,FlxG.stage.stageHeight];
    waterShader.data["iResolution"] = param;


And what are we doing here?

1. We create a `GLShaderParameter`, defined in `openfl.display.Shader`. (*Note:* We only need to create this once - it can be reused to save on memory and recomputing). We give it the type of our value, in this case `vec2`. This is different to ShaderToy which uses `vec3` -- the implication is that our shader will never be using the `z` coordinate.
2. We set the values in the `value` member of the ShaderParameter. We provide an Array which has the same length as the second paramater given to the `GLShaderParameter` constructor.
3. We set the parameter as the `iResolution` string in the `data` member of our Shader. Again, now that this parameter exists we can update the values directly without having to reconstruct every time.

That's all we need to do! Using this, we can convert from dynamic, exciting ShaderToy shaders into working HaxeFlixel shaders. Or we can write our own from scratch!

---

## A couple of gotchas

There are some small things which might cause a shader to simply... break, when converted to work with openfl/HaxeFlixel. Here's a quick reminder of what those are:

**Coordinates are different:** In ShaderToy, texture coordinates are measured in pixels across the screen. So, to work out where you are on a scale from 0 to 1, most shaders have something like `fragCoord.xy / iResolution.xy`. The natural conversion would then be to `${Shader.uTexCoord}.xy / iResolution.xy`. This won't work! openfl's sprites are not measured in pixels, since they can be scaled -- they are measured from 0 to 1 already in both x and y directions. So to convert the line, you just need to use `${Shader.uTexCoord}.xy`. Some similar manipulations might be needed for procedural shaders. Also, the y coordinate is inverted by default -- you can un-invert it by doing `coord.y = 1-coord.y` somewhere in your shader.

**Cameras are weird:** I mentioned above that PostProcessing shaders (with `ShaderFilter`) are harder work than per-sprite shaders. This is because of an efficiency measure which HaxeFlixel uses. Graphics cards are very good at dealing with sprites of size power 2, like 1024x1024. Therefore whenever the camera size hits one of these boundaries, it jumps up to the next powe of two. This causes the on-screen `xy` coordinates to be different from [0,1]. In fact it can be so far as [0,0.5]. This weirdness has to be taken into account when translating or designing PostProcessing shaders. A good way to do this is, instead of providing `FlxG.width, FlxG.height` as the `iResolution` value, instead give the camera `pixels` width and height. Hopefully this weird corner case will be fixed in some future iteration.

---

## Enjoy

That concludes this whistle-stop tour of shaders in HaxeFlixel. 

Here is the example used in this article, so you can see the translation steps in action.  
   
[This is a link to the raw ShaderToy shader (again!)](https://www.shadertoy.com/view/Ms2SD1).  
[And the HaxeFlixel project containing that translated shader](https://github.com/dixonary/ocean-sample).

I am Alex Dixon, a computer scientist from the UK. You can find me on [twitter](https://twitter.com/dixonary_).
