set :application, 'lw-dev.simplebitdesign.com'
set :deploy_to, '/home/152547/users/.home/domains/lw-dev.simplebitdesign.com/'
set :branch, 'staging'

server 'simplebitdesign.com', user: 'simplebitdesign.com', roles: %w{web app}

# Only update gridserver symlinks on staging
after 'deploy:publishing', 'gridserver:create_relative_symlinks'
