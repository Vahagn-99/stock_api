export PATH=$HOME/bin:$PATH

export ZSH="$HOME/.oh-my-zsh"

ZSH_THEME="frontcube"

zstyle ':omz:update' mode disabled

DISABLE_UNTRACKED_FILES_DIRTY="true"

plugins=(
    git
    zsh-syntax-highlighting
    zsh-autosuggestions
)

source $ZSH/oh-my-zsh.sh