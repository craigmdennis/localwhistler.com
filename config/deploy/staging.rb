set :application, 'lw-dev.simplebitdesign.com'
set :deploy_to, '/home/152547/users/.home/domains/lw-dev.simplebitdesign.com/'
set :branch, 'staging'

set :scm, :git
set :deploy_via, :remote_cache
set :copy_exclude, [".git", ".DS_Store", ".gitignore", ".gitmodules"]

server 'simplebitdesign.com', user: 'simplebitdesign.com', roles: %w{web app}

namespace :localwhister do
    task :symlink, :roles => :app do
        run "ln -nfs #{shared_path}/uploads #{release_path}/content/uploads"
    end
end

after "deploy:symlink", "localwhister:symlink"
