set :application, 'localwhistler.com'
set :deploy_to, '/home/localwhistler/'
set :branch, 'master'
set :tmp_dir, "/home/localwhistler/tmp"

server '23.229.194.226', user: 'localwhistler', roles: %w{web app}
