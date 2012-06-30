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
   git://github.com/codekiln/S75-Sections.git find
   ~/public_html -type d -print0 | xargs -0 chmod 755

Git will then download the latest update to the section
examples.  You may need to infer the correct permissions
and use the ls and chmod commands to get the examples to
display in your appliance.  Once the permissions are
right, you can see each section's example folder by opening a
browser in the appliance and going to:

   http://localhost/~jharvard/S75-Sections/

To update to the latest version of the examples from
section:

   cd ~/public_html/S75-Sections git pull

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

http://www.yuiblog.com/blog/2011/06/09/video-f2esummit2011-donnelly/

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

    export PS1='\[\e[1;33m\] \w\[\e[1;36m\]$(git branch &>/dev/null; if [ $? -eq 0 ]; then echo " ($(git branch | grep '^*' |sed s/\*\ //))"; fi) \[\e[1;37m\]$PS1_END_SIGN\[\e[00m\] '

If you don't like the way it looks, just exit the terminal and
open it up again.  Do you like the way it looks? Then edit
~/.bash_profile and add that line to the end, save, and enter:

    source ~/.bash_profile

Now you have the name of your git branch in your bash prompt. If
you are curious about how this display stuff works, google "Bash
PS1". 
