set :application, 'lw-dev.simplebitdesign.com'
set :deploy_to, '/home/152547/users/.home/domains/lw-dev.simplebitdesign.com/'
set :branch, 'develop'

server 'simplebitdesign.com', user: 'simplebitdesign.com', roles: %w{web app}

# Local Whistler specific tasks namespaced to reduce conflict
namespace :localwhister do

  desc 'Make a staging file'
  task :staging do
    on roles(:app), in: :groups do
      execute "touch #{release_path}/env_staging"
    end
  end

end

after 'deploy:updated', 'localwhister:staging'
