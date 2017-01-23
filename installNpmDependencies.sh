#!bin/bash
#check for npm and node requirements
command -v npm >/dev/null 2>&1 || { echo >&2 "I require npm but it's not installed.\nAborting."; exit 1; }
command -v node >/dev/null 2>&1 || { echo >&2 "I require node but it's not installed.\nOn Ubuntu a symlink to nodejs has to be established due to legacy reasons, like: sudo ln -s /usr/bin/nodejs /usr/bin/node \nAborting."; exit 1; }

sudo npm install -g gulp
sudo npm install -g gulp-concat
sudo npm install -g gulp-imagemin
sudo npm install -g gulp-less
sudo npm install -g gulp-minify-css
sudo npm install -g gulp-notify
sudo npm install -g gulp-uglify
sudo npm install -g gulp-util
sudo npm install -g gulp-watch
npm install gulp
npm install gulp-concat
npm install gulp-imagemin
npm install gulp-less
npm install gulp-minify-css
npm install gulp-notify
npm install gulp-uglify
npm install gulp-util
npm install gulp-watch
exit 0
