# Local Whistler
### A local business directory for Whistler

You will need:
- Bundler
- Node.js
- Bower
- GIT
- Compass

## Installing dependencies
- Run `npm install`
- Run `bundle install`
- Run `bower install`

## Developing
- Make sure you have Apache running
- Set up a virtul host for localwhistler.local
- Run `grunt serve` to compile templates

## Building
- Run `grunt build` to compile templates, minify and concat as well as other cool stuff.

## Releasing
Please use the [changelog syntax][1] in commit messages
- Run `grunt bump-only:minor` to version the new release
- Run `grunt changelog` to update the changelog
- Run `grunt bump-commit` to push the changes to master

## Deploying
- Update your development server credentials in `/config/deploy.rb`
- Run `bundle exec cap staging deploy` to deploy a version to staging server
- Run `bundle exec cap production deploy` to deploy to production server


## Rolling Back
You can roll back a version if you make a mistake
- Run `bundle exec cap production deploy:rollbak`


[1]:https://docs.google.com/document/d/1QrDFcIiPjSLDn3EL15IJygNPiHORgU1_OOAqWjiDU5Y/edit
