set :application, 'localwhistler.com'
set :deploy_to, '/home/localwhistler/'
set :branch, 'master'
set :tmp_dir, "/home/localwhistler/tmp"

server 'localwhistler.com', user: 'localwhistler', roles: %w{web app}

# Local Whistler specific tasks namespaced to reduce conflict
namespace :localwhister do

  desc 'Make a production file'
  task :production do
    on roles(:app), in: :groups do
      execute "touch #{release_path}/env_production"
    end
  end

end

after 'deploy:updated', 'localwhister:production'
