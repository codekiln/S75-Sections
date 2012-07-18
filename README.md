Sections for S-75, Building Dynamic Websites
============================================

https://github.com/codekiln/S75-Sections 

All instructions of this document assume you are working in
version of the CS50 Appliance that your class is using: 
https://manual.cs50.net/CS50_Appliance_3

If this is your first time running examples in the CS50
Appliance, you'll need to set up your environment in the
command line: 

    cd ~ mkdir public_html chmod 711 public_html

To download these examples and keep them sync'd to your
appliance, enter each of these commands: 

    cd ~/public_html git clone
    git://github.com/codekiln/S75-Sections.git 
    find ~/public_html -type d -print0 | xargs -0 chmod 755

Git will then download the latest update to the section
examples.  You may need to infer the correct permissions
and use the ls and chmod commands to get the examples to
display in your appliance.  Once the permissions are
right, you can see each section's example folder by opening a
browser in the appliance and going to:

    http://localhost/~jharvard/S75-Sections/

To update to the latest version of the examples from
section:

    cd ~/public_html/S75-Sections 
    git pull

This will update to the latest version of the section
examples. Each time you pull down a fresh version, you will have
to change the permissions. 

    ~/public_html -type d -print0 | xargs -0 chmod 755

In general you want these permissions: directories: 711
php files: 600 css, image files, and other public facing
files: 644

For the mysql examples, you will need to create the
database `jharvard_example02` using phpmyadmin.

The example source code will look best in vim if you

    cd ~/public_html/S75-Sections cp .vimrc ~

Other Git Tricks for the CS50 Appliance
=======================================

If you have never used a source code manager before, Git will
change your life as a programmer. Take an hour and watch this
video from YUI theater to get a better sense of how life is different for "software engineers" than it is for "hackers." 

