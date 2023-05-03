# ~/.bashrc: executed by bash(1) for non-login shells.

# Note: PS1 and umask are already set in /etc/profile. You should not
# need this unless you want different defaults for root.
# PS1='${debian_chroot:+($debian_chroot)}\h:\w\$ '
# umask 022

# You may uncomment the following lines if you want `ls' to be colorized:
# export LS_OPTIONS='--color=auto'
# eval "$(dircolors)"
# alias ls='ls $LS_OPTIONS'
# alias ll='ls $LS_OPTIONS -l'
# alias l='ls $LS_OPTIONS -lA'
#
# Some more alias to avoid making mistakes:
alias rm='rm -i'
alias cp='cp -i'
alias mv='mv -i'

# Custom aliases
alias cc='composer code-check'
alias clf='composer lint-fix'
alias cl='composer lint'
alias pa='php artisan'
alias pat='php artisan test'
alias parc='php artisan route:cache'
alias parl='php artisan route:list'
alias paoc='php artisan optimize:clear'
alias paswag='php artisan l5-swagger:generate'
alias pam='php artisan migrate'
alias pamfs='php artisan migrate:fresh --seed'
alias padbs='php artisan db:seed'
alias pai='php artisan inspire'
alias pacc='php artisan config:cache'
alias patink='php artisan tinker'