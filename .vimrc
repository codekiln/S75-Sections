
set textwidth=65
set foldmethod=marker
set formatoptions+=t
set wrap
set expandtab
set shiftwidth=2
set softtabstop=2

nmap <F4> :w<CR>:make<CR>:cw<CR>

" see http://technotales.wordpress.com/2011/05/21/node-jslint-and-vim/
set makeprg=jslint\ %
"set errorformat=%-P%f,
"                    \%-G/*jslint\ %.%#*/,
"                    \%*[\ ]%n\ %l\\,%c:\ %m,
"                    \%-G\ \ \ \ %.%#,
"                    \%-GNo\ errors\ found.,
"                    \%-Q
set errorformat=%-P%f,
                    \%E%>\ #%n\ %m,%Z%.%#Line\ %l\\,\ Pos\ %c,
                    \%-G%f\ is\ OK.,%-Q
