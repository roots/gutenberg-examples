<h1>Gutenberg 098: A Simple Container Block</h1>
Getting started with the <strong>WordPress Block Editor</strong> (or <strong>Gutenberg</strong>, they're the same thing) can be a challenge. There is a lot of information, and little organization. Depending on your experience as a developer, you may be entering the Gutenberg ecosystem with little or no prior React experience, or you might be a React expert who's never developed a WordPress plugin from scratch. As a result, the most common question we see regarding Gutenberg is something like:

<h2>Where the Heck do I Start?</h2>
At Roots we want to demystify WordPress development and make it as accessible as possible using modern tools and workflows. This series attempts to give you practical, useful knowledge for building Gutenberg blocks for your WordPress sites, with a focus on how to make something that works, quickly.

Before you read further, be sure your development environment is set up according to <a href="https://roots.io/getting-started/docs/development-environment-recommendations/">our "Getting Started" documentation</a>.

This example uses <a href="https://www.npmjs.com/package/@wordpress/create-block">WordPress create-block</a> to do the heavy-lifting of scaffolding a plugin and installing dependencies.

<h2>Try to Contain Yourself</h2>
In this example we're building a simple container block which allows other blocks to be nested inside it. Let's get right to it.

In your project's <code>plugins</code> directory, type the following:
<pre><code class="language-shell">$ npm init @wordpress/block container</code></pre>
Once this command completes you'll see the following output:
<pre><code class="language-shell">Creating a new WordPress block in "container" folder.

Creating a "package.json" file.
Installing packages. It might take a couple of minutes.

Formatting JavaScript files.

Compiling block.

Done: block "Container" bootstrapped in the "container" folder.

Inside that directory, you can run several commands:

$ npm start
Starts the build for development.

$ npm run build
Builds the code for production.

$ npm run format:js
Formats JavaScript files.

$ npm run lint:css
Lints CSS files.

$ npm run lint:js
Lints JavaScript files.

$ npm run packages-update
Updates WordPress packages to the latest version.

You can start by typing:

$ cd container
$ npm start

Code is Poetry
</code></pre>
Change directories to your new <code>container</code> plugin and run <code>npm start</code> as suggested. Leave this running while you make your edits below.

<h2>Code is Poetry</h2>
Open your new block's <code>src/index.js</code> file and look around. You'll see a pretty standard ES6-formatted javascript file with <code>imports</code> at the top and functions further down.

Make note of the <code>edit()</code> and <code>save()</code> functions; this is where we'll be doing most of our work.

<h3>Rare Imports</h3>
Since we're making a container block, we need to be able to nest other blocks inside ours. Fortunately WordPress gives us a React component just for this purpose called <code>InnerBlocks</code>. Near the top of your <code>index.js</code> file, add the following line to import <code>InnerBlocks</code> so that we can use it in this plugin:
<pre><code class="language-javascript">import { InnerBlocks } from '@wordpress/block-editor';</code></pre>

<h3>Making Edit()</h3>
The <code>edit()</code> function is what Gutenberg shows us in the Block Editor (the admin, or the back-end of the site). When you start with a new block, this function contains some placeholder content from the <code>create-block</code> command. Delete that and replace it with the following:
<pre><code class="language-javascript">edit: ( props ) => {
  return (
    &lt;div className={ props.className }&gt;

      {/* InnerBlocks lets us nest other blocks here */}
      &lt;InnerBlocks /&gt;

    &lt;/div&gt;
  );
},
</code></pre>

<h3>Save()-ing the Day</h3>
The <code>save()</code> function is what's saved to the WordPress database and shown on the front-end of the site. This saved HTML code will sometimes differ from what's in the <code>edit()</code> function, but in this case it'll be nearly identical:
<pre><code class="language-javascript">save: ( props ) => {
  return (
    &lt;div className={ props.className }&gt;

      {/* InnerBlocks.Content saves the output of our nested blocks */}
      &lt;InnerBlocks.Content /&gt;

    &lt;/div&gt;
  );
},
</code></pre>

<h2>You're Literally Done</h2>
That's it! Your block plugin is ready to activate and use in your pages.

<h2>There's So Much More</h2>
This is, intentionally, the most basic possible example. In future posts I will cover block templates, allowed blocks, inspector controls, and more. Each future post will build from this starting example, so stay tuned and happy building!
