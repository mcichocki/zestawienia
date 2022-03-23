#!/bin/sh

tmux new-session -s orders ./app.sh \; split-window -v -p 35 ./node.sh yarn dev --watch \; split-window -h -p 50 ./mysql.sh \; select-pane -t 0 \; split-window -h -p 50 \;

#$tmux = "tmux";
#$w_app = './app.sh';
#$w_node = './node.sh yarn dev --watch';
#$w_mysql = './mysql.sh';
#
#$tmux new-session -s stan-mienia $w_app \;
#$tmux split-window -v -p 35 $w_node \;
#$tmux split-window -h -p 50 $w_mysql \;
#$tmux split-window -h -p 50 \;
#$tmux setw -g pane-base-index 0;


# tmux ctrl + w                       | windows
# tmux ctrl + b d                     | detach from session
# tmux kill-ses -t mysession          | kill session mysession
# tmux kill-session -a                | kill all current sessions
# tmux attach-session -t mysession    |
# tmux ctrl + b s 
# tmux list-sessions                  | show all sessions
# CTRL-b "          split vertically (top/bottom)
# CTRL-b %          split horizontally (left/right)
