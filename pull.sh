eval "$(ssh-agent -s)" &>> pull.log
ssh-add deploy_key &>> pull.log
git pull -v --ff-only 2&>1 | tee pull.log
