# config valid only for Capistrano 3.1
lock '3.1.0'

# set :application, 'dev.simplebitdesign.com'
set :repo_url, 'git@bitbucket.org:simplebitdesign/localwhistler.com.git'

# Default branch is :master
ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }

set :scm, :git
set :deploy_via, :remote_cache
set :copy_exclude, [".git", ".DS_Store", ".gitignore", ".gitmodules"]

namespace :deploy do

  desc 'Restart application'
  task :restart do
    on roles(:app), in: :sequence, wait: 5 do
      # Your restart mechanism here, for example:
      # execute :touch, release_path.join('tmp/restart.txt')
    end
  end

  # desc "Backup MySQL Database"
  # task :mysqlbackup do
  #   on roles(:app), in: :groups do
  #     run "mysqldump -u#{db_username} -p#{db_password} #{db_database} > #{shared_path}/backups/#{release_name}.sql"
  #   end
  # end

  after :publishing, :restart

  after :restart, :clear_cache do
    on roles(:web), in: :groups, limit: 3, wait: 10 do
      # Here we can do anything such as:
      # within release_path do
      #   execute :rake, 'cache:clear'
      # end
    end
  end

end

# Local Whistler specific tasks namespaced to reduce conflict
namespace :localwhister do

  desc 'Point uploads directory to shared folder'
  task :symlink do
    on roles(:app), in: :groups do
      execute "cd '#{release_path}/content' && ln -nfs '#{shared_path}/uploads' 'uploads'"
    end
  end

end

after 'deploy:symlink:release', 'localwhister:symlink'
