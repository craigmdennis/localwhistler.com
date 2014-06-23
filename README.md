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

## GIT
- Files are stored in a git repository. Contact support@simplebitdesign.com for access.
- Branches are maintained as follows:
  - Master: Bleeding edge. **Not stable**.
  - Staging: Stable but may need some hotfixes.
  - Production: Production ready code.
- If you are developing a feature:
  1. Create a new branch `git checkout -b feature_some_description` (when 'some_feature' is a meaningful name for the feature)
  2. Push changes to the new branch
  3. Submit a pull request to staging.
  4. A new release will be deployed to the staging server where it will be tested before being tagged and merged with `production`.
- If you find a bug in the production branch please:
  1. Create an issue in the repository.
  2. Stash any local changes, pull any updates and checkout the staging branch. Create a new branch called `hotfix_issue#`
  3. Fix the issue and push to that branch
  4. Submit a pull request to staging.
  5. A new release will be deployed to the staging server where it will be tested before being tagged and merged with `production`.

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