[current link](http://www.youtube.com/watch?v=QB6r9Y7mqyU)
[original
link](http://www.yuiblog.com/blog/2011/06/09/video-f2esummit2011-donnelly/)

My favorite git workflow: 

    git checkout -b "new_feature"
    git add -A
    git commit -m "finished new_feature"
    git checkout master
    git merge "new_feature"
    git branch -D "new_feature"

Once you decide to really utilize git, you will be branching and
merging all the time. When that time comes, it will become handy
to know what branch you are on. For that, I recommend two tools,
Git Command-Line Autocomplete and Git Branch in Bash Prompt. 

Git Command-Line Autocomplete
-----------------------------

    curl "https://raw.github.com/git/git/master/contrib/completion/git-completion.bash" -o ~/.git-completion.bash
    echo "source ~/.git-completion.bash" >> ~/.bash_profile
    source ~/.bash_profile

Git Branch in Bash Prompt
-------------------------

In the CS50 Appliance, paste the following into bash and hit return.

    export PS1='\[\e[1;33m\] \w\[\e[1;36m\]$(git branch &>/dev/null; if [ $? -eq 0 ]; then echo " ($(git branch | grep '^*' | sed s/\*\ //))"; fi)\[\e[1;37m\]:\[\e[00m\]'

If you don't like the way it looks, just exit the terminal and
open it up again.  Do you like the way it looks? Then edit
~/.bash_profile and add that line to the end, save, and enter:

    source ~/.bash_profile

Now you have the name of your git branch in your bash prompt. If
you are curious about how this display stuff works, google "Bash
PS1". 

JavaScript
==========

JavaScript videos by Douglas Crockford
-------------------------------
1.  [The Early Years](http://www.youtube.com/watch?v=JxAXlJEmNMg&feature=plcp)
2.  [And Then there was JavaScript](http://www.youtube.com/watch?v=RO1Wnu-xKoY&feature=plcp)
3.  [Function the
Ultimate](http://www.youtube.com/watch?v=ya4UHuXNygM&feature=plcp) - also see the [slides](http://www.slideshare.net/douglascrockford/3-7687071/74)
4.  [The Metamorphosis of Ajax](http://www.youtube.com/watch?v=Fv9qT9joc0M&feature=plcp)
5.  [The End of All Things](http://www.youtube.com/watch?v=47Ceot8yqeI&feature=plcp)
6.  [Loopage](http://www.youtube.com/watch?v=QgwSUtYSUqA&feature=plcp)
7.  [EMCAScript 5: The New Parts](http://www.youtube.com/watch?v=UTEqr0IlFKY&feature=plcp) 
8.  [Programming Style & Your Brain](http://www.youtube.com/watch?v=taaEzHI9xyY&feature=plcp)

JavaScript Style Enforcer - JSLint
----------------------------------
JSLint is a program you run that examines your JavaScript code
and offers stylistic improvements according to Douglas
Crockford's ideas of best practice. One thing's for sure - if
you're a junior JavaScript developer, JSLint can inform your
your style. 

While the tool is most often used [online](http://www.jslint.com/), it really is most valuable on the command line to decrease the iterative improvement round trip time. To get it working you should probably install node.js, a server-side javascript language that comes with its own package manager. For the time being (last updated 2012-07-17), these instructions will install jslint on the command line in the CS50 appliance:

    sudo su
    yum localinstall --nogpgcheck http://nodejs.tchol.org/repocfg/fedora/nodejs-stable-release.noarch.rpm
    yum install nodejs-compat-symlinks npm
    npm install -g jslint

Once you get it working, if you're a vim chick like me, you'll
want to integrate jslint into vim to get great feedback. To do
that you'll need to set errorformat like in the .vimrc document
in this folder. If you want, you can copy the .vimrc in the same
folder as this readme into your home directory: cp .vimrc
~/.vimrc. Then in vim you should be able to enter F4 and start to get
some great output from jslint. You can use :cn and :cN to move
forward/backward through the quickfix list, respectively. You may
find [the list of JSLint error messages](http://goo.gl/APTVi) valuable.

JavaScript Documentation Generation 
-----------------------------------
So you want to write documentation for your JavaScript just like for PHP or Java? Enter [yuidoc](http://yui.github.com/yuidoc/).

JavaScript Semicolon Insertion
------------------------------
See [this](http://inimino.org/~inimino/blog/javascript_semicolons).

JavaScript Online Testing Ground: JSFiddle
------------------------------------------
Sometimes you need to demonstrate something as an isolated proof
of concept. JSFiddle lets you use standard libraries such as
MooTools and JQuery, and even store your JavaScript examples
online. See [this example](http://jsfiddle.net/MpBE3/) of how to
avoid the JSLint error "[Don't make functions within a
loop](http://goo.gl/RDslK)."

PHP 
===

PHP Documentaiton Generation
------------------------
So you want to have class documentation generated like with JavaDoc? Check out [phpDocumentor](http://www.phpdoc.org/).

Regular Expressions
===================

[This](http://gskinner.com/RegExr/) ajaxy regex selector
is one of many useful tools I use to for quick screen scraping. 
[Here](http://chris.photobooks.com/regex/default.htm) is
another one by Chris Neilson.

XPath
=====

Google Chrome
-------------
If you use Google's Chrome browser, the
[Scraper](https://chrome.google.com/webstore/detail/mbigbapnjcgaffohmbkdlecaccepngjd)
tool is really great at helping extract an XPath used to
find a particular element.

Also, Google Chrome's DOM displayer has XPath support
baked into its search field - just press `Ctrl+Shift+C` to
bring up the developer console, then start typing an xpath
expression to bring up a match.

[This](http://www.bit-101.com/xpath/) is currently my
favorite online XPath tool.

[Chris Neilson's XPath and XML
Tools](http://chris.photobooks.com/xml/default.htm) works
really well for conducting xPath queries online. He also
has a tool for [visualizing xpath
queries](http://chris.photobooks.com/regex/default.htm)
and [visualizing
json](http://chris.photobooks.com/json/default.htm).

I find [Stylus Studio's XPath
reference](http://www.stylusstudio.com/docs/v62/d_xpath15.html)
pretty helpful when I'm searching for an XPath function.


