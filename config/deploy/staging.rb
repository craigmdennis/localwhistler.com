set :application, 'lw-dev.simplebitdesign.com'
set :deploy_to, '/home/152547/users/.home/domains/lw-dev.simplebitdesign.com/'
set :branch, 'staging'

server 'simplebitdesign.com', user: 'simplebitdesign.com', roles: %w{web app}

namespace :localwhistler do
    task :symlink, :roles => :app do
        run "ln -nfs /home/152547/users/.home/domains/lw-dev.simplebitdesign.com/shared/uploads /home/152547/users/.home/domains/lw-dev.simplebitdesign.com/current/content/uploads"
    end
end

after "deploy:symlink", "localwhistler:symlink"
