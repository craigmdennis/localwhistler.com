# config valid only for Capistrano 3.1
lock '3.1.0'

# set :application, 'dev.simplebitdesign.com'
set :repo_url, 'git@bitbucket.org:simplebitdesign/localwhistler.com.git'

# Default branch is :master
ask :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }

set :scm, :git
set :deploy_via, :remote_cache
set :copy_exclude, [".git", ".DS_Store", ".gitignore", ".gitmodules"]

# Local Whistler specific tasks namespaced to reduce conflict
namespace :localwhister do

  desc 'Point uploads directory to shared folder'
  task :symlink do
    on roles(:app), in: :groups do
      execute "cd '#{release_path}/content' && ln -nfs '../../../shared/uploads' 'uploads'"
    end
  end

  desc 'Point cache directory to shared folder'
  task :symlink do
    on roles(:app), in: :groups do
      execute "cd '#{release_path}/content' && ln -nfs '../../../shared/cache' 'cache'"
    end
  end

end

after 'deploy:symlink:release', 'localwhister:symlink'

# Change abolute symlinks to relative
after 'deploy:publishing', 'gridserver:create_relative_symlinks'
