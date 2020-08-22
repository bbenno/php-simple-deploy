eval "$(ssh-agent -s)" &>> .logs/pull.log
ssh-add deploy_key &>> .logs/pull.log
git pull -v --ff-only 2&>1 | tee .logs/pull.log
